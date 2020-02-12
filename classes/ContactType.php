<?php

namespace EEV\Company\Classes;

class ContactType
{
    public static function get()
    {
        return [
            'none'  => 'eev.company::lang.not_defined',
            'phone' => 'eev.company::lang.phone',
            'email' => 'eev.company::lang.email',
            'fax'   => 'eev.company::lang.fax',
            'skype'   => 'eev.company::lang.skype',
            'viber'   => 'eev.company::lang.viber',
            'telegram'   => 'eev.company::lang.telegram',
            'WhatsApp'   => 'eev.company::lang.whatsapp',
        ];
    }
}