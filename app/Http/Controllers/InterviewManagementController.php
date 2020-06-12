<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InterviewManagerment;
use Carbon\Carbon;
use Session;
use config\constants;
use Illuminate\Validation\Rule;

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
        $cst_lang =config('constants.LANGUAGE');
        $cst_cvchannel = config('constants.CV_CHANNEL');
        $cst_status = config('constants.STATUS');
        $req_arr = array(
            'in_firstname' => '',
            'in_lastname' => '',
            'in_cvchannel' => '',
            'in_address' => '',
            'in_dob' => '',
            'in_tel' => '',
            'in_mail' => '',
            'in_language' => '',
            'in_cvno' => '',
            'in_status' => ''
        );
        if($request->has('submit')){
            $validator = $request->validate([
                'in_tel' => 'nullable|regex:/(0)[0-9]{9}/',
                'in_mail'    => 'nullable|email',

            ], [
                'in_tel.regex' => 'The in tel format is invalid.',
                'in_mail.email' => 'The mail must be a valid email address.'
            ]);

            $first_name = $request->get('in_firstname');
            $last_name = $request->get('in_lastname');
            $address = $request->get('in_address');
            $dob = $request->get('in_dob');
            $tel = $request->get('in_tel');
            $mail = $request->get('in_mail');
            $language = $request->get('in_language');
            $cv_channel = $request->get('in_cvchannel');
            $cvno = $request->get('in_cvno');
            $status = $request->get('in_status');


            $req_arr = $request->all();

            $list_interviewers = InterviewManagerment::where('in_del_flg', 0);
             if(!empty($first_name)){
               $list_interviewers = $list_interviewers ->where('in_firstname','like','%'.$first_name.'%');
             }
            if(!empty($last_name)){
                $list_interviewers = $list_interviewers ->where('in_lastname','like','%'.$last_name.'%');
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
            if(!empty($cv_channel)){
                $list_interviewers = $list_interviewers ->where('in_cvchannel',$cv_channel);
            }
            if(!empty($cvno)){
                $list_interviewers = $list_interviewers ->where('in_cvno','like','%'.$cvno.'%');
            }
            if(!empty($status)){
                $list_interviewers = $list_interviewers ->where('in_status',$status);
            }
             $list_interviewers = $list_interviewers->orderBy('in_id', 'DESC')->paginate(10);


            $list_interviewers_count= $list_interviewers->count();
            $current_page = $list_interviewers->currentPage();
            return view('pages.interview_management', compact('list_interviewers','list_interviewers_count','req_arr','cst_lang','cst_cvchannel','cst_status','current_page'));
        }else{
            $req_arr = array(
                'in_firstname' => '',
                'in_lastname' => '',
                'in_cvchannel' => '',
                'in_address' => '',
                'in_dob' => '',
                'in_tel' => '',
                'in_mail' => '',
                'in_language' => '',
                'in_cvno' => '',
                'in_status' => ''
            );
            // get all interviewer have del_flg = 0 and soft by update time
            $list_interviewers = InterviewManagerment::where('in_del_flg', 0)->orderBy('in_id', 'DESC')->paginate(10);
            $list_interviewers_count= $list_interviewers->count();
            $current_page = $list_interviewers->currentPage();
            return view('pages.interview_management', compact('list_interviewers','list_interviewers_count','req_arr','cst_lang','cst_cvchannel','cst_status','current_page'));
        }


    }    

    public function getInterviewerNew() {
        $currentTime = Carbon::now()->format('yy/m/d');
        $cst_lang =config('constants.LANGUAGE');
        $cst_cvchannel = config('constants.CV_CHANNEL');
        $cst_status = config('constants.STATUS');
        return view('pages.interviewer_new',compact('currentTime','cst_status','cst_cvchannel','cst_lang'));
    }

    public function postInterviewerNew(Request $request) {

        $validator = $request->validate([
            'in_firstname'   => 'required',
            'in_lastname'   => 'required',
            'in_language'    => 'required',
            'in_salary' => 'nullable|numeric|digits_between:0,9',
            'in_mail' => 'nullable|email',
            'in_tel' => 'nullable|regex:/(0)[0-9]{9}/',
            'in_cvno' => 'required|unique:t_interviewmanagement,in_cvno'


        ], [
            'in_firstname.required'  => 'The first name field is required.',
            'in_lastname.required'  => 'The last name field is required.',
            'in_language.required'   => 'Please choose a progamming language.',
            'in_salary.numeric' => 'The salary must be a number.',
            'in_tel.regex' => 'The tel format is invalid.',
            'in_mail.email' => 'The mail must be a valid email address.',
            'in_cvno.required' => 'The CV No. field is required.',
            'in_cvno.unique' => 'The CV No. has already been taken.',
            'in_salary.digits_between' => 'The salary must be max 9 digits.',
        ]);


        // get current time
        $currentTime = Carbon::now();
        $interviewer = new InterviewManagerment([
//        'in_id'               => $request->get('in_id'),
        'in_cvno'             => $request->get('in_cvno'),
        'in_cvchannel'       => $request->get('in_cvchannel'),
        'in_firstname'       => $request->get('in_firstname'),
        'in_lastname'         => $request->get('in_lastname'),
        'in_cvlink'           => $request->get('in_cvlink'),
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
         'in_dob'               => $request->get('in_dob'),
        'in_del_flg'          => 0,
        'in_datecreate'       => $currentTime,
        'in_update'           => $currentTime
        ]);
        $interviewer->save();
        if($request->has('continuos')){
            return redirect('interview-management/new');
        }
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
        $cst_lang =config('constants.LANGUAGE');
        $cst_cvchannel = config('constants.CV_CHANNEL');
        $cst_status = config('constants.STATUS');

        return view('pages.interviewer_edit', compact('interviewer','currentTime','cst_status','cst_cvchannel','cst_lang'));
    }

    public function postInterviewerEdit(Request $request) {

        $validator = $request->validate([
            'in_firstname'   => 'required',
            'in_lastname'   => 'required',
            'in_language'    => 'required',
            'in_salary' => 'nullable|numeric|digits_between:0,9',
            'in_mail' => 'nullable|email',
            'in_tel' => 'nullable|regex:/(0)[0-9]{9}/',
            'in_cvno'=>[
                'required',
                Rule::unique('t_interviewmanagement')->ignore($request->get('in_id'), 'in_id')
            ],
           // 'in_cvno' => 'required|unique:t_interviewmanagement,in_cvno,'.$request->get('in_id')


        ], [
            'in_firstname.required'  => 'The first name field is required.',
            'in_lastname.required'  => 'The last name field is required.',
            'in_language.required'   => 'Please choose a progamming language.',
            'in_salary.numeric' => 'The salary must be a number.',
            'in_tel.regex' => 'The tel format is invalid.',
            'in_mail.email' => 'The mail must be a valid email address.',
            'in_cvno.required' => 'The CV No. field is required.',
            'in_cvno.unique' => 'The CV No. has already been taken.',
            'in_salary.digits_between' => 'The salary must be max 9 digits.',
        ]);

        $interviewer  = InterviewManagerment::find($request->get('in_id'));


        $interviewer ->in_cvno            = $request->get('in_cvno');
        $interviewer ->in_cvchannel            = $request->get('in_cvchannel');
        $interviewer ->in_cvlink            = $request->get('in_cvlink');
        $interviewer-> in_firstname            = $request->get('in_firstname');
        $interviewer-> in_lastname           = $request->get('in_lastname');
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

    public function getInterviewerDelete($id,$page) {
        $interviewer = InterviewManagerment::find($id);
        $interviewer->in_del_flg = 1;
        $interviewer->in_update  = Carbon::now();
        $interviewer->save();


       $result = InterviewManagerment::where('in_del_flg',0)->paginate(10,['*'],'page',$page);
       //$a = $result->lastPage();
        if (count($result) === 0) {
            $lastPage = $result->lastPage(); // Get last page with results.
            return redirect('interview-management?page='.$lastPage)->with('success', 'Deleted Interviewer successfully!');
        }
        return redirect()->back()->with('success', 'Deleted Interviewer successfully!');
    }
}
