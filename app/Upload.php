<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $table = 'uploads'; //table uploads diprotected
	
	public $fillable = ['name', 'image', 'file']; //karena id auoto increment jadi jika menambahkan langsung masuk
}
