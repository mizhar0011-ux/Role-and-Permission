<?php

namespace App\Livewire\Role;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleCreate extends Component
{
    public $name;
    public $allpermission = [];
    public $permission = [];

    public function mount(){
        $this->allpermission = Permission::all();
    }
    public function render()
    {
        return view('livewire.role.role-create');
    }

        public function submit()
    {
        $this->validate([
            "name"=>"required|unique:roles,name",
            "permission"=>"required"
        ]);

        $role = Role::create([
            'name' => $this->name
        ]);

        $role->syncPermissions($this->permission);

        
        return redirect()->route('role.index')->with('success', 'Role Added Successfully!');

        }
}
