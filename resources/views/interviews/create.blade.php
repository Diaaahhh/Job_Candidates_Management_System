@extends('layouts.app')

@section('title', 'Schedule Interview')
@section('page-title', 'Schedule Interview')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-xl p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Schedule New Interview</h2>

        <form action="{{ route('interviews.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Selection Type -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3">Selection Method</label>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <label class="relative flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-indigo-500 transition-colors">
                        <input type="radio" name="selection_type" value="single" class="mr-3" checked onchange="toggleSelectionMethod('single')">
                        <span class="font-medium">Single Candidate</span>
                    </label>
                    <label class="relative flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-indigo-500 transition-colors">
                        <input type="radio" name="selection_type" value="multiple" class="mr-3" onchange="toggleSelectionMethod('multiple')">
                        <span class="font-medium">Multiple Candidates</span>
                    </label>
                    <label class="relative flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-indigo-500 transition-colors">
                        <input type="radio" name="selection_type" value="range" class="mr-3" onchange="toggleSelectionMethod('range')">
                        <span class="font-medium">Range Selection</span>
                    </label>
                </div>
            </div>

            <!-- Single Candidate Selection -->
            <div id="single-selection" class="selection-method">
                <label for="candidate_id" class="block text-sm font-medium text-gray-700 mb-2">Select Candidate</label>
                <select name="candidate_id" id="candidate_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    <option value="">Choose a candidate...</option>
                    @foreach($candidates as $candidate)
                        <option value="{{ $candidate->id }}">{{ $candidate->id }} - {{ $candidate->name }} ({{ $candidate->email }})</option>
                    @endforeach
                </select>
            </div>

            <!-- Multiple Candidates Selection -->
            <div id="multiple-selection" class="selection-method hidden">
                <label class="block text-sm font-medium text-gray-700 mb-2">Select Candidates</label>
                <div class="max-h-64 overflow-y-auto border border-gray-300 rounded-lg p-4 space-y-2">
                    @foreach($candidates as $candidate)
                        <label class="flex items-center p-2 hover:bg-gray-50 rounded cursor-pointer">
                            <input type="checkbox" name="candidate_ids[]" value="{{ $candidate->id }}" class="mr-3">
                            <span class="text-sm">{{ $candidate->id }} - {{ $candidate->name }} ({{ $candidate->email }})</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Range Selection -->
            <div id="range-selection" class="selection-method hidden">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="range_start" class="block text-sm font-medium text-gray-700 mb-2">Start ID</label>
                        <input type="number" name="range_start" id="range_start" min="1" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label for="range_end" class="block text-sm font-medium text-gray-700 mb-2">End ID</label>
                        <input type="number" name="range_end" id="range_end" min="1" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>
            </div>

            <!-- Interview Date & Time -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="interview_date" class="block text-sm font-medium text-gray-700 mb-2">Interview Date</label>
                    <input type="date" name="interview_date" id="interview_date" required min="{{ date('Y-m-d') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label for="interview_time" class="block text-sm font-medium text-gray-700 mb-2">Interview Time</label>
                    <input type="time" name="interview_time" id="interview_time" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>

            <!-- Interview Type -->
            <div>
                <label for="interview_type" class="block text-sm font-medium text-gray-700 mb-2">Interview Type</label>
                <select name="interview_type" id="interview_type" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    <option value="first">First Interview</option>
                    <option value="second">Second Interview</option>
                </select>
            </div>

            <!-- Notes -->
            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notes (Optional)</label>
                <textarea name="notes" id="notes" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" placeholder="Add any additional notes..."></textarea>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end space-x-4">
                <a href="{{ route('interviews.upcoming') }}" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg font-semibold hover:shadow-lg transition-all duration-200">
                    Schedule Interview
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function toggleSelectionMethod(method) {
    // Hide all selection methods
    document.querySelectorAll('.selection-method').forEach(el => {
        el.classList.add('hidden');
    });
    
    // Show selected method
    document.getElementById(method + '-selection').classList.remove('hidden');
}
</script>
@endsection
