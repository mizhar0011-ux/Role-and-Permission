<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable // <-- Class name MUST match filename (Member.php)
{
    use HasFactory, HasRoles;

    protected $guard_name = 'web'; 
    
    // Allows mass assignment for these fields
 protected $fillable = ['name', 'email', 'password', 'roles'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];
    
    // Mutator to automatically hash the password when set
    public function setPasswordAttribute(string $value): void
    {
        // Only hash if the value is not already hashed
        if (!Hash::needsRehash($value)) {
            $this->attributes['password'] = Hash::make($value);
        } else {
            $this->attributes['password'] = $value;
        }
    }



}