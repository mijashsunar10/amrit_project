@extends('template.template')

@section('pagecontent')
    <style>
        /* Smooth FAQ open/close */
        .faq-answer {
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            transition: max-height 0.5s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.4s ease;
        }

        .faq-answer.open {
            /* max-height set dynamically via JS based on scrollHeight */
        }

        /* Enhanced paragraph styling */
        .faq-answer p {
            font-size: 1.125rem;
            /* 18px */
            line-height: 1.75rem;
            /* 28px */
        }

        /* Content translate for fade-in effect */
        .faq-answer .content {
            transform: translateY(-10px);
            transition: transform 0.3s ease, padding 0.3s ease;
        }

        .faq-answer.open .content {
            transform: translateY(0);
        }

        /* Border accent and shadow */
        .faq-answer {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        /* Floating animations for other elements */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-float-delay {
            animation: float 6s ease-in-out infinite 1s;
        }

        .animate-float-delay-2 {
            animation: float 6s ease-in-out infinite 2s;
        }

        /* Highlight effect */
        .highlight-text::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 30%;
            background-color: #fbcfe8;
            opacity: 0.4;
            z-index: -1;
            transition: height 0.3s ease, opacity 0.3s ease;
        }

        .highlight-text:hover::after {
            height: 50%;
            opacity: 0.6;
        }
    </style>


    <section class="min-h-screen bg-amber-100 py-12 px-4 sm:px-6 lg:px-8">
        <!-- Decorative floating elements (using Tailwind for base styles) -->
        <div class="fixed top-20 left-10 w-16 h-16 rounded-full bg-rose-200 opacity-20 animate-float"></div>
        <div class="fixed bottom-1/3 right-20 w-24 h-24 rounded-full bg-amber-200 opacity-15 animate-float-delay"></div>
        <div class="fixed top-1/4 right-1/4 w-12 h-12 rounded-full bg-amber-300 opacity-10 animate-float-delay-2"></div>

        <div class="flex items-center justify-center">
            <div class="w-full max-w-5xl">
                <!-- Header with decorative elements -->
                <div class="relative overflow-hidden bg-white/90 rounded-xl mb-8 shadow-lg backdrop-blur-sm">
                    <div class="absolute inset-0 bg-gradient-to-r from-amber-900/5 to-amber-600/5"></div>
                    <div class="relative z-10 text-center py-8 px-6">
                        <h1 class="text-4xl md:text-5xl font-bold text-amber-900 font-serif">
                            <span class="relative inline-block highlight-text">
                               Book Cycle
                            </span>
                        </h1>
                        <div class="w-24 h-1 bg-amber-500 mx-auto my-4 rounded-full"></div>
                        <p class="mt-4 text-lg text-amber-800 max-w-2xl mx-auto">
                            Answers to all your questions about our culinary programs
                        </p>
                        @auth
                            <a href="{{ route('faqs.create') }}" class="inline-block mt-6">
                                <button
                                    class="text-white font-bold px-6 py-2 bg-gradient-to-r from-amber-600 to-amber-800 rounded-full hover:shadow-lg transition-all duration-300 hover:scale-105 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Add New FAQ
                                </button>
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- FAQ Container -->
                <div id="faq-container" class="space-y-6">
                    @foreach ($faqs as $index => $faq)
                        <div class="group">
                            <button
                                class="faq-toggle w-full flex justify-between items-center text-left p-6 text-lg font-semibold text-amber-900 bg-white focus:outline-none shadow-lg hover:shadow-xl transition-all duration-300 rounded-xl"
                                onclick="toggleAnswer('answer{{ $faq->id }}')" aria-expanded="false">
                                <div class="flex items-center">
                                    <span
                                        class="w-8 h-8 flex items-center justify-center bg-amber-600 text-white rounded-full mr-4 font-mono">{{ $index + 1 }}</span>
                                    <span class="text-left">{{ $faq->question }}</span>
                                </div>
                                <svg id="icon{{ $faq->id }}"
                                    class="ml-2 w-6 h-6 text-amber-700 transition-transform duration-300 transform"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="faq-answer rounded-b-xl mt-1 bg-white/90 border-l-4 border-amber-600"
                                id="answer{{ $faq->id }}">
                                <div class="content pb-6 pt-4 px-6">
                                    <p class="text-amber-700  leading-relaxed text-lg">
                                        {{ $faq->answer }}
                                    </p>
                                    @auth
                                        <div class="mt-4 flex flex-wrap gap-3">
                                            <a href="{{ route('faqs.edit', $faq->slug) }}"
                                                class="transition-all duration-200 hover:scale-105">
                                                <button
                                                    class="text-white font-bold px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg hover:shadow-md flex items-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                                        fill="currentColor">
                                                        <path
                                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                    </svg>
                                                    Edit
                                                </button>
                                            </a>
                                            <form action="{{ route('faqs.destroy', $faq->slug) }}" method="POST"
                                                class="transition-all duration-200 hover:scale-105">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-white font-bold px-4 py-2 bg-gradient-to-r from-red-500 to-red-700 rounded-lg hover:shadow-md flex items-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                                        fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


                <!-- Footer -->
                <div class="mt-12 text-center">
                    <p class="text-amber-800">Still have questions?</p>
                    <button
                        class="mt-4 px-8 py-3 bg-gradient-to-r from-amber-600 to-amber-800 text-white font-bold rounded-full hover:shadow-lg transition-all duration-300 hover:scale-105">
                        <a href="\contact">Contact Us</a>
                    </button>
                    <div class="mt-6 flex justify-center space-x-4">
                        <div class="w-10 h-10 rounded-full bg-amber-400 opacity-30"></div>
                        <div class="w-10 h-10 rounded-full bg-amber-600 opacity-30"></div>
                        <div class="w-10 h-10 rounded-full bg-amber-800 opacity-30"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Toggle FAQ answers with smoother animation
        function toggleAnswer(answerId) {
            const answer = document.getElementById(answerId);
            const icon = document.getElementById(`icon${answerId.replace('answer', '')}`);

            const isOpen = answer.classList.contains('open');
            if (isOpen) {
                // Close: animate height and opacity
                answer.style.maxHeight = '0';
                answer.style.opacity = '0';
                icon.classList.remove('rotate-180');
                answer.addEventListener('transitionend', () => {
                    answer.classList.remove('open');
                }, {
                    once: true
                });
            } else {
                // Open: first add class to calculate height
                answer.classList.add('open');
                const fullHeight = answer.scrollHeight;
                answer.style.maxHeight = fullHeight + 'px';
                answer.style.opacity = '1';
                icon.classList.add('rotate-180');
            }
        }
    </script>
@endsection
