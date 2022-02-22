<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use Carbon\Carbon;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        //Date
        if($request->leaving_date == null)
        {
            $leavingDate = date('Y-m-d');
        }
        else
        {
            $leavingDate =  $request->leaving_date;
        }
        $to = Carbon::createFromFormat('Y-m-d', $request->joining_date);
        $from = Carbon::createFromFormat('Y-m-d', $leavingDate);
        
        $totalmonths = $to->diffInMonths($from);
        $years = $totalmonths / 12;
        $months = $totalmonths % 12;
        $experience = floor($years) ." Years ". $months. " Months";


        //Moving Image 
        $file = $request->file('avatar');
        $filename = $file->getClientOriginalName();
        $file->move(public_path('\images'),   $filename );

        //Insert
        $data = new Customers;
        $data->name             = $request->name;
        $data->email            = $request->email;
        $data->joining_date     = $request->joining_date;
        $data->leaving_date     = $leavingDate;
        $data->avatar           = $filename;
        $data->total_experience = $experience;

        $data->save();

        return redirect('/');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Customers::where('id',$id)->delete();
        return redirect('/');
    }
}
