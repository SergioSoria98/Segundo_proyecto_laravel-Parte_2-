<?php

namespace Database\Seeders;

use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Message::truncate();

        for ($i=1; $i < 101; $i++){
            Message::create([
                'nombre' => "Usuario {$i}",
                'email' => "usuario{$i}@gmail.com",
                'mensaje' => "Este es el mensaje del usuario {$i}",
                'created_at' => Carbon::now()->subDays(100)->addDays($i)
            ]);
        }


    }
}
