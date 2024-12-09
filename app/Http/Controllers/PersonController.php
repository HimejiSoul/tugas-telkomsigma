<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    // Menampilkan semua data orang
    public function index()
    {
        $people = Person::orderBy('created_at', 'asc')->get();
        return view('people.index', compact('people'));
    }

    // Menampilkan form untuk menambah data orang
    public function create()
    {
        return view('people.create');
    }

    // Menyimpan data orang ke database
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'category' => 'required|string|max:255',
        ]);

        Person::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'category' => $request->category,
            'date' => now(),
        ]);

        return redirect()->route('people.index')->with('success', 'Person created successfully.');
    }

    // Menampilkan form untuk mengedit data orang
    public function edit($id)
    {
        $person = Person::findOrFail($id);
        return view('people.edit', compact('person'));
    }

    // Mengupdate data orang di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'category' => 'required|string|max:255',
        ]);

        $person = Person::findOrFail($id);
        $person->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'category' => $request->category,
        ]);

        return redirect()->route('people.index')->with('success', 'Person updated successfully.');
    }

    // Menghapus data orang
    public function destroy($id)
    {
        $person = Person::findOrFail($id);
        $person->delete();

        return redirect()->route('people.index')->with('success', 'Person deleted successfully.');
    }
}
