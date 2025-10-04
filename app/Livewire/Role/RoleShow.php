<?php

namespace App\Livewire\Role;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleShow extends Component
{
    public $role;
    public function mount($id){
        $this->role= Role::find($id);
        
    }
    public function render()
    {
        return view('livewire.role.role-show');
    }
}
