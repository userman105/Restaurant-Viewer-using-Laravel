<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Carbon\Carbon;

class CancelPastReservations extends Command
{
    protected $signature = 'reservations:cancel-past';
    protected $description = 'Cancel reservations where the scheduled time has passed';

    public function handle()
    {
        $now = Carbon::now();

        Reservation::where('status', 'pending')
        ->where(function($query) use ($now) {
            $query->whereDate('date', '<', $now->toDateString())
                ->orWhere(function($query) use ($now) {
                    $query->whereDate('date', '=', $now->toDateString())
                        ->whereTime('time', '<', $now->toTimeString());
                });
        })
            ->update(['status' => 'cancelled']);

        $this->info('Past reservations cancelled.');
    }
}
