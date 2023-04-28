<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    public function compra(): BelongsTo
    {
        return $this->belongsTo(Compra::class);
    }

    public function camiseta(): BelongsTo
    {
        return $this->belongsTo(Camiseta::class)->withTrashed();
    }
}
