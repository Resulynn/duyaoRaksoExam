<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\company;
use App\Http\Requests\StorecompanyRequest;
use App\Http\Requests\UpdatecompanyRequest;
use Session;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = company::all();
        return view ('company.index')->with([
            'data'=> $data,
        ]);

    
        // return Http::get('https://raw.githubusercontent.com/dariusk/corpora/master/data/corporations/fortune500.json')['companies'];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecompanyRequest $request)
    {
        $this->validate($request,[
            'logo'=>'dimensions:min_width=100,min_height=100',
            'name'=>'required',
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('company_logos'), $filename);
            $data->logo="/company_logos/".$filename;
        }

        $data = new company;
        $data->name=$request->name;
        $data->email=$request->email;
        $data->website=$request->url;

        Session::put('name', $request->name);

        $data->save();

        return redirect("/notif");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = company::where('id',$id)->get();
        return view ('company.edit')->with([
            'data'=> $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecompanyRequest $request, $id)
    {
        try{
            $this->validate($request,[
                'logo'=>'dimensions:min_width=100,min_height=100',
                'name'=>'required',
            ]);
            $data = company::where('id',$id)->first();
    
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $filename = $file->getClientOriginalName();
                $file->move(public_path('company_logos'), $filename);
                $data->logo="/company_logos/".$filename;
            }
           
            
            $data->name=$request->name;
            $data->email=$request->email;
            $data->website=$request->url;
            $data->save();
    
            Session::flash('success', 'Company Has Been Updated.');
            return redirect("/company");
        }
        catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->getCode();
            $errorMessage = $e->getMessage();
            Session::flash('error', $errorMessage);
            return redirect('/company');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $del = company::where('id',$id)->first();
            $del->delete();
            Session::flash('error', 'A Company Has Been Removed.');
            return redirect('/company');
        }
        catch(\Illuminate\Database\QueryException $e) {
            $errorCode = $e->getCode();
            $errorMessage = $e->getMessage();
            Session::flash('error', $errorMessage);
            return redirect('/company');
        }
    }
    
    public function import(){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://raw.githubusercontent.com/dariusk/corpora/master/data/corporations/fortune500.json');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_response = curl_exec($ch);

        curl_close($ch);

        $data = json_decode($server_response);
    
        try{
            foreach($data->companies as $name){
                $save = new company;
                $save->name=$name;
                $save->save();
            }
        }
        catch(\Illuminate\Database\QueryException $e) {
            $errorCode = $e->getCode();
            $errorMessage = $e->getMessage();
            Session::flash('error', $errorMessage);
            return redirect('/company');
        }
        
        Session::flash('success', '500 companies have been imported from cURL');
       return redirect('/company');

    }
}
