<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\user; // Or App\Models\User, depending on your setup
use Livewire\WithPagination;

class UserIndex extends Component
{
    // 1. IMPORTANT: Include the Livewire\WithPagination trait
    use WithPagination;

    public $search = '';

    public function render()
    {
        // 2. Change 'get()' or 'all()' to 'paginate()'
        $users = user::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            // Use 10 items per page (or your desired number)
            ->paginate(10); 

        return view('livewire.users.userindex', [
            'users' => $users,
        ]);
    }

    public function delete(user $user) 
    {
        $user->delete();
        session()->flash('message', 'User deleted successfully.');
    }
}
