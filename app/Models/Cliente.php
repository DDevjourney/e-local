<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pedido;

class Cliente extends Model
{
    protected $fillable = ['nombre', 'email', 'telefono'];
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
