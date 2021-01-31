<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Auth;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{

    use RefreshDatabase;

    public function test_admin_can_see_all_companies()
    {
        $this->seed();
        $admin = User::first();

        $companies = Company::factory()->count(10)->create();

        $response = $this->actingAs($admin)->get('/companies');

        foreach ($companies as $company) {
            $response->assertSee($company->name);
        }
    }

    public function test_admin_can_see_company_details()
    {
        $this->seed();
        $admin = User::first();

        $company = Company::factory()->create();

        $response = $this->actingAs($admin)->get('/companies/' . $company->id);

        $response->assertSee($company->name);
    }

    public function test_admin_can_see_a_company_employees()
    {
        $this->seed();
        $admin = User::first();

        $company = Company::factory()
            ->has(Employee::factory()->count(10), 'employees')
            ->create();

        $response = $this->actingAs($admin)
            ->get('/companies/' . $company->id . '/employees');

        foreach ($company->employees as $employee) {
            $response->assertSee($employee->first_name);
        }
    }

    public function test_admin_can_see_employee_details()
    {
        $this->seed();
        $admin = User::first();

        $company = Company::factory()
            ->has(Employee::factory(), 'employees')
            ->create();

        $employee = $company->employees()->first();

        $response = $this->actingAs($admin)
            ->get('/companies/' . $company->id . '/employees/' . $employee->id);

        $response->assertSee($employee->first_name);
    }
}
