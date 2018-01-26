<?php


use App\Models\Users\User;
use App\Models\Users\UserProfile;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::truncate();
        DB::table('role_users')->truncate();

        $vlado = Sentinel::registerAndActivate([
            'email'=>'vladimir.pejic@gmail.com',
            'password'=>'Vladimir123',
            'uid'=>strtoupper(str_random(16).'-'.uniqid().'-'.str_random(16)),
            'first_name'=>'Vladimir',
            'last_name'=>'Pejic',
        ]);

        UserProfile::create(['user_id' => $vlado->id, 'gender_id' => 2, 'profile_url' => 'Vlad85']);

        $mili = Sentinel::registerAndActivate([
            'email'=>'milinko.m.dragovic@gmail.com',
            'password'=>'Milinko123',
            'uid'=>strtoupper(str_random(16).'-'.uniqid().'-'.str_random(16)),
            'first_name'=>'Milinko',
            'last_name'=>'Dragovic',
        ]);

        UserProfile::create(['user_id' => $mili->id, 'gender_id' => 2]);


    }
}
