<nav id="navbar" class="fixed w-full z-10 transition-transform duration-300" style="transition: all 0.3s ease-in-out">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <img class="h-8 w-auto" src="{{ asset('images/logo/logo_desa.png') }}" alt="Logo">
                <h6 class="text-white font-bold ml-3">Cantigi Kulon</h6>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center">
                <div class="ml-10 flex items-baseline space-x-4">
                    <a href="{{ route('home') }}"
                        class="link text-white hover:text-orange-300 px-3 py-2 rounded-md text-sm font-medium">Beranda</a>
                    <a href="#pelayanan"
                        class="link text-white hover:text-orange-300 px-3 py-2 rounded-md text-sm font-medium">Pelayanan</a>
                    <a href="{{ route('profile-desa') }}"
                        class="link text-white hover:text-orange-300 px-3 py-2 rounded-md text-sm font-medium">Profil
                        Desa</a>
                    <a href="{{ route('pengaduan.create') }}"
                        class="link text-white hover:text-orange-300 px-3 py-2 rounded-md text-sm font-medium">Pengaduan</a>
                </div>
                <div class="ml-6 flex items-center">
                    @if (Route::has('login'))
                        @auth
                            @if (auth()->user()->role_id == 2)
                                <!-- User is authenticated, show avatar/profile -->
                                <div class="relative">
                                    <button id="profile-dropdown-button" class="flex items-center focus:outline-none">
                                        <img class="h-8 w-8 rounded-full object-cover border-2 border-white"
                                            src="{{ auth()->user()->profile_photo_url ?? asset('images/icons/default-avatar.svg') }}"
                                            alt="Profile Photo">
                                        <span class="ml-2 text-white font-medium">{{ auth()->user()->name }}</span>
                                    </button>
                                    <!-- Dropdown menu (hidden by default) -->
                                    <div id="profile-dropdown-menu"
                                        class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                        <a href="{{ route('profile.edit') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                        <a href="#"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit"
                                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <!-- If role_id is not 2, show login/register buttons -->
                                <a href="{{ route('login') }}" id="login-button" target="_blank"
                                    class="btn-auth px-4 py-2 text-sm font-medium text-white border-1 rounded-md hover:text-black hover:border-white hover:bg-white">Masuk</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" id="register-button" target="_blank"
                                        class="ml-3 px-4 py-2 text-sm font-medium text-white bg-orange-300 hover:bg-orange-400 rounded-md">Daftar</a>
                                @endif
                            @endif
                        @else
                            <!-- User is not authenticated, show login/register buttons -->
                            <a href="{{ route('login') }}" id="login-button" target="_blank"
                                class="btn-auth px-4 py-2 text-sm font-medium text-white border-1 rounded-md hover:text-black hover:border-white hover:bg-white">Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" id="register-button" target="_blank"
                                    class="ml-3 px-4 py-2 text-sm font-medium text-white bg-orange-300 hover:bg-orange-400 rounded-md">Daftar</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="flex md:hidden items-center">
                <button type="button" id="mobile-menu-button"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <!-- Icon when menu is closed -->
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <!-- Icon when menu is open -->
                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Mobile menu, show/hide based on menu state. -->
            <div class="md:hidden hidden" id="mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                    <a href="#home"
                        class="text-white hover:text-orange-300 block px-3 py-2 rounded-md text-base font-medium">Beranda</a>
                    <a href="#pelayanan"
                        class="text-white hover:text-orange-300 block px-3 py-2 rounded-md text-base font-medium">Pelayanan</a>
                    <a href="#profil-desa"
                        class="text-white hover:text-orange-300 block px-3 py-2 rounded-md text-base font-medium">Profil
                        Desa</a>
                    <a href="#pengaduan"
                        class="text-white hover:text-orange-300 block px-3 py-2 rounded-md text-base font-medium">Pengaduan</a>
                </div>
                <div class="pt-4 pb-3 border-t border-gray-200">
                    @auth
                        <!-- User is authenticated, show profile info -->
                        <div class="flex items-center px-5">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full object-cover"
                                    src="{{ auth()->user()->profile_photo_url ?? asset('images/default-avatar.png') }}"
                                    alt="Profile Photo">
                            </div>
                            <div class="ml-3">
                                <div class="text-base font-medium text-white">{{ auth()->user()->name }}</div>
                            </div>
                        </div>
                        <div class="mt-3 px-2 space-y-1">
                            {{-- <a href="{{ route('profile.show') }}" --}}
                            <a href="#"
                                class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-orange-300">
                                Profile
                            </a>
                            {{-- <a href="{{ route('dashboard') }}" --}}
                            <a href="#"
                                class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-orange-300">
                                Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-white hover:text-orange-300">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <!-- User is not authenticated, show login/register buttons -->
                        <div class="flex items-center px-5">
                            <a href="{{ route('login') }}" target="_blank" id="login-button"
                                class="block px-4 py-2 text-base font-medium text-white outline-1 rounded-md hover:text-orange-300">Masuk</a>
                            <a href="{{ route('register') }}" target="_blank" id="register-button"
                                class="block ml-3 px-4 py-2 text-base font-medium text-white bg-orange-300 hover:bg-orange-400 0 rounded-md">Daftar</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="md:hidden hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="#home"
                class="text-white hover:text-orange-300 block px-3 py-2 rounded-md text-base font-medium">Beranda</a>
            <a href="#pelayanan"
                class="text-white hover:text-orange-300 block px-3 py-2 rounded-md text-base font-medium">Pelayanan</a>
            <a href="#profil-desa"
                class="text-white hover:text-orange-300 block px-3 py-2 rounded-md text-base font-medium">Profil
                Desa</a>
            <a href="#pengaduan"
                class="text-white hover:text-orange-300 block px-3 py-2 rounded-md text-base font-medium">Pengaduan</a>
        </div>
        <div class="pt-4 pb-3 border-t border-gray-200">
            <div class="flex items-center px-5">
                <a href="{{ route('login') }}" target="_blank" id="login-button"
                    class="block px-4 py-2 text-base font-medium text-white outline-1 rounded-md hover:text-orange-300">Masuk</a>
                <a href="{{ route('register') }}" target="_blank" id="register-button"
                    class="block ml-3 px-4 py-2 text-base font-medium text-white bg-orange-300 hover:bg-orange-400 0 rounded-md">Daftar</a>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Smooth scroll untuk semua link internal
        const internalLinks = document.querySelectorAll('a[href^="#"]');

        internalLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                // Dapatkan target elemen
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    // Scroll dengan smooth behavior
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        const navbar = document.getElementById('navbar');
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const profileDropdownButton = document.getElementById('profile-dropdown-button');
        const profileDropdownMenu = document.getElementById('profile-dropdown-menu');

        let lastScrollTop = 0;
        let isNavbarHidden = false;

        if (profileDropdownButton && profileDropdownMenu) {
            profileDropdownButton.addEventListener('click', function() {
                profileDropdownMenu.classList.toggle('hidden');
            });

            // Close the dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!profileDropdownButton.contains(event.target) && !profileDropdownMenu.contains(event
                        .target)) {
                    profileDropdownMenu.classList.add('hidden');
                }
            });
        }


        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            const navbar = document.getElementById('navbar');
            const profileTextElement = document.querySelector('#profile-dropdown-button span');
            const profileMenu = document.querySelector('#profile-dropdown-menu');

            // Menentukan arah scroll (naik atau turun)
            const isScrollingDown = scrollTop > lastScrollTop;
            if (profileTextElement) {
                if (scrollTop < 50) {
                    // At top - white text
                    profileTextElement.classList.add('text-white');
                    profileTextElement.classList.remove('text-gray-800');
                    // if (profileMenu) {
                    //     profileMenu.classList.remove('text-white');
                    // }
                } else {
                    profileTextElement.classList.remove('text-white');
                    profileTextElement.classList.add('text-gray-800');
                    // Scrolled - dark text
                }
            }
            // Saat scroll ke bawah dan posisi > 50px
            if (isScrollingDown && scrollTop > 50) {
                // Saat di-scroll ke bawah
                navbar.classList.remove('bg-transparent');
                navbar.classList.add('bg-white', 'shadow-md', '-translate-y-full');

                // Mengubah warna teks menjadi hitam saat background putih
                const navLinks = navbar.querySelectorAll('a.link');
                if (navLinks.length > 0) {
                    navLinks.forEach(link => {
                        link.classList.remove('text-white');
                        link.classList.add('text-gray-800');
                    });
                }

                const btnAuth = navbar.querySelectorAll('a.btn-auth');
                if (btnAuth.length > 0) {
                    btnAuth.forEach(btn => {
                        btn.classList.remove('text-white');
                        btn.classList.add('text-gray-800');
                        btn.classList.remove('hover:bg-white')
                        btn.classList.add('hover:bg-orange-400')
                    });
                }

                // Mengubah warna teks logo
                const logoText = navbar.querySelector('h6');
                if (logoText) {
                    logoText.classList.remove('text-white');
                    logoText.classList.add('text-gray-800');
                }

                isNavbarHidden = true;
            }
            // Saat scroll ke atas
            else if (scrollTop < 50) {
                // Kembalikan ke penampilan awal 
                navbar.classList.add('bg-transparent');
                navbar.classList.remove('bg-white', 'shadow-md', '-translate-y-full');
                // profileMenu.classList.remove('text-white');

                // Mengubah warna teks kembali menjadi putih
                const navLinks = navbar.querySelectorAll('a.link');
                if (navLinks.length > 0) {
                    navLinks.forEach(link => {
                        link.classList.add('text-white');
                        link.classList.remove('text-gray-800');
                    });
                }

                const btnAuth = navbar.querySelectorAll('a.btn-auth');
                if (btnAuth.length > 0) {
                    btnAuth.forEach(btn => {
                        btn.classList.add('text-white');
                        btn.classList.remove('text-gray-800');
                        btn.classList.add('hover:bg-white')
                        btn.classList.remove('hover:bg-orange-400')
                    });
                }

                // Mengubah warna teks logo kembali
                const logoText = navbar.querySelector('h6');
                if (logoText) {
                    logoText.classList.add('text-white');
                    logoText.classList.remove('text-gray-800');
                }

                isNavbarHidden = false;
            }
            // Untuk kondisi di antara 0-50px scroll
            else {
                navbar.classList.remove('bg-transparent');
                navbar.classList.add('bg-white', 'shadow-md');
                navbar.classList.remove('-translate-y-full');

                const profileMenu = document.querySelector('#profile-dropdown-menu');
                if (profileMenu) {
                    profileMenu.classList.remove('text-white');
                    profileMenu.classList.add('text-gray-700');
                }

                // Mengubah warna teks menjadi hitam
                const navLinks = navbar.querySelectorAll('a.link');
                if (navLinks.length > 0) {
                    navLinks.forEach(link => {
                        link.classList.remove('text-white');
                        link.classList.add('text-gray-800');
                    });
                }

                // Mengubah warna teks logo
                const logoText = navbar.querySelector('h6');
                if (logoText) {
                    logoText.classList.remove('text-white');
                    logoText.classList.add('text-gray-800');
                }
            }

            // Simpan posisi scroll untuk perbandingan berikutnya
            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        });

        // Toggle menu mobile
        mobileMenuButton.addEventListener('click', function() {
            const expanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
            mobileMenuButton.setAttribute('aria-expanded', !expanded);

            // Toggle icon
            const openIcon = mobileMenuButton.querySelector('svg:first-child');
            const closeIcon = mobileMenuButton.querySelector('svg:last-child');

            if (expanded) {
                mobileMenu.classList.add('hidden');
                openIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            } else {
                mobileMenu.classList.remove('hidden');
                openIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
            }
        });
    });
</script>
