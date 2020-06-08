<?php

namespace App\Http\Controllers;

use App\TechQuestion;
use Illuminate\Http\Request;
use App\TeachQuestion;
use Carbon\Carbon;
use League\Flysystem\Config;
use Session;
use config\constants;


class TechQuestionController extends Controller
{
    public function index() {
        $userLogged = Session::get('user');
        if ($userLogged == null) {
            return redirect('/login');
        }

            // get all interviewer have del_flg = 0 and soft by update time
            $list_tech = TechQuestion::where('del_flg', 0)->orderBy('id', 'DESC')->paginate(10);
            $list_tech_count= $list_tech->count();
            for ($i=0;$i<$list_tech_count;$i++){
                $list_tech[$i]['type'] = $this->getProgammingLanguage($list_tech[$i]['type']);
            }


        return view('pages.tech_list', compact('list_tech','list_tech_count'));
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


    public function getTechQuestionNew() {
        $language = config('constants.LANGUAGE');


        return view('pages.teach_question_new',compact('language'));
    }

    public function postTechQuestionNew(Request $request) {

        $validator = $request->validate([
            'content'   => 'required',
        ]);


        // get current time
        $currentTime = Carbon::now();
        $tech = new TechQuestion([
//        'in_id'               => $request->get('in_id'),
        'content'             => $request->get('content'),
        'type'             => $request->get('type'),
        'del_flg'          => 0,
        'date_created'       => $currentTime,
        'date_update'           => $currentTime
        ]);
        $tech->save();
        return redirect('tech-list')->with('success', 'Added technical question successfully!');
    }

    public function getTechQuestionEdit($id) {
        $tech = TechQuestion::where('id', $id)->first();
        $language = config('constants.LANGUAGE');
        return view('pages.tech_question_edit', compact('tech','language'));
    }

    public function postTechQuestionEdit(Request $request) {
        $validator = $request->validate([
            'content'   => 'required',
        ]);

        $tech  = TechQuestion::find($request->get('id'));
        $tech ->content   = $request->get('content');
        $tech ->type   = $request->get('type');
        $tech->date_update    = Carbon::now();
        $tech->save();
        return redirect('tech-list')->with('success', 'Updated technical question successfully!');
    }

    public function getTechQuestionDelete($id) {
        $tech = TechQuestion::where('id', $id)->first();
        $tech->del_flg = 1;
        $tech->date_update  = Carbon::now();
        $tech->save();
        return redirect()->back()->with('success', 'Deleted technical question successfully!');
    }
}
