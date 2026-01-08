@extends('layouts.app')

@section('title', 'All Candidates')
@section('page-title', 'All Candidates Overview')

@section('content')
<div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
    <!-- Header with Actions -->
    <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-indigo-50 to-purple-50">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Manage Candidates</h2>
                <p class="text-sm text-gray-600">Total: {{ count($candidates) }} candidates</p>
            </div>
            @can('create-interview')
            <a href="{{ route('interviews.create') }}" class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:shadow-lg transition-all duration-200 font-medium text-sm">
                <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Schedule Interview
            </a>
            @endcan
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
                    <th scope="col" class="px-6 py-4 text-start text-xs font-semibold uppercase tracking-wider">ID</th>
                    <th scope="col" class="px-6 py-4 text-start text-xs font-semibold uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-4 text-start text-xs font-semibold uppercase tracking-wider">Email</th>
                    <th scope="col" class="px-6 py-4 text-start text-xs font-semibold uppercase tracking-wider">Phone</th>
                    <th scope="col" class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider">Experience</th>
                    <th scope="col" class="px-6 py-4 text-start text-xs font-semibold uppercase tracking-wider">Previous Roles</th>
                    <th scope="col" class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider">Age</th>
                    <th scope="col" class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-4 text-end text-xs font-semibold uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @foreach ($candidates as $candidate)
                    <tr class="hover:bg-indigo-50 transition-colors duration-150 ease-in-out group">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('show', $candidate->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-indigo-100 text-indigo-700 hover:bg-indigo-600 hover:text-white transition-all duration-200 font-bold border border-indigo-200">
                                {{ $candidate->id }}
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-800">
                            {{ $candidate->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $candidate->email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $candidate->phone }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                {{ $candidate->experience_years }} Years
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            @if ($candidate->previous_experience)
                                <div class="flex flex-col gap-1">
                                    @foreach ($candidate->previous_experience as $company => $role)
                                        <div class="flex items-center text-xs">
                                            <span class="font-medium text-gray-700 mr-1">{{ $company }}:</span>
                                            <span class="text-gray-500">{{ $role }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-gray-400 italic text-xs">No experience</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-600">
                            {{ $candidate->age }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                            @php
                                $statusColors = [
                                    'applied' => 'bg-gray-100 text-gray-700',
                                    'interview_scheduled' => 'bg-blue-100 text-blue-700',
                                    'interviewed' => 'bg-yellow-100 text-yellow-700',
                                    'passed' => 'bg-green-100 text-green-700',
                                    'rejected' => 'bg-red-100 text-red-700',
                                    'hired' => 'bg-emerald-100 text-emerald-700'
                                ];
                                $statusLabels = [
                                    'applied' => 'Applied',
                                    'interview_scheduled' => 'Interview Scheduled',
                                    'interviewed' => 'Interviewed',
                                    'passed' => 'Passed',
                                    'rejected' => 'Rejected',
                                    'hired' => 'Hired'
                                ];
                            @endphp
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$candidate->current_status] ?? 'bg-gray-100 text-gray-700' }}">
                                {{ $statusLabels[$candidate->current_status] ?? 'Unknown' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('edit', $candidate->id) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 p-2 rounded-lg transition-colors" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                @can('delete-candidate')
                                <a href="{{ route('delete', $candidate->id) }}" class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition-colors" title="Delete" onclick="return confirm('Are you sure you want to delete this candidate?');">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </a>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    @if(count($candidates) === 0)
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No candidates found</h3>
            <p class="mt-1 text-sm text-gray-500">Get started by creating a new candidate.</p>
        </div>
    @endif
</div>
@endsection