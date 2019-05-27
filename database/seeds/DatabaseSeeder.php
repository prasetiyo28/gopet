<?php

use App\BuyingAnimal;
use App\Food;
use App\Medicine;
use App\PetShop;
use App\WashingAndSpa;
use Faker\Factory;
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
        $faker = Factory::create();
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

        foreach (range(1,50) as $i) {
            Food::create([
                'image' => 'default.png',
                'name' => 'Food Name ' . $i,
                'price' => $faker->randomElement([10000, 20000, 30000, 5000]),
                'description' => $faker->text(200),
                'category' => $faker->randomElement(['Type A', 'Type B', 'Type C']),
                'seller' => $faker->name,
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime(),
            ]);
        }

        foreach (range(1,50) as $i) {
            Medicine::create([
                'image' => 'default.png',
                'name' => 'Medicine Name ' . $i,
                'price' => $faker->randomElement([10000, 20000, 30000, 5000]),
                'description' => $faker->text(200),
                'category' => $faker->randomElement(['Type A', 'Type B', 'Type C']),
                'seller' => $faker->name,
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime(),
            ]);
        }

        foreach (range(1,50) as $i) {
            WashingAndSpa::create([
                'image' => 'default.png',
                'name' => 'Washing and Spa Name ' . $i,
                'description' => $faker->text(300),
                'street' => $faker->streetAddress,
                'districts' => $faker->city,
                'city' => $faker->state,
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime(),
            ]);
        }

        foreach (range(1,100) as $i) {
            BuyingAnimal::create([
                'image' => 'default.png',
                'name' => $faker->firstName,
                'description' => $faker->text(300),
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime(),
            ]);
        }

        foreach (range(1,50) as $i) {
            PetShop::create([
                'image' => 'default.png',
                'name' => $faker->name . " Shop",
                'description' => $faker->text(300),
                'street' => $faker->streetAddress,
                'districts' => $faker->city,
                'city' => $faker->state,
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime(),
            ]);
        }

//        for ($i=1;$i<=10;$i++){
//            DB::table('foods')->insert([
//                'image' => 'default.png',
//                'name' => 'Food ' . $i,
//                'price' => 10000,
//                'description' => "This is description of Food " . $i,
//                'category' => "Type A",
//                'seller' => "Seller " . $i,
//            ]);
//
//            DB::table('medicines')->insert([
//                'image' => 'default.png',
//                'name' => 'Medikit ' . $i,
//                'price' => 10000,
//                'description' => "This is description of Medikit " . $i,
//                'category' => "Type A",
//                'seller' => "Seller " . $i,
//            ]);
//
//            DB::table('washing_and_spas')->insert([
//                'image' => 'default.png',
//                'name' => 'Washing and Spa ' . $i,
//                'description' => "This is description of Washing of Spa " . $i,
//                'street' => 'This is street of Washing and Spa ' . $i,
//                'districts' => 'Tegal',
//                'city' => 'Tegal',
//            ]);
//
//            DB::table('buying_animals')->insert([
//                'image' => 'default.png',
//                'name' => 'Animal ' . $i,
//                'description' => "This is description of animal " . $i,
//                'address' => 'This is the address of animal ' . $i,
//                'phone' => '08989898989'
//            ]);
//
//            DB::table('pet_shops')->insert([
//                'image' => 'default.png',
//                'name' => 'PetShop ' . $i,
//                'description' => "This is description of petshop " . $i,
//                'street' => 'This is the street of petshop ' . $i,
//                'districts' => 'Margadana',
//                'city' => 'Tegal',
//            ]);
//        }
    }
}
