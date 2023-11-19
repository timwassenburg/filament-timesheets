<?php

namespace TimWassenburg\FilamentTimesheets\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'name',
        'hourly_rate',
        'client_id',
    ];

    public static function getProjectsWithClientName(): array
    {
        $projectsList = [];
        $projects = self::with('client')->get();

        foreach ($projects as $project) {
            $projectsList[$project->id] = $project->name.' - '.$project->client->name;
        }

        return $projectsList;
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function timesheets(): HasMany
    {
        return $this->hasMany(Timesheet::class);
    }
}
