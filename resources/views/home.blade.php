<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student.io - Landing Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
</head>
<body class="body-home hero-bg bg-gray-900">

    <!-- Background Image -->
    <div class="fixed inset-0 bg-cover bg-center opacity-[0.35] -z-10" 
         style="background-image: url('https://images.unsplash.com/photo-1455390582262-044cdead277a?q=80&w=1073&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
    </div>

    <!-- MAIN HERO SECTION -->
    <div class="min-h-screen flex flex-col relative z-10">
        
        <!-- Navbar (Dibuat lebih responsif dengan flex-wrap) -->
        <nav class="flex flex-wrap justify-center gap-4 md:gap-8 py-8 px-4 text-sm font-medium tracking-wide text-white">
            <a href="#student" class="hover:text-blue-400 transition">Apa itu Student.io ?</a>
            <a href="#solusi" class="hover:text-blue-400 transition">Solusi</a>
            <a href="#pelajari" class="hover:text-blue-400 transition">Pelajari</a>
        </nav>

        <main class="flex-grow flex flex-col items-center justify-center text-center px-6">
            <div class="flex flex-col items-center mt-10 md:mt-0">
                <!-- Ukuran font responsif (text-4xl di HP, 6xl di PC) -->
                <h1 class="text-white text-4xl md:text-6xl font-bold tracking-tighter mb-4 max-w-4xl uppercase glow-text">
                    Satu Tempat Untuk Semua Tugas dan Jadwalmu
                </h1>
                <p class="text-white text-base md:text-xl mb-10 max-w-2xl font-light">
                    Ayo kelola jadwal dan tugas-tugas agar lebih mudah
                </p>
                
                <a href="{{ url('/login') }}" class="border border-white text-white px-8 py-3 rounded-full hover:bg-white hover:text-black transition flex items-center gap-2 group">
                    BUAT SEKARANG 
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:translate-x-1 transition-transform">
                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                        <polyline points="15 3 21 3 21 9"></polyline>
                        <line x1="10" y1="14" x2="21" y2="3"></line>
                    </svg>
                </a>
            </div>
        </main>

        <!-- Bottom bar (Dibuat responsif) -->
        <div class="bottom-bar relative z-10 flex flex-wrap justify-center gap-4 py-6 text-xs md:text-sm text-gray-400">
            <a href="#" class="hover:text-white transition">COMMUNITY</a>
            <a href="#" class="hover:text-white transition">INTEGRATION</a>
            <a href="#" class="hover:text-white transition">COLLABORATE</a>
            <a href="#" class="hover:text-white transition">HELP</a>
        </div>
    </div>

    <!-- SECTION 1: Apa itu Student.io -->
    <section id="student" class="min-h-screen flex items-center justify-center relative z-10 px-6 md:px-24 py-16 bg-black/40 backdrop-blur-sm">
        <div class="max-w-6xl w-full flex flex-col md:flex-row items-center justify-between gap-12">
            <div class="md:w-1/2 text-center md:text-left">
                <h2 class="text-white text-3xl md:text-5xl font-bold mb-6 tracking-tight">Apa itu Student.IO?</h2>
                <p class="text-gray-300 text-base md:text-xl leading-relaxed font-light">Student.IO adalah platform yang membantu pelajar dan mahasiswa mengatur tugas, jadwal, dan aktivitas belajar dalam satu tempat. Dengan Student.IO, semua tugas menjadi lebih terorganisir dan mudah dipantau.</p>
            </div>
            <div class="md:w-1/2 flex justify-center">
                <img src="{{ asset('assets/img/photo-1563121661-cd531f4fb8cb.avif') }}" alt="Ilustrasi Student.IO" class="max-w-full h-auto rounded-lg drop-shadow-2xl hover:scale-105 transition-transform duration-500">
            </div>
        </div>
    </section>

    <!-- SECTION 2: Solusi (BAGIAN BARU) -->
    <section id="solusi" class="min-h-screen flex items-center justify-center relative z-10 px-6 md:px-24 py-16">
        <div class="max-w-6xl w-full text-center">
            <h2 class="text-white text-3xl md:text-5xl font-bold mb-12 tracking-tight">Solusi Belajar Lebih Baik</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card Fitur 1 -->
                <div class="bg-white/10 border border-white/20 p-8 rounded-2xl backdrop-blur-md hover:bg-white/20 transition duration-300">
                    <div class="text-blue-400 text-4xl mb-4">📅</div>
                    <h3 class="text-white text-xl font-semibold mb-3">Manajemen Jadwal</h3>
                    <p class="text-gray-300 font-light text-sm md:text-base">Tidak ada lagi deadline yang terlewat. Pantau semua tenggat waktu tugasmu di satu dashboard rapi.</p>
                </div>
                <!-- Card Fitur 2 -->
                <div class="bg-white/10 border border-white/20 p-8 rounded-2xl backdrop-blur-md hover:bg-white/20 transition duration-300">
                    <div class="text-blue-400 text-4xl mb-4">📊</div>
                    <h3 class="text-white text-xl font-semibold mb-3">Pantau Performa</h3>
                    <p class="text-gray-300 font-light text-sm md:text-base">Dapatkan poin setiap menyelesaikan tugas dan lihat grafik seberapa konsisten belajarmu.</p>
                </div>
                <!-- Card Fitur 3 -->
                <div class="bg-white/10 border border-white/20 p-8 rounded-2xl backdrop-blur-md hover:bg-white/20 transition duration-300">
                    <div class="text-blue-400 text-4xl mb-4">🚀</div>
                    <h3 class="text-white text-xl font-semibold mb-3">Fokus & Produktif</h3>
                    <p class="text-gray-300 font-light text-sm md:text-base">Antarmuka yang bersih dan bebas gangguan membantu kamu fokus pada apa yang benar-benar penting.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 3: Pelajari / Call to Action (BAGIAN BARU) -->
    <section id="pelajari" class="py-24 flex items-center justify-center relative z-10 px-6 md:px-24 bg-black/60 backdrop-blur-md text-center">
        <div class="max-w-4xl w-full">
            <h2 class="text-white text-3xl md:text-4xl font-bold mb-6">Siap Menjadi Lebih Produktif?</h2>
            <p class="text-gray-300 text-base md:text-lg font-light mb-8">Bergabunglah dan mulai atur aktivitasmu dengan Student.IO sekarang juga.</p>
            <a href="{{ url('/register') }}" class="inline-block bg-blue-500 text-white px-8 py-3 rounded-full font-semibold hover:bg-blue-600 transition shadow-lg hover:shadow-blue-500/50">
                Mulai Sekarang - Gratis!
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-6 text-center text-gray-500 text-sm relative z-10 bg-black/80">
        &copy; {{ date('Y') }} Student.io. Hak Cipta Dilindungi.
    </footer>

</body>
</html>
