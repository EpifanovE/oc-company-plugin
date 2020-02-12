<?php namespace EEV\Company\Components;

use Cms\Classes\ComponentBase;
use EEV\Company\Classes\SocialType;
use EEV\Company\Models\Social;

class Socials extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'eev.company::lang.components.socials.name',
            'description' => 'eev.company::lang.components.socials.desc'
        ];
    }

    public function defineProperties()
    {
        return [
            'show_icons'  => [
                'title'             => 'eev.company::lang.show_icons',
                'description'       => '',
                'default'           => false,
                'type'              => 'checkbox',
                'showExternalParam' => false,
                'group'             => 'eev.company::lang.params',
            ],
            'show_labels' => [
                'title'             => 'eev.company::lang.show_labels',
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
        ];
    }

    public function items()
    {
        $items = Social::orderBy('sort_order', 'ASC')->active()->get();

        $html = '';

        if ($items->count() === 0) {
            return $html;
        }

        foreach ($items as $item) {
            $html .= $this->getItem($item);
        }

        return $html;
    }

    protected function getItem($item)
    {
        $html = "<li class='socials__item'>";

        if ( ! empty($item->link)) {
            $html .= '<a href="' . $this->getLink($item) . '" class="socials__link" target="_blank" rel="nofollow">';
        }

        $icon = $this->getIconClass($item) ? ' ' . $this->getIconClass($item) : '';

        if ($this->property('show_icons') && $icon) {
            $html .= "<i class='socials__icon{$icon}'></i>";
        }

        if ($this->property('show_labels') && $label = $this->getLabel($item)) {
            $html .= "<span class='socials__label'>" . trans($label) . "</span>";
        }

        if ( ! empty($item->link)) {
            $html .= '</a>';
        }

        $html .= "</li>";

        return $html;
    }

    protected function getIconClass($item)
    {
        if (!empty($item->icon_class)) {
            return $item->icon_class;
        }

        if (isset(SocialType::all()[$item->type]) && isset(SocialType::all()[$item->type]['icon-class'])) {
            return SocialType::all()[$item->type]['icon-class'];
        }

        return '';
    }

    protected function getLabel($item)
    {
        if ($item->type === 'none') {
            return $item->title;
        }

        if (isset(SocialType::all()[$item->type])) {
            return SocialType::all()[$item->type]['label'];
        }

        return '';
    }

    protected function getLink($item)
    {
        return $item->link;
    }

    public function classes()
    {
        $classes = [
            'socials',
        ];

        return join(' ', $classes) . (( ! empty($this->property('adv_class')))
                ? ' ' . $this->property('adv_class')
                : '');
    }

    public function onRun()
    {
        $this->addCss('/plugins/eev/company/assets/css/socials-component.min.css');
    }
}
