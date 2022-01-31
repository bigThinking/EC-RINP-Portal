<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallType extends Model
{
      protected $primaryKey = 'call_type';
      protected $keyType = 'string';
      public $timestamps = false;
      public function call(){
        return $this->HasMany(Call::class, 'call_type');
    }
}
