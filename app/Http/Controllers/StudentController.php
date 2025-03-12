<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index(){
        $data = DB::table('students')
        ->leftJoin('country','country.id','=','students.country_id')
        ->select('students.*','country.country')
        ->get();
        return view('pages/page1',compact('data'));
    }

    public function add_student_form(){
        $country = DB::table('country')
        ->get();
        return view('pages/add-student',compact('country'));
    }

    public function do_insert(Request $request){
        $request->validate([
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'country_id' => 'required',
            'birthdate' => 'required',   
        ]);

        $query = DB::table('students')
        ->insert([
            'country_id' => $request->input('country_id'),
            'firstname' => $request->input('firstname'),
            'middlename' => $request->input('middlename'),
            'lastname' => $request->input('lastname'),
            'birthdate' => $request->input('birthdate'),
        ]);

        if($query)
        {
            return redirect(url('/page1'))->with('success','Add data successful');
        }


    }

    public function edit_student_form($id){
        $data = DB::table('students')->where('id',$id)->get();
        $country = DB::table('country')->get();
        return view('pages/edit-student',compact('country','data'));
    }

    public function do_delete($id){
        $query = DB::table('students')
        ->where('id',$id)
        ->delete();

        if($query)
        {
            return redirect(url('/page1'))->with('success','Delete data successfully');
        }
    }


    public function do_update(Request $request){
        $request->validate([
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'country_id' => 'required',
            'birthdate' => 'required',   
        ]);

        $query = DB::table('students')
        ->where('id', $request->input('id'))
        ->update([
            'country_id' => $request->input('country_id'),
            'firstname' => $request->input('firstname'),
            'middlename' => $request->input('middlename'),
            'lastname' => $request->input('lastname'),
            'birthdate' => $request->input('birthdate'),
        ]);

        if($query)
        {
            return redirect(url('/page1'))->with('success','Update data successfully');
        }


    }

}
