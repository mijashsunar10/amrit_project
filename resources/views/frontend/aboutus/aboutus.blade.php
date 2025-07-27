@extends('template.template')

@section('pagecontent')
    <style>
        html {
            scroll-behavior: smooth;
        }

        .wave-container {
            height: 100px;
            position: absolute;
            z-index: 10;
        }

        @media (min-width: 768px) {
            .wave-container {
                height: 200px;
            }
        }

        .clipped-image {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: calc(100% + 100px);
            /* Extend into wave area */
            object-fit: cover;
            object-position: center;
            z-index: 5;
        }

        @media (min-width: 768px) {
            .clipped-image {
                height: calc(100% + 200px);
            }
        }

        .hero-container {
            position: relative;
            height: 24rem;
            overflow: hidden;
        }

        /* Animation classes for scroll reveal */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s cubic-bezier(0.5, 0, 0, 1);
        }

        .scroll-reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Page load animations */
        .page-load-anim {
            opacity: 0;
            animation: fadeInUp 0.8s ease-out forwards;
        }

        /* .carousel-container {
            position: relative;
            overflow: hidden;
            width: 100%;
        }

        .carousel-track {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .carousel-item {
            flex: 0 0 auto;
            transition: all 0.3s ease;
            position: relative;
            min-width: 200px;
        }

        .carousel-item:hover {
            transform: translateY(-5px);
        }

        .logo-container {
            transition: all 0.3s ease;
            width: 144px;
            height: 144px
        }

        .logo-container:hover {
            box-shadow: 0 15px 30px rgba(249, 115, 22, 0.2);
            transform: scale(1.05);
        }

        .section-title {
            position: relative;
            display: inline-block;
            padding-bottom: 10px;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #f97316, #fb923c);
            border-radius: 2px;
        }

        .partner-actions {
            position: absolute;
            top: 10px;
            right: 10px;
            display: none;
        }

        .carousel-item:hover .partner-actions {
            display: flex;
        }


        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        } */
    </style>

    <!-- About Us Section -->
    <section class="hero-container page-load-anim">
        <!-- Background image that will be clipped -->
        <img src="{{ asset('images/hero/bakerystall.jpg') }}" alt="Bakery background" class="clipped-image">

        <div class="absolute inset-0 bg-black bg-opacity-60 backdrop-blur-sm z-5"></div>

        <!-- 4 Balanced S-Curves Wave with gradient -->
        <div class="absolute bottom-0 inset-x-0 overflow-hidden wave-container animate-reveal-up"
            style="animation-delay: 0.3s">
            <svg viewBox="0 0 1440 140" preserveAspectRatio="none" class="w-full h-full">
                <!-- Main wave with 4 curves (360px per segment) -->
                <path fill="#fff7ed" d="M0,70 C180,130 360,10 540,70
                                                                    C720,130 900,10 1080,70
                                                                    C1260,130 1440,10 1440,70
                                                                    L1440,140 L0,140 Z"></path>
                <!-- Depth layers with reduced opacity -->
                <path fill="#fff7ed" opacity="0.85" d="M0,80 C180,120 360,30 540,80
                                                                                   C720,120 900,30 1080,80
                                                                                   C1260,120 1440,30 1440,80
                                                                                   L1440,140 L0,140 Z"></path>
                <path fill="#fff7ed" opacity="0.7" d="M0,90 C180,110 360,50 540,90
                                                                                  C720,110 900,50 1080,90
                                                                                  C1260,110 1440,50 1440,90
                                                                                  L1440,140 L0,140 Z"></path>
            </svg>
        </div>
    </section>


    <!-- Content Sections -->
    <section class="py-4 px-4 bg-gradient-to-br from-orange-50 to-white">
        <div class="max-w-[80%] mx-auto">
            <!-- Admin Controls (Top Right) -->
            @auth
                <div class="flex justify-end mb-6 space-x-4 animate-reveal-right" style="animation-delay: 0.2s">
                    <a href="{{ route('aboutus.edit') }}"
                        class="px-5 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-full transition-all duration-300 shadow-md hover:shadow-lg flex items-center animate-bounce-in">
                        <i class="fas fa-edit mr-2"></i> Edit Page
                    </a>
                    @if (isset($aboutUs) && $aboutUs->exists)
                        <form action="{{ route('aboutus.destroy') }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to reset the About Us page?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-5 py-2 bg-red-500 hover:bg-red-600 text-white rounded-full transition-all duration-300 shadow-md hover:shadow-lg flex items-center animate-bounce-in"
                                style="animation-delay: 0.3s">
                                <i class="fas fa-trash mr-2"></i> Reset Content
                            </button>
                        </form>
                    @endif
                </div>
            @endauth

            <!-- Main Heading -->
            <div class="text-center mb-16 relative scroll-reveal">
                <div class="absolute -top-6 left-1/2 transform -translate-x-1/2">
                    <svg class="w-16 h-16 text-orange-300 opacity-30 animate-float" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                        </path>
                    </svg>
                </div>
                <h1 class="text-5xl font-bold mb-6 relative animate-reveal-up text-pastry-dark">
                    <span class="relative z-10">{{ $aboutUs->main_title ?? 'About Our Bakery' }}</span>
                    <span
                        class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-orange-400 rounded-full"></span>
                </h1>
                <p class="text-xl max-w-3xl mx-auto animate-reveal-up text-pastry-dark" style="animation-delay: 0.2s">
                    {!! $aboutUs->main_description ??
                        'Welcome to our artisanal bakery where tradition meets innovation. We take pride in crafting delicious pastries using time-honored techniques with a modern twist.' !!}
                </p>
            </div>

            <!-- Content Sections -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Column -->
                <div class="space-y-8 scroll-reveal">
                    <h2 class="text-4xl font-bold animate-reveal-up text-pastry-dark">
                        {{ $aboutUs->why_choose_title ?? 'Why Choose Our Bakery' }}
                    </h2>
                    <p class="text-lg animate-reveal-up text-pastry-dark" style="animation-delay: 0.2s">
                        {{ $aboutUs->why_choose_description ?? 'We combine generations of baking expertise with the finest ingredients to create unforgettable flavors and textures in every bite.' }}
                    </p>

                    <!-- Features -->
                    <div class="space-y-6">
                        @forelse($aboutUs->features ?? [] as $index => $feature)
                            <div class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 group relative animate-reveal-up"
                                style="animation-delay: {{ $index * 0.1 }}s">
                                @auth
                                    <div
                                        class="absolute top-4 right-4 flex space-x-2 opacity-0 group-hover:opacity-100 transition-all duration-300">
                                        <button @click="openFeatureEdit({{ $index }})"
                                            class="w-8 h-8 flex items-center justify-center bg-white text-orange-500 rounded-full shadow-md hover:bg-orange-50 transition-all">
                                            <i class="fas fa-pencil-alt text-sm"></i>
                                        </button>
                                        <button @click="removeFeature({{ $index }})"
                                            class="w-8 h-8 flex items-center justify-center bg-white text-red-500 rounded-full shadow-md hover:bg-red-50 transition-all">
                                            <i class="fas fa-trash-alt text-sm"></i>
                                        </button>
                                    </div>
                                @endauth
                                <h3 class="text-xl font-semibold mb-2 ">
                                    {{ $feature['title'] ?? 'Artisan Quality' }}
                                </h3>
                                <p class="text-gray-600">
                                    {{ $feature['description'] ?? 'Each product is handcrafted with care using traditional techniques.' }}
                                </p>
                            </div>
                        @empty
                            <!-- Default features with staggered animations -->
                            <div class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 animate-reveal-up"
                                style="animation-delay: 0.1s">
                                <h3 class="text-xl font-semibold mb-2 text-gray-800">Handcrafted Daily</h3>
                                <p class="text-gray-600">Our bakers prepare fresh goods every morning using locally-sourced
                                    ingredients.</p>
                            </div>
                            <div class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 animate-reveal-up"
                                style="animation-delay: 0.2s">
                                <h3 class="text-xl font-semibold mb-2 text-gray-800">Family Recipes</h3>
                                <p class="text-gray-600">We use recipes passed down through generations, perfected over
                                    decades.</p>
                            </div>
                            <div class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 animate-reveal-up"
                                style="animation-delay: 0.3s">
                                <h3 class="text-xl font-semibold mb-2 text-gray-800">Eco-Friendly</h3>
                                <p class="text-gray-600">Committed to sustainable practices and biodegradable packaging.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Right Column - Images -->
                <div class="relative h-[600px] scroll-reveal">
                    <!-- Main Image -->
                    <div
                        class="absolute top-0 left-0 w-3/5 aspect-[3/4] rounded-2xl overflow-hidden shadow-xl z-10 animate-reveal-right">
                        <img src="{{ $aboutUs->main_image ? Storage::url($aboutUs->main_image) : asset('bakery/images/main.jpeg') }}"
                            alt="Our bakery interior"
                            class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                    </div>

                    <!-- Secondary Image -->
                    <div class="absolute bottom-0 right-0 w-3/5 aspect-[3/4] rounded-2xl overflow-hidden shadow-xl animate-reveal-right"
                        style="animation-delay: 0.2s">
                        <img src="{{ $aboutUs->secondary_image ? Storage::url($aboutUs->secondary_image) : asset('bakery/images/second.jpeg') }}"
                            alt="Freshly baked goods"
                            class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                    </div>

                    <!-- Decorative elements -->
                    <div class="absolute -z-10 -bottom-8 -left-8 w-32 h-32 bg-orange-200 rounded-full opacity-30 animate-reveal-scale"
                        style="animation-delay: 0.4s"></div>
                    <div class="absolute -z-10 -top-8 -right-8 w-24 h-24 bg-orange-300 rounded-full opacity-20 animate-reveal-scale"
                        style="animation-delay: 0.5s"></div>
                </div>
            </div>
        </div>
    </section>





    <!-- Our Team Section -->
    <section class="py-20 px-4 bg-gradient-to-b from-orange-50 to-white " id="team-section">
        <div class="max-w-[80%] mx-auto">
            <!-- Section Header with Create Button -->
            <div class="text-center mb-16 relative scroll-reveal">
                <div class="flex justify-between items-center mb-8">
                    <span
                        class="inline-block px-4 py-2 bg-orange-100 text-orange-600 rounded-full text-sm font-semibold mb-4 animate-reveal-up">Meet
                        the Experts</span>
                    @auth
                        <a href="{{ route('ourteam.create') }}"
                            class="flex items-center px-5 py-2 bg-pastry-primary hover:bg-orange-600 text-white rounded-full transition-all duration-300 shadow-md hover:shadow-lg animate-bounce-in"
                            style="animation-delay: 0.2s">
                            <i class="fas fa-plus mr-2"></i> Add Team Member
                        </a>
                    @endauth
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-pastry-secondary  mb-4 animate-reveal-up">Our <span
                        class=" text-pastry-primary">Teammembers</span></h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg animate-reveal-up" style="animation-delay: 0.2s">
                    Learn from the best in the industry. Our team of award-winning pastry chefs and bakers bring decades of
                    experience to our classrooms.
                </p>
            </div>

            <!-- Team Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($teamMembers as $index => $member)
                    <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 group relative scroll-reveal"
                        style="transition-delay: {{ $index * 0.1 }}s">
                        <!-- Admin Controls (Edit/Delete) -->
                        @auth
                            <div
                                class="absolute top-4 right-4 z-10 flex space-x-2 opacity-0 group-hover:opacity-100 transition-all duration-300">
                                <a href="{{ route('ourteam.edit', $member->id) }}"
                                    class="w-8 h-8 flex items-center justify-center bg-white text-orange-500 rounded-full shadow-md hover:bg-orange-50 transition-all animate-bounce-in"
                                    style="animation-delay: 0.2s">
                                    <i class="fas fa-pencil-alt text-sm"></i>
                                </a>
                                <form action="{{ route('ourteam.destroy', $member->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this team member?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-8 h-8 flex items-center justify-center bg-white text-red-500 rounded-full shadow-md hover:bg-red-50 transition-all animate-bounce-in"
                                        style="animation-delay: 0.3s">
                                        <i class="fas fa-trash-alt text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        @endauth

                        <div class="relative overflow-hidden h-80">
                            <img src="{{ $member->image_path ? asset('storage/' . $member->image_path) : asset('images/default-team-member.jpg') }}"
                                loading="lazy" alt="{{ $member->name }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                            <!-- Modified gradient - lighter at top, stronger at bottom -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-black/30"></div>
                            <div class="absolute bottom-0 left-0 p-6">
                                <h3 class="text-2xl font-bold text-orange-400 drop-shadow-md">{{ $member->name }}</h3>
                                <p class="font-bold text-white drop-shadow-md">{{ $member->position }}</p>
                            </div>
                        </div>
                        <div class="p-6 ">
                            <p class="text-orange-800 mb-4">{{ $member->bio }}</p>
                            <div class="flex justify-between items-center">
                                <div class="flex space-x-4">
                                    @if ($member->social_instagram)
                                        <a href="{{ $member->social_instagram }}"
                                            aria-label="{{ $member->name }}'s Instagram"
                                            class="text-orange-500 hover:text-orange-600 transition-colors animate-reveal-up"
                                            style="animation-delay: 0.3s">
                                            <i class="fab fa-instagram text-xl"></i>
                                        </a>
                                    @endif
                                    @if ($member->social_facebook)
                                        <a href="{{ $member->social_facebook }}"
                                            aria-label="{{ $member->name }}'s Twitter"
                                            class="text-orange-500 hover:text-orange-600 transition-colors animate-reveal-up"
                                            style="animation-delay: 0.4s">
                                            <i class="fab fa-facebook text-xl"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 animate-reveal-up">
                        <p class="text-gray-500 text-lg">No team members found</p>
                        @auth
                            <a href="{{ route('ourteam.create') }}"
                                class="mt-4 inline-flex items-center px-5 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-full transition-all duration-300 shadow-md hover:shadow-lg animate-bounce-in">
                                <i class="fas fa-plus mr-2"></i> Add Your First Team Member
                            </a>
                        @endauth
                    </div>
                @endforelse
            </div>
        </div>
    </section>



    <!-- Partners Section -->
      <section>
        @include("frontend.aboutus.partners.index")
    </section>




   <!-- Our Endorsed Brands -->


    <section>
        @include("frontend.aboutus.brands.index")
    </section>


    <script>
        // Scroll reveal animation
        document.addEventListener('DOMContentLoaded', function() {
            // Page load animations
            const pageLoadElements = document.querySelectorAll('.page-load-anim');
            pageLoadElements.forEach(el => {
                el.style.animationDelay = '0.1s';
            });

            // Scroll reveal animation
            const scrollRevealElements = document.querySelectorAll('.scroll-reveal');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            scrollRevealElements.forEach(el => {
                observer.observe(el);
            });

            // Staggered animations for team members
            const teamMembers = document.querySelectorAll('.team-member-anim');
            teamMembers.forEach((member, index) => {
                member.style.animationDelay = `${index * 0.1}s`;
            });
        });

        // Smooth scroll to sections
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
  



    @auth
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('aboutUsEditor', () => ({
                    features: @json($aboutUs->features ?? []),

                    openFeatureEdit(index) {
                        // Implement your feature edit modal logic here
                        console.log('Editing feature:', this.features[index]);
                    },

                    removeFeature(index) {
                        if (confirm('Are you sure you want to remove this feature?')) {
                            this.features.splice(index, 1);
                            this.saveChanges();
                        }
                    },

                    addNewFeature() {
                        this.features.push({
                            title: 'New Feature',
                            description: 'Feature description here'
                        });
                        this.saveChanges();
                    },

                    updateMainImage(event) {
                        const file = event.target.files[0];
                        if (file) {
                            // Implement image upload logic
                            console.log('Updating main image:', file);
                        }
                    },

                    updateSecondaryImage(event) {
                        const file = event.target.files[0];
                        if (file) {
                            // Implement image upload logic
                            console.log('Updating secondary image:', file);
                        }
                    },

                    saveChanges() {
                        // Implement AJAX save to server
                        console.log('Saving features:', this.features);
                    }
                }));
            });
        </script>
    @endauth
            @if(session('scroll'))
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const section = document.getElementById('{{ session('scroll') }}');
            if (section) {
                // Smooth scroll to the section
                section.scrollIntoView({ behavior: 'smooth' });
                
                // Optional: Add a highlight effect
                section.style.transition = 'box-shadow 0.5s ease';
                section.style.boxShadow = '0 0 0 4px rgba(249, 115, 22, 0.5)';
                
                setTimeout(() => {
                    section.style.boxShadow = 'none';
                }, 2000);
            }
        });
        </script>
        @endif
@endsection

