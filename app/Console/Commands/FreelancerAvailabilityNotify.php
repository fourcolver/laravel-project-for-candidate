<?php

namespace App\Console\Commands;

use App\Mail\FreelancerAvailabilityNotification;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class FreelancerAvailabilityNotify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:freelancer-availability';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $nextAvailableDate = Carbon::now()->addWeeks(4);
        $freelancers = User::isActive()
            ->isFreelancer()
            ->willBeAvailableFrom($nextAvailableDate)
            ->get();

        $freelancers->each(function(User $user) {
            Mail::to($user)
                ->send(new FreelancerAvailabilityNotification($user));
        });

        $this->table(['id', 'fist_name', 'last_name', 'email'], $freelancers->map(function($user) {
            return [$user->id, $user->first_name, $user->last_name, $user->email];
        }));
    }
}
