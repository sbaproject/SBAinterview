<?php

namespace App\Http\Controllers;

use App\IqQuestion;
use App\IqQuestionOption;
use App\TestAnswer;
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

        public function resultIQ($result_id){
            $userLogged = Session::get('user');
            if ($userLogged == null) {
                return redirect('/login');
            }
            $list_iq_question_arr = TestAnswer::where([
                't_test_answer.type' => 1,
                't_test_answer.result_id' => $result_id,
               // 't_iq_questions.del_flg' => 0
            ])
                ->join('t_iq_questions', function($join) {
                    $join->on('t_iq_questions.id', '=', 't_test_answer.question_id');
                })
                ->orderBy('t_test_answer.id', 'ASC')->get()->toArray();

            $count_iq_question = count($list_iq_question_arr);
            //get options
            $count_correct = 0;
            for($i=0;$i<$count_iq_question;$i++){
                $list_option = IqQuestionOption::where([
                    'del_flg' => 0,
                    'iq_question_id' => $list_iq_question_arr[$i]['question_id']
                ])->orderBy('id', 'ASC')->get()->toArray();
                $list_iq_question_arr[$i]['list_option'] = array();
                $list_iq_question_arr[$i]['list_option'] = $list_option;

                //get correct answers count
                foreach ($list_option as $option){
                    if($list_iq_question_arr[$i]['question_options_id'] == $option['id'] && $option['correct_flg'] == 1){
                        $count_correct = $count_correct +10;
                    }
                }
            }

            return view('pages.result_iq', compact('list_iq_question_arr','count_iq_question','count_correct'));
        }

        public function ResultTech ($result_id){
            $userLogged = Session::get('user');
            if ($userLogged == null) {
                return redirect('/login');
            }

            $list_tech_question_arr = TestAnswer::where([
                't_test_answer.type' => 2,
                't_test_answer.result_id' => $result_id,
               // 't_tech_questions.del_flg' => 0
            ])
                ->join('t_tech_questions', function($join) {
                    $join->on('t_tech_questions.id', '=', 't_test_answer.question_id');
                })
                ->select(['t_test_answer.id AS id_result', 't_tech_questions.*','t_test_answer.*'])
                ->orderBy('t_test_answer.id', 'ASC')->get()->toArray();

            //check is marked
            $result  = Result::where('id',$result_id)->first();
            $is_marked = $result->is_marked;
            $total_score = $result->tech_score;

            $count_tech_question = count($list_tech_question_arr);


            return view('pages.result_tech', compact('list_tech_question_arr','count_tech_question','is_marked','result_id','total_score'));
        }



    public function getResultTechMark ($result_id){
        $userLogged = Session::get('user');
        if ($userLogged == null) {
            return redirect('/login');
        }

        $list_tech_question_arr = TestAnswer::where([
            't_test_answer.type' => 2,
            't_test_answer.result_id' => $result_id,
           // 't_tech_questions.del_flg' => 0
        ])
            ->join('t_tech_questions', function($join) {
                $join->on('t_tech_questions.id', '=', 't_test_answer.question_id');
            })
            ->select([ 't_tech_questions.*','t_test_answer.*'])
            ->orderBy('t_test_answer.id', 'ASC')->get()->toArray();

        //check is marked
        $result  = Result::find($result_id)->first();
        $is_marked = $result->is_marked;


        $count_tech_question = count($list_tech_question_arr);



        return view('pages.result_tech_mark', compact('list_tech_question_arr','count_tech_question','is_marked','result_id'));
    }

    public function postResultTechMark(Request $request ,$result_id){
            foreach ($request->except('_token') as $data => $value) {
                //var_dump($data);die;
                $valids[$data] = "required|numeric|max:10";
                $valid_req[$data.'.required'] = 'The score field is required.';
                $valid_req[$data.'.numeric'] = 'The score must be a number';
               $valid_req[$data.'.max'] = 'The score may not be greater than 10.';
             }
            $request->validate($valids,$valid_req);

        $request_arr = $request->all();
        $count_req = count($request_arr);
        if($count_req>1){
            $total_score = 0;
            foreach ($request_arr as $key =>$value){
                if($key != '_token'){
                    $key_arr = explode('_',$key);
                    TestAnswer::where('id',$key_arr[1])->update(['score' => $value]);
                    $total_score = $total_score + $value;

                }
                Result::where('id',$result_id)->update([
                    'is_marked' => 1,
                    'tech_score' => $total_score
                ]);


            }
            return redirect('result-tech/'.$result_id)->with('success', 'Mark successfully!');
        }
    }




}
