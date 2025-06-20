<?php

namespace App\Http\Controllers;

use App\Models\TypeOfWork;
use Illuminate\Http\Request;

class TypeOfWorkController extends Controller
{
    public function index()
    {
        $types = TypeOfWork::all();
        return view('type-of-works.index', compact('types'));
    }

    public function create()
    {
        return view('type-of-works.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'rate' => 'required|numeric|min:0',
            'code' => 'required|string|max:50|unique:type_of_works',
        ]);

        TypeOfWork::create($validated);

        return redirect()->route('type-of-works.index')
            ->with('success', 'Type of work created successfully.');
    }

    public function show(TypeOfWork $typeOfWork)
    {
        return view('type-of-works.show', compact('typeOfWork'));
    }

    public function edit(TypeOfWork $typeOfWork)
    {
        return view('type-of-works.edit', compact('typeOfWork'));
    }

    public function update(Request $request, TypeOfWork $typeOfWork)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'rate' => 'required|numeric|min:0',
            'code' => 'required|string|max:50|unique:type_of_works,code,'.$typeOfWork->id,
        ]);

        $typeOfWork->update($validated);

        return redirect()->route('type-of-works.index')
            ->with('success', 'Type of work updated successfully');
    }

    public function destroy(TypeOfWork $typeOfWork)
    {
        $typeOfWork->delete();
        return redirect()->route('type-of-works.index')
            ->with('success', 'Type of work deleted successfully');
    }
}