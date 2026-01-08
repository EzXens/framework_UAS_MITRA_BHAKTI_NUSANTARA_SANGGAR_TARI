<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlaceRental;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Helpers\DocxGenerator;
use PhpOffice\PhpWord\TemplateProcessor;

class PlaceRentalController extends Controller
{
    /**
     * Display admin list of all place rentals
     */
    public function adminIndex()
    {
        // Only allow admins to view the admin index
        if (auth()->user()->role !== 'admin') {
            abort(403, 'This action is unauthorized.');
        }

        $items = PlaceRental::latest()->paginate(15);
        return view('admin.place-rentals.index', compact('items'));
    }

    /**
     * Show the form for creating a new place rental (Admin Only)
     */
    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'This action is unauthorized.');
        }

        return view('admin.place-rentals.create');
    }

    /**
     * Store a newly created place rental in storage (Admin Only)
     */
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'This action is unauthorized.');
        }

        $validated = $request->validate([
            'to' => 'nullable|string|max:255',
            'activity_name' => 'required|string|max:255',
            'organizer' => 'nullable|string|max:255',
            'place_name' => 'required|string|max:255',
            'rental_purpose' => 'required|string',
            'day' => 'required|string|max:50',
            'date_from' => 'required|date',
            'date_to' => 'nullable|date',
            'time' => 'nullable|string|max:100',
            'city_province' => 'nullable|string|max:255',
        ]);

        PlaceRental::create([
            'user_id' => Auth::id(),
            'to' => $validated['to'] ?? null,
            'activity_name' => $validated['activity_name'],
            'organizer' => $validated['organizer'] ?? null,
            'place_name' => $validated['place_name'],
            'rental_purpose' => $validated['rental_purpose'],
            'day' => $validated['day'],
            'date_from' => $validated['date_from'],
            'date_to' => $validated['date_to'] ?? null,
            'time' => $validated['time'] ?? null,
            'city_province' => $validated['city_province'] ?? null,
            'status' => 'draft',
        ]);

        return redirect()->route('admin.place-rentals.index')->with('success', 'Surat peminjaman tempat berhasil dibuat.');
    }

    /**
     * Display the specified place rental
     */
    public function show(PlaceRental $placeRental)
    {
        $user = auth()->user();
        if ($user->role !== 'admin' && $user->id !== $placeRental->user_id) {
            abort(403, 'This action is unauthorized.');
        }

        return view('admin.place-rentals.show', compact('placeRental'));
    }

    /**
     * Generate DOCX and PDF documents for a place rental
     */
    public function generate(PlaceRental $placeRental)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'This action is unauthorized.');
        }

        try {
            $this->generateDocuments($placeRental);
            return redirect()->back()->with('success', 'Dokumen surat peminjaman berhasil digenerate.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengenerate dokumen: ' . $e->getMessage());
        }
    }

    /**
     * Download DOCX file
     */
    public function downloadDocx(PlaceRental $placeRental)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        if (!$placeRental->template) {
            return redirect()->back()->with('error', 'File DOCX belum digenerate.');
        }

        $path = storage_path('app/public/' . $placeRental->template);
        if (!file_exists($path)) {
            return redirect()->back()->with('error', 'File DOCX tidak ditemukan.');
        }

        return response()->download($path, 'Surat_Peminjaman_' . $placeRental->id . '.docx');
    }
    /**
     * Helper function: format date in Indonesian
     */
    private function tanggalIndo($date)
    {
        $bulan = [
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $tgl = date('j', strtotime($date));
        $bln = $bulan[(int)date('n', strtotime($date))];
        $thn = date('Y', strtotime($date));

        return "$tgl $bln $thn";
    }

    /**
     * Generate DOCX and PDF documents
     * Maps payload to template placeholders
     */
    protected function generateDocuments(PlaceRental $placeRental)
    {
        $templateFile = public_path('images/surat/peminjaman_rumah_adat.docx');

        if (!file_exists($templateFile)) {
            throw new \RuntimeException("Template DOCX tidak ditemukan: {$templateFile}");
        }

        // Load TemplateProcessor
        $template = new TemplateProcessor($templateFile);

        // Generate letter number if not exists
        if (!$placeRental->letter_number) {
            $lastNumber = PlaceRental::whereYear('created_at', date('Y'))
                ->max('letter_number');

            $placeRental->letter_number = $lastNumber ? $lastNumber + 1 : 1;
            $placeRental->save();
        }

        // =============================
        // 1. VARIABEL SESUAI FORMAT TAG
        // =============================
        $variables = [
            'Nomor_Surat' => str_pad($placeRental->letter_number, 2, '0', STR_PAD_LEFT) . '/' . $placeRental->letter_code . '/' . date('Y'),
            'Kepada_Yth' => $placeRental->to ?? '—',
            'Nama_Kegiatan' => $placeRental->activity_name ?? '—',
            'Penyelenggara_Acara' => $placeRental->organizer ?? '—',
            'Nama_Tempat_Peminjaman' => $placeRental->place_name ?? '—',
            'Tujuan_Peminjaman' => $placeRental->rental_purpose ?? '—',
            'Hari' => $placeRental->day ?? '—',
            'Tanggal_Dilaksanakan' => $this->formatTanggalDilaksanakan($placeRental),
            'Waktu' => $placeRental->time ?? '—',
            'Kota_Atau_Provinsi' => $placeRental->city_province ?? '—',
            'Tanggal_Surat' => $this->tanggalIndo(now()),
        ];

        // =============================
        // 2. SET VALUE TEMPLATE
        // =============================
        foreach ($variables as $tag => $value) {
            $template->setValue($tag, $value);
        }

        // =============================
        // 3. Simpan DOCX hasil generate
        // =============================
        $timestamp = time();

        $filename = 'place_rental_' . $placeRental->id . '_' . $timestamp . '.docx';
        $relativePath = 'surat/' . $filename;
        $savePath = storage_path('app/public/' . $relativePath);

        // Pastikan folder ada
        if (!is_dir(dirname($savePath))) {
            mkdir(dirname($savePath), 0755, true);
        }

        // Simpan file DOCX
        $template->saveAs($savePath);

        // Simpan path ke DB dan set status approved
        $placeRental->update(['template' => $relativePath, 'status' => 'approved']);

        return true;
    }

    /**
     * Helper function: format tanggal dilaksanakan
     */
    private function formatTanggalDilaksanakan(PlaceRental $placeRental)
    {
        $months = [1=> 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

        if (!$placeRental->date_from) return '—';
        
        $fromTs = strtotime($placeRental->date_from);
        if ($fromTs === false) return '—';
        
        $fromDay = date('j', $fromTs);
        $fromMonth = (int)date('n', $fromTs);
        $fromYear = date('Y', $fromTs);

        if (!$placeRental->date_to) {
            return $fromDay . ' ' . $months[$fromMonth] . ' ' . $fromYear;
        }

        $toTs = strtotime($placeRental->date_to);
        if ($toTs === false) {
            return $fromDay . ' ' . $months[$fromMonth] . ' ' . $fromYear;
        }
        
        $toDay = date('j', $toTs);
        $toMonth = (int)date('n', $toTs);
        $toYear = date('Y', $toTs);

        // Same year
        if ($fromYear === $toYear) {
            // Same month
            if ($fromMonth === $toMonth) {
                return $fromDay . ' - ' . $toDay . ' ' . $months[$fromMonth] . ' ' . $fromYear;
            }
            // Different month but same year
            return $fromDay . ' ' . $months[$fromMonth] . ' - ' . $toDay . ' ' . $months[$toMonth] . ' ' . $fromYear;
        }

        // Different years
        return $fromDay . ' ' . $months[$fromMonth] . ' ' . $fromYear . ' - ' . $toDay . ' ' . $months[$toMonth] . ' ' . $toYear;
    }
}
