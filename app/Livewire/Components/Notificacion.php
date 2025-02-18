<?php

namespace App\Livewire;

use Livewire\Component;

class Notificacion extends Component
{
    public $message = '';
    public $type = 'success';
    public $show = false;

    protected $listeners = ['showNotification'];

    public function showNotification($message = '', $type = 'success')
    {
        $this->message = $message;
        $this->type = $type;
        $this->show = true;

        // Cambiamos dispatchBrowserEvent por dispatch
        $this->dispatch('hide-notification', ['delay' => 3000]);
    }
    public function render()
    {
        return view('livewire.components.notificacion');
    }
}
