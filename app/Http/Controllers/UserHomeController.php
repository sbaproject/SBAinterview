<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Config;
use App\Result;
use App\TechQuestion;
use App\IqQuestion;
use App\TestAnswer;
use App\InterviewManagerment;
use App\IqQuestionOption;
use Carbon\Carbon;
use DB;
use Session;

class UserHomeController extends Controller
{
    public function __construct()
    {
        if(session('permission') == null){
            return redirect()->route('home');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(session('user')){
            return view('user.home');
        }else{
            return redirect()->back();
        }        
    }
    /**
     * 
     * Insert info user from frontEnd
     * 
     * **/
    public function postUserHome(Request $request){
        if($request->email != ""){
            $this->validate($request, [
                'email' => "email"
            ]);
        }

        if($request->tel){
            if (!is_numeric($request->tel)){
                return \Redirect::back()->withErrors(['Tel is not a number, please try again.'])->withInput(\Request::all());
            } elseif (strlen($request->tel) < 10 || strlen($request->tel) > 15) {
                return \Redirect::back()->withErrors(['Tel must greater than 10 and less than 14.'])->withInput(\Request::all());
            } elseif (substr($request->tel, 0, 1) != 0){
                return \Redirect::back()->withErrors(['The Tel format is invalid.'])->withInput(\Request::all());
            }
        }
        if($request->selecttest == 0){
            return \Redirect::back()->withErrors(['Please select a programing language.'])->withInput(\Request::all());
        }
        $time = Carbon::now();
        $data = [
            'candidate_id' => $request->candidate_id,
            'candidate_firstname' => $request->firstname,
            'candidate_lastname' => $request->lastname,
            'candidate_tel' => $request->tel,
            'candidate_address' => $request->address,
            'candidate_mail' => $request->email,
            'candidate_language' => $request->selecttest,
            'candidate_dob' => $request->dob,
            'starttime' => '00:00',
            'endtime' => '00:00',
            'totaltime' => 0,
            'iq_score' => 0,
            'tech_score' => 0,
            'date_created' => $time
        ];
        $userId = DB::table('t_result')->insertGetId($data);
        Session(['ID' => $userId]);
        return view('user.infoTest', compact("data", "userId"));
    }
    /**
     * 
     * Edit candidate by ID
     * 
     * **/
    public function userHomeEditById($id){
        $data = Result::find($id);
        return view('user.edituser', compact("data"));
    }
    /**
     * 
     * Update user by ID
     * 
     * **/
    public function postUserHomeEditById(Request $request){
        if($request->email != ""){
            $this->validate($request, [
                'email' => "email"
            ]);
        }
        
        if($request->tel){
            if (!is_numeric($request->tel)){
                return \Redirect::back()->withErrors(['Tel is not a number, please try again.'])->withInput(\Request::all());
            } elseif (strlen($request->tel) < 10 || strlen($request->tel) > 15) {
                return \Redirect::back()->withErrors(['Tel must greater than 10 and less than 14.'])->withInput(\Request::all());
            } elseif (substr($request->tel, 0, 1) != 0){
                return \Redirect::back()->withErrors(['The Tel format is invalid.'])->withInput(\Request::all());
            }
        }
        if($request->selecttest == 0){
            return \Redirect::back()->withErrors(['Please select a programing language.'])->withInput(\Request::all());
        }
        $time = Carbon::now();
        $user = Result::find($request->userId);
        $user->candidate_id = $request->candidate_id;
        $user->candidate_firstname = $request->firstname;
        $user->candidate_lastname = $request->lastname;
        $user->candidate_tel = $request->tel;
        $user->candidate_address = $request->address;
        $user->candidate_mail = $request->email;
        $user->candidate_language = $request->selecttest;
        $user->candidate_dob = $request->dob;
        $user->date_created = $time;
        $user->save();
        
        $data = [
            'candidate_id' => $request->candidate_id,
            'candidate_firstname' => $request->firstname,
            'candidate_lastname' => $request->lastname,
            'candidate_tel' => $request->tel,
            'candidate_address' => $request->address,
            'candidate_mail' => $request->email,
            'candidate_language' => $request->selecttest,
            'candidate_dob' => $request->dob,
        ];
        $userId = $request->userId;

        return view('user.infoTest', compact("data", "userId"));
    }
    /**
     * 
     * Start test with data selected
     * 
     * **/
    public function postUserTest($type, Request $request){
        if(session()->has('key')){
            return redirect()->route('userHome');
        }
        $key = time() . rand(1111,9999);
        session(['key' => $key]);
        
        $data = [];
        $time = Carbon::now();
        $id = $request->session()->get('ID');
        $result = Result::find($id);
        $result->starttime = $time->toTimeString();
        
        $result->save();
        if($type != 0){
            $data = TechQuestion::where([['type', $type], ['del_flg', 0]])->orderBy('id', 'ASC')->get();
        }else{
            $q = IqQuestion::where('del_flg', 0)->get();
        
            foreach($q as $k => $i){
                $data['q'][$k]['id'] = $i->id;
                $data['q'][$k]['content'] = $i->content;
                $data['q'][$k]['option'] = $i->Options; 
            }
            return view('user.testIQ', compact("type", "data"));
        }
        return view('user.questionTest', compact("type", "data"));
    }
    /**
     * 
     * Save result test
     * 
     * **/
    public function postResultTech(Request $request){
        $total = "";
        $tech = $request->tech;
        $id = $request->session()->get('ID');
        $currentTime = Carbon::now();

        $cnt = 0;
        foreach($tech as $key => $value){
            if($value != null){
                $cnt++;
            }
            $result = new TestAnswer;
            $result->result_id = $id;
            $result->type = 2;
            $result->question_id = $key;
            $result->tech_content_ans = $value;
            $result->save();
        }
        $total = $cnt."/".count($tech);
        $user = Result::find($id);
        $user->tech_total = $total;
        $user->save();
        //
        $type = 3;
        $q = IqQuestion::where('del_flg', 0)->orderBy('id', 'ASC')->get();
        
        foreach($q as $k => $i){
            $data['q'][$k]['id'] = $i->id;
            $data['q'][$k]['content'] = $i->content;
            $data['q'][$k]['option'] = $i->Options; 
        }
        return view('user.testIQ', compact("type", "data"));
    }
    /**
     * 
     * Save result test IQ
     * 
     * **/
    public function postResultIQ(Request $request){
        $total = "";
        $score = 0;
        $id = $request->session()->get('ID');
        $currentTime = Carbon::now();
        $q = IqQuestion::where('del_flg', 0)->get();
        if($request->anser){
            $iq = $request->anser;            
            foreach($q as $value){
                $result = new TestAnswer;
                if(isset($iq[$value->id])){
                    $option = IqQuestionOption::find($iq[$value->id]);
                    if($option->correct_flg == 1){
                        $score++;
                    }

                    $result->result_id = $id;
                    $result->type = 1;
                    $result->question_id = $value->id;
                    $result->date_created = $currentTime;
                    $result->question_options_id = $iq[$value->id];
                }else{
                    $result->result_id = $id;
                    $result->type = 1;
                    $result->question_id = $value->id;
                    $result->date_created = $currentTime;
                }         
                $result->save();
            }
            $total = count($iq)."/".count($q);
        }else{
            $total = "0/".count($q);
        }
        $result = Result::find($id);
        //
        $start = explode(':',$result->starttime);
        $end = explode(':',$currentTime->toTimeString());
        $totaltime = (((int)$end[0]-(int)$start[0])*60) + ((int)$end[1]-(int)$start[1]);
        //
        $tech_total = $result->tech_total;
        $iq_total = $total;
        //
        $result->endtime = $currentTime->toTimeString();
        $result->iq_total = $total;
        $result->totaltime = $totaltime;
        $result->iq_score = $score*10;
        $result->date_update = $currentTime;
        $result->save();
        $request->session()->forget('ID');
        return view('user.success', compact("tech_total", "iq_total"));
    }
    /**
     * 
     * 
     * Get link test
     * 
     * **/
    public function getName($id, Request $request){
        $userid = $request->session()->get('ID');
        $lang = Result::where('id', $userid)->first();
        $type = $lang->candidate_language;
        return view('user.testname', compact("type"));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * 
     * Ajax get candidate by ID
     * 
     * **/
    public function getLoadCandidate($id){
        $user = InterviewManagerment::where([['in_id', $id],['in_del_flg', 0]])->first();
        if($user != null){
            return response()->json($user, 200);
        }else{
            return 'error';
        }
    }
}
