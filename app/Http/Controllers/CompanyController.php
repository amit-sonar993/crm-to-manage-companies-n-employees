<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreCompanyRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::paginate(10);

        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();
        $logo = $validated['logo'];


        $fileHashName = $logo->hashName();
        Storage::disk('public')->put('/', $logo);

        Company::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'logo' => 'storage/'.$fileHashName
        ]);

        return Redirect::route('companies.index')->with('success', 'Companies added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::findOrFail($id);

        $deleted = $company->delete();

        return response()->json([
            'success' => $deleted
        ]);
    }
}
