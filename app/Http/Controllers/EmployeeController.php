<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with('company')->paginate(10);
        $page = 'employees.index';

        return view('employees.index', compact('employees', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employee = new Employee();
        $companies = Company::all();

        return view('employees.create', compact('employee', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        $company = Company::findOrFail($validated['company_id']);
        $employee = new Employee([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
        ]);

        $company->employees()->save($employee);

        return Redirect::route('employees.index')->with('success', 'Employee added successfully!');
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
        $employee = Employee::findOrFail($id);
        $companies = Company::all();

        return view('employees.create', compact('employee', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, string $id)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        $employee = Employee::findOrFail($id);

        $employee->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'company_id' => $validated['company_id'],
        ]);

        return Redirect::route('employees.index')->with('success', 'Employee updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);

        $deleted = $employee->delete();

        return response()->json([
            'success' => $deleted
        ]);
    }
}
