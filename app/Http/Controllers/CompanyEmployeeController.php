<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class CompanyEmployeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Company $company
     * @return View
     */
    public function index(Company $company): View
    {
        $employees = $company->employees()->orderBy('first_name')->paginate(10);

        return view('employees.index', compact('employees', 'company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Company $company
     * @return View
     */
    public function create(Company $company): View
    {
        return view('employees.create', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EmployeeRequest $request
     * @param Company $company
     * @return RedirectResponse
     */
    public function store(EmployeeRequest $request, Company $company): RedirectResponse
    {
        $employee = new Employee($request->all());
        $company->employees()->save($employee);

        return redirect()->route('companies.employees.show', [$company, $employee]);
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @param Employee $employee
     * @return View
     */
    public function show(Company $company, Employee $employee): View
    {
        $employee->append('full_name');

        return view('employees.show', compact('company', 'employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Company $company
     * @param Employee $employee
     * @return View
     */
    public function edit(Company $company, Employee $employee): View
    {
        $employee->append('full_name');

        return view('employees.edit', compact('company', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EmployeeRequest $request
     * @param Company $company
     * @param Employee $employee
     * @return RedirectResponse
     */
    public function update(EmployeeRequest $request, Company $company, Employee $employee): RedirectResponse
    {
        $employee->update($request->all());

        return redirect()->route('companies.employees.show', [$company, $employee]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @param Employee $employee
     * @return RedirectResponse
     */
    public function destroy(Company $company, Employee $employee): RedirectResponse
    {
        try {
            $employee->delete();
        } catch (\Exception $e) {
            return redirect()->back($e->getCode())->withErrors($e->getMessage());
        }

        return redirect()->route('companies.employees.index', $company);
    }
}
