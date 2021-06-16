<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupPoint extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function clients() {
      return $this->hasMany(Client::class,'id_pick-up_point','id');
    }

    public function employees() {
      return $this->hasMany(Employee::class,'id_pick-up_point','id');
    }
}
