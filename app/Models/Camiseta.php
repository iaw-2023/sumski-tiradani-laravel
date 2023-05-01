<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Camiseta extends Model
{
    use HasFactory;
    use SoftDeletes;


    public function categorias(): BelongsToMany
    {
        return $this->belongsToMany(Categoria::class);
    }
}
