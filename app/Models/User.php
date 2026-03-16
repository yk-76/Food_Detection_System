<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user'; 
    protected $primaryKey = 'UserID'; 
    public $incrementing = false; 
    protected $keyType = 'string';

    protected $fillable = [
        'UserID', 'UserName', 'Password', 'Email', 
        'DateOfBirth', 'Gender', 'PhoneNo', 'CreatedAt', 'Role',
        'reset_token_hash',        
        'reset_token_expires_at'   
    ];

    public $timestamps = false; 

    public function getAuthPassword()
{
    return $this->Password;
}

}

