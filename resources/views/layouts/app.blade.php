<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title', 'Job Candidates Management System')</title>
</head>
<body class="bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 min-h-screen">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        @include('components.sidebar')

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header -->
            <header class="bg-white shadow-md z-10">
                <div class="flex items-center justify-between px-6 py-4">
                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-button" class="lg:hidden text-gray-600 hover:text-gray-900 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <!-- Page Title -->
                    <h1 class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                        @yield('page-title', 'Dashboard')
                    </h1>

                    <!-- User Menu -->
                    <div class="flex items-center space-x-4">
                        @auth
                            <div class="flex items-center space-x-3">
                                <div class="text-right hidden sm:block">
                                    <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray-500">
                                        @if(auth()->user()->isAdmin())
                                            <span class="px-2 py-1 bg-purple-100 text-purple-700 rounded-full">Admin</span>
                                        @elseif(auth()->user()->isStaff())
                                            <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full">Staff</span>
                                        @elseif(auth()->user()->isCandidate())
                                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full">Candidate</span>
                                        @endif
                                    </p>
                                </div>
                                <form action="{{ route('logout') }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors text-sm font-medium">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors text-sm font-medium">
                                Login
                            </a>
                        @endauth
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto p-6">
                <!-- Success/Error Messages -->
                @if(session('success'))
                    <div class="mb-6 animate-slideIn">
                        <div class="bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center space-x-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 animate-slideIn">
                        <div class="bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center space-x-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="font-medium">{{ session('error') }}</span>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Mobile Sidebar Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden lg:hidden"></div>

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');

        mobileMenuButton?.addEventListener('click', () => {
            sidebar?.classList.toggle('-translate-x-full');
            sidebarOverlay?.classList.toggle('hidden');
        });

        sidebarOverlay?.addEventListener('click', () => {
            sidebar?.classList.add('-translate-x-full');
            sidebarOverlay?.classList.add('hidden');
        });

        // Auto-hide success/error messages
        setTimeout(() => {
            const alerts = document.querySelectorAll('.animate-slideIn');
            alerts.forEach(alert => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-20px)';
                setTimeout(() => alert.remove(), 300);
            });
        }, 3000);
    </script>

    <style>
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-slideIn {
            animation: slideIn 0.3s ease-out;
            transition: all 0.3s ease-out;
        }
    </style>
</body>
</html>
