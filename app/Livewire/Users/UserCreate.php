<?php

namespace App\Livewire\Users;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\user; 
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Guard;

class UserCreate extends Component
{

    public user $user; 

    public $name;
    public $email;
    public $password;
    public $roles = []; // holds selected roles
      public $allroles = [];

    public function save()
    {
        $user = user::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

  

        $user->syncRoles($this->roles);

        session()->flash('success', 'user created with roles successfully!');
        return redirect()->route('user.index');
    }

    public function mount(){
        // $this->user = user::find($id); 
        $this->allroles = Role::all();
    }

    public function render()
    {
        return view('livewire.users.usercreate', [
            'allroles' => Role::all()
        ]);
    }

    public function submit()
{
    $this->save();
}
}