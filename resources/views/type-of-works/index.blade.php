@extends('layouts.app')

@section('content')
<div class="bg-white rounded shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Type of Works</h2>
        <a href="{{ route('type-of-works.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Create New
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-left">Name</th>
                    <th class="py-2 px-4 border-b text-left">Rate</th>
                    <th class="py-2 px-4 border-b text-left">Code</th>
                    <th class="py-2 px-4 border-b text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($types as $type)
                <tr>
                    <td class="py-2 px-4 border-b text-left">{{ $type->name }}</td>
                    <td class="py-2 px-4 border-b text-left">{{ number_format($type->rate, 2) }}</td>
                    <td class="py-2 px-4 border-b text-left">{{ $type->code }}</td>
                    <td class="py-2 px-4 border-b text-left">
                        <a href="{{ route('type-of-works.edit', $type) }}" class="text-green-600 hover:text-green-800">Edit</a>
                        <form action="{{ route('type-of-works.destroy', $type) }}" method="POST" class="inline">
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