<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InterviewManagerment;
use Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Session;

class AdminMEController extends Controller implements FromCollection, WithHeadings
{
    use Exportable;
    public $rows = [];
    //

    public function index(Request $request){
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
        if($request->submit){
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
            return view('pages.adminME', compact('list_interviewers','list_interviewers_count','req_arr','cst_lang','cst_cvchannel','cst_status','current_page'));
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
            $list_interviewers = InterviewManagerment::where('in_del_flg', 0)->orderBy('in_id', 'DESC')->get();
            $list_interviewers_count= $list_interviewers->count();
            return view('pages.adminME', compact('list_interviewers','list_interviewers_count','req_arr','cst_lang','cst_cvchannel','cst_status','current_page'));
        }
    }
    /**
     * 
     * 
     * Sent mail multi
     * 
     * **/
    public function headings(): array
    {
        return [
            [
                'No.',
                'CV No.',
                'Name',
                'DOB',
                'Salary (VNĐ/USD)',
                'Mail',
                'Education',
                'Experience',
                'Language',
                'University',
                'Tel',
                'Address',
                'Status',
                'Interview Time',
                'Interview Date',
                'Note',
                'Ky thuat, kinh nghiem lien quan',
                'tinh cach, to chat'
            ]
        ];
    }
    public function collection(){
        $cnt = 1;
        foreach($this->rows as $item){
            $data[] = [
                $cnt,
                $item->in_cvno,
                $item->in_firstname.' '.$item->in_lastname,
                $item->in_dob,
                $item->in_salary,
                $item->in_mail,
                $item->in_education,
                $item->in_experience,
                $item->in_language,
                $item->in_university,
                $item->in_tel,
                $item->in_address,
                $item->in_status,
                $item->in_time,
                $item->in_date,
                $item->in_note,
                $item->in_extraskill,
                $item->in_personality
            ];
            $cnt++;
        }
        return collect($data);
    }
    public function postadminSentMail(Request $request){
        
        if($request->seletitem){
            if($request->export){
                $arr = explode(',', $request->seletitem);
                $rows = InterviewManagerment::whereIn('in_id', $arr)->get();
                $export = new AdminMEController();
                $export->rows = $rows;
                return Excel::download($export, 'testexcel.csv');
            }
        }else{
            return \Redirect::back()->withErrors(['Please choose a candilate.']);
        }
        
    }
}
