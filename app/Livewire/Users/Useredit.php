<?php

namespace App\Livewire\Users;

use App\Models\user;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UserEdit extends Component
{
    // The user model instance is injected by Livewire/Laravel
    // public user $user; 

    // These public properties are what the form fields are bound to
    public ?string $name = '';
    public ?string $email = '';
    public ?string $password = ''; 
    public ?string $confirm_password = '';
    public $roles = [];
    public $allroles = [];
    public $user;

    // Validation rules
    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            // Unique rule excludes the current user's ID
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->user->id, 
            'password' => 'nullable|min:8|same:confirm_password',
        ];
    }

    /**
     * Runs once when the component is initialized.
     * Fills the public properties with the existing user data.
     */
    public function mount($id)
    {
        // 1. Assign the injected model to the component property (if not already done by Livewire)
        // This is often redundant as Livewire does this, but it's good practice.
        $this->user = user::find($id); 
        
        // 2. CRITICAL FIX: Populate the form fields with the existing data
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->allroles = Role::all();
        
        $this->roles = $this->user->roles()->pluck('name');
        
        // Note: Password fields remain empty for security
    }

    /**
     * Handle the form submission to update the user's data.
     */
    public function update()
    {
        $validatedData = $this->validate();

        $dataToUpdate = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ];

        if (!empty($this->password)) {
            $dataToUpdate['password'] = Hash::make($validatedData['password']);
        }
         

        $this->user->update($dataToUpdate);
        $this->user->syncRoles($this->roles);
        // Flash the success message and redirect
        session()->flash('success', 'user Updated Successfully!');
        return $this->redirect(route('user.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.users.useredit');
    }
}