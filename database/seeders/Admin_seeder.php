<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Admin_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
           'name'=>'admin' ,
            'email' =>'admin@app.com' ,
            'password' =>'123456' ,
            'phone' =>'123456789' ,
            'is_admin'=>true
        ]);
    }
}
