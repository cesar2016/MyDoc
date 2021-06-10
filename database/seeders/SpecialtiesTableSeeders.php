<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Seeder;

class SpecialtiesTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialties= 
        [
            'Cardiologia', 
            'Oftalmologia', 
            'Psicomotricidad', 
            'Nutrisionismo', 
            'Traumatologia', 
            'Pediatria', 
            'Neumonologia',
            'Neurologia'
        ];

        foreach($specialties as $specialtie){

            Specialty::create([
                'name'=> $specialtie                 
                 
            ]);

        }
        
    }
}
