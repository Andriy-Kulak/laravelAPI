<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maker extends Model {

    protected $table = 'makers';

    protected $fillable = [
        'name',
        'phone'
    ];

    protected $hidden = [
        'updated_at',
        'created_at'
    ];

    public function vehicles() {
        return $this->hasMany('App\Vehicle');
    }

    public function makerExistCheck($maker){
        if(!$maker){
            return response()->json(['message' => 'This maker does not exist', 'code' => 404], 404);
        }
    }

}