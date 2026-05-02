<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student.io - Landing Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="public/assets/css/style.css">
</head>
<body class="body-home hero-bg">

    <!-- Layer Background Image Full Screen -->
    <div class="fixed inset-0 bg-cover bg-center opacity-[0.35] -z-10" 
         style="background-image: url('https://images.unsplash.com/photo-1455390582262-044cdead277a?q=80&w=1073&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
    </div>

    <!-- Halaman Utama (Hero Section) -->
    <div class="min-h-screen flex flex-col relative z-10">
        <!-- Navigation -->
        <nav class="flex justify-center space-x-8 py-8 text-sm font-medium tracking-wide text-white">
            <a href="#student" class="hover:text-blue-400 transition">Apa itu Student.io ?</a>
            <a href="#" class="hover:text-blue-400 transition">Solusi</a>
            <a href="#" class="hover:text-blue-400 transition">Pelajari</a>
            <a href="#" class="hover:text-blue-400 transition">Penerapan</a>
        </nav>

        <!-- Main Content -->
        <main class="flex-grow flex flex-col items-center justify-center text-center px-4">
            <!-- Wrapper Konten Utama -->
            <div class="flex flex-col items-center">
                <h1 class="text-white text-4xl md:text-6xl font-bold tracking-tighter mb-4 max-w-4xl uppercase glow-text">
                    Satu Tempat Untuk Semua Tugas dan Jadwalmu
                </h1>
                <p class="text-white text-lg md:text-xl mb-10 max-w-2xl font-light">
                    Ayo kelola jadwal dan tugas-tugas agar lebih mudah
                </p>
                
                <a href="index.php?url=auth/login" class="border border-white text-white px-8 py-2 rounded-full hover:bg-white hover:text-black transition flex items-center gap-2 group">
                    BUAT 
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:translate-x-1 transition-transform">
                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                        <polyline points="15 3 21 3 21 9"></polyline>
                        <line x1="10" y1="14" x2="21" y2="3"></line>
                    </svg>
                </a>
            </div>
        </main>

        <!-- Footer Bar (Tetap di halaman pertama) -->
        <div class="bottom-bar relative z-10">
            <a href="#">COMMUNITY</a>
            <a href="#">INTEGRATION</a>
            <a href="#">COLLABORATE</a>
            <a href="#">HELP</a>
        </div>
    </div>

    <!-- Bagian Apa itu Student.io -->
    <section id="student" class="min-h-screen flex items-center justify-center relative z-10 px-8 md:px-24 py-16">
        <div class="max-w-6xl w-full flex flex-col md:flex-row items-center justify-between gap-12">
            <!-- Teks -->
            <div class="md:w-1/2 text-left">
                <h2 class="text-white text-4xl md:text-5xl font-bold mb-6 tracking-tight">Apa itu Student.IO?</h2>
                <p class="text-gray-300 text-lg md:text-xl leading-relaxed font-light">
                    Student.IO adalah platform yang membantu pelajar dan mahasiswa mengatur tugas, jadwal, dan aktivitas belajar dalam satu tempat. Dengan Student.IO, semua tugas menjadi lebih terorganisir dan mudah dipantau.
                </p>
            </div>

            <!-- Gambar Ilustrasi -->
            <div class="md:w-1/2 flex justify-center">
                <!-- Ganti path src ini dengan lokasi file gambarmu -->
                <img src="public/assets/img/photo-1563121661-cd531f4fb8cb.avif" alt="Ilustrasi Student.IO" class="max-w-full h-auto object-contain drop-shadow-2xl hover:scale-105 transition-transform duration-500">
            </div>
        </div>
    </section>

</body>
</html>
