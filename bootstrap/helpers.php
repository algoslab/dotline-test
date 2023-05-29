<?php 


use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


function action_buttons($item_id, $buttons=[]){
    $delete = '<a href="#" data-item_id="'.$item_id.'" onclick="item_delete('.$item_id.')" class="btn btn-danger btn-circle btn-sm ml-1" title="delete item"><i class="fas fa-trash"></i></a>';
    $edit   = '<a href="#" data-item_id="'.$item_id.'" onclick="item_edit('.$item_id.')" class="btn btn-info btn-circle btn-sm ml-1" title="Edit item"><i class="fas fa-edit"></i></a>';
    $view   = '<a href="#" data-item_id="'.$item_id.'" onclick="item_view('.$item_id.')" class="btn btn-success btn-circle btn-sm ml-1" title="View item"><i class="fas fa-eye"></i></a>';
    $print  = '<a href="#" data-item_id="'.$item_id.'" onclick="item_print('.$item_id.')" class="btn btn-warning btn-circle btn-sm ml-1" title="Print item"><i class="fas fa-print"></i></a>';
    $create = '<a href="#" data-item_id="'.$item_id.'" onclick="item_create('.$item_id.')" class="btn btn-primary btn-circle btn-sm ml-1" title="Create item"><i class="fas fa-plus"></i></a>';
    $buttons_array = [
                        'delete' => $delete, 'edit' => $edit, 'view' => $view, 
                        'print' => $print, 'create' => $create
                    ];
    $output_buttons = '';
    foreach($buttons as $button){
        $output_buttons .= !empty($buttons_array[$button]) ? $buttons_array[$button] : '';
    }
    return $output_buttons;
    
}

function single_file_upload($file, $directory, $optional_string=null){
    if(!empty($optional_string)){
        $original_name = $optional_string;
    }else{
        $original_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
    }
    
    $name = str_replace(" ","-",$original_name);
    $ext = $file->getClientOriginalExtension();
    $filename = $name.'-'.time().'.'.$ext;

    $dest = storage_path('app/public/').$directory.'/';
    $file->move($dest, $filename);

    $save_path = '/'.$directory.'/'.$filename;
    return $save_path;
}

function remove_file($file_path){
    if(file_exists($file_path)){
        unlink($file_path);
    }
}

function checkbox_status($status){
    if($status == 1){
        $status = 1;
    }else{
        $status = 0;
    }
    return $status;
}

function report_status($num){
    if($num == 0){
        $status = "<span class='badge badge-info'>Pending</span>";
    }elseif($num == 1){
        $status = "<span class='badge badge-primary'>Completed</span>";
    }elseif($num == 2){
        $status = "<span class='badge badge-success'>Delivered</span>";
    }else{
        $status = "<span class='badge badge-danger'>Error!</span>"; 
    }
    return $status;
}

function unique_identity($length){
    return Str::random($length);
}

function identify_gender($gender){
    if($gender == 1){
        return "Male";
    }else{
        return "Female";
    }
}

function entry_type($entry_type){
    if($entry_type ==1){
        $html = "<span class='badge badge-primary'>Income</span>";
    }elseif($entry_type ==2){
        $html = "<span class='badge badge-warning'>Expense</span>";
    }else{
        $html = "<span class='badge badge-danger'>Error!</span>";;
    }
    return $html;
}

function last_nth_year_month($nth){
    //This function works perfect considering if the last month is last year's december.
    $year_month = date('Y-m-d', strtotime("-$nth month"));
    $last_year = date('Y', strtotime($year_month));
    $last_month = date('m', strtotime($year_month));
    return [$last_year, $last_month];
}