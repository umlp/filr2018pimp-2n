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
    public $Pseudo = "";
    public $Password = "";
    public $Email = "";
    public $Prenom = "";
    public $Nom = "";
    public $Genre = 0;
    public $Ville = "";
    public $checkCU = false;
}
