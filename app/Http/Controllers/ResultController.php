<?php

namespace App\Http\Controllers;

use App\IqQuestion;
use App\IqQuestionOption;
use App\Result;
use Illuminate\Http\Request;
use Carbon\Carbon;
use League\Flysystem\Config;
use Session;
use config\constants;


class ResultController extends Controller
{
    public function index(Request $request) {
        $userLogged = Session::get('user');
        if ($userLogged == null) {
            return redirect('/login');
        }

            // get all interviewer have del_flg = 0 and soft by update time
            $req_arr = array(
                'candidate_firstname' => '',
                'candidate_lastname' => '',
                'candidate_address' => '',
                'candidate_dob' => '',
                'candidate_tel' => '',
                'candidate_mail' => '',
                'candidate_language' => ''
            );
            $cst_lang = config('constants.LANGUAGE');
            $req_search = $request->all();
        if(!empty($req_search)){
                $validator = $request->validate([
                    'candidate_tel' => 'nullable|regex:/(0)[0-9]{9}/',
                    'candidate_mail'    => 'nullable|email',

                ]);


                $first_name = $request->get('candidate_firstname');
                $last_name = $request->get('candidate_lastname');
                $address = $request->get('candidate_address');
                $dob = $request->get('candidate_dob');
                $tel = $request->get('candidate_tel');
                $mail = $request->get('candidate_mail');
                $language = $request->get('candidate_language');

                $req_arr = array(
                    'candidate_firstname' => $first_name,
                    'candidate_lastname' => $last_name,
                    'candidate_address' => $address,
                    'candidate_dob' =>$dob,
                    'candidate_tel' => $tel,
                    'candidate_mail' => $mail,
                    'candidate_language' => $language
                );

               // $req_arr = $request->all();

                $list_result =  new Result();
                if(!empty($first_name)){
                    $list_result = $list_result ->where('candidate_firstname','like','%'.$first_name.'%');
                }
                if(!empty($last_name)){
                    $list_result = $list_result ->where('candidate_lastname','like','%'.$last_name.'%');
                }
                if(!empty($address)){
                    $list_result = $list_result ->where('candidate_address','like','%'.$address.'%');
                }
                if(!empty($dob)){
                    $list_result = $list_result ->where('candidate_dob','like','%'.$dob.'%');
                }
                if(!empty($tel)){
                    $list_result = $list_result ->where('candidate_tel','like','%'.$tel.'%');
                }
                if(!empty($mail)){
                    $list_result = $list_result ->where('candidate_mail','like','%'.$mail.'%');
                }
                if(!empty($language)){
                    $list_result = $list_result ->where('candidate_language',$language);
                }


                $list_result = $list_result->orderBy('id', 'DESC')->paginate(10);
                $list_result_count= $list_result->count();
                return view('pages.result_list', compact('list_result','list_result_count','cst_lang','req_arr'));
            }else{
                $list_result = Result::orderBy('id', 'DESC')->paginate(10);

                $list_result_count= $list_result->count();

                return view('pages.result_list', compact('list_result','list_result_count','cst_lang','req_arr'));
            }

        }





}
