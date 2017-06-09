<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class File extends Eloquent
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function texter()
    {
        return $this->belongsTo(User::class, 'texter_id');
    }
}
