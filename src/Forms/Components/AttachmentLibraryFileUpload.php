<?php

namespace VictorScatolon\FilamentAttachmentLibrary\Forms\Components;

use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Model;

class AttachmentLibraryFileUpload extends FileUpload
{
    public static function make(string $name = 'attachments'): static
    {
        return parent::make($name)
            ->label('Attachments')
            ->multiple()
            ->openable()
            ->formatStateUsing(function (?Model $record) {
                if (!$record) {
                    return [];
                }
                return $record->attachments()->pluck('filename')->all();
            })
            ->dehydrated(false);
    }
}
