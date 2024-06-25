<?php

namespace App\Http\Controllers;

use App\Models\Period;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    public function index()
    {
        $periods = Period::all();
        return view('faculty.periods.index', compact('periods'));
    }

    public function create()
    {
        return view('faculty.periods.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
        ]);

        Period::create($request->all());

        return redirect()->route('faculty.periods.index')->with('success', 'Period created successfully.');
    }

    public function show(Period $period)
    {
        return response()->json($period);
    }

    // Method untuk menampilkan form edit
    public function edit($id)
    {
        $period = Period::findOrFail($id);
        return view('faculty.periods.edit', compact('period'));
    }

    // Method untuk menyimpan perubahan dari form edit
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $period = Period::findOrFail($id);
        $period->update($request->all());

        return redirect()->route('faculty.periods.index')->with('success', 'Period updated successfully.');
    }

    public function destroy($id)
    {
        $period = Period::findOrFail($id);
        $period->delete();

        return redirect()->route('faculty.periods.index')->with('success', 'Period deleted successfully.');
    }
}
