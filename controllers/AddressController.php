<?php namespace EEV\Company\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class AddressController extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'eev.company.addresses' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('EEV.Company', 'company', 'addresses');
    }
}
