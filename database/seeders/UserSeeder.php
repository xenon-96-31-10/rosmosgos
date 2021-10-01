<?php

namespace Database\Seeders;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use App\Models\Bio;
use App\Models\Bioki;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $admin = Role::where('slug','admin')->first();
      $ki = Role::where('slug', 'ki')->first();
      $client = Role::where('slug', 'client')->first();

      $ow = Permission::findorFail(2);
      $ap = Permission::findorFail(1);

      $user1 = new User();
      $user1->phone = '79093751695';
      $user1->email = 'admin@admin.com';
      $user1->password = bcrypt('000001');
      $user1->save();
      $user1->roles()->attach($admin);
      $user1->roles()->attach($ki);
      $user1->permissions()->attach($ap);
      $bio1 = new Bio();

      $bio1->familia = 'Иванов';
      $bio1->name = 'Сергей';
      $bio1->lastname = 'Михайлович';

      $bioki1 = new Bioki();

      $bioki1->sertificate = '25-17-254';
      $bioki1->region = 'Москва';
      $bioki1->save();

      $bio1->data()->associate($bioki1);
      $user1->bio()->save($bio1);



      $user2 = new User();
      $user2->phone = '79093751696';
      $user2->email = 'mike@thomas.com';
      $user2->password = bcrypt('000002');
      $user2->save();
      $user2->roles()->attach($ki);
      $user2->permissions()->attach($ap);

      $bio2 = new Bio();

      $bio2->familia = 'Вахрушев';
      $bio2->name = 'Илья';
      $bio2->lastname = 'Николаевич';

      $bioki2 = new Bioki();

      $bioki2->sertificate = '25-17-54';
      $bioki2->region = 'Московская';
      $bioki2->save();

      $bio2->data()->associate($bioki2);
      $user2->bio()->save($bio2);

      $user3 = new User();
      $user3->phone = '79093751697';
      $user3->email = 'smike@thomas.com';
      $user3->password = bcrypt('000003');
      $user3->save();
      $user3->roles()->attach($ki);
      $user3->permissions()->attach($ow);
    }
}
