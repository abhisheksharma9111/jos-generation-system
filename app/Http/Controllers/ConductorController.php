<?php

namespace App\Http\Controllers;

use App\Models\Conductor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

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
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'staff_id' => [
                'required',
                'string',
                'max:50',
                Rule::unique('conductors')->whereNull('deleted_at')
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('conductors')->whereNull('deleted_at')
            ],
            'phone_number' => [
                'required',
                'string',
                'max:20',
                Rule::unique('conductors')->whereNull('deleted_at')
            ],
            'department_name' => 'required|string|max:255',
        ], [
            'staff_id.unique' => 'This staff ID is already registered',
            'email.unique' => 'This email address is already in use',
            'phone_number.unique' => 'This phone number is already registered',
        ]);

        try {
            DB::beginTransaction();

            // Double-check uniqueness before creating
            if (Conductor::where('email', $validated['email'])->exists()) {
                throw new \Exception('Email already exists in database');
            }

            $conductor = Conductor::create($validated);

            DB::commit();

            return redirect()->route('conductors.index')
                ->with('success', 'Conductor created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->withErrors(['email' => $e->getMessage()]);
        }
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