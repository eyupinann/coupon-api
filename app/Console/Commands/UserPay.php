<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;
class UserPay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:pay';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'User Pay';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = [
            1 => '1 Hafta',
            2 => '1 Ay',
            3 => '3 Ay'
        ];

        // Get all users whose type is not 0
        $users = User::where('type', '<>', 0)->get();

        foreach ($users as $user) {
            $payDate = Carbon::parse($user->pay_date);
            $now = Carbon::now();

            if ($user->type === 1 && $now->diffInWeeks($payDate) >= 1) {
                $user->type = 0;
                $user->role = 'free';
                $user->save();
            }

            if ($user->type === 2 && $now->diffInMonths($payDate) >= 1) {
                $user->type = 0;
                $user->role = 'free';
                $user->save();
            }

            if ($user->type === 3 && $now->diffInMonths($payDate) >= 3) {
                $user->type = 0;
                $user->role = 'free';
                $user->save();
            }
        }

        return true;
    }
}
