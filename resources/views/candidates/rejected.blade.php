@extends('layouts.app')

@section('title', 'Rejected Candidates')
@section('page-title', 'Rejected Candidates')

@section('content')
<div class="bg-white rounded-2xl shadow-xl overflow-hidden">
    <!-- Header -->
    <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-red-50 to-pink-50">
        <div>
            <h2 class="text-lg font-semibold text-gray-800">Rejected Candidates</h2>
            <p class="text-sm text-gray-600">Total: {{ count($candidates) }} rejected</p>
        </div>
    </div>

    <!-- Candidates List -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Candidate</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rejected Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reason</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($candidates as $candidate)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                                    <span class="text-red-700 font-bold">{{ $candidate->id }}</span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $candidate->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $candidate->email }}</div>
                            <div class="text-sm text-gray-500">{{ $candidate->phone }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $candidate->rejected_at ? $candidate->rejected_at->format('M d, Y') : 'N/A' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $candidate->rejection_reason ?? 'No reason provided' }}
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium">
                            <a href="{{ route('show', $candidate->id) }}" class="text-indigo-600 hover:text-indigo-900">View Details</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5"/>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No rejected candidates</h3>
                            <p class="mt-1 text-sm text-gray-500">Candidates will appear here after being rejected.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
