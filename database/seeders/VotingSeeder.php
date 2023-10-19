<?php

namespace Database\Seeders;

use App\Models\Voting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VotingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Voting::create([
			"title" => "TechMinds Elections System",
			"description" => "Welcome to TM Online Voting system. We have selectively chosen the best of the candidates who applied to be nominated for the categories. Now register to vote for the candidates. Thank you.",
			"start_date" => "2023-10-20 12:00:00",
			"end_date" => "2023-10-30 12:00:00",
		]);
    }
}
