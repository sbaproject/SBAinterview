<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InterviewManagerment;
use Excel;
use InfiniteIterator;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Session;
use Mail;
use Carbon\Carbon;

class AdminMEController extends Controller implements FromCollection, WithHeadings, WithEvents
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
            $date_from = $request->get('date_from');
            $date_to = $request->get('date_to');


            $req_arr = $request->all();

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
            if(!empty($cvno)){
                $list_interviewers = $list_interviewers ->where('inter.in_cvno','like','%'.$cvno.'%');
                $list_candidate_score = $list_candidate_score ->where('inte.in_cvno','like','%'.$cvno.'%');
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
            $list_interviewers = $list_interviewers->orderBy('in_id', 'DESC')->get();
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
                'in_cvno' => '',
                'in_status' => '',
                'date_from' => '',
                'date_to' => ''
            );
            // get all interviewer have del_flg = 0 and soft by update time
            $list_interviewers = InterviewManagerment::where('in_del_flg', 0)->orderBy('in_id', 'DESC')->get();

        }
        $list_candidate_score = $list_candidate_score->get();
        return view('pages.adminME', compact('list_interviewers','req_arr','cst_lang','cst_cvchannel','cst_status','currentTime','list_candidate_score'));

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
                'Salary '. PHP_EOL .'(VNĐ/USD)',
                'Mail',
                'Education',
                'Experience',
                'Language',
                'University',
                'Tel',
                'Address',
                'Status',
                'Interview',
                '',
                'Note',
                'Ky thuat, kinh nghiem lien quan',
                'tinh cach, to chat'
            ]
        ];
    }
    public function collection(){
        $cnt = 1;
        $data[] = [
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            'Time',
            'Date',
            '',
            '',
            '',
        ];
        foreach($this->rows as $item){
            $lang = config('constants.LANGUAGE');
            $status = config('constants.STATUS');
            $t = ($item->in_status != 0) ? $status[$item->in_status] : ''; 
            $data[] = [
                $cnt,
                $item->in_cvno,
                $item->in_firstname.' '.$item->in_lastname,
                $item->in_dob,
                $item->in_salary,
                $item->in_mail,
                $item->in_education,
                $item->in_experience,
                $lang[$item->in_language],
                $item->in_university,
                $item->in_tel,
                $item->in_address,
                $t,
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
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->mergeCells(sprintf('A1:A2'));
                $event->sheet->mergeCells(sprintf('B1:B2'));
                $event->sheet->mergeCells(sprintf('C1:C2'));
                $event->sheet->mergeCells(sprintf('D1:D2'));
                $event->sheet->mergeCells(sprintf('E1:E2'));
                $event->sheet->mergeCells(sprintf('F1:F2'));
                $event->sheet->mergeCells(sprintf('G1:G2'));
                $event->sheet->mergeCells(sprintf('H1:H2'));
                $event->sheet->mergeCells(sprintf('I1:I2'));
                $event->sheet->mergeCells(sprintf('J1:J2'));
                $event->sheet->mergeCells(sprintf('K1:K2'));
                $event->sheet->mergeCells(sprintf('L1:L2'));
                $event->sheet->mergeCells(sprintf('M1:M2'));
                $event->sheet->mergeCells(sprintf('N1:O1'));
                $event->sheet->mergeCells(sprintf('P1:P2'));
                $event->sheet->mergeCells(sprintf('Q1:Q2'));
                $event->sheet->mergeCells(sprintf('R1:R2'));
                //
                // assign cell styles
                $event->sheet->getStyle('A1:R2')->applyFromArray([
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                    ],
                    'font' => [
                        'name' => 'Times New Roman',
                        'size' => 13
                    ]
                ]);
                $styleArray  = [
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ];
                $event->sheet->getStyle('A1:A2')->applyFromArray($styleArray);
                $event->sheet->getStyle('B1:B2')->applyFromArray($styleArray);
                $event->sheet->getStyle('C1:C2')->applyFromArray($styleArray);
                $event->sheet->getStyle('D1:D2')->applyFromArray($styleArray);
                $event->sheet->getStyle('E1:E2')->applyFromArray($styleArray);
                $event->sheet->getStyle('F1:F2')->applyFromArray($styleArray);
                $event->sheet->getStyle('G1:G2')->applyFromArray($styleArray);
                $event->sheet->getStyle('H1:H2')->applyFromArray($styleArray);
                $event->sheet->getStyle('I1:I2')->applyFromArray($styleArray);
                $event->sheet->getStyle('J1:J2')->applyFromArray($styleArray);
                $event->sheet->getStyle('K1:K2')->applyFromArray($styleArray);
                $event->sheet->getStyle('L1:L2')->applyFromArray($styleArray);
                $event->sheet->getStyle('M1:M2')->applyFromArray($styleArray);
                $event->sheet->getStyle('N1')->applyFromArray($styleArray);
                $event->sheet->getStyle('O1')->applyFromArray($styleArray);
                $event->sheet->getStyle('N1:N2')->applyFromArray($styleArray);
                $event->sheet->getStyle('O1:O2')->applyFromArray($styleArray);
                $event->sheet->getStyle('P1:P2')->applyFromArray($styleArray);
                $event->sheet->getStyle('Q1:Q2')->applyFromArray($styleArray);
                $event->sheet->getStyle('R1:R2')->applyFromArray($styleArray);

                $event->sheet->getColumnDimension('A')->setWidth(15);
                $event->sheet->getColumnDimension('B')->setWidth(15);
                $event->sheet->getColumnDimension('C')->setWidth(30);
                $event->sheet->getColumnDimension('D')->setWidth(15);
                $event->sheet->getColumnDimension('E')->setWidth(20);
                $event->sheet->getColumnDimension('F')->setWidth(30);
                $event->sheet->getColumnDimension('G')->setWidth(30);
                $event->sheet->getColumnDimension('H')->setWidth(30);
                $event->sheet->getColumnDimension('I')->setWidth(15);
                $event->sheet->getColumnDimension('J')->setWidth(30);
                $event->sheet->getColumnDimension('K')->setWidth(30);
                $event->sheet->getColumnDimension('L')->setWidth(30);
                $event->sheet->getColumnDimension('M')->setWidth(30);
                $event->sheet->getColumnDimension('N')->setWidth(30);
                $event->sheet->getColumnDimension('O')->setWidth(30);
                $event->sheet->getColumnDimension('P')->setWidth(30);
                $event->sheet->getColumnDimension('Q')->setWidth(30);
                $event->sheet->getColumnDimension('R')->setWidth(30);
            },
        ];
    }
    /**
     * 
     * 
     * 
     * **/
    public function postadminSentMail(Request $request){
        if($request->seletitem){
            $arr = explode(',', $request->seletitem);
            if($request->export){
                $now = Carbon::now();

                $rows = InterviewManagerment::whereIn('in_id', $arr)->get();
                $export = new AdminMEController();
                $export->rows = $rows;
                return Excel::download($export, 'Candidate'.$now .'.xlsx');
            }
            if($request->sent){
                $mails = '';
                $list = InterviewManagerment::whereIn('in_id', $arr)->get();
                $cnt = 0;
                foreach($list as $key => $item){
                    if($cnt == 0){
                        if($item->in_mail != ""){
                            $mails .= $item->in_mail;
                            $cnt++;
                        }                        
                    }else{
                        if($item->in_mail != ""){
                            $mails .= ',' . "\n" . $item->in_mail;
                        }
                    }
                }
                $content = "<strong>Dear [firstname]</strong>, <br/><br/>We were impressed by your background on website [in_cvchannel] and would like to invite you to come to our office for the interview as the following:<br/> Time/ Date: [time] on  [date]<br/> Venue:  StarboardAsia Company <br/><br/>Room 2.2B, 2nd floor QTSC 1, No. 14 Str., Quang Trung software city, Tan Chanh Hiep Ward, District 12, Ho Chi Minh City <br/><strong>Tel:</strong> (+84)-28-3715-4544 <br/><strong>Website:</strong>  http://www.starboardasia.com   <br/><br/>We have enclosed the company profile as attached file. <br/>Please help to reply for confirmation through this email. <br/>Should you have any question regarding to this appointment, please do not hesitate to contact us. <br/>Thanks & best regards, <br/><br/> <strong>Phuong Nhi</strong><br/>";
                return view('pages.adminMailPage', compact('mails','content'));
            }
        }else{
            return \Redirect::back()->withErrors(['Please choose a candilate.']);
        }   
    }
    /**
     * 
     * Sent mail list
     * 
     * **/
    public function sendMail(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'mails' => 'required'
        ]);
        $textarea = trim(preg_replace('/\s\s+/', '', $request->mails));
        $mails = explode(',', $textarea);
        $mailcc = '';
        if($request->mailcc){
            $mailcc = explode(',', $request->mailcc);
        }
        $candi = InterviewManagerment::whereIn('in_mail', $mails)->get();

        foreach($candi as $item){
            $iq_find = [
                '[firstname]',
                '[in_cvchannel]',
                '[time]',
                '[date]'
            ];
            $firstname = $item->in_firstname;

            $times = $item->in_time;
            $times = explode(':',$times);
            $time = $times[0].':'.$times[1];
            $cvchannel = "";
            if($item->in_cvchannel != "" || $item->in_cvchannel != 0){
                $cvchannel = config('constants.CV_CHANNEL')[$item->in_cvchannel];
            }
            $date = Carbon::parse($item->in_date);
            $date = $date->isoFormat('dddd Do MMMM, YYYY');
            
            $iq_replace = [
                $firstname,
                $cvchannel,
                $time,
                $date
            ];

            $details = str_replace($iq_find, $iq_replace, $request->content);
            $file = ($item->in_file) ? \URL::to('/public/cv_upload/'.$item->in_file) : "";
            if($file != ""){
                $tempImage = public_path().'/cv_upload/'.$item->in_file;
            }
            Mail::send('Mail', [
                'title' => $request->title,
                'details' => $details,
            ], function ($message) use ($request, $item, $mailcc, $file, $tempImage) {
                $message->from(env('NO_REPLAY_EMAIL', 'noreplay.mlt@gmail.com'), $request->title);
                $message->to($item->in_mail);
                if($mailcc != ""){
                    $message->cc($mailcc);
                }
                if($file != ""){
                    $message->attach($tempImage);
                }
                $message->replyTo('noreplay.mlt@gmail.com', $request->title);
                $message->subject($request->title);

            });
        }
        return redirect()->route('adminME')->with('doneMessage', 'Successful!');
    }
}
