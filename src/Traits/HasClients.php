<?php

namespace TimWassenburg\FilamentTimesheets\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use TimWassenburg\FilamentTimesheets\Models\Client;

trait HasClients
{
    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }
}
