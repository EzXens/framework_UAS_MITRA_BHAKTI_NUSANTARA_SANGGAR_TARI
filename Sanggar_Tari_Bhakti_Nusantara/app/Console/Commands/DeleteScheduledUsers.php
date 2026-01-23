<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class DeleteScheduledUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:delete-scheduled';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menghapus users yang sudah melewati jadwal penghapusan mereka';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Find users whose deletion deadline has passed
        $usersToDelete = User::whereNotNull('scheduled_deletion_at')
                            ->where('scheduled_deletion_at', '<=', now())
                            ->get();

        if ($usersToDelete->isEmpty()) {
            $this->info('Tidak ada users yang perlu dihapus saat ini.');
            return 0;
        }

        $count = 0;
        foreach ($usersToDelete as $user) {
            $userName = $user->name;
            $userEmail = $user->email;
            
            $user->forceDelete();
            $count++;
            
            $this->line("✓ User '{$userName}' ({$userEmail}) berhasil dihapus permanen.");
        }

        $this->info("\nTotal {$count} user(s) berhasil dihapus permanen.");
        return 0;
    }
}
