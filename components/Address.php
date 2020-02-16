<?php namespace EEV\Company\Components;

use Cms\Classes\CodeBase;
use Cms\Classes\ComponentBase;
use EEV\Company\Models\Address as AddressEntity;

class Address extends ComponentBase
{

    protected $address = null;

    public function __construct(CodeBase $cmsObject = null, $properties = [])
    {
        parent::__construct($cmsObject, $properties);

        if ( ! empty($this->property('address')) && $this->property('address') !== 'none') {
            $this->address = AddressEntity::find($this->property('address'));
        }
    }

    public function componentDetails()
    {
        return [
            'name'        => 'eev.company::lang.components.address.name',
            'description' => 'eev.company::lang.components.address.desc'
        ];
    }

    public function defineProperties()
    {
        return [
            'address'        => [
                'title'             => 'eev.company::lang.address',
                'description'       => '',
                'default'           => 'none',
                'type'              => 'dropdown',
                'showExternalParam' => false,
                'group'             => 'eev.company::lang.params',
            ],
            'show_title'     => [
                'title'             => 'eev.company::lang.show_title',
                'description'       => '',
                'default'           => false,
                'type'              => 'checkbox',
                'showExternalParam' => false,
                'group'             => 'eev.company::lang.params',
            ],
            'title_tag'      => [
                'title'             => 'eev.company::lang.title_tag',
                'description'       => '',
                'type'              => 'dropdown',
                'showExternalParam' => false,
                'default'           => 'span',
                'options'           => [
                    'span' => 'span',
                    'div'  => 'div',
                    'h1'   => 'h1',
                    'h2'   => 'h2',
                    'h3'   => 'h3',
                    'h4'   => 'h4',
                    'h5'   => 'h5',
                    'h6'   => 'h6',
                ],
                'group'             => 'eev.company::lang.params',
            ],
            'show_labels'    => [
                'title'             => 'eev.company::lang.show_labels',
                'description'       => '',
                'default'           => false,
                'type'              => 'checkbox',
                'showExternalParam' => false,
                'group'             => 'eev.company::lang.params',
            ],
            'show_as_list'   => [
                'title'             => 'eev.company::lang.show_as_list',
                'description'       => '',
                'default'           => false,
                'type'              => 'checkbox',
                'showExternalParam' => false,
                'group'             => 'eev.company::lang.params',
            ],
            'show_icon'      => [
                'title'             => 'eev.company::lang.show_icon',
                'description'       => '',
                'default'           => false,
                'type'              => 'checkbox',
                'showExternalParam' => false,
                'group'             => 'eev.company::lang.params',
            ],
            'microdata'      => [
                'title'             => 'eev.company::lang.microdata',
                'description'       => '',
                'default'           => '',
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
            'name'           => [
                'title'             => 'eev.company::lang.name',
                'description'       => '',
                'default'           => '',
                'type'              => 'string',
                'showExternalParam' => false,
                'group'             => 'eev.company::lang.content',
            ],
            'country'        => [
                'title'             => 'eev.company::lang.country',
                'description'       => '',
                'default'           => '',
                'type'              => 'string',
                'showExternalParam' => false,
                'group'             => 'eev.company::lang.content',
            ],
            'region'         => [
                'title'             => 'eev.company::lang.region',
                'description'       => '',
                'default'           => '',
                'type'              => 'string',
                'showExternalParam' => false,
                'group'             => 'eev.company::lang.content',
            ],
            'locality'       => [
                'title'             => 'eev.company::lang.locality',
                'description'       => '',
                'default'           => '',
                'type'              => 'string',
                'showExternalParam' => false,
                'group'             => 'eev.company::lang.content',
            ],
            'street_address' => [
                'title'             => 'eev.company::lang.street_address',
                'description'       => '',
                'default'           => '',
                'type'              => 'string',
                'showExternalParam' => false,
                'group'             => 'eev.company::lang.content',
            ],
            'postal_code'    => [
                'title'             => 'eev.company::lang.postal_code',
                'description'       => '',
                'default'           => '',
                'type'              => 'string',
                'showExternalParam' => false,
                'group'             => 'eev.company::lang.content',
            ],
            'latitude'       => [
                'title'             => 'eev.company::lang.latitude',
                'description'       => '',
                'default'           => '',
                'type'              => 'string',
                'showExternalParam' => false,
                'group'             => 'eev.company::lang.content',
            ],
            'longitude'      => [
                'title'             => 'eev.company::lang.longitude',
                'description'       => '',
                'default'           => '',
                'type'              => 'string',
                'showExternalParam' => false,
                'group'             => 'eev.company::lang.content',
            ],
        ];
    }

    public function getAddressOptions()
    {
        $result = [
            'none' => 'eev.company::lang.not_defined'
        ];
        $result = $result + AddressEntity::all()->lists('name', 'id');

        return $result;
    }

    public function getIconClass()
    {
        if ($this->property('icon_class')) {
            return ' ' . $this->property('icon_class');
        }

        return ' fas fa-map-marker-alt';
    }

    public function classes()
    {
        $classes = [
            'address',
        ];

        if (!$this->property('show_as_list')) {
            $classes[] = 'address_inline';
        }

        return join(' ', $classes) . (( ! empty($this->property('adv_class')))
            ? ' ' . $this->property('adv_class')
            : '');
    }

    public function getContent()
    {
        $fields = [
            'country',
            'region',
            'locality',
            'postal_code',
            'street_address',
        ];

        $joinGlue = ($this->property('show_as_list')) ? '' : ', ';

        $content = trim(
            join($joinGlue,
                array_filter(
                    array_map([$this, 'getItem'], $fields),
                    [$this, 'itemsFilter']
                )
            ),
            ', '
        );

        if ($this->property('show_as_list')) {
            $content = "<ul class='address__list'>" . $content . "</ul>";
        }

        return $content;
    }

    public function getItem($field)
    {
        if ( ! empty($this->getProp($field))) {
            $tag = ($this->property('show_as_list')) ? 'li' : 'span';

            $string = "<{$tag} class='address__item'>";

            if ($this->property('show_labels')) {
                $label  = trans('eev.company::lang.' . $field);
                $string .= "<span class='address__label'>{$label}</span>";
            }

            $string .= "<span class='address__value'{$this->getSchemaItemProp($field)}>{$this->getProp($field)}</span>";

            return $string . "</{$tag}>";
        }
    }

    public function itemsFilter($item)
    {
        return ! empty($item);
    }

    public function getProp($propName)
    {
        if ( ! empty($this->property($propName))) {
            return $this->property($propName);
        }

        if ($this->address && ! empty($this->address->{$propName})) {
            return $this->address->{$propName};
        }

        return '';
    }

    protected function getSchemaItemProp($fieldName)
    {

        if ( ! $this->property('microdata')) {
            return '';
        }

        $map = [
            'country'        => 'addressCountry',
            'region'         => 'addressRegion',
            'locality'       => 'addressLocality',
            'postal_code'    => 'postalCode',
            'street_address' => 'streetAddress',
        ];

        if (isset($map[$fieldName])) {
            return " itemprop='{$map[$fieldName]}'";
        }

        return '';
    }

    public function getSchemaScope()
    {
        if ($this->property('microdata')) {
            return " itemprop='address' itemscope itemtype='http://schema.org/PostalAddress'";
        }

        return '';
    }

    public function getGeo()
    {
        if (
            $this->property('microdata') &&
            ! empty($this->getProp('latitude')) &&
            ! empty($this->getProp('longitude'))
        ) {
            return "<div itemprop='geo' itemscope itemtype='http://schema.org/GeoCoordinates' class='address__geo'>
            <meta itemprop='latitude' content='{$this->getProp('latitude')}' />
            <meta itemprop='longitude' content='{$this->getProp('longitude')}' />
        </div>";
        }

        return '';
    }

    public function getTitleTag()
    {
        if ($this->property('title_tag')) {
            return $this->property('title_tag');
        }

        return 'span';
    }

    public function onRun()
    {
        $this->addCss('/plugins/eev/company/assets/css/address-component.min.css');
    }
}
