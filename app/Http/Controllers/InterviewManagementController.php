<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InterviewManagerment;
use Carbon\Carbon;
use MicrosoftAzure\Storage\Common\Internal\Validate;
use Session;
use config\constants;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Storage;


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
            'in_id' => '',
            'in_status' => '',
            'date_from' => '',
            'date_to' => ''
        );
        $currentTime = Carbon::now()->format('yy/m/d');
        //get score iq , skill
        $list_candidate_score = InterviewManagerment::from('t_interviewmanagement as inte');
        $list_candidate_score = $list_candidate_score ->join('t_result as re', function($join) {
            $join->on('inte.in_id', '=', 're.candidate_id');
        });
        $list_candidate_score = $list_candidate_score->where([
           're.is_marked' =>1,
//            'inte.in_del_flg' =>0

        ]);
        $list_candidate_score = $list_candidate_score->select('re.iq_score','re.tech_score','inte.in_firstname','inte.in_lastname');


        $req_search = $request->all();
        if(!empty($req_search)){
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
            $inid = $request->get('in_id');
            $status = $request->get('in_status');
            $date_from = $request->get('date_from');
            $date_to = $request->get('date_to');

            $req_arr = array(
                'in_firstname' => $first_name,
                'in_lastname' => $last_name,
                'in_cvchannel' => $cv_channel,
                'in_address' => $address,
                'in_dob' => $dob,
                'in_tel' => $tel,
                'in_mail' => $mail,
                'in_language' => $language,
                'in_id' => $inid,
                'in_status' => $status,
                'date_from' => $date_from,
                'date_to' => $date_to
            );
           // $req_arr = $request->all();

            $list_interviewers = InterviewManagerment::from('t_interviewmanagement as inter')->where('inter.in_del_flg', 0);
             if(!empty($first_name)){
               $list_interviewers = $list_interviewers ->where('inter.in_firstname','like','%'.$first_name.'%');
               $list_candidate_score = $list_candidate_score ->where('inte.in_firstname','like','%'.$first_name.'%');
             }
            if(!empty($last_name)){
                $list_interviewers = $list_interviewers ->where('inter.in_lastname','like','%'.$last_name.'%');
                $list_candidate_score = $list_candidate_score ->where('inte.in_lastname','like','%'.$last_name.'%');
            }
            if(!empty($address)){
                $list_interviewers = $list_interviewers ->where('inter.in_address','like','%'.$address.'%');
                $list_candidate_score = $list_candidate_score ->where('inte.in_address','like','%'.$address.'%');
            }
            if(!empty($dob)){
                $list_interviewers = $list_interviewers ->where('inter.in_dob','like','%'.$dob.'%');
                $list_candidate_score = $list_candidate_score ->where('inte.in_dob','like','%'.$dob.'%');
            }
            if(!empty($tel)){
                $list_interviewers = $list_interviewers ->where('inter.in_tel','like','%'.$tel.'%');
                $list_candidate_score = $list_candidate_score ->where('inte.in_tel','like','%'.$tel.'%');
            }
            if(!empty($mail)){
                $list_interviewers = $list_interviewers ->where('inter.in_mail','like','%'.$mail.'%');
                $list_candidate_score = $list_candidate_score ->where('inte.in_mail','like','%'.$mail.'%');
            }
            if(!empty($language)){
                $list_interviewers = $list_interviewers ->where('inter.in_language',$language);
                $list_candidate_score = $list_candidate_score ->where('inte.in_language',$language);
            }
            if(!empty($cv_channel)){
                $list_interviewers = $list_interviewers ->where('inter.in_cvchannel',$cv_channel);
                $list_candidate_score = $list_candidate_score ->where('inte.in_cvchannel',$cv_channel);
            }
            if(!empty($inid)){
                $list_interviewers = $list_interviewers ->where('inter.in_id','like','%'.$inid.'%');
                $list_candidate_score = $list_candidate_score ->where('inte.in_id','like','%'.$inid.'%');
            }
            if(!empty($status)){
                $list_interviewers = $list_interviewers ->where('inter.in_status',$status);
                $list_candidate_score = $list_candidate_score ->where('inte.in_status',$status);
            }
            if(!empty($date_from) || !empty($date_to)){
                $date_from = date_format(date_create($date_from),'Y-m-d 00:00:00');
                $date_to = date_format(date_create($date_to),'Y-m-d 23:59:59');
                $list_interviewers = $list_interviewers ->join('t_result as res', function($join) {
                    $join->on('inter.in_id', '=', 'res.candidate_id');
                });
                if(!empty($date_from)){
                    $list_interviewers = $list_interviewers ->where('res.date_created','>=',$date_from);
                    $list_candidate_score = $list_candidate_score ->where('re.date_created','>=',$date_from);
                }
                if(!empty($date_to)){
                    $list_interviewers = $list_interviewers->where('res.date_created','<=',$date_to);
                    $list_candidate_score = $list_candidate_score->where('re.date_created','<=',$date_to);
                }
            }
           // var_dump($list_candidate_score->toSql());die;
            $list_interviewers = $list_interviewers->orderBy('in_id', 'DESC')->paginate(10);


            $list_interviewers_count= $list_interviewers->count();
            $current_page = $list_interviewers->currentPage();
            //return view('pages.interview_management', compact('list_interviewers','list_interviewers_count','req_arr','cst_lang','cst_cvchannel','cst_status','current_page'));
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
                'in_id' => '',
                'in_status' => '',
                'date_from' => '',
                'date_to' => ''
            );
            // get all interviewer have del_flg = 0 and soft by update time
            $list_interviewers = InterviewManagerment::where('in_del_flg', 0)->orderBy('in_id', 'DESC')->paginate(10);
            $list_interviewers_count= $list_interviewers->count();
            $current_page = $list_interviewers->currentPage();
           // var_dump($list_candidate_score->toSql());die;

        }
        $list_candidate_score = $list_candidate_score->get();
        return view('pages.interview_management', compact('list_interviewers','list_interviewers_count','req_arr','cst_lang','cst_cvchannel','cst_status','current_page','currentTime','list_candidate_score'));


    }    

    public function getInterviewerNew() {
        $currentTime = Carbon::now()->format('yy/m/d');
        $cst_lang =config('constants.LANGUAGE');
        $cst_cvchannel = config('constants.CV_CHANNEL');
        $cst_status = config('constants.STATUS');
        $candidate = InterviewManagerment::orderBy('in_id','desc')->first();
        if(!empty($candidate)){
            $candidate_id = $candidate->in_id + 1;
        }else{
            $candidate_id = 1;
        }
        return view('pages.interviewer_new',compact('currentTime','cst_status','cst_cvchannel','cst_lang','candidate_id'));
    }

    public function postInterviewerNew(Request $request) {

        $rules = [
            'in_firstname'   => 'required',
            'in_lastname'   => 'required',
            'in_language'    => 'required',
            'in_salary' => 'nullable|numeric|digits_between:0,9',
            'in_mail' => 'nullable|email',
//            'in_tel' => 'nullable|regex:/(0)[0-9]{9}/',
            'in_tel' => 'nullable|regex:/(^[\+\x200-9])[\x200-9]{9,14}$/',
            'in_dob' => 'nullable|date_format:Y/m/d'
           // 'in_cvno' => 'required|unique:t_interviewmanagement,in_cvno'


        ];
        $custom_message = [
            'in_firstname.required'  => 'The first name field is required.',
            'in_lastname.required'  => 'The last name field is required.',
            'in_language.required'   => 'Please choose a progamming language.',
            'in_salary.numeric' => 'The salary must be a number.',
            'in_tel.regex' => 'The tel format is invalid.',
            'in_mail.email' => 'The mail must be a valid email address.',
//            'in_cvno.required' => 'The CV No. field is required.',
//            'in_cvno.unique' => 'The CV No. has already been taken.',
            'in_salary.digits_between' => 'The salary must be max 9 digits.',
            'in_dob.date_format' => 'The dob does not match the format yyyy/mm/dd.'
        ];
        $validator = \Validator::make($request->all(), $rules,$custom_message);
        $file_data_old = $request->get('temp_file_old');
        if($request->has('in_file')){
            $file_temp = $request->file('in_file');
            if(!empty($file_temp)){
                $new_tem_name = $file_temp->getClientOriginalName();
                $temp = $file_temp->move(public_path('cv_upload/temp'),$new_tem_name);
               // $tem_name = $request->get('temp_file');
                //          //var_dump($tem_name) ;die;
                if($new_tem_name!=$file_data_old && !empty($file_data_old)){
                    $path= public_path().'/cv_upload/temp/'.$file_data_old;
                   //Storage::delete(public_path().'/cv_upload/temp/'.$tem_name);
                    unlink($path);
                }
                $file_data_old = $new_tem_name;
            }
        }else{
            $file_data_new = $request->get('temp_file_new');
            if(!empty($file_data_old) && $file_data_new ==''){
                $path = public_path().'/cv_upload/temp/'.$file_data_old;
                unlink($path);
                $file_data_old = '';
            }
        }



        if ($validator->fails()) {
            return Redirect::back()->with('file_data_old',$file_data_old)->withInput()->withErrors($validator->errors());
        }



        // get current time
        $currentTime = Carbon::now();
        $new_file_name = '';
        if(!empty($file_data_old)){
            $source_file = public_path().'/cv_upload/temp/'.$file_data_old;
            $file_extension = explode('.',$file_data_old);
            $new_file_name = $request->get('in_id').'_'.$request->get('in_lastname').' '.$request->get('in_firstname').'.'.end($file_extension);
            $new_file_name = preg_replace('/\s+/', '', $new_file_name);
            $destination_path = public_path().'/cv_upload/'.$new_file_name;
            //var_dump($destination_path);die;
            if (copy($source_file,$destination_path)) {
                unlink($source_file);
            }
        }
//        $new_file_name = '';
//        if($request->has('in_file')){
//            $file = $request->in_file;
//            $new_file_name = $request->get('in_cvno').'_'.$request->get('in_lastname').'_'.$request->get('in_firstname').'.'.$file->getClientOriginalExtension();
//            $cv_file = $file->move(public_path('cv_upload'),$new_file_name);
//           // var_dump($new_file_name);die;
//        }
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
        'in_file'               => $new_file_name,
        'in_del_flg'          => 0,
        'in_datecreate'       => $currentTime,
        'in_update'           => $currentTime
        ]);
        $interviewer->save();
        if($request->has('continuos')){
            return redirect('interview-management/new')->with('success', 'Added candidate successfully!');
        }
        return redirect('interview-management')->with('success', 'Added candidate successfully!');
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

        $rules = [
            'in_firstname'   => 'required',
            'in_lastname'   => 'required',
            'in_language'    => 'required',
            'in_salary' => 'nullable|numeric|digits_between:0,9',
            'in_mail' => 'nullable|email',
//            'in_tel' => 'nullable|regex:/(0)[0-9]{9}/',
            'in_tel' => 'nullable|regex:/(^[\+\x200-9])[\x200-9]{9,14}$/',
            'in_dob' => 'nullable|date_format:Y/m/d'
//            'in_cvno'=>[
//                'required',
//                Rule::unique('t_interviewmanagement')->ignore($request->get('in_id'), 'in_id')
//            ],


        ];
        $custom_message = [
            'in_firstname.required'  => 'The first name field is required.',
            'in_lastname.required'  => 'The last name field is required.',
            'in_language.required'   => 'Please choose a progamming language.',
            'in_salary.numeric' => 'The salary must be a number.',
            'in_tel.regex' => 'The tel format is invalid.',
            'in_mail.email' => 'The mail must be a valid email address.',
//            'in_cvno.required' => 'The CV No. field is required.',
//            'in_cvno.unique' => 'The CV No. has already been taken.',
            'in_salary.digits_between' => 'The salary must be max 9 digits.',
            'in_dob.date_format' => 'The dob does not match the format yyyy/mm/dd.'
        ];

        $validator = \Validator::make($request->all(), $rules,$custom_message);
        $file_data_old = $request->get('temp_file_old');
        if($request->has('in_file')){
            $file_temp = $request->file('in_file');
            if(!empty($file_temp)){
                $new_tem_name = $file_temp->getClientOriginalName();
                $temp = $file_temp->move(public_path('cv_upload/temp'),$new_tem_name);
                // $tem_name = $request->get('temp_file');
                //          //var_dump($tem_name) ;die;
                if($new_tem_name!=$file_data_old && !empty($file_data_old)){
                    $path= public_path().'/cv_upload/temp/'.$file_data_old;
                    //Storage::delete(public_path().'/cv_upload/temp/'.$tem_name);
                    unlink($path);
                }
                $file_data_old = $new_tem_name;
            }
        }else{
            $file_data_new = $request->get('temp_file_new');
            if(!empty($file_data_old) && $file_data_new ==''){
                $path = public_path().'/cv_upload/temp/'.$file_data_old;
                unlink($path);
                $file_data_old = '';
            }
        }



        if ($validator->fails()) {
            return Redirect::back()->with('file_data_old',$file_data_old)->withInput()->withErrors($validator->errors());
        }

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

        $new_file_name = '';
        if(!empty($file_data_old)){
            $source_file = public_path().'/cv_upload/temp/'.$file_data_old;
            $file_extension = explode('.',$file_data_old);
            $new_file_name = $request->get('in_cvno').'_'.$request->get('in_lastname').' '.$request->get('in_firstname').'.'.end($file_extension);
            $new_file_name = preg_replace('/\s+/', '', $new_file_name);

            $destination_path = public_path().'/cv_upload/'.$new_file_name;
            //var_dump($destination_path);die;
            if (copy($source_file,$destination_path)) {
                unlink($source_file);
            }
            $interviewer->in_file      = $new_file_name;
        }
//        if($request->has('in_file_new') && !empty($request->in_file_new)){
//            $file = $request->in_file_new;
//            $new_file_name = $request->get('in_cvno').'_'.$request->get('in_lastname').'_'.$request->get('in_firstname').'.'.$file->getClientOriginalExtension();
//            $cv_file = $file->move(public_path('cv_upload'),$new_file_name);
//            $interviewer->in_file      = $new_file_name;
//        }
        $interviewer->in_update    = Carbon::now();
        $interviewer->save();
        return redirect('interview-management')->with('success', 'Updated candidate successfully!');
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
            return redirect('interview-management?page='.$lastPage)->with('success', 'Deleted candidate successfully!');
        }
        return redirect()->back()->with('success', 'Deleted candidate successfully!');
    }
}
