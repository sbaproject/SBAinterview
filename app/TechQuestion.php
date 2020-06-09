<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TechQuestion extends Model
{
    // change default Eloquent Model config
    protected $table = "t_tech_questions";
    public $timestamps = false;
    public $primaryKey = 'id';

    protected $fillable = [
        'id',
        'content',
        'type',
        'del_flg',
        'date_created',
        'date_update'
    ];
     

}
