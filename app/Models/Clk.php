<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Clk extends Model
{
    protected $fillable = ['ip_address', 'clicked_at'];
 protected $casts = [
        'clicked_at' => 'datetime',
    ];
    public function link(): BelongsTo
    {
        return $this->belongsTo(Link::class);
    }
}