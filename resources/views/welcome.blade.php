<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Additional CSS -->
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .smooth-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        .button-hover {
            transition: all 0.2s ease;
            transform-origin: center;
        }

        .button-hover:hover {
            transform: scale(1.05);
        }

        @media (prefers-reduced-motion: reduce) {
            .smooth-transition,
            .card-hover,
            .button-hover {
                transition: none !important;
                animation: none !important;
            }
        }

        /* Custom Scrollbar for Webkit Browsers */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>

    <!-- Existing Styles -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <!-- Existing inline styles -->
    @endif
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col smooth-transition">
    
    <!-- Dark Mode Toggle -->
    <button id="theme-toggle" class="fixed top-4 right-4 p-2 rounded-full bg-white/80 dark:bg-[#1b1b18]/80 backdrop-blur-sm shadow-lg hover:shadow-xl smooth-transition">
        <svg id="theme-icon" class="w-6 h-6 text-[#1b1b18] dark:text-[#EDEDEC]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <!-- SVG path will be dynamically updated -->
        </svg>
    </button>

    <header class="flex justify-between items-center w-full lg:max-w-4xl max-w-[335px] mb-6">
        @if (Route::has('login'))
            <nav class="flex items-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="button-hover inline-block px-5 py-1.5 dark:text-[#EDEDEC] border border-[#19140035] hover:border-[#1915014a] text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm">
                        Dashboard
                    </a>
                @else
                  
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750">
        <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row card-hover">
            <!-- Content Section -->
            <div class="text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none">
                <!-- Content goes here -->
            </div>

            <!-- Graphic Section -->
            <div class="bg-[#fff2f2] dark:bg-[#1D0002] relative lg:-ml-px -mb-px lg:mb-0 rounded-t-lg lg:rounded-t-none lg:rounded-r-lg aspect-[335/376] lg:aspect-auto w-full lg:w-[438px] shrink-0 overflow-hidden">
                <!-- SVG Graphic -->
                <svg class="animate-float w-full text-[#F53003] dark:text-[#F61500] transition-all opacity-100 duration-750 starting:opacity-0 starting:translate-y-6" viewBox="0 0 438 104">
                    <!-- SVG paths go here -->
                </svg>
                
                <div class="absolute inset-0 rounded-t-lg lg:rounded-t-none lg:rounded-r-lg shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]"></div>
            </div>
        </main>
    </div>

    <script>
        // Dark Mode Toggle Logic
        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        const htmlElement = document.documentElement;

        function toggleTheme() {
            htmlElement.classList.toggle('dark');
            localStorage.setItem('theme', htmlElement.classList.contains('dark') ? 'dark' : 'light');
            updateThemeIcon();
        }

        function updateThemeIcon() {
            const isDark = htmlElement.classList.contains('dark');
            themeIcon.innerHTML = isDark ? 
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>' :
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707"/>';
        }

        // Initialize theme on page load
        const savedTheme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        if (savedTheme === 'dark') htmlElement.classList.add('dark');
        updateThemeIcon();
        themeToggle.addEventListener('click', toggleTheme);

        // Scroll animations for elements
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                    entry.target.classList.remove('opacity-0', 'translate-y-6');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.starting').forEach((el) => observer.observe(el));
        
        // Button hover effects
        document.querySelectorAll('.button-hover').forEach(button => {
            button.addEventListener('mousemove', e => {
                const rect = button.getBoundingClientRect();
                const x = (e.clientX - rect.left) / button.offsetWidth - 0.5;
                const y = (e.clientY - rect.top) / button.offsetHeight - 0.5;
                
                button.style.transform = `scale(1.05) rotateX(${y * 6}deg) rotateY(${x * 6}deg)`;
            });

            button.addEventListener('mouseleave', () => {
                button.style.transform = 'scale(1) rotateX(0) rotateY(0)';
            });
        });
    </script>
</body>
</html>