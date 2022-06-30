<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddAlias extends Component
{
    public $aliases = [0];

    public function addAlias()
    {
        $this->aliases[] = ['id' => '', 'name' => ''];
    }

    public function removeAlias($index)
    {
        unset($this->aliases[$index]);
        $this->aliases = array_values($this->aliases);
    }

    public function render()
    {
        return view('livewire.add-alias');
    }
}
