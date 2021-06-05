<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ExtractExifData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:extractExifData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Extract Exchangeable Image File metadata from file in storage';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        echo "ExtractExifData constructor fired!\n\n";
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // echo 'Start: Extract EXIF data from image';
        $path = '/images/OCmUcO47ICWQHwPFIWR2EPsk4fVz5FKe0RSIx2II.heic';
        $image = '/var/www/html/storage/app' . $path;
        $process = new Process(['exiftool', $image]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
            // echo $process->getErrorOutput();
        }
        
        echo $process->getOutput();

        // try {
        //     $process->mustRun();
        
        //     echo $process->getOutput();
        // } catch (ProcessFailedException $exception) {
        //     echo $exception->getMessage();
        // }

        return 0;
    }
}
