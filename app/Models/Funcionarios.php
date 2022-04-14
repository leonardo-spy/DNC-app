<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionarios extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'cpf'];

    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];

    /**
     * Retorna os Checkins deste Funcionario.
     *
     * @return \App\Models\Checkins::class
     */
    public function Checkins()
    {
        #return $this->hasMany(Checkin::class,'cpf');
        return $this->hasMany(Checkin::class)->where('func_cpf', '=', 'cpf');
    }
}
