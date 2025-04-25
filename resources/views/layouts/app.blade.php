<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conference App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.3s ease-out;
        }

        /* Progress Bar Style */
        .progress-bar {
            height: 3px;
            background: linear-gradient(90deg, #3b82f6 0%, #8b5cf6 50%, #ec4899 100%);
            width: 0%;
            transition: width 0.3s ease;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 50;
        }

        /* Glass Effect for Buttons */
        .glass-effect {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 0.5rem;
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 font-sans antialiased transition-colors duration-300">
    <!-- Dark Mode Toggle -->
    <button id="theme-toggle" class="fixed bottom-4 right-4 p-3 rounded-full bg-white/80 dark:bg-gray-800/80 shadow-lg glass-effect transition-all hover:shadow-xl">
        <svg id="theme-icon" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <!-- SVG paths will be added via JavaScript -->
        </svg>
    </button>

    <!-- Scroll Progress -->
    <div class="progress-bar"></div>

    @include('partials.nav')

    <main class="max-w-4xl mx-auto px-4 py-10">
        @if(session('success'))
            <div class="mb-6 p-4 rounded-lg bg-green-100 dark:bg-green-900 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-200 animate-fade-in flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button class="text-green-600 dark:text-green-300 hover:text-green-800 dark:hover:text-green-100 transition-colors" data-dismiss>
                    &times;
                </button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Scroll to Top -->
    <button id="scroll-top" class="fixed bottom-20 right-4 p-3 glass-effect bg-white/80 dark:bg-gray-800/80 rounded-full shadow-lg transition-opacity opacity-0 invisible">
        ↑
    </button>

    <script>
        // Dark Mode Toggle
        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        const html = document.documentElement;

        function toggleTheme() {
            html.classList.toggle('dark');
            localStorage.setItem('theme', html.classList.contains('dark') ? 'dark' : 'light');
            updateThemeIcon();
        }

        function updateThemeIcon() {
            const isDark = html.classList.contains('dark');
            themeIcon.innerHTML = isDark ? 
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>' :
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707"/>';
        }

        // Initialize theme
        const savedTheme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        if (savedTheme === 'dark') html.classList.add('dark');
        updateThemeIcon();
        themeToggle.addEventListener('click', toggleTheme);

        // Scroll Progress
        window.addEventListener('scroll', () => {
            const scrollTop = document.documentElement.scrollTop;
            const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
            const progress = (scrollTop / scrollHeight) * 100;
            document.querySelector('.progress-bar').style.width = `${progress}%`;

            // Scroll to Top Button Visibility
            const scrollTopBtn = document.getElementById('scroll-top');
            if (scrollTop > 300) {
                scrollTopBtn.classList.remove('opacity-0', 'invisible');
                scrollTopBtn.classList.add('opacity-100', 'visible');
            } else {
                scrollTopBtn.classList.remove('opacity-100', 'visible');
                scrollTopBtn.classList.add('opacity-0', 'invisible');
            }
        });

        document.getElementById('scroll-top').addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Dismiss Success Message Functionality
        document.querySelectorAll('[data-dismiss]').forEach(button => {
            button.addEventListener('click', (e) => {
                const alert = e.target.closest('.alert');
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            });
        });

        // Intersection Observer for animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                    entry.target.classList.remove('opacity-0', 'translate-y-6');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));
    </script>
</body>
</html>