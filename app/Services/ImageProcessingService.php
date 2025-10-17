<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ImageProcessingService
{
    protected ImageManager $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    public function optimizeTemporaryImage(TemporaryUploadedFile $file): string
    {
        $maxWidth = 1920;
        $maxHeight = 1080;

        $image = $this->manager->read($file->get());

        if ($image->width() > $maxWidth || $image->height() > $maxHeight) {
            $image = $image->scaleDown($maxWidth, $maxHeight);
        }

        $encoded = $image->toWebp(80);

        $tmpFilename = 'resized_' . Str::uuid() . '.webp';
        $tmpPath = 'livewire-tmp/' . $tmpFilename;

        Storage::disk('local')->put($tmpPath, $encoded);

        return $tmpPath;
    }


    public function store(string $tmpPath, string $directory, ?int $recordId = null): string
    {
        $filename = basename($tmpPath);
        $filename = preg_replace('/^resized_/', '', $filename);

        $newPath = $recordId ? "{$directory}/{$recordId}/{$filename}" : "{$directory}/{$filename}";

        Storage::disk('public')->makeDirectory(dirname($newPath));

        $content = Storage::disk('local')->get($tmpPath);
        Storage::disk('public')->put($newPath, $content);
        Storage::disk('local')->delete($tmpPath);

        return $newPath;
    }


    public function delete(TemporaryUploadedFile $file): void
    {
        $storedPath = 'livewire-tmp/' . $file->getFilename();
        if (Storage::disk('local')->exists($storedPath)) {
            Storage::disk('local')->delete($storedPath);
        }
    }

    public function processTemporaryFile(TemporaryUploadedFile $file, string $directory, ?int $recordId = null): string
    {
        try {
            $tmpPath = $this->optimizeTemporaryImage($file);

            if (!Storage::disk('local')->exists($tmpPath)) {
                throw new \RuntimeException('轉檔失敗，暫存檔不存在');
            }

            $newPath = $this->store($tmpPath, $directory, $recordId);

            if (Storage::disk('public')->exists($newPath)) {
                $this->delete($file);
            }

            return $newPath;

        } catch (\Throwable $e) {
            \Log::error('processTemporaryFile failed: ' . $e->getMessage(), [
                'file' => $file->getFilename(),
            ]);

            throw $e;
        }
    }
}
