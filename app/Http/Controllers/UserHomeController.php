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
use Carbon\Carbon;
use DB;
use Session;

class UserHomeController extends Controller
{
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
        if (!is_numeric($request->tel)){
            return \Redirect::back()->withErrors(['Tel is not a number, please try again.'])->withInput(\Request::all());
        } elseif (strlen($request->tel) < 10) {
            return \Redirect::back()->withErrors(['Number must greater than 10.'])->withInput(\Request::all());
        } elseif (substr($request->tel, 0, 1) != 0){
            return \Redirect::back()->withErrors(['The Tel format is invalid.'])->withInput(\Request::all());
        }
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'address' => 'required',
            'email' => 'required|email'
        ]);
        if($request->selecttest == 0){
            return \Redirect::back()->withErrors(['Please select a programing language.'])->withInput(\Request::all());
        }
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
            'tech_score' => 0
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
        if (!is_numeric($request->tel)){
            return \Redirect::back()->withErrors(['Tel is not a number, please try again.'])->withInput(\Request::all());
        } elseif (strlen($request->tel) < 10) {
            return \Redirect::back()->withErrors(['Number must greater than 10.'])->withInput(\Request::all());
        } elseif (substr($request->tel, 0, 1) != 0){
            return \Redirect::back()->withErrors(['The Tel format is invalid.'])->withInput(\Request::all());
        }
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'address' => 'required',
            'email' => 'required|email'
        ]);
        if($request->selecttest == 0){
            return \Redirect::back()->withErrors(['Please select a programing language.'])->withInput(\Request::all());
        }
        $user = Result::find($request->userId);
        $user->candidate_id = $request->candidate_id;
        $user->candidate_firstname = $request->firstname;
        $user->candidate_lastname = $request->lastname;
        $user->candidate_tel = $request->tel;
        $user->candidate_address = $request->address;
        $user->candidate_mail = $request->email;
        $user->candidate_language = $request->selecttest;
        $user->candidate_dob = $request->dob;
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
        $data = [];
        $time = Carbon::now();
        $id = $request->session()->get('ID');
        $result = Result::find($id);
        $result->starttime = $time->toTimeString();
        $result->save();
        if($type == "PHP"){
            $type = 1;
            $data = TechQuestion::where([['type', 1], ['del_flg', 0]])->get();
        }elseif($type == "IQ"){
            $type = 3;
            $q = IqQuestion::where('del_flg', 0)->get();
        
            foreach($q as $k => $i){
                $data['q'][$k]['id'] = $i->id;
                $data['q'][$k]['content'] = $i->content;
                $data['q'][$k]['option'] = $i->Options; 
            }
            return view('user.testIQ', compact("type", "data"));
        }else{
            $type = 2;
            $data = TechQuestion::where([['type', 2], ['del_flg', 0]])->get();
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
            $result->date_created = $currentTime;
            $result->save();
        }
        $total = $cnt."/".count($tech);
        $user = Result::find($id);
        $user->tech_total = $total;
        $user->save();
        //
        $type = 3;
        $q = IqQuestion::where('del_flg', 0)->get();
        
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
        $id = $request->session()->get('ID');
        $currentTime = Carbon::now();
        $q = IqQuestion::where('del_flg', 0)->get();
        if($request->anser){
            $iq = $request->anser;            
            foreach($q as $value){
                $result = new TestAnswer;
                if(isset($iq[$value->id])){
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
        $result->tech_total = $total;
        $result->totaltime = $totaltime;
        $result->save();
        $request->session()->forget('ID');
        return view('user.success', compact("tech_total", "iq_total"));
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
