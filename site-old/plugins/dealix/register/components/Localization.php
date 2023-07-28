<?php namespace Dealix\Register\Components;

use Cms\Classes\ComponentBase;
use RainLab\Translate\Models\Locale;
use Dealix\Register\Models\State;
use Dealix\Register\Models\City;
use Dealix\Register\Models\Country;

class Localization extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'StatLocalizationes Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRender()
    {
        $this->page['prefix'] = $this->property('prefix'); 
    }

    public function onRun()
    {
        $countries = Country::all();

        if ($countries->count() == 1) {
            $country = $countries->first();
            $first_state = $country->states->first();

            $this->page['cities'] = $first_state->cities;
            $this->page['states'] = $country->states;
        }

        $this->page['countries'] = $countries;
    }

    public function onSelectState()
    {
        $prefix = post('prefix');
        $state_id = post($prefix.'_id_estado');
        $this->page['cities'] = City::where('a048_id_estado', $state_id)->get();
    }
}
