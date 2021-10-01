<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $admin = new Role();
      $admin->name = 'admin';
      $admin->slug = 'admin';
      $admin->save();

      $ki = new Role();
      $ki->name = 'ki';
      $ki->slug = 'ki';
      $ki->save();

      $client = new Role();
      $client->name = 'client';
      $client->slug = 'client';
      $client->save();
    }
}
