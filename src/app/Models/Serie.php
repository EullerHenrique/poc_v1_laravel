<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Serie extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'cover'];

    #Um série tem muitas temporadas
    #Faz lazy loading por padrão, para acessar as temporadas de uma série, basta chamar Series::with('temporadas')->get()
    public function seasons()
    {
        return $this->hasMany(Season::class);
    }

    protected static function booted()
    {
       self::addGlobalScope('ordered', function (Builder $builder) {
           $builder->orderBy('name');
       });
    }
}
