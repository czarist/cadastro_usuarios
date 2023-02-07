<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adress extends Model
{
    protected $table = "adress";

    protected $fillable = [
        'logradouro', 'numero', 'bairro', 'complemento', 'cep'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
