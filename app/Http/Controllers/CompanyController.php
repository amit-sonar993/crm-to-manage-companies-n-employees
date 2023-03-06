<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;

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
        $company = new Company();

        return view('companies.create', compact('company'));
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
            'logo' => 'storage/' . $fileHashName
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
        $company = Company::findOrFail($id);

        return view('companies.create', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, string $id)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        $company = Company::findOrFail($id);
        $company->name = $validated['name'];
        $company->email = $validated['email'];

        if (isset($validated['logo'])) {
            $logo = $validated['logo'];
            $oldFileName = Str::of($company->logo)->basename();

            if (Storage::disk('public')->exists($oldFileName->value)) {
                Storage::disk('public')->delete($oldFileName->value);
            }

            $fileHashName = $logo->hashName();
            Storage::disk('public')->put('/', $logo);
            $company->logo = 'storage/'.$fileHashName;
        }

        $company->update();

        return Redirect::route('companies.index')->with('success', 'Companies updated successfully!');
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
