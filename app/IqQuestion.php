<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IqQuestion extends Model
{
    // change default Eloquent Model config
    protected $table = "t_iq_questions";
    public $timestamps = false;
    public $primaryKey = 'id';

    protected $fillable = [
        'id',
        'content',
        'del_flg',
        'date_created',
        'date_update'
    ];
     

}
