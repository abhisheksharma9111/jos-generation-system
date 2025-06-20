<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
use Illuminate\Http\Request;

class ContractorController extends Controller
{
    public function index()
    {
        $contractors = Contractor::all();
        return view('contractors.index', compact('contractors'));
    }

    public function create()
    {
        return view('contractors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:contractors',
            'email' => 'required|email|unique:contractors',
            'phone_number' => 'required|string|unique:contractors',
            'company_name' => 'required|string|unique:contractors',
            'balance' => 'nullable|numeric',
        ]);

        Contractor::create($validated);

        return redirect()->route('contractors.index')
            ->with('success', 'Contractor created successfully.');
    }

    public function show(Contractor $contractor)
    {
        return view('contractors.show', compact('contractor'));
    }

    public function edit(Contractor $contractor)
    {
        return view('contractors.edit', compact('contractor'));
    }

    public function update(Request $request, Contractor $contractor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:contractors,code,'.$contractor->id,
            'email' => 'required|email|unique:contractors,email,'.$contractor->id,
            'phone_number' => 'required|string|unique:contractors,phone_number,'.$contractor->id,
            'company_name' => 'required|string|unique:contractors,company_name,'.$contractor->id,
            'balance' => 'nullable|numeric',
        ]);

        $contractor->update($validated);

        return redirect()->route('contractors.index')
            ->with('success', 'Contractor updated successfully');
    }

    public function destroy(Contractor $contractor)
    {
        $contractor->delete();
        return redirect()->route('contractors.index')
            ->with('success', 'Contractor deleted successfully');
    }
}