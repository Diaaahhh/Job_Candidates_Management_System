@extends('layouts.app')

@section('title', 'Completed Interviews')
@section('page-title', 'Completed Interviews')

@section('content')
<div class="bg-white rounded-2xl shadow-xl overflow-hidden">
    <!-- Header -->
    <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-indigo-50">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Completed Interviews</h2>
                <p class="text-sm text-gray-600">Total: {{ count($interviews) }} completed</p>
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
                                <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center">
                                    <span class="text-gray-700 font-bold">{{ $interview->candidate->id }}</span>
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
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $interview->interview_type === 'first' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700' }}">
                                        {{ ucfirst($interview->interview_type) }} Interview
                                    </span>
                                    @if($interview->candidate->current_status === 'passed')
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                            Passed
                                        </span>
                                    @elseif($interview->candidate->current_status === 'rejected')
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">
                                            Rejected
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if($interview->candidate->current_status === 'interviewed')
                        <div class="flex items-center space-x-2">
                            <form action="{{ route('candidates.mark-passed', $interview->candidate->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-sm font-medium">
                                    Mark as Passed
                                </button>
                            </form>
                            <button onclick="showRejectModal({{ $interview->candidate->id }})" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-sm font-medium">
                                Mark as Rejected
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No completed interviews</h3>
                <p class="mt-1 text-sm text-gray-500">Interviews will appear here after completion.</p>
            </div>
        @endforelse
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-8 max-w-md w-full mx-4">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Reject Candidate</h3>
        <form id="rejectForm" method="POST">
            @csrf
            <div class="mb-4">
                <label for="rejection_reason" class="block text-sm font-medium text-gray-700 mb-2">Rejection Reason</label>
                <textarea name="rejection_reason" id="rejection_reason" rows="4" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500" placeholder="Please provide a reason for rejection..."></textarea>
            </div>
            <div class="flex items-center justify-end space-x-3">
                <button type="button" onclick="closeRejectModal()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    Confirm Rejection
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function showRejectModal(candidateId) {
    const modal = document.getElementById('rejectModal');
    const form = document.getElementById('rejectForm');
    form.action = `/candidates/${candidateId}/mark-rejected`;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeRejectModal() {
    const modal = document.getElementById('rejectModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>
@endsection
