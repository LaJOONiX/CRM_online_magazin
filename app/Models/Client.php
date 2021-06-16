<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function receipts() {
        return $this->hasMany(Receipt::class, 'id_receipt', 'id');
    }

    public function pickup_point() {
      return $this->belongsTo(PickupPoint::class,'id_office','id');
    }

    public function getRouteKeyName()
    {
      return 'id';
    }
}
