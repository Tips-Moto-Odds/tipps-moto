<?php

    namespace App\Jobs;

    use Illuminate\Support\Facades\Log;
    use Symfony\Component\Process\Process;
    use Illuminate\Foundation\Queue\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;

    class SendPushNotifications implements ShouldQueue {
        use Queueable;

        protected string $title;
        protected string $body;

        /**
         * Create a new job instance.
         */
        public function __construct(string $title, string $body)
        {
            $this->title = $title;
            $this->body = $body;
        }

        /**
         * Execute the job.
         */

        public function handle(): void
        {
            $scriptPath = base_path('app/Scripts/push.js');
            $node = env('NODE_LOCATION', 'node');

            if (str_contains($node, ' ')) {
                $node = "\"$node\"";
            }

            $payload = base64_encode(
                json_encode([
                                'title' => $this->title,
                                'body'  => $this->body,
                            ])
            );

            Log::info($payload);

            $command = "$node \"$scriptPath\" \"$payload\"";
            Log::info('[PushJob] Running command:', [$command]);

            $process = Process::fromShellCommandline($command);
            $process->run();

            Log::info('[PushJob] process ran');

            if (!$process->isSuccessful()) {
                Log::error('[PushJob] STDOUT:', [$process->getOutput()]);
                Log::error('[PushJob] STDERR:', [$process->getErrorOutput()]);
            } else {
                Log::info('[PushJob] Output:', [$process->getOutput()]);
            }
        }

    }
