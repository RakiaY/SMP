<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        // $fillable : champs modifiables
            'user_id',
            'street',
            'city',
            'zipcode',
        ];
    public function user(){
        return $this ->belongsTo(User::class);
    }
}
