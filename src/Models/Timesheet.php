<?php

namespace TimWassenburg\FilamentTimesheets\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Timesheet extends Model
{
    protected $fillable = [
        'project_id',
        'date',
        'hours',
        'description',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function setHoursAttribute($value): void
    {
        $value = str_replace(',', '.', $value);

        if (str_contains($value, ':')) {
            [$hours, $minutes] = explode(':', $value);
            $this->attributes['hours'] = (int) $hours + ($minutes / 60);
        } else {
            $this->attributes['hours'] = $value;
        }
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
