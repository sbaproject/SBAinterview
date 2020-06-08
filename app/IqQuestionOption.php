<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IqQuestionOption extends Model
{
    // change default Eloquent Model config
    protected $table = "t_iq_question_options";
    public $timestamps = false;
    public $primaryKey = 'id';

    protected $fillable = [
        'id',
        'iq_question_id',
        'option_key',
        'option_value',
        'correct_flg',
        'del_flg',
        'date_created',
        'date_update'
    ];
     

}
