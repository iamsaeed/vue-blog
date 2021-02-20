<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(CategorySeeder::class);

         $user = new \App\User;
         $user->name = 'Super Admin';
         $user->email = 'superadmin@app.com';
         $user->password = bcrypt('password');
         $user->save();
    }
}
