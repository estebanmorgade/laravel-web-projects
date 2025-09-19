<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    use HasFactory;

    use SoftDeletes;

    //protected $fillable = ['title','url','description']; fillable indica los campos admitidos para modificar en la base

    protected $guarded = []; //indica lo contrario, lo dejamos vacio sin seguridad ya que no estamos usando request()->all en el metodo store

    protected $appends = ['image_url'];  // indica los atributos adicionales que se quieren agregar al modelo cuando se convierte a array o json

    // Accessors & Mutators
    public function getImageUrlAttribute(){ // acccesor para obtener la url de la imagen
        if($this->image){
            return Storage::url($this->image); // Storage::url genera la url completa a partir de la ruta relativa
        }
        return 'https://via.placeholder.com/640x480.png/003366?text=No+Image';
    }


    public function getRouteKeyName()
    {
        return 'url';
    }

    public function category(){ // metodo para relacionar los projectos con las categorias
        return $this->belongsTo(Category::class); //el modelo Category no necesita ser importado porque estamos en el mismo namespace
    }

    public function user() // metodo para relacionar los proyectos con los usuarios
    {
        return $this->belongsTo(User::class); // el modelo User no necesita ser importado porque estamos en el mismo namespace
    }
}
