<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'url';
    }

    public function projects(){ // metodo para relacionar las categorias con los projectos

        return $this->hasMany(Project::class);

    }
}
