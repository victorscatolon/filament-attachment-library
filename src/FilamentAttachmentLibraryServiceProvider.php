<?php

namespace VictorScatolon\FilamentAttachmentLibrary;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentAttachmentLibraryServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-attachment-library')
            ->hasMigrations('create_attachments_table')
            ->runsMigrations();
    }
}
