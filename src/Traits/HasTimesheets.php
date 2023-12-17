<?php

namespace TimWassenburg\FilamentTimesheets\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use TimWassenburg\FilamentTimesheets\Models\Client;
use TimWassenburg\FilamentTimesheets\Models\Project;
use TimWassenburg\FilamentTimesheets\Models\Timesheet;

trait HasTimesheets
{
    use HasRelationships;

    public function timesheets(): HasManyDeep
    {
        return $this->hasManyDeep(Timesheet::class, [Client::class, Project::class]);
    }

    public function projects(): HasManyDeep
    {
        return $this->hasManyDeep(Project::class, [Client::class]);
    }

    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }
}
