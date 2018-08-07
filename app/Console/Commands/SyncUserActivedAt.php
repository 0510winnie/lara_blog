<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class SyncUserActivedAt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larablog:sync-user-actived-at';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '將用戶最後登錄時間從Redis同步到DB';

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
    public function handle(User $user)
    {
        $user->syncUserActivedAt();
        $this->info('同步成功！');
    }
}
