<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected   $notice;
    public function __construct(\App\Notice $notice)
    {
        $this->notice=$notice;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //通知每个用户系统消息
        $users=\App\User::all();
        foreach ($users as $user)
        {
            $user->addNotices($this->notice);
        }
    }
}
