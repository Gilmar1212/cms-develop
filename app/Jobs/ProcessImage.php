<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessImage implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(  
        public string $url,
        public array $payload,
        public string $secret
        )
    {
    }

    /**
     * Execute the job.
     */
    public function handle(WebhookService $webhook)
    {
            $webhook->send(
            $this->url,
            $this->payload,
            $this->secret
            );
    }
}
