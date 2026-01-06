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
