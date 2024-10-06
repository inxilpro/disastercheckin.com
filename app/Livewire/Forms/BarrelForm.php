<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class BarrelForm extends Form
{
    #[Rule('unique:barrels,code|numeric')]
    public $code = null;

    #[Rule('required|min:3')]
    public $address_street = null;

    #[Rule('required|min:3')]
    public $address_city = null;

    #[Rule('required|min:2|max:2')]
    public $address_state = null;

    #[Rule('numeric|digits:5')]
    public $address_zip = null;
}
