<?php

namespace App\Http\Controllers;

use App\Models\employee;
use App\Models\company;
use App\Http\Requests\StoreemployeeRequest;
use App\Http\Requests\UpdateemployeeRequest;
use Illuminate\Support\Collection;
use Session;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $data = employee::all();
        return view ('employee.index')->with([
            'data'=>$data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = company::all();
       
        return view ('employee.create')->with([
            'data'=>$data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreemployeeRequest $request)
    {
        $this->validate($request,[
        'fname'=>'required',
        'lname'=>'required',
        ]);

        
        $data = new employee;
        $data->fname=$request->fname;
        $data->lname=$request->lname;
        $data->company=$request->company;
        $data->email=$request->email;
        $data->phone=$request->phone;

        $data->save();

        Session::flash('success', 'A New Employee has been added!');
        return redirect('/employee');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {   
        $com = company::all();
        $data = employee::where('id',$id)->get();
        return view('employee.edit')->with([
            'data' => $data,
            'com' => $com,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(employee $employee)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateemployeeRequest $request, $id)
    {
        $this->validate($request,[
            'fname'=>'required',
            'lname'=>'required',
            'phone'=>['regex:/^(\+?63|0)9\d{9}$/'],
            ]);
    
            
            $data = employee::where('id',$id)->first();
            $data->fname=$request->fname;
            $data->lname=$request->lname;
            $data->company=$request->company;
            $data->email=$request->email;
            $data->phone=$request->phone;
    
            $data->save();
            Session::flash('success', 'Employee Has Been Edited!');
            return redirect('/employee');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $del = employee::where('id',$id)->first();
        $del->delete();
        Session::flash('error', 'Employee Has Been Removed');
        return redirect('/employee');
    }
}
