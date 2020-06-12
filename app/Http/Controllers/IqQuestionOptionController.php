<?php

namespace App\Http\Controllers;

use App\IqQuestion;
use App\IqQuestionOption;
use Illuminate\Http\Request;
use Carbon\Carbon;
use League\Flysystem\Config;
use mysql_xdevapi\Result;
use Session;
use config\constants;


class IqQuestionOptionController extends Controller
{
    public function index($iq_id) {
        $userLogged = Session::get('user');
        if ($userLogged == null) {
            return redirect('/login');
        }


        // get all interviewer have del_flg = 0 and soft by update time
        $list_iq_option = IqQuestionOption::where([
                            'del_flg'=> 0,
                            'iq_question_id' => $iq_id
                        ])
                        ->orderBy('id', 'DESC')->paginate(10);
        $list_iq_option_count= $list_iq_option->count();

        return view('pages.iq_option_list', compact('list_iq_option','list_iq_option_count','iq_id'));
        }


    public function getIqQuestionOptionNew($iq_id) {
        return view('pages.iq_question_option_new',compact('iq_id'));
    }

    public function postIqQuestionOptionNew(Request $request,$iq_id) {
        $validator = $request->validate([
            'option_value'   => 'required',
        ]);
        // get current time
        $currentTime = Carbon::now();
        $correct_flg = $request->get('correct_flg');


        if($correct_flg == 'on'){
            $list_iq_option_last = IqQuestionOption::where([
                'del_flg'=> 0,
                'iq_question_id' => $iq_id
            ])->orderBy('option_key', 'DESC')->get()->all();
            foreach ($list_iq_option_last as $option_iq){
                $option= IqQuestionOption::find($option_iq->id);
                $option -> correct_flg    = 0;
                $option->save();
            }
        }

        $iq_option = new IqQuestionOption([
        'option_value'             => $request->get('option_value'),
        'iq_question_id' => $iq_id,
        'correct_flg' => ($request->get('correct_flg') == 'on') ? 1 : 0,
        'del_flg'          => 0,
        'date_created'       => $currentTime,
        'date_update'           => $currentTime
        ]);
        $iq_option->save();
        if($request->has('continuos')){
            return redirect('iq-option/new/'.$iq_id)->with('success', 'Added QI question option successfully!');
        }
        return redirect('iq-option-list/'.$iq_id)->with('success', 'Added QI question option successfully!');
    }

    public function getIqQuestionOptionEdit($op_id) {
        $option = IqQuestionOption::where('id', $op_id)->first();
        return view('pages.iq_question_option_edit', compact('option'));
    }

    public function postIqQuestionOptionEdit(Request $request) {
        $validator = $request->validate([
            'option_value'   => 'required',
        ]);

        $option= IqQuestionOption::find($request->get('id'));

        $correct_flg = $request->get('correct_flg');
        if($correct_flg == 'on'){
            $list_iq_option_last = IqQuestionOption::where('del_flg', 0)->where('iq_question_id' , $option->iq_question_id)->get()->all();
            foreach ($list_iq_option_last as $option_iq){
                $option1= IqQuestionOption::find($option_iq->id);
                $option1 -> correct_flg    = 0;
                $option1->save();
            }

        }

        $option -> option_value    = $request->get('option_value');
        $option -> correct_flg    = ($request->get('correct_flg') == 'on') ? 1 : 0;
        $option->date_update    = Carbon::now();
        $option->save();

        return redirect('iq-option-list/'.$option->iq_question_id)->with('success', 'Updated IQ question option successfully!');
    }

    public function getIqQuestionOptionDelete($op_id) {
        $option = IqQuestionOption::where('id', $op_id)->first();
        $option->del_flg = 1;
        $option->date_update  = Carbon::now();
        $option->save();
        return redirect()->back()->with('success', 'Deleted IQ question option successfully!');
    }




}
