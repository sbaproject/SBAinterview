<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InterviewManagerment extends Model
{
    // change default Eloquent Model config
    protected $table = "t_interviewmanagement";
    public $timestamps = false;
    public $primaryKey = 'in_id';

    protected $fillable = [
        'in_id',
        'in_cvchannel',
        'in_cvno',
        'in_firstname',
        'in_lastname',
        'in_dob',
        'in_salary',
        'in_mail',
        'in_education',
        'in_del_flg',
        'in_datecreate',
        'in_update',
        'in_experience',
        'in_language',
        'in_university',
        'in_tel',
        'in_address',
        'in_cvlink',
        'in_status',
        'in_time',
        'in_date',
        'in_note',
        'in_extraskill',
        'in_personality',
        'in_file'
    ];
     

}
