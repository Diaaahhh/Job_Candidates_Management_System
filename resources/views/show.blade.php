<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>{{ $candidate->name }} - Candidate Profile</title>
</head>
<body class="bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <!-- Navigation -->
        <div class="mb-6">
            <a href="{{ route('all_candidates') }}" class="group inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium transition duration-200">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to All Candidates
            </a>
        </div>

        <!-- Profile Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <!-- Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-8 py-8 text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white bg-opacity-20 rounded-full mb-4 text-white text-3xl font-bold backdrop-blur-sm">
                    {{ substr($candidate->name, 0, 1) }}
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">{{ $candidate->name }}</h1>
                <p class="text-indigo-100">{{ $candidate->email }}</p>
            </div>

            <!-- Content -->
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <!-- Personal Info -->
                    <div class="space-y-4">
                        <h2 class="text-xs font-bold text-gray-500 uppercase tracking-wide border-b border-gray-100 pb-2">Personal Information</h2>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-500">Phone</p>
                                <p class="text-base text-gray-900">{{ $candidate->phone }}</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-500">Age</p>
                                <p class="text-base text-gray-900">{{ $candidate->age }} Years Old</p>
                            </div>
                        </div>
                    </div>

                    <!-- Professional Info -->
                    <div class="space-y-4">
                        <h2 class="text-xs font-bold text-gray-500 uppercase tracking-wide border-b border-gray-100 pb-2">Professional Summary</h2>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-500">Experience</p>
                                <p class="text-base text-gray-900">{{ $candidate->experience_years }} Years</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Previous Experience List -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Previous Experience
                    </h3>
                    
                    @if($candidate->previous_experience && count($candidate->previous_experience) > 0)
                        <div class="grid grid-cols-1 gap-4">
                            @foreach($candidate->previous_experience as $company => $role)
                                <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm text-gray-500 font-medium">Company</p>
                                            <p class="text-lg font-semibold text-gray-800">{{ $company }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm text-gray-500 font-medium">Role</p>
                                            <span class="inline-block px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-sm font-medium">
                                                {{ $role }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-6 text-gray-500">
                            No previous experience listed.
                        </div>
                    @endif
                </div>

                <!-- Footer Actions -->
                <div class="mt-8 flex justify-end space-x-4">
                    <a href="{{ route('edit', $candidate->id) }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition duration-200 shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Candidate
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
