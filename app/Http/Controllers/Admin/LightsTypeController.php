<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\PlotType;
use App\Category;
use App\Plot;
use App\Building;
use App\Room;
use App\LightsType;

use Illuminate\Http\Request;
use DB;
use Auth;

class LightsTypeController extends Controller
{
    public function index(Request $request){
        
        if($request->id){
            $getSwalltype = DB::table('lights_types')
            ->where('id', '=',$request->id)
            ->get();
            return response()->json($getSwalltype);
        }else{
          $data =   LightsType::all();
           return view('admin.types.lightsType',compact('data'));
    
        }
        	
    }

    public function addLightsType(Request $request){
        $this->validate($request, [
            'lights_type' => 'required',
        ]);

        $input = $request->all();
        // $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];

        LightsType::create($input);
        return back()->with('message', 'New Type added successfully.');
    }

    public function update(Request $request)
    {

        // dd($request);
          $lightstypeId = LightsType::find($request->lights_typeID);
          
          $lightstypeId->lights_type = $request->lights_type_value;   
         
          $lightstypeId->save();

        return redirect()->action([LightsTypeController::class, 'index']);

    }

    public function delete(Request $request)
    {
        
        // dd($request->id);
        // $this->request->delete($id);
        $lightsType = LightsType::find($request->delete_id);
        if($lightsType){
            $lightsType->delete();
            return back()->with('message', 'Type deleted  successfully.');
        }else{
            return back()->with('message', 'Type Not Found.');
        }
        // return redirect()->route('admin.auth.user.deleted');
    }
}
