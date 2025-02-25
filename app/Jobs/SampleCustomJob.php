<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SampleCustomJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The maximum number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * The number of seconds before the job times out.
     *
     * @var int
     */
    public $timeout = 120;

    /**
     * Example user model instance.
     *
     * @var User
     */
    protected $user;

    /**
     * Additional data you might pass into the job.
     *
     * @var array
     */
    protected $data;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @param  array  $data
     * @return void
     */
    public function __construct(User $user, array $data = [])
    {
        $this->user = $user;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // 1. Write a log entry to confirm the job is running.
        Log::info('SampleCustomJob started for user: ' . $this->user->email);

        // 2. Perform some quick action, e.g., updating user info.
        $this->user->update([
            'last_processed_at' => now(),
        ]);

        // 3. Optionally, you could send a notification/event or do any other custom work here.
        // $this->user->notify(new SomeNotification($this->data));

        // 4. Log another entry to confirm completion.
        Log::info('SampleCustomJob completed for user: ' . $this->user->email);
    }
}
