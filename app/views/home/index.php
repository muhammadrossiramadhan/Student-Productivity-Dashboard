<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student.io - Landing Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="public/assets/css/style.css">
</head>
<body class="body-home hero-bg min-h-screen flex flex-col">

    <!-- Navigation -->
    <nav class="flex justify-center space-x-8 py-8 text-sm font-medium tracking-wide">
        <a href="#" class="hover:text-blue-400 transition">Apa itu Student.io ?</a>
        <a href="#" class="hover:text-blue-400 transition">Solusi</a>
        <a href="#" class="hover:text-blue-400 transition">Pelajari</a>
        <a href="#" class="hover:text-blue-400 transition">Penerapan</a>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow flex flex-col items-center justify-center text-center px-4">
        <h1 class="text-4xl md:text-6xl font-bold tracking-tighter mb-4 max-w-4xl uppercase glow-text">
            Satu Tempat Untuk Semua Tugas dan Jadwalmu
        </h1>
        <p class="text-gray-300 text-lg md:text-xl mb-10 max-w-2xl font-light">
            Ayo kelola jadwal dan tugas-tugas agar lebih mudah
        </p>
        
        <a href="index.php?url=auth/login" class="border border-white px-8 py-2 rounded-full hover:bg-white hover:text-black transition flex items-center gap-2 group">
            BUAT 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:translate-x-1 transition-transform">
                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                <polyline points="15 3 21 3 21 9"></polyline>
                <line x1="10" y1="14" x2="21" y2="3"></line>
            </svg>
        </a>
    </main>

    <!-- Footer Bar -->
    <div class="bottom-bar">
        <a href="#">COMMUNITY</a>
        <a href="#">INTEGRATION</a>
        <a href="#">COLLABORATE</a>
        <a href="#">HELP</a>
    </div>

</body>
</html>
