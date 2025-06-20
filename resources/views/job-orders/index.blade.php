@extends('layouts.app')

@section('content')
<div class="bg-white rounded shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Job Orders</h2>
        <a href="{{ route('job-orders.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Create New
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-left">Reference</th>
                    <th class="py-2 px-4 border-b text-left">Date</th>
                    <th class="py-2 px-4 border-b text-left">Contractor</th>
                    <th class="py-2 px-4 border-b text-left">Conductor</th>
                    <th class="py-2 px-4 border-b text-left">Type of Work</th>
                    <th class="py-2 px-4 border-b text-left">Amount</th>
                    <th class="py-2 px-4 border-b text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobOrders as $jobOrder)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $jobOrder->reference_number }}</td>
                    <td class="py-2 px-4 border-b">
    {{ \Carbon\Carbon::parse($jobOrder->date)->format('Y-m-d') }}
</td>
                    <td class="py-2 px-4 border-b">{{ $jobOrder->contractor->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $jobOrder->conductor->full_name }}</td>
                    <td class="py-2 px-4 border-b">{{ $jobOrder->typeOfWork->name }}</td>
                    <td class="py-2 px-4 border-b">{{ number_format($jobOrder->amount, 2) }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('job-orders.show', $jobOrder) }}" class="text-blue-600 hover:text-blue-800">View</a>
                        <a href="{{ route('job-orders.edit', $jobOrder) }}" class="ml-2 text-green-600 hover:text-green-800">Edit</a>
                        <form action="{{ route('job-orders.destroy', $jobOrder) }}" method="POST" class="inline">
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