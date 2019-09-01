<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DynamicDependent extends Controller
{
    //
    function index(){
        $country_list=DB::table('kraju_wojeowda_miasto')
            ->groupBy('kraju')
            ->get();
        return view('dynamic_dependent')->with('country_list',$country_list);
    }
    function fetch(Request $request){

        $select=$request->get('select');
        $value=$request->get('value');
        $dependent=$request->get('dependent');
        $data=DB::table('kraju_wojeowda_miasto')
            ->where($select,$value)
            ->groupBy($dependent)
            ->get();
        $output='<option value="">Select '.ucfirst($dependent).'</option>';
        foreach ($data as $row) {
            $output.='<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
        }
        echo $output;
    }
}
