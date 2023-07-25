<?php

namespace Database\Seeders;

use App\Models\FeedbackComponent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeedbackComponentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $feedbackComponents = json_decode(file_get_contents(storage_path('db-json/feedbacks.json')), true);

        foreach ($feedbackComponents as $component) {
            FeedbackComponent::firstOrCreate(['component' => $component]);
        }
    }
}
