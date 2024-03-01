<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MembershipCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire:memberships';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'El comando identifica si el usuario ya tiene una membresia vencida y la vuelve a poner a la membresia principal';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::where('expiration_date', '<=', now())->get();
        foreach ($users as $user) {
            $user->membership_id = 4;
            $user->expiration_date = null;
            $user->save();
        }
        $this->info('Membresías expiradas actualizadas con éxito.');
    }
}
