<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => Str::random(10),
            'company_voen' => Str::random(10),
            'company_area' => Str::random(10),
            'company_phone' => Str::random(10),
            'main_address' => Str::random(10),
            'bank_branch' => Str::random(10),
            'bank_voen' => Str::random(10),
            'bank_swift' => Str::random(10),
            'bank_iban' => Str::random(10),
            'bank_code' => Str::random(10),
            'company_cat' => Str::random(10),
            'company_count_employee' => 5,
            'company_address' => Str::random(10),
            'company_return' => Str::random(10),
            'company_type' => Str::random(10),
            'contract_name' => Str::random(10),
            'contract_curator' => Str::random(10),
            'contract_date' => Str::random(10),
            'contract_number' => Str::random(10),
            'contract_end_date' => Str::random(10),
            'contract_file' => Str::random(10),
            'person_name' => Str::random(10),
            'person_phone' => Str::random(10),
            'person_address' => Str::random(10),
            'person_filial' => Str::random(10),
            'person_email' => Str::random(10)
        ];
    }
}
