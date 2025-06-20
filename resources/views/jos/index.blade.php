@extends('layouts.app')

@section('content')
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-2xl font-bold mb-6">Job Order Statements</h2>

        <form method="GET" action="{{ route('jos.index') }}" class="mb-6">
            <div class="flex items-center">
                <label for="month" class="mr-2">Filter by Month:</label>
                <input type="month" name="month" id="month" value="{{ $month }}" class="px-3 py-2 border rounded" required>
                <button type="submit" class="ml-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Filter
                </button>
            </div>
        </form>

        <h3 class="text-xl font-semibold mb-4">Ungrouped Job Orders</h3>
        @foreach($ungroupedJobOrders as $contractorId => $conductors)
            @foreach($conductors as $conductorId => $jobOrders)
                <div class="mb-8 p-4 border rounded-lg">
                    <h4 class="text-lg font-medium mb-2">
                        {{ $jobOrders->first()->contractor->name }} - {{ $jobOrders->first()->conductor->full_name }}
                    </h4>

                    <form method="POST" action="{{ route('jos.store') }}">
                        @csrf
                        <input type="hidden" name="contractor_id" value="{{ $contractorId }}">
                        <input type="hidden" name="conductor_id" value="{{ $conductorId }}">

                        <div class="overflow-x-auto mb-4">
                            <table class="min-w-full bg-white border">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border-b ">Select</th>
                                        <th class="py-2 px-4 border-b">Reference</th>
                                        <th class="py-2 px-4 border-b">Date</th>
                                        <th class="py-2 px-4 border-b">Type of Work</th>
                                        <th class="py-2 px-4 border-b">Actual Work</th>
                                        <th class="py-2 px-4 border-b">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jobOrders as $jobOrder)
                                        <tr>
                                            <td class="py-2 px-4 border-b text-center">
                                                <input type="checkbox" name="job_order_ids[]" value="{{ $jobOrder->id }}" checked>
                                            </td>
                                            <td class="py-2 px-4 border-b">{{ $jobOrder->reference_number }}</td>
                                            <td class="py-2 px-4 border-b">
                                                {{ \Carbon\Carbon::parse($jobOrder->date)->format('Y-m-d') }}
                                            </td>
                                            <td class="py-2 px-4 border-b">{{ $jobOrder->typeOfWork->name }}</td>
                                            <td class="py-2 px-4 border-b">{{ $jobOrder->actual_work_completed }}</td>
                                            <td class="py-2 px-4 border-b">{{ number_format($jobOrder->amount, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="paid_amount" class="block text-gray-700">Paid Amount:</label>
                                <input type="number" step="0.01" name="paid_amount" id="paid_amount"
                                    class="w-full px-3 py-2 border rounded" value="0">
                            </div>
                            <div>
                                <label for="remarks" class="block text-gray-700">Remarks:</label>
                                <textarea name="remarks" id="remarks" class="w-full px-3 py-2 border rounded"></textarea>
                            </div>
                        </div>

                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                            Create JOS
                        </button>
                    </form>
                </div>
            @endforeach
        @endforeach

        <h3 class="text-xl font-semibold mb-4 mt-8">Existing JOS</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b text-left">Reference</th>
                        <th class="py-2 px-4 border-b text-left">Contractor</th>
                        <th class="py-2 px-4 border-b text-left">Conductor</th>
                        <th class="py-2 px-4 border-b text-left">Total Job Orders</th>
                        <th class="py-2 px-4 border-b text-left">Total Amount</th>
                        <th class="py-2 px-4 border-b text-left">Paid Amount</th>
                        <th class="py-2 px-4 border-b text-left">Balance</th>
                        <th class="py-2 px-4 border-b text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobOrderStatements as $jos)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $jos->reference_number }}</td>
                            <td class="py-2 px-4 border-b"> {{ $jos->jobOrders->first()->contractor->name ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $jos->jobOrders->first()->conductor->full_name ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $jos->total_job_orders }}</td>
                            <td class="py-2 px-4 border-b">{{ number_format($jos->total_amount, 2) }}</td>
                            <td class="py-2 px-4 border-b">{{ number_format($jos->paid_amount, 2) }}</td>
                            <td class="py-2 px-4 border-b">{{ number_format($jos->balance_amount, 2) }}</td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('jos.show', $jos) }}" class="text-blue-600 hover:text-blue-800">View</a>
                                <a href="{{ route('jos.export', $jos) }}"
                                    class="ml-2 text-green-600 hover:text-green-800">PDF</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection