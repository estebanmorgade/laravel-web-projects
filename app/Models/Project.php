<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;

    use SoftDeletes;

    //protected $fillable = ['title','url','description']; fillable indica los campos admitidos para modificar en la base

    protected $guarded = []; //indica lo contrario, lo dejamos vacio sin seguridad ya que no estamos usando request()->all en el metodo store

    public function getRouteKeyName()
    {
        return 'url';
    }

    public function category(){ // metodo para relacionar los projectos con las categorias
        return $this->belongsTo(Category::class); //el modelo Category no necesita ser importado porque estamos en el mismo namespace
    }
}
