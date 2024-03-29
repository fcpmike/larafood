<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [
        'cnpj', 'name', 'url', 'email', 'logo', 'active', 'subscription',
        'expires_at', 'subscription_id', 'subscription_active', 'subscription_suspended',
    ];

    /**
     * Return Users
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Return Plans
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
