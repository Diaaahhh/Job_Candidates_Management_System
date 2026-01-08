@php
    use App\Models\AllCandidate;
    use App\Models\Interview;
    
    // Get counts for sidebar badges
    $allCandidatesCount = AllCandidate::count();
    $hiredCount = AllCandidate::hired()->count();
    $rejectedCount = AllCandidate::rejected()->count();
    $upcomingInterviewsCount = Interview::upcoming()->count();
    $completedInterviewsCount = Interview::completed()->count();
    $passedCount = AllCandidate::passed()->count();
@endphp

<aside id="sidebar" class="w-64 bg-white shadow-xl transform transition-transform duration-300 ease-in-out lg:translate-x-0 -translate-x-full fixed lg:relative h-full z-40 overflow-y-auto">
    <!-- Logo/Brand -->
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
            Candidate Manager
        </h2>
        <p class="text-xs text-gray-500 mt-1">Job Application System</p>
    </div>

    <!-- Navigation Menu -->
    <nav class="p-4 space-y-2">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            <span>Dashboard</span>
        </a>

        <!-- All Candidates -->
        <a href="{{ route('all_candidates') }}" class="sidebar-link {{ request()->routeIs('all_candidates') ? 'active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <span>All Candidates</span>
            @if($allCandidatesCount > 0)
                <span class="ml-auto px-2 py-1 text-xs font-semibold bg-indigo-100 text-indigo-700 rounded-full">
                    {{ $allCandidatesCount }}
                </span>
            @endif
        </a>

        <!-- Divider -->
        <div class="border-t border-gray-200 my-3"></div>

        <!-- Interview Management Section -->
        <div class="px-3 py-2">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Interview Management</p>
        </div>

        <!-- Create Interview -->
        @can('create-interview')
        <a href="{{ route('interviews.create') }}" class="sidebar-link {{ request()->routeIs('interviews.create') ? 'active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Create Interview</span>
        </a>
        @endcan

        <!-- Upcoming Interviews -->
        <a href="{{ route('interviews.upcoming') }}" class="sidebar-link {{ request()->routeIs('interviews.upcoming') ? 'active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <span>Upcoming Interviews</span>
            @if($upcomingInterviewsCount > 0)
                <span class="ml-auto px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-700 rounded-full">
                    {{ $upcomingInterviewsCount }}
                </span>
            @endif
        </a>

        <!-- Completed Interviews -->
        <a href="{{ route('interviews.completed') }}" class="sidebar-link {{ request()->routeIs('interviews.completed') ? 'active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>Completed Interviews</span>
            @if($completedInterviewsCount > 0)
                <span class="ml-auto px-2 py-1 text-xs font-semibold bg-gray-100 text-gray-700 rounded-full">
                    {{ $completedInterviewsCount }}
                </span>
            @endif
        </a>

        <!-- Divider -->
        <div class="border-t border-gray-200 my-3"></div>

        <!-- Candidate Status Section -->
        <div class="px-3 py-2">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Candidate Status</p>
        </div>

        <!-- Passed Candidates -->
        <a href="{{ route('candidates.passed') }}" class="sidebar-link {{ request()->routeIs('candidates.passed') ? 'active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
            </svg>
            <span>Passed Candidates</span>
            @if($passedCount > 0)
                <span class="ml-auto px-2 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full">
                    {{ $passedCount }}
                </span>
            @endif
        </a>

        <!-- Hired Candidates -->
        <a href="{{ route('candidates.hired') }}" class="sidebar-link {{ request()->routeIs('candidates.hired') ? 'active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
            </svg>
            <span>Hired Candidates</span>
            @if($hiredCount > 0)
                <span class="ml-auto px-2 py-1 text-xs font-semibold bg-emerald-100 text-emerald-700 rounded-full">
                    {{ $hiredCount }}
                </span>
            @endif
        </a>

        <!-- Rejected Candidates -->
        <a href="{{ route('candidates.rejected') }}" class="sidebar-link {{ request()->routeIs('candidates.rejected') ? 'active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5"/>
            </svg>
            <span>Rejected Candidates</span>
            @if($rejectedCount > 0)
                <span class="ml-auto px-2 py-1 text-xs font-semibold bg-red-100 text-red-700 rounded-full">
                    {{ $rejectedCount }}
                </span>
            @endif
        </a>

        <!-- Divider -->
        <div class="border-t border-gray-200 my-3"></div>

        <!-- Excel Upload (Staff & Admin only) -->
        @can('upload-excel')
        <a href="{{ route('excel.upload') }}" class="sidebar-link {{ request()->routeIs('excel.upload') ? 'active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
            </svg>
            <span>Upload Excel</span>
        </a>
        @endcan
    </nav>
</aside>

<style>
    .sidebar-link {
        @apply flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition-all duration-200 font-medium text-sm;
    }
    
    .sidebar-link.active {
        @apply bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-lg;
    }
    
    .sidebar-link.active svg {
        @apply text-white;
    }
    
    .sidebar-link:hover:not(.active) {
        @apply transform scale-105;
    }
</style>
