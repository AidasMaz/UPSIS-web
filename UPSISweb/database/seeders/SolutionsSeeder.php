<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Solution;

class SolutionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $student_ids = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 13, 14, 64, 65, 66, 67, 69, 70, 
        71, 72, 73, 94, 95, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 
        109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123, 124, 
        125, 126, 127, 128, 129, 130, 131, 132, 133, 134, 135, 136, 137, 138, 139, 140, 
        141, 142, 143, 144, 145, 146, 147, 148, 149, 150, 151, 152, 153, 154, 155);

        $category_ids = array(1, 2, 3, 4, 5);

        $min = strtotime("10 September 2021");
        $max = strtotime("now");

        for($i = 0; $i < 200; $i++)
        {
            $student_ids_key = array_rand($student_ids);
            $category_ids_key = array_rand($category_ids);
            $date = rand($min, $max);
            $duration = rand(20, 250);
            $correct = rand(0, 10);
            $incorrect = rand(0, 20);
            $timed = rand(0, 10);

            if ($i % 12 == 0)
            {
                $was_solution_canceled = 1;
            }
            else
            {
                $was_solution_canceled = 0;
            }

            DB::table('solutions')->insert([
                'student_id' => $student_ids[$student_ids_key],
                'game_category_id' => $category_ids[$category_ids_key],              
                'play_date' => date('Y-m-d H:i:s', $date),
                'duration' => $duration,
                'correct_answer_count' => $correct,
                'incorrect_answer_count' => $incorrect,
                'timed_out_answer_count' => $timed,
                'was_solution_canceled' => $was_solution_canceled
            ]);
        }
    }
}
