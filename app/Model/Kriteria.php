<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = 'kriteria';
    protected $fillable = [];
    public $timestamps = false;
    public $incrementing = false;
    public $primaryKey ='kode';
}
