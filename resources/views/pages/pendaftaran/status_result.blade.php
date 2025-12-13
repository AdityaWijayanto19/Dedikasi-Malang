<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Status Pendaftaran | {{ $pendaftaran->full_name }}</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.svg') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    @vite('resources/css/app.css')

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .brand-color {
            background-color: #E9C153;
        }

        .brand-text {
            color: #E9C153;
        }

        .brand-hover:hover {
            background-color: #f7d46c;
        }

        .status-card-yellow {
            background: linear-gradient(135deg, #fffbeb, #E9C153);
            border: 2px solid #eab308;
        }

        .status-card-green {
            background: linear-gradient(135deg, #a7f3d0, #34d399);
            border: 2px solid #059669;
        }

        .status-card-red {
            background: linear-gradient(135deg, #fecaca, #f87171);
            border: 2px solid #dc2626;
        }

        .status-card-gray {
            background: linear-gradient(135deg, #f3f4f6, #d1d5db);
            border: 2px solid #6b7280;
        }

        .double-logo-background {
            background-image:
                url('/assets/logoDedikasi.png'),
                url('/assets/logoDedikasi.png');
            background-size: 100vh auto, 100vh auto;

            background-position:
                right -48vh center,
                left -51vh center;

            background-repeat: no-repeat;
            opacity: 0.1;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -20;
            pointer-events: none;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">

    <div class="double-logo-background"></div>

    @php
        $status = $pendaftaran->status;
        $colorName = [
            'pending' => 'yellow',
            'accepted' => 'green',
            'rejected' => 'red',
        ][$status] ?? 'gray';

        $baseColor = match ($colorName) {
            'yellow' => 'amber',
            'green' => 'emerald',
            'red' => 'red',
            default => 'gray',
        };

        $whatsappLink = $kegiatan->link_whatsapp_group;
        $adminContactNumber = '6281234567890';
        $adminWhatsappLink = 'https://wa.me/' . $adminContactNumber;

        $message = [
            'pending' => 'Terima kasih, data Anda telah kami terima dan sedang dalam proses verifikasi. Mohon tunggu informasi selanjutnya.',
            'rejected' => 'Mohon maaf, pendaftaran Anda belum dapat kami terima. Jika Anda memiliki pertanyaan atau ingin mengajukan banding, silakan hubungi Admin Panitia di bawah ini.',
        ][$status] ?? 'Status tidak dikenali.';

        if ($status === 'accepted') {
            if ($whatsappLink) {
                $message = 'SELAMAT! Pendaftaran Anda untuk kegiatan ini telah **DITERIMA**. Silakan segera gabung ke grup WhatsApp di bawah untuk mendapatkan informasi teknis dan jadwal selanjutnya.';
            } else {
                $message = 'SELAMAT! Pendaftaran Anda untuk kegiatan ini telah **DITERIMA**. Informasi teknis akan dikirimkan melalui email atau diumumkan kemudian. (Link Grup WhatsApp belum tersedia dari Admin).';
            }
        }

        $iconClass = [
            'pending' => 'fas fa-clock text-amber-600',
            'accepted' => 'fas fa-check-circle text-emerald-600',
            'rejected' => 'fas fa-times-circle text-red-600',
        ][$status] ?? 'fas fa-question-circle text-gray-600';
    @endphp


    <div
        class="w-full max-w-xl mx-auto bg-white rounded-3xl shadow-2xl overflow-hidden transform transition-all duration-500 hover:shadow-3xl relative z-10">

        <div class="p-8 sm:p-10 text-white text-center status-card-{{ $colorName }}">

            <div class="mb-4">
                <i class="{{ $iconClass }} text-7xl 
                    @if ($status === 'pending') animate-pulse @endif
                    @if ($status === 'accepted') animate-bounce @endif
                "></i>
            </div>

            <h1 class="text-4xl sm:text-5xl font-extrabold drop-shadow-md tracking-wider uppercase text-gray-800">
                {{ $status }}
            </h1>
            <p class="mt-2 text-sm font-semibold text-gray-700">Status Pendaftaran Anda</p>
        </div>

        <div class="p-8 sm:p-10 text-center">

            <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $pendaftaran->full_name }}</h2>
            <p class="text-md text-gray-500 mb-6">Untuk Kegiatan: **{{ $kegiatan->title }}**</p>

            <div class="mb-8 p-4 bg-{{ $baseColor }}-50 rounded-xl border border-dashed border-{{ $baseColor }}-200">
                <p class="text-lg text-gray-700 italic leading-relaxed">{!! $message !!}</p>
            </div>

            @if ($status === 'accepted' && $whatsappLink)
                <div
                    class="mb-8 p-4 bg-emerald-100 border-2 border-emerald-400 rounded-xl shadow-lg transform hover:scale-[1.03] transition duration-300">
                    <p class="text-lg font-bold text-emerald-700 mb-3">Langkah Selanjutnya:</p>
                    <a href="{{ $whatsappLink }}" target="_blank"
                        class="w-full inline-flex items-center justify-center px-4 py-3 text-lg font-bold rounded-xl shadow-md text-white bg-emerald-600 hover:bg-emerald-700 transition duration-300">
                        <i class="fab fa-whatsapp text-2xl mr-3"></i> GABUNG GRUP WHATSAPP SEKARANG
                    </a>
                    <p class="text-xs text-gray-500 mt-2">Ketuk tautan di atas untuk mendapatkan detail kegiatan.</p>
                </div>
            @endif

            <div class="space-y-3">

                @if ($status === 'rejected')
                    <a href="{{ $adminWhatsappLink }}" target="_blank"
                        class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-xl shadow-sm text-white bg-red-600 hover:bg-red-700 transition duration-300 transform hover:scale-[1.02] font-bold">
                        <i class="fab fa-whatsapp mr-2"></i> HUBUNGI ADMIN PANITIA
                    </a>
                    <p class="text-xs text-red-500 mt-1 mb-3">Tekan tombol di atas untuk menghubungi Admin terkait status
                        Anda.</p>
                @endif

                <a href="{{ route('pages.kegiatan.index') }}"
                    class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-xl shadow-sm text-white brand-color hover:bg-yellow-600 transition duration-300 transform hover:scale-[1.02]">
                    <i class="fas fa-home mr-2"></i> Kembali ke Halaman Utama
                </a>

                <a href="{{ route('pendaftaran.status.form', $kegiatan) }}"
                    class="w-full inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-100 transition duration-300">
                    <i class="fas fa-search mr-2"></i> Cek status pendaftar lain
                </a>
            </div>

        </div>

        <div class="p-4 bg-gray-100 text-center text-xs text-gray-400">
            Pastikan Anda mencatat status ini. Semua informasi akan dikirimkan melalui kontak terdaftar.
        </div>
    </div>

</body>

</html>