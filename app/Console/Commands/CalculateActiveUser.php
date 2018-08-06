<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class CalculateActiveUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lara_blog:calculate-active-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Active Users';

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
        //在命令行打印一行信息
        $this->info("開始計算...");

        $user->calculateAndCacheActiveUsers();

        $this->info("生成成功！");
    }
}
