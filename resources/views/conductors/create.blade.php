@extends('layouts.app')

@section('content')
<div class="bg-white rounded shadow p-6">
    <h2 class="text-2xl font-bold mb-6">Create New Conductor</h2>
    
    <form action="{{ route('conductors.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label for="first_name" class="block text-gray-700">First Name:</label>
                <input type="text" name="first_name" id="first_name" 
                       value="{{ old('first_name') }}" 
                       class="w-full px-3 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="middle_name" class="block text-gray-700">Middle Name:</label>
                <input type="text" name="middle_name" id="middle_name" 
                       value="{{ old('middle_name') }}" 
                       class="w-full px-3 py-2 border rounded">
            </div>

            <div class="mb-4">
                <label for="last_name" class="block text-gray-700">Last Name:</label>
                <input type="text" name="last_name" id="last_name" 
                       value="{{ old('last_name') }}" 
                       class="w-full px-3 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="staff_id" class="block text-gray-700">Staff ID:</label>
                <input type="text" name="staff_id" id="staff_id" 
                       value="{{ old('staff_id') }}" 
                       class="w-full px-3 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email:</label>
                <input type="email" name="email" id="email" 
                       value="{{ old('email') }}" 
                       class="w-full px-3 py-2 border rounded">
            </div>

            <div class="mb-4">
                <label for="phone_number" class="block text-gray-700">Phone Number:</label>
                <input type="text" name="phone_number" id="phone_number" 
                       value="{{ old('phone_number') }}" 
                       class="w-full px-3 py-2 border rounded">
            </div>

            <div class="mb-4">
                <label for="department_name" class="block text-gray-700">Department:</label>
                <input type="text" name="department_name" id="department_name" 
                       value="{{ old('department_name') }}" 
                       class="w-full px-3 py-2 border rounded" required>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Create Conductor
            </button>
            <a href="{{ route('conductors.index') }}" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection