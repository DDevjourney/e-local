<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;
use App\Models\LineaPedido;


class Pedido extends Model
{

    protected $fillable = ['cliente_id', 'fecha', 'estado'];
    
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function lineasPedido()
    {
        return $this->hasMany(LineaPedido::class);
    }
}
