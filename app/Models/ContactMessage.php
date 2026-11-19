<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    public const TYPES = [
        'information' => "Demande d'information",
        'devis'       => 'Demande de devis',
        'partenariat' => 'Partenariat / investissement',
        'fournisseur' => 'Fournisseur / producteur',
        'autre'       => 'Autre',
    ];

    protected $fillable = [
        'full_name', 'email', 'phone', 'company', 'subject',
        'request_type', 'message', 'is_read', 'is_handled', 'ip_address',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'is_handled' => 'boolean',
    ];

    public function getTypeLabelAttribute(): string
    {
        return self::TYPES[$this->request_type] ?? $this->request_type;
    }
}
