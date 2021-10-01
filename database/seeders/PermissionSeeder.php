<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $manageUser = new Permission();
      $manageUser->name = 'All Permission';
      $manageUser->slug = 'all-permission';
      $manageUser->save();
      $createTasks = new Permission();
      $createTasks->name = 'Only Watch';
      $createTasks->slug = 'only-watch';
      $createTasks->save();
    }
}
