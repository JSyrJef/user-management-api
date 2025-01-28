<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GenerateUserStatistics extends Command
{
    protected $signature = 'generate:user-statistics';
    protected $description = 'Genera estadísticas diarias de usuarios registrados';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $today = Carbon::today();
        $userCount = DB::table('users')
            ->whereDate('created_at', $today)
            ->count();

        DB::table('user_statistics')->insert([
            'date' => $today,
            'user_count' => $userCount,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->info('Estadísticas de usuarios generadas para ' . $today->toDateString());
    }
}
