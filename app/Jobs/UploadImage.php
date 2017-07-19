<?php

namespace App\Jobs;

use File;
use Image;
use Storage;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UploadImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $photo;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Photo $photo)
    {
        $this->photo = $photo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $file = storage_path() . "/uploads/" . $this->photo->filename;

        Image::make($file)->encode('jpg')->fit(500, 500, function($c){
            $c->upsize();
        })->save($file);

        if(Storage::disk('s3')->put($this->photo->filename, fopen($file, 'r+'))){
            File::delete($file);
        }
    }
}
