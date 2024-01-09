<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\PlotType;
use App\Category;
use App\Plot;
use App\Building;
use App\Room;
use App\RailingType;

use Illuminate\Http\Request;
use DB;
use Auth;

class RailingTypeController extends Controller
{
    public function index(Request $request){
        
        if($request->id){
            $getSrailingtype = DB::table('railing_types')
            ->where('id', '=',$request->id)
            ->get();
            return response()->json($getSrailingtype);
        }else{
          $data =   RailingType::all();
           return view('admin.types.railingType',compact('data'));
    
        }
        	
    }

    public function addRailingType(Request $request){
        $this->validate($request, [
            'railing_type' => 'required',
        ]);

        $input = $request->all();
        // $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];

        RailingType::create($input);
        return back()->with('message', 'New Type added successfully.');
    }

    public function update(Request $request)
    {

        // dd($request);
          $railingtypeId = RailingType::find($request->railing_typeID);
          
          $railingtypeId->railing_type = $request->railing_type_value;   
         
          $railingtypeId->save();

        return redirect()->action([RailingTypeController::class, 'index']);

    }

    public function delete(Request $request)
    {
        
        // dd($request->id);
        // $this->request->delete($id);
        $railingType = RailingType::find($request->delete_id);
        if($railingType){
            $railingType->delete();
            return back()->with('message', 'Type deleted  successfully.');
        }else{
            return back()->with('message', 'Type Not Found.');
        }
        // return redirect()->route('admin.auth.user.deleted');
    }
}
