<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    protected $table = 'alternatif';
    protected $fillable = [];
    public $timestamps = false;
    public $incrementing = false;
    public $primaryKey ='kode';
}
