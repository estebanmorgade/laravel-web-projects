<?php

namespace App\Listeners;

use App\Events\ProjectSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class OptimizeProjectImage implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProjectSaved $event): void
    {
        $image = ImageManager::imagick()->read(Storage::get($event->project->image));
        $image->scale(width: 600);
        $image->save(Storage::path($event->project->image),quality: 60);
    }
}
