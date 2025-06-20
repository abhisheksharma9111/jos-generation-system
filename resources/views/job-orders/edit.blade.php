@extends('layouts.app')

@section('content')
<div class="bg-white rounded shadow p-6">
    <h2 class="text-2xl font-bold mb-6">Edit Job Order: {{ $jobOrder->reference_number }}</h2>
    
    <form action="{{ route('job-orders.update', $jobOrder) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Job Name:</label>
                <input type="text" name="name" id="name" 
                       value="{{ old('name', $jobOrder->name) }}" 
                       class="w-full px-3 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="date" class="block text-gray-700">Date:</label>
                <input type="date" name="date" id="date" 
                       value="{{ old('date', $jobOrder->date->format('Y-m-d')) }}" 
                       class="w-full px-3 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="jos_date" class="block text-gray-700">JOS Date:</label>
                <input type="date" name="jos_date" id="jos_date" 
                       value="{{ old('jos_date', $jobOrder->jos_date->format('Y-m-d')) }}" 
                       class="w-full px-3 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="type_of_work_id" class="block text-gray-700">Type of Work:</label>
                <select name="type_of_work_id" id="type_of_work_id" class="w-full px-3 py-2 border rounded" required>
                    <option value="">Select Type</option>
                    @foreach($types as $type)
                    <option value="{{ $type->id }}" 
                        {{ old('type_of_work_id', $jobOrder->type_of_work_id) == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="contractor_id" class="block text-gray-700">Contractor:</label>
                <select name="contractor_id" id="contractor_id" class="w-full px-3 py-2 border rounded" required>
                    <option value="">Select Contractor</option>
                    @foreach($contractors as $contractor)
                    <option value="{{ $contractor->id }}" 
                        {{ old('contractor_id', $jobOrder->contractor_id) == $contractor->id ? 'selected' : '' }}>
                        {{ $contractor->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="conductor_id" class="block text-gray-700">Conductor:</label>
                <select name="conductor_id" id="conductor_id" class="w-full px-3 py-2 border rounded" required>
                    <option value="">Select Conductor</option>
                    @foreach($conductors as $conductor)
                    <option value="{{ $conductor->id }}" 
                        {{ old('conductor_id', $jobOrder->conductor_id) == $conductor->id ? 'selected' : '' }}>
                        {{ $conductor->full_name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="actual_work_completed" class="block text-gray-700">Actual Work Completed:</label>
                <input type="number" step="0.01" name="actual_work_completed" id="actual_work_completed" 
                       value="{{ old('actual_work_completed', $jobOrder->actual_work_completed) }}" 
                       class="w-full px-3 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="remarks" class="block text-gray-700">Remarks:</label>
                <textarea name="remarks" id="remarks" 
                          class="w-full px-3 py-2 border rounded">{{ old('remarks', $jobOrder->remarks) }}</textarea>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update Job Order
            </button>
            <a href="{{ route('job-orders.index') }}" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection