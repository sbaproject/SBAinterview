<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Config;
use App\Result;
use DB;

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
        return view('user.home');
    }
    /**
     * 
     * Insert info user from frontEnd
     * 
     * **/
    public function postUserHome(Request $request){
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'address' => 'required',
            'email' => 'required|email'
        ]);

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
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'address' => 'required',
            'email' => 'required|email'
        ]);

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
    public function postUserTest($type){
        if($type == "PHP"){
            $type = 1;
        }elseif($type == "IQ"){
            $type = 3;
            return view('user.testIQ', compact("type"));
        }else{
            $type = 2;
        }
        return view('user.questionTest', compact("type"));
    }
    /**
     * 
     * Save result test
     * 
     * **/
    public function postTech(Request $request){
        return "OK";
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
}
