@extends('layouts.app')

@section('title', 'Passed Candidates')
@section('page-title', 'Passed Candidates')

@section('content')
<div class="bg-white rounded-2xl shadow-xl overflow-hidden">
    <!-- Header -->
    <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-green-50 to-blue-50">
        <div>
            <h2 class="text-lg font-semibold text-gray-800">Passed Candidates</h2>
            <p class="text-sm text-gray-600">Total: {{ count($candidates) }} passed • Eligible for second interview</p>
        </div>
    </div>

    <!-- Candidates List -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Candidate</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Experience</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($candidates as $candidate)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                    <span class="text-green-700 font-bold">{{ $candidate->id }}</span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $candidate->name }}</div>
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                        Passed
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $candidate->email }}</div>
                            <div class="text-sm text-gray-500">{{ $candidate->phone }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $candidate->experience_years }} Years
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium space-x-2">
                            <a href="{{ route('show', $candidate->id) }}" class="text-indigo-600 hover:text-indigo-900">View Details</a>
                            <span class="text-gray-300">|</span>
                            <form action="{{ route('candidates.mark-hired', $candidate->id) }}" method="POST" class="inline" onsubmit="return confirm('Mark this candidate as hired?');">
                                @csrf
                                <button type="submit" class="text-green-600 hover:text-green-900 font-medium">
                                    Mark as Hired
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No passed candidates</h3>
                            <p class="mt-1 text-sm text-gray-500">Candidates will appear here after passing their interview.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
