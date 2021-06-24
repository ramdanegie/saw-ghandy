<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class NilaiAlternatif extends Model
{
  
        protected $table = 'nilaialternatif';
        protected $fillable = [];
        public $timestamps = false;
        public $incrementing = false;
        public $primaryKey ='id';
}
