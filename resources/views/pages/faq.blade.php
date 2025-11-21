@extends('layouts.app')

@section('title', 'FAQ')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-heading font-bold text-neutral-900 mb-4">Pertanyaan yang Sering Diajukan</h1>
        <p class="text-neutral-600">Temukan jawaban untuk pertanyaan umum tentang JerukPin</p>
    </div>

    <div class="space-y-4">
        <!-- FAQ Item -->
        <details class="bg-white rounded-lg shadow-sm">
            <summary class="px-6 py-4 cursor-pointer font-bold text-neutral-900 hover:text-primary-600">
                Bagaimana cara memesan jeruk di JerukPin?
            </summary>
            <div class="px-6 pb-4 text-neutral-600">
                <p>Anda dapat memesan dengan mudah melalui website kami. Pilih produk yang diinginkan, tambahkan ke keranjang, lalu lakukan checkout. Anda bisa berbelanja sebagai tamu atau mendaftar sebagai member untuk kemudahan di pemesanan berikutnya.</p>
            </div>
        </details>

        <details class="bg-white rounded-lg shadow-sm">
            <summary class="px-6 py-4 cursor-pointer font-bold text-neutral-900 hover:text-primary-600">
                Berapa lama waktu pengiriman?
            </summary>
            <div class="px-6 pb-4 text-neutral-600">
                <p>Untuk area Jakarta dan sekitarnya, pengiriman memakan waktu 1-2 hari kerja. Untuk area luar Jakarta, pengiriman memakan waktu 2-4 hari kerja tergantung lokasi.</p>
            </div>
        </details>

        <details class="bg-white rounded-lg shadow-sm">
            <summary class="px-6 py-4 cursor-pointer font-bold text-neutral-900 hover:text-primary-600">
                Metode pembayaran apa saja yang tersedia?
            </summary>
            <div class="px-6 pb-4 text-neutral-600">
                <p>Saat ini kami menerima pembayaran melalui transfer bank (BCA, Mandiri, BNI). Setelah melakukan pemesanan, Anda akan mendapatkan instruksi pembayaran dan dapat mengupload bukti transfer.</p>
            </div>
        </details>

        <details class="bg-white rounded-lg shadow-sm">
            <summary class="px-6 py-4 cursor-pointer font-bold text-neutral-900 hover:text-primary-600">
                Bagaimana cara melacak pesanan saya?
            </summary>
            <div class="px-6 pb-4 text-neutral-600">
                <p>Jika Anda member, Anda dapat melihat status pesanan di halaman "Pesanan Saya". Untuk tamu, gunakan fitur "Lacak Pesanan" dengan memasukkan nomor pesanan dan email yang digunakan saat checkout.</p>
            </div>
        </details>

        <details class="bg-white rounded-lg shadow-sm">
            <summary class="px-6 py-4 cursor-pointer font-bold text-neutral-900 hover:text-primary-600">
                Apakah jeruk dijamin segar?
            </summary>
            <div class="px-6 pb-4 text-neutral-600">
                <p>Ya! Kami menjamin kesegaran jeruk kami. Semua jeruk dipetik langsung dari kebun dan dikirim dalam kondisi segar. Jika ada masalah dengan kualitas produk, silakan hubungi customer service kami.</p>
            </div>
        </details>

        <details class="bg-white rounded-lg shadow-sm">
            <summary class="px-6 py-4 cursor-pointer font-bold text-neutral-900 hover:text-primary-600">
                Apa itu Flash Sale?
            </summary>
            <div class="px-6 pb-4 text-neutral-600">
                <p>Flash Sale adalah promo spesial dengan harga diskon untuk produk tertentu dalam waktu terbatas. Pantau terus halaman Flash Sale kami untuk mendapatkan penawaran terbaik!</p>
            </div>
        </details>

        <details class="bg-white rounded-lg shadow-sm">
            <summary class="px-6 py-4 cursor-pointer font-bold text-neutral-900 hover:text-primary-600">
                Bagaimana jika saya ingin mengembalikan produk?
            </summary>
            <div class="px-6 pb-4 text-neutral-600">
                <p>Kami menerima pengembalian jika produk yang diterima tidak sesuai atau rusak. Silakan hubungi customer service kami dalam 24 jam setelah menerima produk untuk proses pengembalian.</p>
            </div>
        </details>

        <details class="bg-white rounded-lg shadow-sm">
            <summary class="px-6 py-4 cursor-pointer font-bold text-neutral-900 hover:text-primary-600">
                Apakah ada minimum pembelian?
            </summary>
            <div class="px-6 pb-4 text-neutral-600">
                <p>Tidak ada minimum pembelian. Anda dapat memesan mulai dari 1 kg jeruk sesuai kebutuhan Anda.</p>
            </div>
        </details>
    </div>

    <div class="mt-12 bg-primary-50 rounded-lg p-8 text-center">
        <h2 class="text-2xl font-bold text-neutral-900 mb-2">Masih Ada Pertanyaan?</h2>
        <p class="text-neutral-600 mb-4">Tim kami siap membantu Anda!</p>
        <a href="{{ route('contact') }}" class="inline-block bg-primary-500 hover:bg-primary-600 text-white px-8 py-3 rounded-lg font-bold">
            Hubungi Kami
        </a>
    </div>
</div>
@endsection
