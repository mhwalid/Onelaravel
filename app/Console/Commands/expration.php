<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class expration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:expre';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command expiretion every 5 minutes';

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
        $users = User::wher('expre', 0)->get();

        foreach ($users as $user) {
            $user->update(['expre' => 1]);
        }
    }
}
