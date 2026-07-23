<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardWarehouseTest extends TestCase
{
    use RefreshDatabase;

    public function test_warehouse_dashboard_supports_year_and_month_filters(): void
    {
        $user = User::create([
            'name' => 'Warehouse Staff',
            'email' => 'warehouse@example.com',
            'password' => bcrypt('password'),
            'role' => User::ROLE_WAREHOUSE,
            'status' => User::STATUS_ACTIVE,
        ]);

        $response = $this->actingAs($user)->get('/dashboard?year=2025&month=6');

        $response->assertStatus(200);
        $response->assertViewHas('selectedYear', '2025');
        $response->assertViewHas('selectedMonth', '6');
        $response->assertViewHas('chartTitle', 'Performa Bulan Juni 2025');
    }
}
