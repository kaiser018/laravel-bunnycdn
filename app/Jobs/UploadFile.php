<?php

namespace App\Jobs;

use App\BunnyCDNStorage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\File;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $filename;
    private $disk;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($filename, $disk)
    {
        $this->filename = $filename;
        $this->disk = $disk;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        if (Storage::disk($this->disk)->exists($this->filename)) {
            
            try {
                
                $storage_zone = env('BUNNYCDN_USERNAME');
                $access_key = env('BUNNYCDN_PASSWORD');

                $bunny_cdn = new BunnyCDNStorage($storage_zone, $access_key);
                $bunny_cdn->uploadFile(Storage::disk($this->disk)->path($this->filename), "/{$storage_zone}/{$this->filename}");

                Storage::disk($this->disk)->delete($this->filename);

                $url = $this->getUrl();

                Log::debug($url);

            } catch (Exception $e) {

                UploadFile::dispatch($this->filename, $this->disk);
                Log::debug($e->getMessage());

            }

        }


    }

    public function getUrl() {
        return rtrim(env('BUNNYCDN_URL'), '/').'/'.ltrim($this->filename, '/');
    }

}
