<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\QuestionAnswer;
use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $subjects = Subject::all();

        $faker = Faker::create();

        QuestionAnswer::truncate();

        foreach ($subjects as $subject) {
            for ($i = 0; $i < 5; $i++) {
                $question = new Question();
                $question->question = $faker->address;
                $question->subject_id = $subject->id;
                $question->batch = '1A';
                $question->answer = "B";
                $question->save();
                for ($j = 0; $j < 4; $j++) {
                    $subjectAnswer = new QuestionAnswer();
                    $subjectAnswer->question_id = $question->id;
                    $subjectAnswer->key = "A";
                    $subjectAnswer->answer = $faker->address;
                    $subjectAnswer->is_correct = true;
                    $subjectAnswer->save();
                    // $question->answers()->attach($subjectAnswer);
                }
            }
        }

        foreach (Question::all() as $question) {
            $qa = $question->answers[rand(0, 3)];
            $qa->is_correct = true;
            $qa->save();
        }
    }
}
