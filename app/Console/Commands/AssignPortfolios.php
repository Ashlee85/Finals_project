<?php

namespace App\Console\Commands;

use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Console\Command;

class AssignPortfolios extends Command
{
    protected $signature = 'portfolios:assign {email : Email of the user who will own them}';

    protected $description = 'Assign all portfolios that have no owner to the given user';

    public function handle(): int
    {
        $user = User::where('email', $this->argument('email'))->first();

        if (! $user) {
            $this->error('No user found with that email. Register first.');
            return self::FAILURE;
        }

        $count = Portfolio::whereNull('user_id')->update(['user_id' => $user->id]);

        $this->info("Assigned {$count} portfolio(s) to {$user->email}.");
        return self::SUCCESS;
    }
}