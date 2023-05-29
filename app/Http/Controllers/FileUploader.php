<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\Datatables\Datatables;
use Validator;
use App\Models\Datam;

class FileUploader extends Controller
{
    public function index(){
        return view("admin.dashboard.dashboard");
    }

    public function data_form_submit(Request $request){
        $request->validate([
            'input_file' => ['required', 'file', 'mimes:csv,txt']
        ]);

        $tmp_name = $_FILES['input_file']['tmp_name']; 
        $csv_as_array = array_map('str_getcsv', file($tmp_name));
        $total_data = count($csv_as_array);

        $filter_email_duplicates = $this->filter_duplicates($csv_as_array, 1); //1 for email
        $filter_duplicates = $this->filter_duplicates($filter_email_duplicates[0], 2); //2 for phone_number
        $duplicates_array = array_merge($filter_email_duplicates[1], $filter_duplicates[1]);

        
        $total_successful_uploaded = 0;
        $total_duplicate = count($duplicates_array);
        $total_invalid = 0;
        $total_incomplete = 0;

        
        foreach($filter_duplicates[0] as $csv_array){
            $data = ['name' => $csv_array[0], 'email' => $csv_array[1], 'phone_number' => $csv_array[2], 'gender' => strtolower($csv_array[3]), 'address' => $csv_array[4]];
            $validator = Validator::make($data, [
                'name' => ['required'],
                'email' => ['required', 'email', 'unique:datams'],
                'phone_number' => ['required', 'regex:/(^(\+8801|8801|01|008801))[1|3-9]{1}(\d){8}$/'],
                'gender' => ['required', Rule::in(['male', 'female'])],
                'address' => ['required', 'max:255']
            ]);

            if($validator->fails()){
                $is_incomplete = false;
                foreach($csv_array as $cell_data){
                    if(empty($cell_data)){
                        $total_incomplete += 1;
                        $is_incomplete = true;
                        break;
                    }
                }
                if(!$is_incomplete){
                    $total_invalid += 1;
                }
            }else{
                //Insert to db
                Datam::create($validator->validated());
                $total_successful_uploaded += 1;
            }
        }

        return json_encode([
                'total_data' => $total_data, 
                'total_successful_uploaded' => $total_successful_uploaded,
                'total_duplicate' => $total_duplicate,
                'total_invalid' => $total_invalid,
                'total_incomplete' => $total_incomplete
                ]);
        

    }

    public function data_datatable(){
        $model = Datam::orderBy('id', 'desc');
        return  DataTables::of($model)
                ->escapeColumns([])
                ->toJson();
    }

    public function sample_file_download(){
        //return response()->download(public_path('sample.csv'));
        return response()->download(public_path('sample.csv'));
    }

    public function filter_duplicates($array,$keyname){

        $unique_array = array();
        $duplicate_array  = array();
        foreach($array as $key=>$value){
       
          if(!isset($unique_array[$value[$keyname]])){
            $unique_array[$value[$keyname]] = $value;
          }else{
            $duplicate_array[$value[$keyname]] = $value;
          }
       
        }
        $unique_array = array_values($unique_array);
        $duplicate_array = array_values($duplicate_array);
        return [$unique_array, $duplicate_array];
    }
}
