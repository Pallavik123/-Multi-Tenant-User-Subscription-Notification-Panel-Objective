<?php 
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Company;
use App\Models\Plan;
use App\Models\Usage;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
     
        $basic = Plan::create([
            'name' => 'Basic',
            'message_limit' => 1000,
            'api_limit' => 5000,
        ]);

        $pro = Plan::create([
            'name' => 'Pro',
            'message_limit' => 10000,
            'api_limit' => 50000,
        ]);

        $enterprise = Plan::create([
            'name' => 'Enterprise',
            'message_limit' => 100000,
            'api_limit' => 500000,
        ]);

     
        $company = Company::create([
            'name' => 'Test Company',
            'plan_id' => $pro->id,
        ]);

     
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@acme.com',
            'password' => Hash::make('password'),
            'company_id' => $company->id,
        ]);

        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@acme.com',
            'password' => Hash::make('password'),
            'company_id' => $company->id,
        ]);

    
        Usage::create([
            'company_id' => $company->id,
            'messages_used' => 8342,
            'api_calls_used' => 42000,
        ]);
    }
}
