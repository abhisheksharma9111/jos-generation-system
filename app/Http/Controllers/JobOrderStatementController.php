<?php

namespace App\Http\Controllers;

use App\Models\JobOrder;
use App\Models\JobOrderStatement;
use App\Models\JosJobOrderLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class JobOrderStatementController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month', now()->format('Y-m'));

        $ungroupedJobOrders = JobOrder::whereDoesntHave('jobOrderStatement')
            ->where('jos_date', 'like', "{$month}%")
            ->with(['contractor', 'conductor', 'typeOfWork'])
            ->get()
            ->groupBy(['contractor_id', 'conductor_id']);

        $jobOrderStatements = JobOrderStatement::with([
            'jobOrders' => function ($query) use ($month) {
                $query->where('jos_date', 'like', "{$month}%");
            },
            'jobOrders.contractor',
            'jobOrders.conductor'
        ])
            ->whereHas('jobOrders', function ($q) use ($month) {
                $q->where('jos_date', 'like', "{$month}%");
            })
            ->get();

        return view('jos.index', compact('ungroupedJobOrders', 'jobOrderStatements', 'month'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'contractor_id' => 'required|exists:contractors,id',
            'conductor_id' => 'required|exists:conductors,id',
            'job_order_ids' => 'required|array',
            'job_order_ids.*' => 'exists:job_orders,id',
            'paid_amount' => 'nullable|numeric|min:0',
            'remarks' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            $jobOrders = JobOrder::whereIn('id', $validated['job_order_ids'])->get();

            $jos = JobOrderStatement::create([
                'total_job_orders' => $jobOrders->count(),
                'total_amount' => $jobOrders->sum('amount'),
                'paid_amount' => $validated['paid_amount'] ?? 0,
                'remarks' => $validated['remarks'] ?? null,
            ]);

            // Create the relationship using the attach method
            $jos->jobOrders()->attach($validated['job_order_ids']);

            DB::commit();

            return redirect()->route('jos.index')
                ->with('success', 'JOS created successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to create JOS: ' . $e->getMessage());
        }
    }



    public function show(JobOrderStatement $jos)
    {
        // Load all necessary relationships
        $jos->load([
            'jobOrders.typeOfWork',
            'jobOrders.contractor',
            'jobOrders.conductor'
        ]);

        // Get the first job order to access contractor/conductor info
        $firstJobOrder = $jos->jobOrders->first();

        return view('jos.show', [
            'jos' => $jos,
            'contractor' => $firstJobOrder->contractor ?? null,
            'conductor' => $firstJobOrder->conductor ?? null
        ]);
    }

    public function exportPdf(JobOrderStatement $jos)
    {
        $jos->load(['jobOrders.typeOfWork', 'contractor', 'conductor']);
        $pdf = PDF::loadView('jos.pdf', compact('jos'));
        return $pdf->download("JOS-{$jos->reference_number}.pdf");
    }
}