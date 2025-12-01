<?php

namespace App\Http\Controllers;

use App\Models\GalleryCarousel;
use App\Models\GalleryImage;
use App\Models\GalleryVideo;
use App\Models\GalleryMusic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminGalleryController extends Controller
{
    // Carousel Management
    public function carouselIndex(Request $request)
    {
        $carousels = GalleryCarousel::ordered()->paginate(25);
        
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'html' => view('admin.gallery.carousel.table', compact('carousels'))->render(),
                'pagination' => view('components.pagination', ['paginator' => $carousels])->render()
            ]);
        }
        
        return view('admin.gallery.carousel.index', compact('carousels'));
    }

    public function carouselCreate()
    {
        return view('admin.gallery.carousel.create');
    }

    public function carouselStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer|min:0'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_carousel_' . $image->getClientOriginalName();
            $image->move(public_path('images/galeri/carousel'), $imageName);
            $validated['image'] = 'images/galeri/carousel/' . $imageName;
        }

        $validated['is_active'] = $request->input('is_active', 0) == 1;

        GalleryCarousel::create($validated);

        return redirect()->route('admin.gallery.carousel.index')
            ->with('success', 'Carousel berhasil ditambahkan!');
    }

    public function carouselEdit(GalleryCarousel $carousel)
    {
        return view('admin.gallery.carousel.edit', compact('carousel'));
    }

    public function carouselUpdate(Request $request, GalleryCarousel $carousel)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer|min:0'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($carousel->image && file_exists(public_path($carousel->image))) {
                unlink(public_path($carousel->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_carousel_' . $image->getClientOriginalName();
            $image->move(public_path('images/galeri/carousel'), $imageName);
            $validated['image'] = 'images/galeri/carousel/' . $imageName;
        }

        $validated['is_active'] = $request->input('is_active', 0) == 1;

        $carousel->update($validated);

        return redirect()->route('admin.gallery.carousel.index')
            ->with('success', 'Carousel berhasil diperbarui!');
    }

    public function carouselDestroy(GalleryCarousel $carousel)
    {
        if ($carousel->image && file_exists(public_path($carousel->image))) {
            unlink(public_path($carousel->image));
        }

        $carousel->delete();

        return redirect()->route('admin.gallery.carousel.index')
            ->with('success', 'Carousel berhasil dihapus!');
    }

    // Image Gallery Management
    public function imageIndex(Request $request)
    {
        $images = GalleryImage::latest()->paginate(25);
        
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'html' => view('admin.gallery.image.table', compact('images'))->render(),
                'pagination' => view('components.pagination', ['paginator' => $images])->render()
            ]);
        }
        
        return view('admin.gallery.image.index', compact('images'));
    }

    public function imageCreate()
    {
        return view('admin.gallery.image.create');
    }

    public function imageStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_gallery_' . $image->getClientOriginalName();
            $image->move(public_path('images/galeri/FOTO'), $imageName);
            $validated['image'] = 'images/galeri/FOTO/' . $imageName;
        }

        $validated['is_active'] = $request->input('is_active', 0) == 1;

        GalleryImage::create($validated);

        return redirect()->route('admin.gallery.image.index')
            ->with('success', 'Gambar berhasil ditambahkan!');
    }

    public function imageEdit(GalleryImage $image)
    {
        return view('admin.gallery.image.edit', compact('image'));
    }

    public function imageUpdate(Request $request, GalleryImage $image)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($image->image && file_exists(public_path($image->image))) {
                unlink(public_path($image->image));
            }

            $imageFile = $request->file('image');
            $imageName = time() . '_gallery_' . $imageFile->getClientOriginalName();
            $imageFile->move(public_path('images/galeri/FOTO'), $imageName);
            $validated['image'] = 'images/galeri/FOTO/' . $imageName;
        }

        $validated['is_active'] = $request->input('is_active', 0) == 1;

        $image->update($validated);

        return redirect()->route('admin.gallery.image.index')
            ->with('success', 'Gambar berhasil diperbarui!');
    }

    public function imageDestroy(GalleryImage $image)
    {
        if ($image->image && file_exists(public_path($image->image))) {
            unlink(public_path($image->image));
        }

        $image->delete();

        return redirect()->route('admin.gallery.image.index')
            ->with('success', 'Gambar berhasil dihapus!');
    }

    // Video Gallery Management
    public function videoIndex(Request $request)
    {
        $videos = GalleryVideo::latest()->paginate(25);
        
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'html' => view('admin.gallery.video.table', compact('videos'))->render(),
                'pagination' => view('components.pagination', ['paginator' => $videos])->render()
            ]);
        }
        
        return view('admin.gallery.video.index', compact('videos'));
    }

    public function videoCreate()
    {
        return view('admin.gallery.video.create');
    }

    public function videoStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url' => 'required|url'
        ]);

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time() . '_video_thumb_' . $thumbnail->getClientOriginalName();
            $thumbnail->move(public_path('images/galeri/video'), $thumbnailName);
            $validated['thumbnail'] = 'images/galeri/video/' . $thumbnailName;
        }

        $validated['is_active'] = $request->input('is_active', 0) == 1;

        GalleryVideo::create($validated);

        return redirect()->route('admin.gallery.video.index')
            ->with('success', 'Video berhasil ditambahkan!');
    }

    public function videoEdit(GalleryVideo $video)
    {
        return view('admin.gallery.video.edit', compact('video'));
    }

    public function videoUpdate(Request $request, GalleryVideo $video)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url' => 'required|url'
        ]);

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($video->thumbnail && file_exists(public_path($video->thumbnail))) {
                unlink(public_path($video->thumbnail));
            }

            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time() . '_video_thumb_' . $thumbnail->getClientOriginalName();
            $thumbnail->move(public_path('images/galeri/video'), $thumbnailName);
            $validated['thumbnail'] = 'images/galeri/video/' . $thumbnailName;
        }

        $validated['is_active'] = $request->input('is_active', 0) == 1;

        $video->update($validated);

        return redirect()->route('admin.gallery.video.index')
            ->with('success', 'Video berhasil diperbarui!');
    }

    public function videoDestroy(GalleryVideo $video)
    {
        if ($video->thumbnail && file_exists(public_path($video->thumbnail))) {
            unlink(public_path($video->thumbnail));
        }

        $video->delete();

        return redirect()->route('admin.gallery.video.index')
            ->with('success', 'Video berhasil dihapus!');
    }

    // Music Gallery Management
    public function musicIndex(Request $request)
    {
        $music = GalleryMusic::latest()->paginate(25);
        
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'html' => view('admin.gallery.music.table', compact('music'))->render(),
                'pagination' => view('components.pagination', ['paginator' => $music])->render()
            ]);
        }
        
        return view('admin.gallery.music.index', compact('music'));
    }

    public function musicCreate()
    {
        return view('admin.gallery.music.create');
    }

    public function musicStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'audio_file' => 'required|mimes:mp3,wav,ogg|max:10240'
        ]);

        if ($request->hasFile('audio_file')) {
            $audio = $request->file('audio_file');
            $audioName = time() . '_music_' . $audio->getClientOriginalName();
            $audio->move(public_path('audio/galeri'), $audioName);
            $validated['audio_file'] = 'audio/galeri/' . $audioName;
        }

        $validated['is_active'] = $request->input('is_active', 0) == 1;

        GalleryMusic::create($validated);

        return redirect()->route('admin.gallery.music.index')
            ->with('success', 'Musik berhasil ditambahkan!');
    }

    public function musicEdit(GalleryMusic $music)
    {
        return view('admin.gallery.music.edit', compact('music'));
    }

    public function musicUpdate(Request $request, GalleryMusic $music)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'audio_file' => 'nullable|mimes:mp3,wav,ogg|max:10240'
        ]);

        if ($request->hasFile('audio_file')) {
            // Delete old audio file
            if ($music->audio_file && file_exists(public_path($music->audio_file))) {
                unlink(public_path($music->audio_file));
            }

            $audio = $request->file('audio_file');
            $audioName = time() . '_music_' . $audio->getClientOriginalName();
            $audio->move(public_path('audio/galeri'), $audioName);
            $validated['audio_file'] = 'audio/galeri/' . $audioName;
        }

        $validated['is_active'] = $request->input('is_active', 0) == 1;

        $music->update($validated);

        return redirect()->route('admin.gallery.music.index')
            ->with('success', 'Musik berhasil diperbarui!');
    }

    public function musicDestroy(GalleryMusic $music)
    {
        if ($music->audio_file && file_exists(public_path($music->audio_file))) {
            unlink(public_path($music->audio_file));
        }

        $music->delete();

        return redirect()->route('admin.gallery.music.index')
            ->with('success', 'Musik berhasil dihapus!');
    }
}
