<?php

namespace Tests\Feature;

use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Storage;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_company_can_have_a_logo()
    {
        Storage::fake('public');

        $company = Company::factory()->create();

        $company->addMediaFromUrl($this->faker->imageUrl(100, 100))
            ->toMediaCollection('logo');
        $filePath = $company->media()->first()->getPath();

        $this->assertCount(1, $company->media()->get());
        $this->assertFileExists($filePath);
    }

    public function test_on_company_delete_logo_must_be_deleted()
    {
        Storage::fake('public');

        $company = Company::factory()->create();

        $company->addMediaFromUrl($this->faker->imageUrl(100, 100))
            ->toMediaCollection('logo');
        $filePath = $company->media()->first()->getPath();

        $this->assertDatabaseCount('companies', 1);
        $this->assertDatabaseCount('media', 1);
        $this->assertFileExists($filePath);

        $company->delete();

        $this->assertDatabaseCount('companies', 0);
        $this->assertDatabaseCount('media', 0);
        $this->assertFileDoesNotExist($filePath);
    }
}
