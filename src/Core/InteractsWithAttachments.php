<?php

namespace VictorScatolon\FilamentAttachmentLibrary\Core;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use VictorScatolon\FilamentAttachmentLibrary\Models\Attachment;

trait InteractsWithAttachments
{
    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
