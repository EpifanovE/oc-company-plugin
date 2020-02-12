<?php namespace EEV\Company\Models;

use EEV\Company\Classes\SocialType;
use Model;
use October\Rain\Database\Traits\Sortable;

/**
 * Model
 */
class Social extends Model
{
    use \October\Rain\Database\Traits\Validation, Sortable;

    public $timestamps = false;

    public $table = 'eev_company_socials';

    public $rules = [
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getTypeOptions() {
        return SocialType::listAll();
    }

    public function getTypeNameAttribute()
    {
        if (isset(SocialType::listAll()[$this->type])) {
            return trans(SocialType::listAll()[$this->type]);
        }
        return $this->type;
    }

    public function scopeActive($query) {
        return $query->where('is_active', true);
    }
}
