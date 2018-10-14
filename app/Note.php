<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'guest_id',
        'style',
        'title',
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
     * Get the guest that owns the note.
     */
    public function guest()
    {
        return $this->belongsTo(Guest::class, 'guest_id', 'id');
    }

    /**
     * Scope a query to filter by guest's token.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string   $token
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByGuestToken($query, string $token)
    {
        return $query->whereHas('guest', function ($query) use ($token) {
            $query->where('token', $token);
        });
    }
}
