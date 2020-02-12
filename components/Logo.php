<?php namespace EEV\Company\Components;

use Cms\Classes\ComponentBase;
use EEV\Company\Models\Settings;

class Logo extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'eev.company::lang.components.logo.name',
            'description' => 'eev.company::lang.components.logo.desc'
        ];
    }

    public function defineProperties()
    {
        return [
            'show_image'      => [
                'title'             => 'eev.company::lang.show_image',
                'description'       => '',
                'default'           => true,
                'type'              => 'checkbox',
                'showExternalParam' => false,
                'group'             => 'eev.company::lang.params',
            ],
            'image_width'     => [
                'title'             => 'eev.company::lang.image_width',
                'description'       => '',
                'default'           => '',
                'type'              => 'string',
                'showExternalParam' => false,
                'group'             => 'eev.company::lang.params',
            ],
            'show_title'      => [
                'title'             => 'eev.company::lang.show_title',
                'description'       => '',
                'default'           => true,
                'type'              => 'checkbox',
                'showExternalParam' => false,
                'group'             => 'eev.company::lang.params',
            ],
            'show_desc'       => [
                'title'             => 'eev.company::lang.show_desc',
                'description'       => '',
                'default'           => true,
                'type'              => 'checkbox',
                'showExternalParam' => false,
                'group'             => 'eev.company::lang.params',
            ],
            'h1_on_home_page' => [
                'title'             => 'eev.company::lang.h1_on_home_page',
                'description'       => '',
                'default'           => true,
                'type'              => 'checkbox',
                'showExternalParam' => false,
                'group'             => 'eev.company::lang.params',
            ],
            'link_to_home_page' => [
                'title'             => 'eev.company::lang.link_to_home_page',
                'description'       => '',
                'default'           => true,
                'type'              => 'checkbox',
                'showExternalParam' => false,
                'group'             => 'eev.company::lang.params',
            ],
            'image_microdata' => [
                'title'             => 'eev.company::lang.image_microdata',
                'description'       => '',
                'default'           => false,
                'type'              => 'checkbox',
                'showExternalParam' => false,
                'group'             => 'eev.company::lang.params',
            ],
            'name_microdata'  => [
                'title'             => 'eev.company::lang.name_microdata',
                'description'       => '',
                'default'           => false,
                'type'              => 'checkbox',
                'showExternalParam' => false,
                'group'             => 'eev.company::lang.params',
            ],
            'adv_class'      => [
                'title'             => 'eev.company::lang.adv_class',
                'description'       => '',
                'default'           => '',
                'type'              => 'string',
                'showExternalParam' => false,
                'group'             => 'eev.company::lang.params',
            ],
            'title'           => [
                'title'             => 'eev.company::lang.title',
                'description'       => '',
                'default'           => '',
                'type'              => 'string',
                'showExternalParam' => false,
                'group'             => 'eev.company::lang.content',
            ],
            'description'     => [
                'title'             => 'eev.company::lang.description',
                'description'       => '',
                'default'           => '',
                'type'              => 'string',
                'showExternalParam' => false,
                'group'             => 'eev.company::lang.content',
            ],
        ];
    }

    public function image()
    {
        return Settings::get('logo');
    }

    public function alt()
    {
        return Settings::get('name');
    }

    public function title()
    {
        if ( ! $this->property('show_title')) {
            return '';
        }

        if ($this->property('title')) {
            return $this->property('title');
        }

        return Settings::get('name');
    }

    public function desc()
    {
        if ( ! $this->property('show_desc')) {
            return '';
        }

        if ($this->property('description')) {
            return $this->property('description');
        }

        return Settings::get('short_desc');
    }

    public function classes()
    {
        $classes = [
            'logo',
        ];

        return join(' ', $classes) . (( ! empty($this->property('adv_class')))
                ? ' ' . $this->property('adv_class')
                : '');
    }

    public function imgWrapperStyles()
    {
        $styles = [];

        if ($this->property('image_width')) {
            $styles['max-width'] = $this->property('image_width') . 'px' ?: '200px';
        }

        if ( ! empty($styles)) {
            return $this->style($styles);
        }

        return '';
    }

    public function style(array $styles)
    {
        if ( ! empty($styles)) :
            $result = 'style="';
            $style  = '';
            foreach ($styles as $key => $value) :
                $style .= $key . ':' . $value . ';';
            endforeach;
            $result .= $style;
            $result .= '"';

            return $result;
        endif;

        return '';
    }

    public function getTag() {
        if ($this->property('link_to_home_page') && $this->page->url !== '/') {
            return 'a';
        }
        return 'div';
    }

    public function getAttrs() {
        if ($this->property('link_to_home_page') && $this->page->url !== '/') {
            return ' href="/"';
        }
        return '';
    }

    public function getTextTag()
    {
        if ($this->page->url === '/' && $this->property('h1_on_home_page')) {
            return 'h1';
        }

        return 'div';
    }

    public function imageMicrodata()
    {
        if ($this->property('image_microdata')) {
            return ' itemprop="logo"';
        }

        return '';
    }

    public function nameMicrodata()
    {
        if ($this->property('name_microdata')) {
            return ' itemprop="name"';
        }

        return '';
    }

    public function onRun()
    {
        $this->addCss('/plugins/eev/company/assets/css/logo-component.min.css');
    }
}
