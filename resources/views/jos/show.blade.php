@extends('layouts.app')

@section('content')
<div class="bg-white rounded shadow p-6">
    <h2 class="text-2xl font-bold mb-6">JOS Details: {{ $jos->reference_number }}</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div>
            <h3 class="text-lg font-semibold mb-2">Contractor Information</h3>
            @if($contractor)
                <p><strong>Name:</strong> {{ $contractor->name }}</p>
                <p><strong>Company:</strong> {{ $contractor->company_name }}</p>
                <p><strong>Email:</strong> {{ $contractor->email }}</p>
                <p><strong>Phone:</strong> {{ $contractor->phone_number }}</p>
            @else
                <p class="text-gray-500">No contractor information available</p>
            @endif
        </div>

        <div>
            <h3 class="text-lg font-semibold mb-2">Conductor Information</h3>
            @if($conductor)
                <p><strong>Name:</strong> {{ $conductor->full_name }}</p>
                <p><strong>Staff ID:</strong> {{ $conductor->staff_id }}</p>
                <p><strong>Department:</strong> {{ $conductor->department_name }}</p>
                <p><strong>Email:</strong> {{ $conductor->email ?? 'N/A' }}</p>
            @else
                <p class="text-gray-500">No conductor information available</p>
            @endif
        </div>
    </div>

    <div class="mb-6">
        <h3 class="text-lg font-semibold mb-2">Summary</h3>
        <p><strong>Total Job Orders:</strong> {{ $jos->total_job_orders }}</p>
        <p><strong>Total Amount:</strong> {{ number_format($jos->total_amount, 2) }}</p>
        <p><strong>Paid Amount:</strong> {{ number_format($jos->paid_amount, 2) }}</p>
        <p><strong>Balance Amount:</strong> {{ number_format($jos->balance_amount, 2) }}</p>
        <p><strong>Remarks:</strong> {{ $jos->remarks ?? 'N/A' }}</p>
    </div>

    <h3 class="text-xl font-semibold mb-4">Job Orders</h3>
    @if($jos->jobOrders->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Reference</th>
                        <th class="py-2 px-4 border-b">Date</th>
                        <th class="py-2 px-4 border-b">Type of Work</th>
                        <th class="py-2 px-4 border-b">Actual Work</th>
                        <th class="py-2 px-4 border-b">Rate</th>
                        <th class="py-2 px-4 border-b">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jos->jobOrders as $jobOrder)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $jobOrder->reference_number }}</td>
                        <td class="py-2 px-4 border-b"> {{ \Carbon\Carbon::parse($jobOrder->date)->format('Y-m-d') }}</td>
                        <td class="py-2 px-4 border-b">{{ $jobOrder->typeOfWork->name ?? 'N/A' }}</td>
                        <td class="py-2 px-4 border-b">{{ $jobOrder->actual_work_completed }}</td>
                        <td class="py-2 px-4 border-b">{{ number_format($jobOrder->typeOfWork->rate ?? 0, 2) }}</td>
                        <td class="py-2 px-4 border-b">{{ number_format($jobOrder->amount, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-500">No job orders found for this JOS</p>
    @endif

    <div class="mt-6">
        <a href="{{ route('jos.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Back to List
        </a>
        <a href="{{ route('jos.export', $jos) }}" class="ml-2 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Export PDF
        </a>
    </div>
</div>
@endsection