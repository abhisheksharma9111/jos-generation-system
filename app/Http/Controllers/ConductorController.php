<?php

namespace App\Http\Controllers;

use App\Models\Conductor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ConductorController extends Controller
{
    public function index()
    {
        $conductors = Conductor::all();
        return view('conductors.index', compact('conductors'));
    }

    public function create()
    {
        return view('conductors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'first_name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'last_name' => 'required|string|max:255',
                'staff_id' => 'required|string|max:50|unique:conductors',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('contractors')->whereNull('deleted_at')
                ],
                'phone_number' => [
                    'required',
                    'string',
                    Rule::unique('contractors')->whereNull('deleted_at')
                ],
                'department_name' => 'required|string|max:255',
            ],
            [
                'email.unique' => 'This email is already in use by another contractor',
                'phone_number.unique' => 'This phone number is already registered',
                // custom messages for other rules...
            ]
        );

        Conductor::create($validated);

        return redirect()->route('conductors.index')
            ->with('success', 'Conductor created successfully.');
    }

    public function show(Conductor $conductor)
    {
        return view('conductors.show', compact('conductor'));
    }

    public function edit(Conductor $conductor)
    {
        return view('conductors.edit', compact('conductor'));
    }

    public function update(Request $request, Conductor $conductor)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'staff_id' => 'required|string|max:50|unique:conductors,staff_id,' . $conductor->id,
            'email' => 'nullable|email|unique:conductors,email,' . $conductor->id,
            'phone_number' => 'nullable|string|unique:conductors,phone_number,' . $conductor->id,
            'department_name' => 'required|string|max:255',
        ]);

        $conductor->update($validated);

        return redirect()->route('conductors.index')
            ->with('success', 'Conductor updated successfully');
    }

    public function destroy(Conductor $conductor)
    {
        $conductor->delete();
        return redirect()->route('conductors.index')
            ->with('success', 'Conductor deleted successfully');
    }
}