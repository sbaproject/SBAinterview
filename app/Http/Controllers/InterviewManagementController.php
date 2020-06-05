<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InterviewManagerment;
use Carbon\Carbon;
use Session;

class InterviewManagementController extends Controller
{
    public function wellcome(){
        return view('pages.landing');
    }
    public function index(Request $request) {
        $userLogged = Session::get('user');
        if ($userLogged == null) {
            return redirect('/login');
        }
        $req_arr = array(
            'in_name' => '',
            'in_address' => '',
            'in_dob' => '',
            'in_tel' => '',
            'in_mail' => '',
            'in_language' => ''
        );
        if($request->has('submit')){
            $validator = $request->validate([
                'in_tel'    => 'nullable|regex:/(01)[0-9]{9}/|size:11',
                'in_mail'    => 'nullable|email',

            ], [
                'in_tel'    => 'Please enter the correct tel format',
                'in_mail'    => 'Please enter the correct email format',
            ]);

            $name = $request->get('in_name');
            $address = $request->get('in_address');
            $dob = $request->get('in_dob');
            $tel = $request->get('in_tel');
            $mail = $request->get('in_mail');
            $language = $request->get('in_language');

            $req_arr = $request->all();

            $list_interviewers = InterviewManagerment::where('in_del_flg', 0);
             if(!empty($name)){
               $list_interviewers = $list_interviewers ->where('in_name','like','%'.$name.'%');
             }
            if(!empty($address)){
                $list_interviewers = $list_interviewers ->where('in_address','like','%'.$address.'%');
            }
            if(!empty($dob)){
                $list_interviewers = $list_interviewers ->where('in_dob','like','%'.$dob.'%');
            }
            if(!empty($tel)){
                $list_interviewers = $list_interviewers ->where('in_tel','like','%'.$tel.'%');
            }
            if(!empty($mail)){
                $list_interviewers = $list_interviewers ->where('in_mail','like','%'.$mail.'%');
            }
            if(!empty($language)){
                $list_interviewers = $list_interviewers ->where('in_language',$language);
            }
             $list_interviewers = $list_interviewers->orderBy('in_id', 'DESC')->paginate(10);


            $list_interviewers_count= $list_interviewers->count();
            return view('pages.interview_management', compact('list_interviewers','list_interviewers_count','req_arr'));
        }else{
            $req_arr = array(
                'in_name' => '',
                'in_address' => '',
                'in_dob' => '',
                'in_tel' => '',
                'in_mail' => '',
                'in_language' => ''
            );
            // get all interviewer have del_flg = 0 and soft by update time
            $list_interviewers = InterviewManagerment::where('in_del_flg', 0)->orderBy('in_id', 'DESC')->paginate(10);
            $list_interviewers_count= $list_interviewers->count();
            return view('pages.interview_management', compact('list_interviewers','list_interviewers_count','req_arr'));
        }


    }    

    public function getInterviewerNew() {
        $currentTime = Carbon::now()->format('yy/m/d');

        return view('pages.interviewer_new',compact('currentTime'));
    }

    public function postInterviewerNew(Request $request) {

        $validator = $request->validate([
            'in_name'   => 'required',
            'in_language'    => 'required',
            'in_salary' => 'nullable|numeric',
            'in_mail' => 'nullable|email',
            'in_tel' => 'nullable|regex:/(01)[0-9]{9}/|size:11'


        ], [
            'in_name.required'  => 'Please enter fullname.',
            'in_language.required'   => 'Please choose language.',
//            'in_salary' => 'Please enter the number format',
//            'in_tel' => 'Please enter the correct tel format',
//            'in_mail' => 'Please enter the correct mail format'
        ]);


        // get current time
        $currentTime = Carbon::now();
        $interviewer = new InterviewManagerment([
//        'in_id'               => $request->get('in_id'),
        'in_cvno'             => $request->get('in_cvno'),
        'in_name'             => $request->get('in_name'),
        'in_dob'             => $request->get('in_dob'),
        'in_salary'           => $request->get('in_salary'),
        'in_mail'             => $request->get('in_mail'),
        'in_education'        => $request->get('in_education'),
        'in_experience'       => $request->get('in_experience'),
        'in_language'         => $request->get('in_language'),
        'in_university'       => $request->get('in_university'),
        'in_tel'              => $request->get('in_tel'),
        'in_address'          => $request->get('in_address'),
        'in_status'           => $request->get('in_status'),
        'in_time'             => $request->get('in_time'),
        'in_date'             => $request->get('in_date'),
        'in_note'             => $request->get('in_note'),
        'in_extraskill'       => $request->get('in_extraskill'),
        'in_personality'      => $request->get('in_personality'),
        'in_del_flg'          => 0,
        'in_datecreate'       => $currentTime,
        'in_update'           => $currentTime
        ]);
        $interviewer->save();
        return redirect('interview-management')->with('success', 'Added interviewer successfully!');
    }
    public  function getStatusInterview_lay($status){
        $status_arr = array(
            0 => '',
            1 => 'Phone&mail contacted',
            2 => 'Interviewed',
            3 => 'Cancelled interview',
            4 => 'Not pass Contacted'
        );
        $status_res = '';
        foreach ($status_arr as $key => $val){
            if ($status == $key){
                $status_res = $val;
            }
        }
        return $status_res;

    }
    public function getInterviewerEdit($id) {
        $currentTime = Carbon::now()->format('yy/m/d');
        $interviewer = InterviewManagerment::where('in_id', $id)->first();

        return view('pages.interviewer_edit', compact('interviewer','currentTime'));
    }

    public function postInterviewerEdit(Request $request) {
        $validator = $request->validate([
            'in_name'   => 'required',
            'in_language'    => 'required',
            'in_salary' => 'nullable|numeric',
            'in_mail' => 'nullable|email',
            'in_tel' => 'nullable|regex:/(01)[0-9]{9}/|size:11'


        ], [
            'in_name.required'  => 'Please enter fullname.',
            'in_language.required'   => 'Please choose language.',
//            'in_salary' => 'Please enter the number format',
//            'in_tel' => 'Please enter the correct tel format',
//            'in_mail' => 'Please enter the correct mail format'
        ]);

        $interviewer  = InterviewManagerment::find($request->get('in_id'));


        $interviewer ->in_cvno            = $request->get('in_cvno');
        $interviewer-> in_name            = $request->get('in_name');
        $interviewer-> in_dob              = $request->get('in_dob');
        $interviewer->in_salary           = $request->get('in_salary');
        $interviewer->in_mail             = $request->get('in_mail');
        $interviewer->in_education        = $request->get('in_education');
        $interviewer->in_experience       = $request->get('in_experience');
        $interviewer->in_language         = $request->get('in_language');
        $interviewer->in_university       = $request->get('in_university');
        $interviewer->in_tel              = $request->get('in_tel');
        $interviewer->in_address          = $request->get('in_address');
        $interviewer->in_status           = $request->get('in_status');
        $interviewer->in_time             = $request->get('in_time');
        $interviewer->in_date             = $request->get('in_date');
        $interviewer->in_note             = $request->get('in_note');
        $interviewer->in_extraskill       = $request->get('in_extraskill');
        $interviewer->in_personality      = $request->get('in_personality');
        $interviewer->in_update    = Carbon::now();
        $interviewer->save();
        return redirect('interview-management')->with('success', 'Updated interviewer successfully!');
    }

    public function getInterviewerDelete($id) {
        $interviewer = InterviewManagerment::find($id);
        $interviewer->in_del_flg = 1;
        $interviewer->in_update  = Carbon::now();
        $interviewer->save();
        return redirect()->back()->with('success', 'Deleted Interviewer successfully!');
    }
}
