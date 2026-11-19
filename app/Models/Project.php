<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    public const CATEGORIES = [
        'agricole'    => 'Projets agricoles',
        'commercial'  => 'Activités commerciales',
        'logistique'  => 'Opérations logistiques',
        'partenariat' => 'Partenariats',
        'terrain'     => 'Photographies de terrain',
    ];

    protected $fillable = [
        'title', 'slug', 'category', 'summary', 'description',
        'location', 'project_date', 'cover_image', 'is_demo', 'is_published',
    ];

    protected $casts = [
        'project_date' => 'date',
        'is_demo' => 'boolean',
        'is_published' => 'boolean',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)->latest('project_date');
    }

    public function getCategoryLabelAttribute(): string
    {
        return self::CATEGORIES[$this->category] ?? ucfirst($this->category);
    }
}
