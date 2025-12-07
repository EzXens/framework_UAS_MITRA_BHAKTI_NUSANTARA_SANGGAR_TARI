<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        @page {
            margin: 0;
        }

        body {
            margin: 0;
            font-family: "Times New Roman", serif;
            font-size: 12pt;
        }

        /* KOP HANYA SEBAGAI BACKGROUND */
        .page {
            width: 100%;
            height: 100%;
            background-image: url("data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/surat/kop_surat.png'))) }}");
            background-repeat: no-repeat;
            background-position: top center;
            background-size: 100% 100%;
            box-sizing: border-box;
        }

                .content {
            position: absolute;
            top: 160px;     /* ✅ JARAK DARI KOP */
            left: 0;
            right: 0;
            padding: 0 50px;
        }

        .tanggal-kanan {
        width: 100%;
        text-align: right;
        margin-top: 10px;
        margin-bottom: 20px;
        font-size: 12pt;
    }


        
    </style>

{{-- <style>
@page {
    margin: 0;
}

body {
    margin: 0;
    font-family: "Times New Roman", serif;
    font-size: 12pt;
    line-height: 1.6;
}

/* HALAMAN */
.page {
    width: 100%;
    
    /* ❌ JANGAN pakai height / vh */
    
    background-image: url("data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/surat/kop_surat.png'))) }}");
    background-repeat: no-repeat;
    background-position: top center;
    background-size: 100% auto;

    box-sizing: border-box;

    /* ✅ JARAK DARI KOP — AMAN, TIDAK PECAH HALAMAN */
    padding-top: 170px;

    /* ✅ AMAN UNTUK KANAN & BAWAH */
    padding-left: 55px;
    padding-right: 55px;
    padding-bottom: 70px;
}

/* ISI */
.content {
    text-align: justify;
    width: 100%;
}

/* PARAGRAF */
p {
    margin: 0 0 12px 0;
}

/* TABEL */
table {
    width: 100%;
    border-collapse: collapse;
}

td {
    padding: 2px 0;
    vertical-align: top;
}

/* ✅✅✅ PAKSA SEMUA FORMAT WORD KEMBALI ✅✅✅ */
b, strong {
    font-weight: bold !important;
}

u {
    text-decoration: underline !important;
}

i, em {
    font-style: italic !important;
}

/* ✅ untuk kasus Word pakai span */
span[style*="font-weight"] {
    font-weight: bold !important;
}

span[style*="underline"] {
    text-decoration: underline !important;
}
</style> --}}

</head>
<body>

    <div class="page">
        <div class="content">
            {!! $htmlContent !!}

            <div class="tanggal-kanan">
                Samarinda, {{ $tanggalSurat }}
            </div>

        </div>
    </div>

</body>
</html>
