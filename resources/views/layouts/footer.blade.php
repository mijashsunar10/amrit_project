    <!-- Footer Section -->
    <footer class="relative bg-contain  text-white pt-16 bottom-0 mt-auto"
        style="background-image: url('{{ asset('images/hero/bread.jpg') }}');">
        <!-- Flour Particle Animation -->
        <div class="absolute inset-0 overflow-hidden z-0 bg-[rgba(42,26,15,0.85)] ">
            <canvas id="flourParticles" class="w-full h-full"></canvas>
        </div>

        <div class="relative z-10 container mx-auto px-4 pb-12 ">
            <div class="flex flex-col md:flex-row justify-between gap-10">
                <!-- About -->
                <div class="md:w-1/3">
                    <h2 class="text-2xl font-bold text-pastry-cream mb-4">SCHOOL OF BAKING & <br>
                        <span>PASTRY TECHNOLOGY</span>

                    </h2>
                    <p class="text-pastry-cream text-sm">
                        Discover the heart of artisan baking. From crusty croissants to creamy éclairs, we blend passion
                        and precision since 2005.
                    </p>
                </div>

                <!-- Quick Links -->
                <div class="md:w-1/3">
                    <a href="">
                        <h4 class="text-lg text-pastry-secondary font-semibold mb-4 border-b-2 border-primary pb-2">Contact Us</h4>
                        <ul class="text-pastry-cream space-y-3 text-sm">
                            <li class="flex items-center">
                                <i class="fas fa-map-marker-alt mr-3 text-xl text-pastry-accent"></i>
                               Street 13, Lakeside, Pokhara
                            </li>
                            <li class="flex items-center">
                                <i class="far fa-envelope mr-3 text-xl  text-pastry-accent"></i>
                                @gmail.com
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-phone-alt mr-3 text-xl  text-pastry-accent"></i>
                                +123 456 7890
                            </li>
                            <li class="flex items-center ">
                                <i class="far fa-clock mr-3 text-xl text-pastry-accent"></i>
                                Throught Week 9am - 9pm
                            </li>
                        </ul>
                    </a>
                </div>

                <!-- Newsletter -->
                <div class="mb-8 md:mb-0">
                        <a href="">
                        <h4 class="text-lg text-pastry-secondary font-semibold mb-4 border-b-2 border-primary pb-2">Contact Us</h4>
                        <ul class="text-pastry-cream space-y-3 text-sm">
                            <li class="flex items-center">
                                <i class="fas fa-map-marker-alt mr-3 text-xl text-pastry-accent"></i>
                               Street 13, Lakeside, Pokhara
                            </li>
                            <li class="flex items-center">
                                <i class="far fa-envelope mr-3 text-xl  text-pastry-accent"></i>
                                @gmail.com
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-phone-alt mr-3 text-xl  text-pastry-accent"></i>
                                +123 456 7890
                            </li>
                            <li class="flex items-center ">
                                <i class="far fa-clock mr-3 text-xl text-pastry-accent"></i>
                                Throught Week 9am - 9pm
                            </li>
                        </ul>
                    </a>
                    </div>
            </div>

            <!-- Footer Bottom -->
            <div class="mt-10 border-t border-white/20 pt-6 text-center text-sm text-pastry-cream">
                &copy; {{ now()->year }} Sweet Chronicles. All Rights Reserved.
            </div>
        </div>
    </footer>

    <!-- Particle Animation Script -->
   <script>
    const canvas = document.getElementById('flourParticles');
    const ctx = canvas.getContext('2d');
    let particlesArray = [];

    // Set initial canvas dimensions
    canvas.width = window.innerWidth;
    canvas.height = 300;

    class Particle {
        constructor(sizeScale) {
            this.x = Math.random() * canvas.width;
            this.y = Math.random() * canvas.height;
            this.size = (Math.random() * 2 + 1.5) * sizeScale;
            this.speedY = Math.random() * 0.5 + 0.2;
            this.opacity = Math.random() * 0.5 + 0.3;
        }

        update() {
            this.y += this.speedY;
            if (this.y > canvas.height) {
                this.y = 0;
                this.x = Math.random() * canvas.width;
            }
        }

        draw() {
            ctx.fillStyle = `rgba(255, 250, 160, ${this.opacity})`;
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
            ctx.fill();
        }
    }

    function initParticles() {
        particlesArray = [];
        const baseWidth = 1280;  // Reference width for desktop design
        const scale = canvas.width / baseWidth;
        
        // Adjust particle count based on screen width (capped between 20-150)
        let particleCount = Math.floor(50 * scale);
        particleCount = Math.min(150, Math.max(20, particleCount));
        
        // Control size scaling (0.5-1 range prevents extreme sizing)
        const sizeScale = Math.min(1, Math.max(0.5, scale));
        
        for (let i = 0; i < particleCount; i++) {
            particlesArray.push(new Particle(sizeScale));
        }
    }

    function animateParticles() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        particlesArray.forEach(p => {
            p.update();
            p.draw();
        });
        requestAnimationFrame(animateParticles);
    }

    // Handle viewport changes
    window.addEventListener('resize', () => {
        canvas.width = window.innerWidth;
        canvas.height = 300;
        initParticles();
    });

    // Start the animation
    initParticles();
    animateParticles();
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    if (window.location.hash === '#journey-section') {
        const element = document.getElementById('journey-section');
        if (element) {
            element.scrollIntoView();
        }
    }
});
</script>
