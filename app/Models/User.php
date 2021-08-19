<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'prenom',
        'sexe',
        'pieceIdentite',
        'numeroPieceIdentite',
        'telephone1',
        'telephone2',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function paiements(){
        return $this->hasMany(Paiement::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class, "user_role", "user_id", "role_id");
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class, "user_permission", "user_id", "permission_id");
    }

    public function hasRole($role){
        return $this->roles()->where("nom", $role)->first() !== null;
    }

    public function hasAnyRoles($roles){
        return $this->roles()->whereIn("nom", $roles)->first() !== null;
    }

    public function getAllRoleNamesAttribute(){
        return $this->roles->implode("nom", ' | ');
    }


}
