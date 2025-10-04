<?php

namespace App\Livewire\Role;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class Roleindex extends Component
{
    public function render()
    {
        


         $roles = Role::with("permissions")->get();

        return view('livewire.role.roleindex', compact("roles"));
    }

        public function delete(Role $role) 
    {
        $role->delete();
        session()->flash('message', 'User deleted successfully.');
    }

}
