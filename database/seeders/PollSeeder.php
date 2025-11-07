<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Poll;
use App\Models\Option;

class PollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a poll
        $poll = Poll::create([
            'title' => 'What is your favorite PHP Framework feature?',
            'description' => 'Choose one of the key Laravel features you like the most.',
        ]);

        // Add options for the poll
        $poll->options()->createMany([
            ['option_text' => 'Eloquent ORM'],
            ['option_text' => 'Artisan CLI'],
            ['option_text' => 'Blade Templating'],
            ['option_text' => 'Routing/Middleware'],
        ]);
    }
}
