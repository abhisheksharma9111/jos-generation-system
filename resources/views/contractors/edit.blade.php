@extends('layouts.app')

@section('content')
<div class="bg-white rounded shadow p-6">
    <h2 class="text-2xl font-bold mb-6">Edit Contractor: {{ $contractor->name }}</h2>
    
    <form action="{{ route('contractors.update', $contractor) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Contractor Name:</label>
                <input type="text" name="name" id="name" 
                       value="{{ old('name', $contractor->name) }}" 
                       class="w-full px-3 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="company_name" class="block text-gray-700">Company Name:</label>
                <input type="text" name="company_name" id="company_name" 
                       value="{{ old('company_name', $contractor->company_name) }}" 
                       class="w-full px-3 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email:</label>
                <input type="email" name="email" id="email" 
                       value="{{ old('email', $contractor->email) }}" 
                       class="w-full px-3 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="phone_number" class="block text-gray-700">Phone Number:</label>
                <input type="text" name="phone_number" id="phone_number" 
                       value="{{ old('phone_number', $contractor->phone_number) }}" 
                       class="w-full px-3 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="code" class="block text-gray-700">Code:</label>
                <input type="text" name="code" id="code" 
                       value="{{ old('code', $contractor->code) }}" 
                       class="w-full px-3 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="balance" class="block text-gray-700">Balance:</label>
                <input type="number" step="0.01" name="balance" id="balance" 
                       value="{{ old('balance', $contractor->balance) }}" 
                       class="w-full px-3 py-2 border rounded">
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update Contractor
            </button>
            <a href="{{ route('contractors.index') }}" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection