<?php

namespace Domain\Imports\Actions;

use Domain\Imports\Enums\ImportType;
use Domain\Imports\Models\Import;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class SyncImports
{
    public function execute(ImportType $type): void
    {
        $finder = $this->getImportables($type);

        $this->createModels($finder, $type);

        $this->cleanupModels($finder, $type);
    }

    protected function createModels(Finder $finder, ImportType $type): void
    {
        collect($finder)
            ->each(fn (SplFileInfo $file) => app(CreateImport::class)->execute([
                'file_name' => $file->getFilename(),
                'name' => $file->getFilenameWithoutExtension(),
                'size' => $file->getSize(),
                'type' => $type,
            ]));
    }

    protected function cleanupModels(Finder $finder, ImportType $type): void
    {
        // $fileNames = $this->getFileNames($finder);

        // Import::query()
        //     ->pending()
        //     ->whereNotIn('file_name', $fileNames->all())
        //     ->delete();
    }

    protected function getImportables(ImportType $type): Finder
    {
        return (new Finder)
            ->in(Storage::disk('import')->path(''))
            ->files()
            ->size('>= 1K')
            ->filter(fn (SplFileInfo $file) => str_starts_with(
                mime_content_type($file->getRealPath()), "{$type->value}/")
            );
    }
}
