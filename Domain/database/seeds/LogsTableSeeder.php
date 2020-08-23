<?php

use Domain\Models\LogModel;
use Illuminate\Database\Seeder;

class LogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(LogModel::class, 100)->create();
    }
}
