@extends('layouts.app')

@section('content')
<div class="bg-white rounded shadow p-6">
    <h2 class="text-2xl font-bold mb-6">Job Order Details: {{ $jobOrder->reference_number }}</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div>
            <h3 class="text-lg font-semibold mb-2">Basic Information</h3>
            <p><strong>Name:</strong> {{ $jobOrder->name }}</p>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($jobOrder->date)->format('Y-m-d') }}</p>
            <p><strong>JOS Date:</strong> {{ \Carbon\Carbon::parse($jobOrder->jos_date)->format('Y-m-d') }}</p>
            <p><strong>Actual Work Completed:</strong> {{ $jobOrder->actual_work_completed }}</p>
            <p><strong>Remarks:</strong> {{ $jobOrder->remarks ?? 'N/A' }}</p>
        </div>

        <div>
            <h3 class="text-lg font-semibold mb-2">Relationships</h3>
            <p><strong>Type of Work:</strong> {{ $jobOrder->typeOfWork->name ?? 'N/A' }}</p>
            <p><strong>Contractor:</strong> {{ $jobOrder->contractor->name ?? 'N/A' }}</p>
            <p><strong>Conductor:</strong> {{ $jobOrder->conductor->full_name ?? 'N/A' }}</p>
            <p><strong>Amount:</strong> {{ number_format($jobOrder->amount, 2) }}</p>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('job-orders.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Back to List
        </a>
        <a href="{{ route('job-orders.edit', $jobOrder) }}" class="ml-2 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Edit
        </a>
        <form action="{{ route('job-orders.destroy', $jobOrder) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="ml-2 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                Delete
            </button>
        </form>
    </div>
</div>
@endsection