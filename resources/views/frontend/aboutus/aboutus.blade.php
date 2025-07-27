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

        .scroll-reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s cubic-bezier(0.5, 0, 0, 1);
        }

        .scroll-reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .page-load-anim {
            opacity: 0;
            animation: fadeInUp 0.8s ease-out forwards;
        }

        /* BookCycle Color Theme */
        .bg-bookcycle-light {
            background-color: #fff9e6; /* Light yellow */
        }
        
        .bg-bookcycle-primary {
            background-color: #ffde7a; /* Medium yellow */
        }
        
        .text-bookcycle-dark {
            color: #5c4d00; /* Dark yellow for text */
        }
        
        .border-bookcycle {
            border-color: #ffde7a;
        }
    </style>

    <!-- Hero Section -->


    <!-- About Us Section -->
    <section class="py-4 px-4 bg-bookcycle-light">
        <div class="max-w-[80%] mx-auto">
            @auth
                <div class="flex justify-end mb-6 space-x-4 animate-reveal-right" style="animation-delay: 0.2s">
                    <a href="{{ route('aboutus.edit') }}" class="px-5 py-2 bg-bookcycle-primary hover:bg-yellow-600 text-white rounded-full transition-all duration-300 shadow-md hover:shadow-lg flex items-center animate-bounce-in">
                        <i class="fas fa-edit mr-2"></i> Edit Page
                    </a>
                </div>
            @endauth

            <!-- Main Heading -->
            <div class="text-center mb-16 relative scroll-reveal">
                <div class="absolute -top-6 left-1/2 transform -translate-x-1/2">
                    <svg class="w-16 h-16 text-yellow-300 opacity-30 animate-float" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                </div>
                <h1 class="text-5xl font-bold mb-6 relative animate-reveal-up text-bookcycle-dark">
                    <span class="relative z-10">{{ $aboutUs->main_title ?? 'About BookCycle' }}</span>
                    <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-yellow-400 rounded-full"></span>
                </h1>
                <p class="text-xl max-w-3xl mx-auto animate-reveal-up text-bookcycle-dark" style="animation-delay: 0.2s">
                    {!! $aboutUs->main_description ?? 'Welcome to BookCycle, where we give books new life! We connect book lovers with affordable second-hand books while promoting sustainable reading habits.' !!}
                </p>
            </div>

            <!-- Content Sections -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Column -->
                <div class="space-y-8 scroll-reveal">
                    <h2 class="text-4xl font-bold animate-reveal-up text-bookcycle-dark">
                        {{ $aboutUs->why_choose_title ?? 'Why Choose BookCycle?' }}
                    </h2>
                    <p class="text-lg animate-reveal-up text-bookcycle-dark" style="animation-delay: 0.2s">
                        {{ $aboutUs->why_choose_description ?? 'We make reading affordable and sustainable by creating a circular economy for books.' }}
                    </p>

                    <!-- Features -->
                    <div class="space-y-6">
                        @forelse($aboutUs->features ?? [] as $index => $feature)
                            <div class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 group relative animate-reveal-up" style="animation-delay: {{ $index * 0.1 }}s">
                                <h3 class="text-xl font-semibold mb-2">
                                    {{ $feature['title'] ?? 'Affordable Books' }}
                                </h3>
                                <p class="text-gray-600">
                                    {{ $feature['description'] ?? 'Get quality books at a fraction of the original price.' }}
                                </p>
                            </div>
                        @empty
                            <div class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 animate-reveal-up" style="animation-delay: 0.1s">
                                <h3 class="text-xl font-semibold mb-2 text-gray-800">Eco-Friendly</h3>
                                <p class="text-gray-600">Reduce waste by giving books a second life through our platform.</p>
                            </div>
                            <div class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 animate-reveal-up" style="animation-delay: 0.2s">
                                <h3 class="text-xl font-semibold mb-2 text-gray-800">Vast Collection</h3>
                                <p class="text-gray-600">From classics to contemporary, find books for every taste.</p>
                            </div>
                            <div class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 animate-reveal-up" style="animation-delay: 0.3s">
                                <h3 class="text-xl font-semibold mb-2 text-gray-800">Community Driven</h3>
                                <p class="text-gray-600">Join a community of book lovers who share your passion.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Right Column - Images -->
                <div class="relative h-[600px] scroll-reveal">
                    <div class="absolute top-0 left-0 w-3/5 aspect-[3/4] rounded-2xl overflow-hidden shadow-xl z-10 animate-reveal-right">
                        <img src="{{  asset('images/product-item1.jpg') }}" alt="Book collection" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                    </div>
                    <div class="absolute bottom-0 right-0 w-3/5 aspect-[3/4] rounded-2xl overflow-hidden shadow-xl animate-reveal-right" style="animation-delay: 0.2s">
                        <img src="{{  asset('images/tab-item2.jpg') }}" alt="Person reading" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team Section -->
    <section class="py-20 px-4 bg-bookcycle-light" id="team-section">
        <div class="max-w-[80%] mx-auto">
            <div class="text-center mb-16 relative scroll-reveal">
                <span class="inline-block px-4 py-2 bg-yellow-100 text-yellow-600 rounded-full text-sm font-semibold mb-4 animate-reveal-up">Meet the Team</span>
                <h2 class="text-4xl md:text-5xl font-bold text-bookcycle-dark mb-4 animate-reveal-up">Our <span class="text-yellow-600">BookCycle</span> Team</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg animate-reveal-up" style="animation-delay: 0.2s">
                    The passionate team behind BookCycle who make this literary ecosystem possible.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($teamMembers as $index => $member)
                    <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 group relative scroll-reveal" style="transition-delay: {{ $index * 0.1 }}s">
                        <div class="relative overflow-hidden h-80">
                            <img src="{{ $member->image_path ? asset('storage/' . $member->image_path) : asset('images/default-team-member.jpg') }}" loading="lazy" alt="{{ $member->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-black/30"></div>
                            <div class="absolute bottom-0 left-0 p-6">
                                <h3 class="text-2xl font-bold text-yellow-400 drop-shadow-md">{{ $member->name }}</h3>
                                <p class="font-bold text-white drop-shadow-md">{{ $member->position }}</p>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-700 mb-4">{{ $member->bio }}</p>
                            <div class="flex space-x-4">
                                @if($member->social_instagram)
                                    <a href="{{ $member->social_instagram }}" class="text-yellow-500 hover:text-yellow-600 transition-colors">
                                        <i class="fab fa-instagram text-xl"></i>
                                    </a>
                                @endif
                                @if($member->social_facebook)
                                    <a href="{{ $member->social_facebook }}" class="text-yellow-500 hover:text-yellow-600 transition-colors">
                                        <i class="fab fa-facebook text-xl"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 animate-reveal-up">
                        <p class="text-gray-500 text-lg">No team members found</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
        });
    </script>
@endsection