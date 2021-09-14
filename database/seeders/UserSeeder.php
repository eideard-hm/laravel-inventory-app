<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create(
            [
                'name' => 'Edier Hernández',
                'email' => 'edierhernandezmo@gmail.com',
                'password' => '$2y$10$YtkLgE.hUq/zcGJcY2Hy2enGpRiF5CO7f9PHzeeUEL6h.2MFOd79G' // password
            ]
        );
    }
}
