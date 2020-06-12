<?php

namespace App\Http\Controllers;

use App\IqQuestion;
use App\IqQuestionOption;
use Illuminate\Http\Request;
use Carbon\Carbon;
use League\Flysystem\Config;
use Session;
use config\constants;


class IqQuestionController extends Controller
{
    public function index() {
        $userLogged = Session::get('user');
        if ($userLogged == null) {
            return redirect('/login');
        }

            // get all interviewer have del_flg = 0 and soft by update time
            $list_iq = IqQuestion::where('del_flg', 0)->orderBy('id', 'DESC')->paginate(10);
            $current_page = $list_iq->currentPage();
            $list_iq_count= $list_iq->count();

        return view('pages.iq_list', compact('list_iq','list_iq_count','current_page'));
        }

    public function getProgammingLanguage($type){
        $language = config('constants.LANGUAGE');
        $lang_code = '';
        foreach ($language as $k => $v){
            if($type == $k){
                $lang_code = $v;
            }
        }
        return $lang_code;
    }


    public function getIqQuestionNew() {
        return view('pages.iq_question_new');
    }

    public function postIqQuestionNew(Request $request) {

        $validator = $request->validate([
            'content'   => 'required',
        ]);


        // get current time
        $currentTime = Carbon::now();
        $tech = new IqQuestion([
        'content'             => $request->get('content'),
        'del_flg'          => 0,
        'date_created'       => $currentTime,
        'date_update'           => $currentTime
        ]);
        $tech->save();
        if($request->has('continuos')){
            return redirect('iq-list/new')->with('success', 'Added QI question successfully!');
        }
        return redirect('iq-list')->with('success', 'Added QI question successfully!');
    }

    public function getIqQuestionEdit($id) {
        $iq = IqQuestion::where('id', $id)->first();
        return view('pages.iq_question_edit', compact('iq'));
    }

    public function postIqQuestionEdit(Request $request) {
        $validator = $request->validate([
            'content'   => 'required',
        ]);

        $iq= IqQuestion::find($request->get('id'));
        $iq ->content   = $request->get('content');
        $iq->date_update    = Carbon::now();
        $iq->save();
        return redirect('iq-list')->with('success', 'Updated IQ question successfully!');
    }

    public function getIqQuestionDelete($id,$page) {
        $iq = IqQuestion::where('id', $id)->first();
        $iq->del_flg = 1;
        $iq->date_update  = Carbon::now();
        $iq->save();

        $result = IqQuestion::where('del_flg',0)->paginate(10,['*'],'page',$page);
        //$a = $result->lastPage();
        if (count($result) === 0) {
            $lastPage = $result->lastPage(); // Get last page with results.
            return redirect('iq-list?page='.$lastPage)->with('success', 'Deleted IQ question successfully!');
        }

        return redirect()->back()->with('success', 'Deleted IQ question successfully!');
    }



}
