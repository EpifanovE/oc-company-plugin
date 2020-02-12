<?php

namespace EEV\Company\Classes;

class SocialType
{

    public static function listAll() {
        $result = [];

        foreach (self::all() as $key => $item) {
            $result[$key] = $item['label'];
        }

        return $result;
    }

    public static function all() {
        return [
            'none' => [
                'label' => 'eev.company::lang.none',
            ],
            'vk' => [
                'label' => 'eev.company::lang.socials.vk',
                'icon-class' => 'fab fa-vk',
            ],
            'ok' => [
                'label' => 'eev.company::lang.socials.ok',
                'icon-class' => 'fab fa-odnoklassniki',
            ],
            'facebook' => [
                'label' => 'eev.company::lang.socials.facebook',
                'icon-class' => 'fab fa-facebook',
            ],
            'instagram' => [
                'label' => 'eev.company::lang.socials.instagram',
                'icon-class' => 'fab fa-instagram',
            ],
            'pinterest' => [
                'label' => 'eev.company::lang.socials.pinterest',
                'icon-class' => 'fab fa-pinterest',
            ],
            'twitter' => [
                'label' => 'eev.company::lang.socials.twitter',
                'icon-class' => 'fab fa-twitter',
            ],
            'youtube' => [
                'label' => 'eev.company::lang.socials.youtube',
                'icon-class' => 'fab fa-youtube',
            ],
        ];
    }

}