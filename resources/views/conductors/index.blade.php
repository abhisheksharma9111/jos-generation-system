@extends('layouts.app')

@section('content')
<div class="bg-white rounded shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Conductors</h2>
        <a href="{{ route('conductors.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Create New
        </a>
    </div>

    @if($conductors->isEmpty())
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded">
            No conductors found. Please create your first conductor.
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-4 border-b text-left">Name</th>
                        <th class="py-3 px-4 border-b text-left">Staff ID</th>
                        <th class="py-3 px-4 border-b text-left">Department</th>
                        <th class="py-3 px-4 border-b text-left">Email</th>
                        <th class="py-3 px-4 border-b text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($conductors as $conductor)
                    <tr>
                        <td class="py-3 px-4 border-b">{{ $conductor->full_name }}</td>
                        <td class="py-3 px-4 border-b">{{ $conductor->staff_id }}</td>
                        <td class="py-3 px-4 border-b">{{ $conductor->department_name }}</td>
                        <td class="py-3 px-4 border-b">{{ $conductor->email ?? 'N/A' }}</td>
                        <td class="py-3 px-4 border-b">
                            <div class="flex space-x-2">
                                <a href="{{ route('conductors.edit', $conductor) }}" 
                                   class="text-green-600 hover:text-green-800 hover:underline">
                                    Edit
                                </a>
                                <form action="{{ route('conductors.destroy', $conductor) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-800 hover:underline"
                                            onclick="return confirm('Are you sure you want to delete this conductor?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection