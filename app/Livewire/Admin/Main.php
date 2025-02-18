<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Livewire\Layout\AdminLayout;

class Main extends Component
{
    protected $layout = AdminLayout::class;

    public function render()
    {
        return view('livewire.admin.main');
    }
}