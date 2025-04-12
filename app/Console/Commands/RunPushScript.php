<?php

    namespace App\Console\Commands;

    use Illuminate\Console\Command;
    use Illuminate\Support\Facades\Log;
    use Symfony\Component\Process\Process;

    class RunPushScript extends Command {
        /**
         * The name and signature of the console command.
         */
        protected $signature = 'app:run-push-script';

        /**
         * The console command description.
         */
        protected $description = 'Executes the push notification script using Node.js';

        /**
         * Execute the console command.
         */
        public function handle(): int
        {
            $scriptPath = base_path('app/Scripts/push.js');
            $nodeBinary = env('NODE_LOCATION', 'node');

            $nodeBinary = str_contains($nodeBinary, ' ') ? "\"$nodeBinary\"" : $nodeBinary;
            $scriptPath = str_contains($scriptPath, ' ') ? "\"$scriptPath\"" : $scriptPath;

            $command = "$nodeBinary $scriptPath";
            Log::info('[PushScript] Executing command:', [$command]);

            $process = Process::fromShellCommandline($command);
            $process->run();

            Log::info('[PushScript] Process executed');

            if (!$process->isSuccessful()) {
                Log::error('[PushScript] STDOUT:', [$process->getOutput()]);
                Log::error('[PushScript] STDERR:', [$process->getErrorOutput()]);
                return self::FAILURE;
            }

            Log::info('[PushScript] Output:', [$process->getOutput()]);
            return self::SUCCESS;
        }
    }
