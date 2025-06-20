<?php

namespace App\Http\Controllers;

use App\Models\JobOrder;
use App\Models\TypeOfWork;
use App\Models\Contractor;
use App\Models\Conductor;
use Illuminate\Http\Request;

class JobOrderController extends Controller
{
    public function index()
    {
        $jobOrders = JobOrder::with(['typeOfWork', 'contractor', 'conductor'])->get();
        return view('job-orders.index', compact('jobOrders'));
    }

    public function create()
    {
        $types = TypeOfWork::all();
        $contractors = Contractor::all();
        $conductors = Conductor::all();
        return view('job-orders.create', compact('types', 'contractors', 'conductors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'jos_date' => 'required|date',
            'type_of_work_id' => 'required|exists:type_of_works,id',
            'contractor_id' => 'required|exists:contractors,id',
            'conductor_id' => 'required|exists:conductors,id',
            'actual_work_completed' => 'required|numeric|min:0',
            'remarks' => 'nullable|string',
        ]);

        $jobOrder = JobOrder::create($validated);

        return redirect()->route('job-orders.index')
            ->with('success', 'Job order created successfully.');
    }

    public function show(JobOrder $jobOrder)
    {
        $jobOrder->load(['typeOfWork', 'contractor', 'conductor']);
    
    return view('job-orders.show', compact('jobOrder'));
    }

    public function edit(JobOrder $jobOrder)
    {
        $types = TypeOfWork::all();
        $contractors = Contractor::all();
        $conductors = Conductor::all();
        return view('job-orders.edit', compact('jobOrder', 'types', 'contractors', 'conductors'));
    }

    public function update(Request $request, JobOrder $jobOrder)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'jos_date' => 'required|date',
            'type_of_work_id' => 'required|exists:type_of_works,id',
            'contractor_id' => 'required|exists:contractors,id',
            'conductor_id' => 'required|exists:conductors,id',
            'actual_work_completed' => 'required|numeric|min:0',
            'remarks' => 'nullable|string',
        ]);

        $jobOrder->update($validated);

        return redirect()->route('job-orders.index')
            ->with('success', 'Job order updated successfully');
    }

    public function destroy(JobOrder $jobOrder)
    {
        $jobOrder->delete();
        return redirect()->route('job-orders.index')
            ->with('success', 'Job order deleted successfully');
    }
}