<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Class OrganizationController
 * @package App\Http\Controllers
 */
class OrganizationController extends Controller
{
    /**
     * Display a listing of the organizations.
     *
     * @return View
     */
    public function index(): View
    {
        $organizations = Organization::all();
        return view('admin.organizations.index', compact('organizations'));
    }

    /**
     * Show the form for creating a new organization.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.organizations.form');
    }

    /**
     * Store a newly created organization in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'nullable|string',
            'type' => 'nullable|string',
            'address' => 'nullable|string',
            'contact_number' => 'nullable|string',
        ]);

        Organization::create($validated);

        return redirect()->route('organizations.index');
    }

    /**
     * Display the specified organization.
     *
     * @param Organization $organization
     * @return View
     */
    public function show(Organization $organization): View
    {
        return view('admin.organizations.show', compact('organization'));
    }

    /**
     * Show the form for editing the specified organization.
     *
     * @param Organization $organization
     * @return View
     */
    public function edit(Organization $organization): View
    {
        return view('admin.organizations.form', compact('organization'));
    }

    /**
     * Update the specified organization in storage.
     *
     * @param Request $request
     * @param Organization $organization
     * @return RedirectResponse
     */
    public function update(Request $request, Organization $organization): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'nullable|string',
            'type' => 'nullable|string',
            'address' => 'nullable|string',
            'contact_number' => 'nullable|string',
        ]);

        $organization->update($validated);

        return redirect()->route('organizations.index');
    }

    /**
     * Remove the specified organization from storage.
     *
     * @param Organization $organization
     * @return RedirectResponse
     */
    public function destroy(Organization $organization): RedirectResponse
    {
        $organization->delete();

        return redirect()->route('organizations.index');
    }
}
