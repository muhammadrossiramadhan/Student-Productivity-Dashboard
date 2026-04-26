function setupCustomScroll(containerId, trackId, thumbId) {
    const container = document.getElementById(containerId);
    const track = document.getElementById(trackId);
    const thumb = document.getElementById(thumbId);

    let isDragging = false;
    let startX;
    let scrollLeft;

    // 1. Hitung lebar thumb berdasarkan rasio konten
    function updateThumbWidth() {
        const scrollRatio = container.clientWidth / container.scrollWidth;
        const thumbWidth = Math.max(container.clientWidth * scrollRatio, 30); // Min 30px
        thumb.style.width = `${thumbWidth}px`;
    }

    // 2. Update posisi thumb saat konten di-scroll (mouse wheel / trackpad)
    container.addEventListener('scroll', () => {
        if (isDragging) return;
        const maxScroll = container.scrollWidth - container.clientWidth;
        const scrollPos = container.scrollLeft;
        const trackWidth = track.clientWidth - thumb.clientWidth;
        
        const thumbPos = (scrollPos / maxScroll) * trackWidth;
        thumb.style.left = `${thumbPos}px`;
    });

    // 3. Logika Dragging pada Thumb
    thumb.addEventListener('mousedown', (e) => {
        isDragging = true;
        startX = e.pageX - thumb.offsetLeft;
        thumb.classList.add('grabbing');
    });

    window.addEventListener('mousemove', (e) => {
        if (!isDragging) return;
        e.preventDefault();

        let x = e.pageX - startX;
        const maxTrack = track.clientWidth - thumb.clientWidth;

        // Batasi thumb di dalam track
        if (x < 0) x = 0;
        if (x > maxTrack) x = maxTrack;

        thumb.style.left = `${x}px`;

        // Geser konten berdasarkan posisi thumb
        const scrollRatio = x / maxTrack;
        const targetScroll = scrollRatio * (container.scrollWidth - container.clientWidth);
        container.scrollLeft = targetScroll;
    });

    window.addEventListener('mouseup', () => {
        isDragging = false;
        thumb.classList.remove('grabbing');
    });

    // 4. Klik pada track untuk lompat ke posisi tertentu
    track.addEventListener('click', (e) => {
        if (e.target === thumb) return;
        const clickPos = e.offsetX - (thumb.clientWidth / 2);
        const maxTrack = track.clientWidth - thumb.clientWidth;
        const boundedPos = Math.max(0, Math.min(clickPos, maxTrack));
        
        const scrollRatio = boundedPos / maxTrack;
        container.scrollTo({
            left: scrollRatio * (container.scrollWidth - container.clientWidth),
            behavior: 'smooth'
        });
    });

    // Inisialisasi awal
    window.addEventListener('load', updateThumbWidth);
    window.addEventListener('resize', updateThumbWidth);
    updateThumbWidth();
}

// Jalankan untuk kedua section
setupCustomScroll('container-1', 'track-1', 'thumb-1');
setupCustomScroll('container-2', 'track-2', 'thumb-2');