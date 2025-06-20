@extends('layouts.app')

@section('content')
<div class="bg-white rounded shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Contractors</h2>
        <a href="{{ route('contractors.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Create New
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-left">Name</th>
                    <th class="py-2 px-4 border-b text-left">Company</th>
                    <th class="py-2 px-4 border-b text-left">Email</th>
                    <th class="py-2 px-4 border-b text-left">Phone</th>
                    <th class="py-2 px-4 border-b text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contractors as $contractor)
                <tr>
                    <td class="py-2 px-4 border-b text-left">{{ $contractor->name }}</td>
                    <td class="py-2 px-4 border-b text-left">{{ $contractor->company_name }}</td>
                    <td class="py-2 px-4 border-b text-left">{{ $contractor->email }}</td>
                    <td class="py-2 px-4 border-b text-left">{{ $contractor->phone_number }}</td>
                    <td class="py-2 px-4 border-b text-left">
                        <a href="{{ route('contractors.edit', $contractor) }}" class="text-green-600 hover:text-green-800">Edit</a>
                        <form action="{{ route('contractors.destroy', $contractor) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="ml-2 text-red-600 hover:text-red-800">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection