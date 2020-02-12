<?php namespace EEV\Company\Models;

use EEV\Company\Classes\ContactType;
use Illuminate\Support\Facades\Lang;
use Model;

/**
 * Model
 */
class Contact extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $timestamps = false;

    public $table = 'eev_company_contacts';

    public $rules = [
    ];

    public function getTypeOptions()
    {
        return ContactType::get();
    }

    public function getTypeNameAttribute()
    {
        if (isset(ContactType::get()[$this->type])) {
            return trans(ContactType::get()[$this->type]);
        }
        return $this->type;
    }
}
