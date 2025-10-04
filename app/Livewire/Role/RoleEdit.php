<?php

namespace App\Livewire\Role;
use Spatie\Permission\Models\Permission;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleEdit extends Component
{
       public $name, $role;
    public $allpermission = [];
    public $permission = [];

    public function mount($id){
        $this->role = Role::find($id);
        $this->allpermission = Permission::all();
        $this->name = $this->role->name;
        $this->permission = $this->role->permissions()->pluck("name");
    }

    public function render()
    {
        return view('livewire.role.role-edit');
    }

    public function submit()
    {
        $this->validate([
            "name"=>"required|unique:roles,name,".$this->role->id,
            "permission"=>"required"
        ]);

        $this->role->name = $this->name;
        $this->role->save();

        $this->role->syncPermissions($this->permission);

        
        return redirect()->route('role.index')->with('success', 'Role updated Successfully!');

        }

}
