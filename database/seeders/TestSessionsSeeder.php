<?php

namespace Database\Seeders;

use App\Models\TestSession;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSessionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $testSessions = json_decode(file_get_contents(storage_path('db-json/sessions.json')), true);

        foreach ($testSessions as $session) {
            TestSession::updateOrCreate(
                [
                    'name' => $session['name'],
                ],
                [
                    'started_at'    => Carbon::createFromFormat('H.i', $session['started_at'])->format('H:i:s'),
                    'ended_at'      => Carbon::createFromFormat('H.i', $session['ended_at'])->format('H:i:s'),
                ]
            );
        }
    }
}
