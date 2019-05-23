<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('admins')->insert([
            'image' => 'default.png',
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        DB::table('users')->insert([
            'image' => 'default.png',
            'name' => 'User1',
            'email' => 'user1@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        for ($i=1;$i<=10;$i++){
            DB::table('foods')->insert([
                'image' => 'default.png',
                'name' => 'Food ' . $i,
                'price' => 10000,
                'description' => "This is description of Food " . $i,
                'category' => "Type A",
                'seller' => "Seller " . $i,
            ]);

            DB::table('medicines')->insert([
                'image' => 'default.png',
                'name' => 'Medikit ' . $i,
                'price' => 10000,
                'description' => "This is description of Medikit " . $i,
                'category' => "Type A",
                'seller' => "Seller " . $i,
            ]);

            DB::table('washing_and_spas')->insert([
                'image' => 'default.png',
                'name' => 'Washing and Spa ' . $i,
                'description' => "This is description of Washing of Spa " . $i,
                'street' => 'This is street of Washing and Spa ' . $i,
                'districts' => 'Tegal',
                'city' => 'Tegal',
            ]);

            DB::table('buying_animals')->insert([
                'image' => 'default.png',
                'name' => 'Animal ' . $i,
                'description' => "This is description of animal " . $i,
                'address' => 'This is the address of animal ' . $i,
                'phone' => '08989898989'
            ]);
        }
    }
}
