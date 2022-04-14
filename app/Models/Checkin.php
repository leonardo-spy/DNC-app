<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkin extends Model
{
    use HasFactory;
    protected $fillable = ['func_cpf','created_at'];

    protected $guarded = ['id'];
    protected $dates = [ 'updated_at'];

    public function Funcionario()
    {
        #return $this->hasMany(Checkin::class,'cpf');
        //return $this->belongsTo(Funcionarios::class)->where('cpf', '=', 'func_cpf');
        return $this->belongsTo(Funcionarios::class,'func_cpf','cpf');
    }
}

