<?php

namespace TimWassenburg\FilamentTimesheets\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Client extends Model
{
    protected $fillable = [
        'name',
        'iban',
        'vat_number',
        'kvk_number',
        'address',
        'city',
        'zipcode',
        'country',
    ];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function timesheets(): HasManyThrough
    {
        return $this->hasManyThrough(Timesheet::class, Project::class);
    }
}
