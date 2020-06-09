<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    // change default Eloquent Model config
    protected $table = "t_result";
    public $timestamps = false;
    public $primaryKey = 'id';

    protected $fillable = [
        'id',
        'candidate_firstname',
        'candidate_lastname',
        'candidate_tel',
        'candidate_address',
        'candidate_mail',
        'candidate_language',
        'candidate_dob',
        'starttime',
        'endtime',
        'totaltime',
        'iq_score',
        'tech_score',
        'is_marked',
        'date_created',
        'date_update'
    ];
     

}
