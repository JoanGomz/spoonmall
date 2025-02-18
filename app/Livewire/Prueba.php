<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

// En tu componente Livewire
class Prueba extends Component 
{    
    public $data = [];
    
    public function render()
    {
        return view('livewire.prueba');
    }
}
