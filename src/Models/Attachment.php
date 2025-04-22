<?php

namespace VictorScatolon\FilamentAttachmentLibrary\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'attachable_id',
        'attachable_type',
        'filename',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function attachable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getUrlAttribute(): ?string
    {
        return $this->disk && $this->path
            ? Storage::disk($this->disk)->url($this->path)
            : null;
    }

    public function scopeForModel($query, Model $model)
    {
        return $query->where('attachable_type', get_class($model))
            ->where('attachable_id', $model->getKey());
    }
}
