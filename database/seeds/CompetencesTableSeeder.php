<?php

use Illuminate\Database\Seeder;

class CompetencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('competences')->truncate();
        $competences = [
            ['name' => 'Microsoft .Net'],
            ['name' => 'Embedded'],
            ['name' => 'Java'],
            ['name' => 'Network Security Infrastructure'],
            ['name' => 'SAP'],
            ['name' => 'Testing'],
            ['name' => 'Business Intelligence'],
            ['name' => 'Project management'],
        ];
        DB::table('competences')->insert($competences);
    }
}
