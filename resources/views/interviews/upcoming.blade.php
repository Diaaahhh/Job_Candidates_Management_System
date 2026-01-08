@extends('layouts.app')

@section('title', 'Upcoming Interviews')
@section('page-title', 'Upcoming Interviews')

@section('content')
<div class="bg-white rounded-2xl shadow-xl overflow-hidden">
    <!-- Header with Actions -->
    <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Upcoming Interviews</h2>
                <p class="text-sm text-gray-600">Total: {{ count($interviews) }} scheduled</p>
            </div>
            <div class="flex space-x-3">
                @if(count($interviews) > 0)
                    <a href="{{ route('interviews.download-phones') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-sm font-medium">
                        <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Download Phone Numbers
                    </a>
                @endif
                <a href="{{ route('interviews.create') }}" class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:shadow-lg transition-all text-sm font-medium">
                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Schedule New
                </a>
            </div>
        </div>
    </div>

    <!-- Interviews List -->
    <div class="divide-y divide-gray-200">
        @forelse($interviews as $interview)
            <div class="p-6 hover:bg-gray-50 transition-colors">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                                    <span class="text-blue-700 font-bold">{{ $interview->candidate->id }}</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $interview->candidate->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $interview->candidate->email }} • {{ $interview->candidate->phone }}</p>
                                <div class="flex items-center space-x-4 mt-2">
                                    <span class="text-sm text-gray-500">
                                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $interview->interview_date->format('M d, Y') }}
                                    </span>
                                    <span class="text-sm text-gray-500">
                                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ \Carbon\Carbon::parse($interview->interview_time)->format('h:i A') }}
                                    </span>
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $interview->interview_type === 'first' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700' }}">
                                        {{ ucfirst($interview->interview_type) }} Interview
                                    </span>
                                </div>
                                @if($interview->notes)
                                    <p class="text-sm text-gray-500 mt-2">
                                        <strong>Notes:</strong> {{ $interview->notes }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <form action="{{ route('interviews.cancel', $interview->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this interview?');">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors text-sm font-medium">
                                Cancel
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No upcoming interviews</h3>
                <p class="mt-1 text-sm text-gray-500">Schedule a new interview to get started.</p>
                <div class="mt-6">
                    <a href="{{ route('interviews.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Schedule Interview
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
