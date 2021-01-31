<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyEmployeeTest extends TestCase
{

    use RefreshDatabase;

    public function test_employees_delete_on_company_delete()
    {
        $company = Company::factory()
            ->has(Employee::factory()->count(10), 'employees')
            ->create();

        $this->assertDatabaseCount('employees', 10);

        $company->delete();

        $this->assertDatabaseCount('employees', 0);
    }

    public function test_employee_can_be_deleted()
    {
        $employee = Employee::factory()
            ->for(Company::factory())
            ->create();

        $this->assertDatabaseCount('employees', 1);
        $this->assertDatabaseCount('companies', 1);

        $employee->delete();

        $this->assertDatabaseCount('employees', 0);
        $this->assertDatabaseCount('companies', 1);
    }
}
