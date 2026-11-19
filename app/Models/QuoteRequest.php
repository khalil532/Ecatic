<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuoteRequest extends Model
{
    public const STATUSES = [
        'nouveau'  => 'Nouveau',
        'en_cours' => 'En cours',
        'traite'   => 'Traité',
        'refuse'   => 'Refusé',
    ];

    protected $fillable = [
        'service_id', 'full_name', 'email', 'phone', 'company',
        'details', 'status', 'ip_address',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
