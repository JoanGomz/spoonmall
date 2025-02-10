<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage(); // Resetea la paginación al buscar
    }

    public function render()
    {
        $users = User::where('name', 'like', "%{$this->search}% ")
            ->orWhere('email', 'like', "%{$this->search}%")
            ->where('status', '=', '1')
            ->paginate(10);

        return view('livewire.admin.user-list', compact('users'));
    }

    protected $listeners = ['refresh' => '$refresh']; // Escucha eventos para actualizar la vista

    public function delete($userId)
    {
        User::where('id', $userId)->update(['status' => 0]);
        session()->flash('message', 'Usuario eliminado correctamente.');
    }
}
