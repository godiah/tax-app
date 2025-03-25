<section id="home" class="relative w-full min-h-screen flex items-center">
    {{-- <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/40 backdrop-blur-sm"></div> --}}

    <div class="relative container mx-auto px-4 grid md:grid-cols-2 gap-8 items-center z-10 max-w-7xl">
        <!-- Content Container -->
        <div class="text-dark-text space-y-6">
            <div class="inline-flex items-center mb-4">
                <span class="inline-block bg-secondary/20 text-secondary px-3 py-1 rounded-full text-sm font-medium">
                    <span class="mr-2">🏆</span>
                    Expert Tax Consultancy
                </span>
            </div>

            <h1 class="text-4xl md:text-5xl font-heading font-bold leading-tight">
                <span class="block">Maximize Your</span>
                <span class="block text-secondary">Tax Efficiency</span>
            </h1>

            <p class="text-xl font-body max-w-xl">
                Navigate the complexities of Kenyan tax laws with personalized, expert advice that saves you money and
                ensures compliance.
            </p>

            <div class="flex space-x-4">
                <a href="#contact"
                    class="bg-gradient-to-r from-primary to-secondary hover:from-primary-hover hover:to-secondary text-white font-medium py-3 px-6 rounded-lg transition-all duration-300 flex items-center">
                    Book a Consultation
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
                <a href="#about"
                    class="border-2 border-white hover:bg-white hover:text-dark-text text-white font-medium py-3 px-6 rounded-lg transition-all duration-300">
                    Learn More
                </a>
            </div>

            <div class="pt-6 border-t border-white/20 flex space-x-6 text-white/80">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-secondary" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                    </svg>
                    <span>Save Time & Money</span>
                </div>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-secondary" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                    </svg>
                    <span>Expert Guidance</span>
                </div>
            </div>
        </div>

        <!-- Consultant Image  -->
        <div class="hidden md:block">
            <div class="rounded-lg overflow-hidden">
                <img src="{{ asset('images/tax-1.jpeg') }}" alt="Professional Tax Consultant"
                    class="w-full h-auto object-cover object-center" loading="lazy">
            </div>
        </div>
    </div>
</section>
