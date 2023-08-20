<?php

namespace Domain\Videos\Actions;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class GetImportableVideos
{
    public function execute(): Finder
    {
        return (new Finder)
            ->in(Storage::disk('import')->path(''))
            ->files()
            ->size('>= 10K')
            ->filter(fn (SplFileInfo $file) => str_starts_with(
                mime_content_type($file->getRealPath()), 'video/')
            );
    }
}
