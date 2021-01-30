<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $companies = Company::withCount('employees')
            ->orderBy('name')
            ->paginate(10);

        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CompanyRequest $request
     * @return RedirectResponse
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function store(CompanyRequest $request): RedirectResponse
    {
        $company = Company::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'website' => $request->get('website')
        ]);

        if ($request->hasFile('logo')) {
            $company->addMediaFromRequest('logo')->toMediaCollection('logo');
        }

        return redirect()->route('companies.show', $company);
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @return View
     */
    public function show(Company $company): View
    {
        $company->loadCount('employees');

        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Company $company
     * @return View
     */
    public function edit(Company $company): View
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CompanyRequest $request
     * @param Company $company
     * @return RedirectResponse
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function update(CompanyRequest $request, Company $company): RedirectResponse
    {
        $company->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'website' => $request->get('website')
        ]);

        if ($company->hasMedia() && $request->has('remove_logo')) {
            $company->clearMediaCollection('logo');
        }

        if ($request->hasFile('logo')) {
            $company->addMediaFromRequest('logo')->toMediaCollection('logo');
        }

        return redirect()->route('companies.show', compact('company'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return RedirectResponse
     */
    public function destroy(Company $company): RedirectResponse
    {
        try {
            $company->delete();
        } catch (\Exception $e) {
            return redirect()->back($e->getCode())->withErrors($e->getMessage());
        }

        return redirect()->route('companies.index');
    }
}
