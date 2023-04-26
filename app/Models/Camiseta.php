<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Camiseta extends Model
{
    use HasFactory;

    public function categorias(): BelongsToMany
    {
        return $this->belongsToMany(Categoria::class);
    }
}