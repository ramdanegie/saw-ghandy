<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class NilaiCrips extends Model
{
    protected $table = 'nilaicrips';
    protected $fillable = [];
    public $timestamps = false;
    public $incrementing = false;
    public $primaryKey ='kode';
}