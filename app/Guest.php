<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guest extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'deleted_at',
        'updated_at',
    ];

    /**
     * Scope a query to filter by token.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string   $token
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByToken($query, string $token)
    {
        return $query->where('token', $token);
    }
}
