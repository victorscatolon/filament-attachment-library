<?php

namespace VictorScatolon\FilamentAttachmentLibrary\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait HandleAttachments
{
    protected function afterCreate(): void
    {
        $this->syncAttachments();
    }

    protected function afterSave(): void
    {
        $this->syncAttachments();
    }

    protected function syncAttachments(): void
    {
        $record = $this->record;
        $attachments = $this->form->getRawState()['attachments'] ?? [];

        if (!$record instanceof Model || !method_exists($record, 'attachments')) {
            return;
        }

        $this->handleAttachments($record, $attachments);
    }

    protected function handleAttachments(Model $record, array $filenames): void
    {
        $existing = $record->attachments()->pluck('id', 'filename')->toArray();
        $newAttachments = [];

        foreach ($filenames as $filename) {
            if (!isset($existing[$filename])) {
                $newAttachments[] = [
                    'filename' => $filename,
                ];
            }
        }

        if (!empty($newAttachments)) {
            $record->attachments()->createMany($newAttachments);
        }

        $filenamesToDelete = array_diff(array_keys($existing), $filenames);
        if (!empty($filenamesToDelete)) {
            $record->attachments()
                ->whereIn('filename', $filenamesToDelete)
                ->delete();
        }
    }
}
