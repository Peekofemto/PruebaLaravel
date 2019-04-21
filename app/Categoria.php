<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //Esta es la tabla que podemos ver en phpmyadmin
    //Si no definimos el nombre laravel da por hecho 
    //que la tabla se llama igual que este archivo
    //Es por eso que dejaré comentado lo de abajo
    //protected $table = 'categorias';
    //lo mismo pasa con el primary key
    //protected $primaryKey = 'id';
    //php artisan make:model categoria

    protected $fillable = ['nombre', 'descripcion','condicion'];

    public function articulos() 
    {
        return $this->hasMany('App\Articulo');
    }
    
}
