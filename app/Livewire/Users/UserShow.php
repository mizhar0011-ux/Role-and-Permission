<?php

namespace App\Livewire\Users;
use App\Models\user;

use Livewire\Component;

class UserShow extends Component
{
    public $user;

    public function mount($id){
        $this->user = user::find($id);
    }

    public function render()
    {
        return view('livewire.users.user-show');
    }
}
