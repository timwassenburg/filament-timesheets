<?php

namespace TimWassenburg\FilamentTimesheets\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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

    public function scopeThisWeek(Builder $query): void
    {
        $query->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
    }

    public function scopeLastWeek(Builder $query): void
    {
        $query->whereBetween('date', [Carbon::now()->subWeek()->startOfWeek()->toDateString(), Carbon::now()->subWeek()->endOfWeek()->toDateString()]);
    }

    public function scopeThisMonth(Builder $query): void
    {
        $query->whereBetween('date', [Carbon::now()->startOfMonth()->toDateString(), Carbon::now()->endOfMonth()->toDateString()]);
    }

    public function scopeThisQuarter(Builder $query): void
    {
        $query->whereBetween('date', [Carbon::now()->startOfQuarter()->toDateString(), Carbon::now()->endOfQuarter()->toDateString()]);
    }

    public function scopeLastQuarter(Builder $query): void
    {
        $query->whereBetween('date', [Carbon::now()->subQuarter()->startOfQuarter()->toDateString(), Carbon::now()->subQuarter()->endOfQuarter()->toDateString()]);
    }

    public function scopeLastMonth(Builder $query): void
    {
        $query->whereBetween('date', [Carbon::now()->subMonth()->startOfMonth()->toDateString(), Carbon::now()->subMonth()->endOfMonth()->toDateString()]);
    }

    public function scopeThisYear(Builder $query): void
    {
        $query->whereBetween('date', [Carbon::now()->startOfYear()->toDateString(), Carbon::now()->endOfYear()->toDateString()]);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
