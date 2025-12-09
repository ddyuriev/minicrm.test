<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $managerRole = Role::firstOrCreate(['name' => 'Manager']);

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('a1234567'),
        ])->assignRole($adminRole);
        User::factory()->create([
            'name' => 'manager',
            'email' => 'mngr@example.org',
            'password' => Hash::make('m1234567'),
        ])->assignRole($managerRole);


        $customers = Customer::factory(70)->create();

        foreach ($customers as $customer) {
            Ticket::factory(rand(2, 7))->create([
                'customer_id' => $customer->id
            ]);
        }

        $tickets = Ticket::query()->take(10)->get();

        foreach ($tickets as $ticket) {
            $name = fake()->word();
            $filePath = storage_path("app/{$name}.txt");
            file_put_contents($filePath, "Тестовый файл для заявки #{$ticket->id}");

            $ticket->addMedia($filePath)
                ->usingName("$name")
                ->toMediaCollection('images');

        }

    }
}
