<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(){
        $list = Report::all();
        return view('dashboard.reports.list', compact('list'));
    }
    public function edit($id){
        $id = decrypt($id);
        $data = Report::find($id);
        return view('dashboard.reports.form', compact('data'));
    }
    public function update(Request $request, $id){
        $id = decrypt($id);
        $request->flash();
        if(empty($request->status)){
            $status = 0;
        }else{
            $status = 1;
        }
        Report::where('id', $id)->update([
            'status' => $status
        ]);
        return redirect()->route('ReportList')->with('success', 'Report updated successfuly');
    }
}
