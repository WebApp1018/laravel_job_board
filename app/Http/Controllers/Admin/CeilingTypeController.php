<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\PlotType;
use App\Category;
use App\Plot;
use App\Building;
use App\Room;
use App\WallType;
use App\CeilingType;

use Illuminate\Http\Request;
use DB;
use Auth;

class CeilingTypeController extends Controller
{
    public function index(Request $request){
        
        if($request->id){
            $getSwalltype = DB::table('ceiling_types')
            ->where('id ', '=',$request->id)
            ->get();
            return response()->json($getSwalltype);
        }else{
          $data =   CeilingType::all();
           return view('admin.types.ceilingType',compact('data'));
    
        }
        	
    }

    
    public function addCeilingType(Request $request){
        $this->validate($request, [
            'ceiling_type' => 'required',
        ]);

        $input = $request->all();
        // $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];

        CeilingType::create($input);
        return back()->with('message', 'New Type added successfully.');
    }

    public function update(Request $request)
    {

        // dd($request);
          $ceilingtypeId = CeilingType::find($request->ceiling_typeID);
          
          $ceilingtypeId->ceiling_type = $request->ceiling_type_value;   
         
          $ceilingtypeId->save();

        return redirect()->action([CeilingTypeController::class, 'index']);

    }

    public function delete(Request $request)
    {
        
        // dd($request->id);
        // $this->request->delete($id);
        $ceilingType = CeilingType::find($request->delete_id);
        if($ceilingType){
            $ceilingType->delete();
            return back()->with('message', 'Type deleted  successfully.');
        }else{
            return back()->with('message', 'Type Not Found.');
        }
        // return redirect()->route('admin.auth.user.deleted');
    }
}
