<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Suggestion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SuggestionController extends Controller
{
    public function index(){
        $list = Suggestion::all();
        return view('dashboard.suggestions.list', compact('list'));
    }
    public function edit($id){
        $id = decrypt($id);
        $data = Suggestion::find($id);
        return view('dashboard.suggestions.form', compact('data'));
    }
    public function update(Request $request, $id){
        $id = decrypt($id);
        $request->flash();
        if(empty($request->status)){
            $status = 0;
        }else{
            $status = 1;
        }
        Suggestion::where('id', $id)->update([
            'status' => $status
        ]);
        return redirect()->route('SuggestionList')->with('success', 'Suggestion updated successfuly');
    }
}
