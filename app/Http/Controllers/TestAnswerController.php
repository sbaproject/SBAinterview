<?php

namespace App\Http\Controllers;

use App\IqQuestion;
use App\IqQuestionOption;
use App\Result;
use Illuminate\Http\Request;
use Carbon\Carbon;
use League\Flysystem\Config;
use Session;
use config\constants;


class TestAnswerController extends Controller
{
    public function index() {

        }

        public function resultIQ(){
            $userLogged = Session::get('user');
            if ($userLogged == null) {
                return redirect('/login');
            }
//            $list_iq_question = IqQuestion::where('t_iq_questions.del_flg', 0)
//                ->leftJoin('t_iq_question_options', function($join) {
//                    $join->on('t_iq_questions.id', '=', 't_iq_question_options.iq_question_id');
//                })
//                ->orderBy('t_iq_questions.id', 'DESC')->get()->all();
//            var_dump($list_iq_question);die;
            $list_iq_question_arr = IqQuestion::where('del_flg',0)->orderBy('id', 'DESC')->get()->toArray();
            $list_iq_question = array();
            $count_iq_question = count($list_iq_question_arr);
            for($i=0;$i<$count_iq_question;$i++){
                $list_option = IqQuestionOption::where([
                    'del_flg' => 0,
                    'iq_question_id' => $list_iq_question_arr[$i]['id']
                ])
                    ->orderBy('id', 'DESC')->get()->toArray();
                $list_iq_question_arr[$i]['list_option'] = array();
                $list_iq_question_arr[$i]['list_option'] = $list_option;
            }


            return view('pages.result_iq', compact('list_iq_question_arr','count_iq_question'));
        }





}
