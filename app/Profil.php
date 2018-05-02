<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Profil extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Pseudo', 'Password', 'Prenom', 'Email', 'Nom', 'Genre', 'Ville', 'checkCU', 'Photo', 'Description',
    ];
    
    protected $table = 'profils';
}
