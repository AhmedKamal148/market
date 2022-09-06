<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = array(
            ['name' => 'ahmed', 'phone' => array('01150048100', '01118477596'), 'address' => 'Giza,Fisal'],
            ['name' => 'omar', 'phone' => array('01144460760'), 'address' => 'Giza,Fisal'],
        );


        foreach ($clients as $client) {
            Client::create([
                'name' => $client['name'],
                'phone' => $client['phone'],
                'address' => $client['address'],
            ]);
        }
    }
}
