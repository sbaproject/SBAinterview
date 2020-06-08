<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestAnswer extends Model
{
    // change default Eloquent Model config
    protected $table = "t_test_answer";
    public $timestamps = false;
    public $primaryKey = 'id';

    protected $fillable = [
        'id',
        'result_id',
        'type',
        'question_id',
        'question_options_id',
        'tech_content_ans',
        'score',
        'date_created',
    ];
     

}
