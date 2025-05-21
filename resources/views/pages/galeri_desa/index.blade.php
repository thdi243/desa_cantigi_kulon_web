@extends('template.layout')

@section('title', 'Galeri Desa | ' . config('app.name'))

@section('content')
    <div class="min-h-screen flex flex-col">
        <div class="relative">
            <!-- Bagian background warna -->
            <div class="w-full h-50 md:h-55 bg-linear-to-br from-sky-500 to-sky-800 overflow-hidden">
            </div>

            <!-- Bagian teks judul -->
            <div class="absolute top-20 left-0 right-0 flex flex-col px-4 items-center justify-center pt-4">
                <h1 class="text-center text-3xl md:text-4xl text-white font-medium mb-4">
                    Yuk Lihat Keseruan Kegiatan Desa!
                </h1>

                <!-- Garis horizontal -->
                <div class="flex justify-center w-full max-w-md px-8">
                    <div class="h-1 md:h-1.5 w-1/2 bg-white rounded"></div>
                    <div class="h-1 md:h-1.5 w-1/6 bg-white rounded mx-4"></div>
                </div>
            </div>
        </div>
        <div class="container mx-auto py-10 px-4">
            <div class="max-w-6xl mx-auto">
                <!-- Filter Galeri -->
                <div class="mb-8">
                    <div class="flex flex-wrap justify-center gap-3">
                        <button class="px-5 py-2 bg-sky-600 text-white rounded-full hover:bg-sky-700 transition active"
                            onclick="filterGallery('all')">
                            Semua
                        </button>
                        @foreach ($kategori as $kat)
                            <button
                                class="px-5 py-2 bg-gray-200 text-gray-700 rounded-full hover:bg-sky-600 hover:text-white transition"
                                onclick="filterGallery('{{ $kat->slug }}')">
                                {{ $kat->nama_kategori }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Galeri Masonry -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 gallery-container">
                    @forelse($galeri as $item)
                        <div class="gallery-item {{ $item->kategori->slug }}" onclick="openLightbox({{ $loop->index }})">
                            <div class="relative overflow-hidden rounded-lg shadow-md group">
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"
                                    class="w-full h-64 object-cover transition duration-500 group-hover:scale-110">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                                    <div class="absolute bottom-0 left-0 p-4 w-full">
                                        <h3 class="text-white font-semibold text-lg">{{ $item->judul }}</h3>
                                        <p class="text-gray-200 text-sm">{{ $item->deskripsi }}</p>
                                        <span
                                            class="inline-block mt-2 px-3 py-1 bg-sky-600 text-white text-xs rounded-full">{{ $item->kategori->nama_kategori }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <p class="text-gray-600 text-xl">Belum ada foto yang ditampilkan</p>
                        </div>
                    @endforelse
                </div>

                <!-- Load More Button (if needed) -->
                @if (count($galeri) > 9)
                    <div class="mt-10 text-center">
                        <button id="loadMoreBtn"
                            class="px-6 py-3 bg-sky-600 text-white rounded-lg hover:bg-sky-700 transition shadow-md">
                            Lihat Lebih Banyak
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <!-- Lightbox -->
        <div id="lightbox" class="fixed inset-0 bg-black/90 z-50 hidden items-center justify-center">
            <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white text-3xl">&times;</button>
            <button onclick="prevImage()" class="absolute left-4 text-white text-4xl">&lsaquo;</button>
            <button onclick="nextImage()" class="absolute right-4 text-white text-4xl">&rsaquo;</button>

            <div class="max-w-4xl mx-auto p-4">
                <img id="lightbox-img" src="" alt="Gambar Galeri" class="max-h-[80vh] max-w-full">
                <div class="mt-4 text-white">
                    <h3 id="lightbox-title" class="text-xl font-semibold"></h3>
                    <p id="lightbox-desc" class="text-gray-300"></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Data gambar dari backend
        const galleryImages = [
            @foreach ($galeri as $item)
                {
                    src: "{{ asset('storage/galeri/' . $item->gambar) }}",
                    title: "{{ $item->judul }}",
                    desc: "{{ $item->deskripsi }}"
                }
                @if (!$loop->last)
                    ,
                @endif
            @endforeach
        ];

        // Filter Galeri
        function filterGallery(category) {
            const items = document.querySelectorAll('.gallery-item');
            const buttons = document.querySelectorAll('.mb-8 button');

            // Reset semua button ke warna default
            buttons.forEach(button => {
                button.classList.remove('bg-sky-600', 'text-white', 'active');
                button.classList.add('bg-gray-200', 'text-gray-700');
            });

            // Aktifkan button yang dipilih
            const activeButton = document.querySelector(`button[onclick="filterGallery('${category}')"]`);
            activeButton.classList.remove('bg-gray-200', 'text-gray-700');
            activeButton.classList.add('bg-sky-600', 'text-white', 'active');

            items.forEach(item => {
                if (category === 'all' || item.classList.contains(category)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        // Lightbox Functionality
        let currentImageIndex = 0;

        function openLightbox(index) {
            currentImageIndex = index;
            updateLightboxContent();
            document.getElementById('lightbox').classList.remove('hidden');
            document.getElementById('lightbox').classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.add('hidden');
            document.getElementById('lightbox').classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        function updateLightboxContent() {
            document.getElementById('lightbox-img').src = galleryImages[currentImageIndex].src;
            document.getElementById('lightbox-title').textContent = galleryImages[currentImageIndex].title;
            document.getElementById('lightbox-desc').textContent = galleryImages[currentImageIndex].desc;
        }

        function nextImage() {
            currentImageIndex = (currentImageIndex + 1) % galleryImages.length;
            updateLightboxContent();
        }

        function prevImage() {
            currentImageIndex = (currentImageIndex - 1 + galleryImages.length) % galleryImages.length;
            updateLightboxContent();
        }

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (document.getElementById('lightbox').classList.contains('flex')) {
                if (e.key === 'Escape') closeLightbox();
                if (e.key === 'ArrowRight') nextImage();
                if (e.key === 'ArrowLeft') prevImage();
            }
        });

        // Load More functionality (optional)
        const loadMoreBtn = document.getElementById('loadMoreBtn');
        if (loadMoreBtn) {
            const galleryItems = document.querySelectorAll('.gallery-item');
            const itemsToShow = 9; // Initial items to show
            let currentItems = itemsToShow;

            // Hide extra items initially
            for (let i = itemsToShow; i < galleryItems.length; i++) {
                galleryItems[i].style.display = 'none';
            }

            loadMoreBtn.addEventListener('click', function() {
                // Show next batch of items
                for (let i = currentItems; i < currentItems + itemsToShow; i++) {
                    if (galleryItems[i]) {
                        galleryItems[i].style.display = 'block';
                    }
                }

                currentItems += itemsToShow;

                // Hide button if no more items
                if (currentItems >= galleryItems.length) {
                    loadMoreBtn.style.display = 'none';
                }
            });
        }
    </script>
@endsection
