{{-- navbar --}}

<style>
    /* Dropdown and transition styles */
    .dropdown-menu li {
        color: #8B4513;
    }

    .block {
        display: block;
    }

    /* Navbar transitions */
    #navbar {
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    #navbar button,
    #navbar a {
        transition: color 0.3s ease;
    }

    .dropdown-menu {
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    /* Mobile menu button fixed positioning */
    #mobileMenuButton {
        position: fixed;
        top: 10px;
        right: 20px;
        z-index: 1000;
        color: #FFF8E1;
        background-color: #8B4513;
        padding: 10px;
        border-radius: 5px;
        display: none;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    @media (max-width: 1023px) {
        #mobileMenuButton {
            display: block;
        }
    }
      @media (max-width: 1023px) {
        #mobileNavbar a,
        #mobileNavbar button {
            color: #FFF8E1 !important;
        }
        
        #mobileNavbar a:hover,
        #mobileNavbar button:hover {
            color: #FFF8E1 !important;
            background-color: transparent !important;
        }
        
        #coursesDropdown a {
            color: #FFF8E1 !important;
        }
    }

    /* Ensure mobile navbar is above other content */
    #mobileNavbar {
        z-index: 999;
    }

    /* Dropdown styles */
    .group:hover .dropdown-menu {
        opacity: 1;
        visibility: visible;
    }

    /* Mobile dropdown styles */
    #coursesDropdown {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }
    
    #coursesDropdown.show {
        max-height: 500px; /* Adjust based on your content */
    }

    /* Homepage dropdown text color */
    .homepage .dropdown-menu li a {
        color: #8B4513 !important; /* Pastry primary color */
    }

    /* Remove hover effects from sidebar */
    #mobileNavbar a:hover,
    #mobileNavbar button:hover {
        background-color: transparent !important;
        color: inherit !important;
    }

    #mobileNavbar li:hover {
        background-color: transparent !important;
    }
</style>

@props(['courses' => []]) 

<nav id="navbar" class="fixed w-full z-50 top-0 transition-all duration-300 bg-transparent">
    <div class="mx-auto px-0 xl:px-8">
        <div class="flex justify-between h-22 items-center">
            <!-- Logo and Name -->
            
            <div class="flex items-center">
                <img src="{{asset('bakery/images/logo.png')}}" alt="Logo" class="logo-img xxs:h-16 xms:h-20 xl:h-24 xl:w-48 h-full w-full sm:ml-10 mr-3 transition-all duration-300">
                <div id="logoName" style="font-family: 'Rubik Doodle Shadow', cursive;"></div>
            </div>

            <!-- Navbar Items -->
            <ul class="navbar-ul hidden lg:flex lg:space-x-2 xl:space-x-6 transition-all duration-300">
                <li class="relative group nav-item">
                    <a href="{{ url('/') }}">
                        <button class="flex items-center justify-center text-[#FFF8E1] font-semibold px-3 mb-2 hover:text-[#D4A76A] focus:outline-none transition-colors duration-300">
                            Home
                        </button>
                    </a>
                </li>
                <li class="relative group">
                    <a href="/aboutus">
                        <button class="flex items-center text-[#FFF8E1] font-semibold px-3 mb-2 hover:text-[#D4A76A] focus:outline-none transition-colors duration-300">
                            About Us
                        </button>
                    </a>
                </li>
                
                <!-- Courses Dropdown -->
                <li class="relative group">
                        <a href="{{route('courses.index')}}">
                    <button class="flex items-center text-[#FFF8E1] font-semibold px-3 hover:text-[#D4A76A] focus:outline-none transition-colors duration-300">
                        Our Courses
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    </a>
                    <ul class="dropdown-menu absolute left-0 mt-2 w-56 bg-[#FFF8E1] border border-gray-200 shadow-lg rounded-md opacity-0 invisible transition-opacity duration-300" style="border-top: 4px solid #8B4513;">
                        @foreach($courses as $course)
                            <li class="relative group">
                                <a href="{{ route('courses.show', $course) }}" class="font-medium px-4 py-2 text-[#8B4513] hover:bg-pastry-light hover:underline flex items-center">
                                    <div class="w-56 font-semibold">{{ $course->title }}</div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <li class="relative group">
                    <a href="{{route('menu.index')}}">
                        <button class="flex items-center text-[#FFF8E1] font-semibold px-3 hover:text-[#D4A76A] focus:outline-none transition-colors duration-300">
                            Menu
                        </button>
                    </a>
                </li>

                <li class="relative group">
                    <a href="{{ route('alumni.index') }}">
                        <button class="flex items-center text-[#FFF8E1] font-semibold px-3 mb-2 hover:text-[#D4A76A] focus:outline-none transition-colors duration-300">
                            Alumini
                        </button>
                    </a>
                </li>
                
                <li class="reltive group">
                    <a href="{{ route('faqs.index') }}">
                        <button class="flex items-center text-[#FFF8E1] font-semibold px-3 mb-2 hover:text-[#D4A76A] focus:outline-none transition-colors duration-300">
                            Faqs
                        </button>
                    </a>
                </li>
                
                <li class="relative group">
                    <a href="/contact">
                        <button class="flex items-center text-[#FFF8E1] font-semibold px-3 mb-2 hover:text-[#D4A76A] focus:outline-none transition-colors duration-300">
                            Contact
                            
                            </button>
                        </a>
                    
                    </li>
                     <li class="relative group">
                        <a href="/gallery">
                            <button class="flex items-center text-[#FFF8E1] font-semibold px-3 mb-2  hover:text-[#D4A76A] focus:outline-none  transition-colors duration-300">
                            Gallery
                            
                            </button>
                        </a>
                    
                    </li>

                @auth
                  <li class="relative group">
                    <a href="{{ route('admin.dashboard') }}">
                        <button
                            {{-- class="flex items-center text-xl font-bold px-3 py-0.5 hover:text-orange-400 focus:outline-none  {{ request()->routeIs('contact') ? 'text-orange-400' : 'text-white' }} " --}}
                            class="flex items-center text-[#FFF8E1] text-xl font-bold px-3  py-0.5 hover:text-[#D4A76A] focus:outline-none  transition-colors duration-300">
                            <i class="fa-solid fa-circle-user"></i>
  
                        </button>
                    </a>
  
                </li>
                @endauth


            
    
                </ul>   
            </div>    
        </div>
    </div>
</nav>

<!-- Hamburger Button -->
<button id="mobileMenuButton" class="lg:hidden">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
    </svg>
</button>

<!-- Mobile Navbar -->
<div id="mobileNavbar" class="fixed top-0 right-0 w-full sm:w-96 h-full transform translate-x-full transition-transform duration-300 z-50 lg:hidden overflow-y-auto">
    <div class="relative bg-center bg-cover h-full" style="background-image: url('{{ asset('images/hero/gpt.png') }}');">
        <div class="absolute inset-0 bg-[rgba(8,5,3,0.85)]"></div>

        <div class="relative z-10 h-full">
            <div class="flex justify-between items-center p-4 border-b border-gray-700">
                <div class="flex items-center space-x-3">
                    <span>
                        <img src="{{ asset('bakery/images/logo.png') }}" alt="Logo" class="h-20 w-40 rounded-full">
                    </span>
                </div>
                <button id="closeMobileMenu" class="text-white focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <ul class="mt-4 space-y-2">
                  
                <li>
                    <a href="{{ url('/') }}" class="block px-4 py-2 text-lg text-[#FFF8E1] font-semibold" style="color: #FFF8E1 !important;">Home</a>
                </li>
                <li>
                    <a href="/aboutus" class="block px-4 py-2 text-lg text-[#FFF8E1] font-semibold" style="color: #FFF8E1 !important;">About Us</a>
                </li>
                
                <li>
                    <button class="w-full flex justify-between items-center text-[#FFF8E1] px-4 py-2 font-bold focus:outline-none"
                    style="color: #FFF8E1 !important;"
                        onclick="toggleDropdown('coursesDropdown')">
                        Our Courses
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <ul id="coursesDropdown" class="hidden pl-6 space-y-1">
                        @foreach ($courses as $course)
                        <li>
                            <a href="{{route('courses.show', $course) }}" class="block px-4 py-2 text-md text-[#FFF8E1] font-semibold" style="color: #FFF8E1 !important;">
                                {{$course->title}}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                
                <li>
                    <a href="{{route('menu.index')}}" class="block px-4 py-2 text-lg text-[#FFF8E1] font-semibold" style="color: #FFF8E1 !important;">Menu</a>
                </li>
                
                <li>
                    <a href="{{ route('alumni.index') }}" class="block px-4 py-2 text-lg text-[#FFF8E1] font-semibold" style="color: #FFF8E1 !important;">Alumni</a>
                </li>
                
                <li>
                    <a href="{{ route('faqs.index') }}" class="block px-4 py-2 text-lg text-[#FFF8E1] font-semibold" style="color: #FFF8E1 !important;">FAQs</a>
                </li>
                
                <li>
                    <a href="/contact" class="block px-4 py-2 text-lg text-[#FFF8E1] font-semibold" style="color: #FFF8E1 !important;">Contact</a>
                </li>
                 <li>
                    <a href="/gallery" class="block px-4 py-2 text-lg text-[#FFF8E1] font-semibold" style="color: #FFF8E1 !important;">Gallery</a>
                </li>
                @auth
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-lg text-[#FFF8E1] font-semibold" style="color: #FFF8E1 !important;">Dashboard</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const navbar = document.getElementById("navbar");
    const logoImg = document.querySelector(".logo-img");
    const navUl = document.querySelector(".navbar-ul");
    const mobileMenuButton = document.getElementById("mobileMenuButton");
    const mobileNavbar = document.getElementById("mobileNavbar");
    const closeMobileMenu = document.getElementById("closeMobileMenu");

    // Add homepage class if needed
    if (window.location.pathname === "/") {
        document.body.classList.add('homepage');
    }

    // Function to toggle mobile dropdown
    window.toggleDropdown = function(id) {
        const dropdown = document.getElementById(id);
        dropdown.classList.toggle('hidden');
        dropdown.classList.toggle('show');
    };

    // Function to check screen size and handle menu button visibility
    function handleMenuButtonVisibility() {
        if (window.innerWidth >= 1024) {
            mobileMenuButton.style.display = "none";
            mobileNavbar.classList.remove("translate-x-0");
            mobileNavbar.classList.add("translate-x-full");
            document.body.style.overflow = "";
        } else {
            if (mobileNavbar.classList.contains("translate-x-full")) {
                mobileMenuButton.style.display = "block";
            } else {
                mobileMenuButton.style.display = "none";
            }
        }
    }

    // Mobile menu toggle functionality
    mobileMenuButton.addEventListener("click", () => {
        mobileNavbar.classList.remove("translate-x-full");
        mobileNavbar.classList.add("translate-x-0");
        mobileMenuButton.style.display = "none"; 
        document.body.style.overflow = "hidden";
    });

    closeMobileMenu.addEventListener("click", () => {
        mobileNavbar.classList.remove("translate-x-0");
        mobileNavbar.classList.add("translate-x-full");
        document.body.style.overflow = "";
        handleMenuButtonVisibility();
    });

    // Close mobile menu when clicking outside
    mobileNavbar.addEventListener("click", (e) => {
        if (e.target === mobileNavbar) {
            mobileNavbar.classList.remove("translate-x-0");
            mobileNavbar.classList.add("translate-x-full");
            document.body.style.overflow = "";
            handleMenuButtonVisibility();
        }
    });

    // Handle window resize
    window.addEventListener('resize', handleMenuButtonVisibility);

    // Function to get clean path from URL or route
    function getCleanPath(url) {
        const a = document.createElement('a');
        a.href = url;
        return a.pathname.split('?')[0].split('#')[0];
    }

    // Function to highlight active nav item
    function highlightActiveNavItem() {
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.navbar-ul a[href]');
        
        navLinks.forEach(link => {
            const href = link.getAttribute('href');
            const linkPath = getCleanPath(href);
            
            if (currentPath === linkPath) {
                const button = link.querySelector('button');
                if (button) {
                    button.classList.add('text-[#5E2C04]');
                    button.classList.remove('text-[#FFF8E1]', 'text-[#8B4513]', 'hover:text-[#D4A76A]');
                    button.dataset.active = "true";
                }
            } else {
                const button = link.querySelector('button');
                if (button) {
                    button.classList.remove('text-[#5E2C04]');
                    if (navbar.classList.contains('scrolled')) {
                        button.classList.add('text-[#8B4513]');
                    } else {
                        button.classList.add('text-[#FFF8E1]');
                    }
                    button.classList.add('hover:text-[#D4A76A]');
                    button.removeAttribute('data-active');
                }
            }
        });
    }

    // Function to set scrolled state styles
    function setScrolledState() {
        navbar.classList.add("scrolled", "shadow-lg", "bg-[#FFF8E1]");
        navbar.classList.remove("bg-transparent");
        logoImg.classList.add("h-16", "w-32", "ml-4");
        logoImg.classList.remove("xl:h-24", "xl:w-48", "h-full", "w-full", "ml-10");
        navUl.classList.add("mt-2");
        
        mobileMenuButton.classList.remove("bg-[#a57d53]");
        mobileMenuButton.classList.add("bg-[#8B4513]");
        
        navbar.querySelectorAll("button, a").forEach((el) => {
            if (!el.hasAttribute('data-active')) {
                el.classList.add("text-[#8B4513]");
                el.classList.remove("text-[#FFF8E1]");
            }
        });
    }

    // Function to set unscrolled state styles (homepage only)
    function setUnscrolledState() {
        navbar.classList.remove("scrolled", "shadow-lg", "bg-[#FFF8E1]");
        navbar.classList.add("bg-transparent");
        logoImg.classList.remove("h-16", "w-32", "ml-4");
        logoImg.classList.add("xl:h-24", "xl:w-48", "h-full", "w-full", "ml-10");
        navUl.classList.remove("mt-2");
        
        mobileMenuButton.classList.remove("bg-[#8B4513]");
        mobileMenuButton.classList.add("bg-[#a57d53]");
        
        navbar.querySelectorAll("button, a").forEach((el) => {
            if (!el.hasAttribute('data-active')) {
                el.classList.add("text-[#FFF8E1]");
                el.classList.remove("text-[#8B4513]");
            }
        });
    }

    // Check if homepage
    if (window.location.pathname === "/") {
        window.addEventListener("scroll", () => {
            if (window.scrollY > 100) {
                setScrolledState();
            } else {
                setUnscrolledState();
            }
        });

        if (window.scrollY > 100) {
            setScrolledState();
        } else {
            setUnscrolledState();
        }
    } else {
        setScrolledState();
    }

    highlightActiveNavItem();
    handleMenuButtonVisibility();
});
</script>