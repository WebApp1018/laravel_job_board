<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\PlotType;
use App\Category;
use App\Plot;
use App\Building;
use App\Room;
use App\FloorType;

use Illuminate\Http\Request;
use DB;
use Auth;

class FloorTypeController extends Controller
{
    public function index(Request $request){
        
        if($request->id){
            $getSfloortype = DB::table('floor_types')
            ->where('id', '=',$request->id)
            ->get();
            return response()->json($getSfloortype);
        }else{
            $data =   FloorType::all();
           return view('admin.types.floorType',compact('data'));
        }
        	
    }

    public function addFloorType(Request $request){
        $this->validate($request, [
            'floor_type' => 'required',
        ]);

        $input = $request->all();
        // $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];

        FloorType::create($input);
        return back()->with('message', 'New Type added successfully.');
    }

    public function update(Request $request)
    {
        // dd($request);
          $floortypeId = FloorType::find($request->floor_typeID);
          $floortypeId->floor_type = $request->floor_type_value;   
          $floortypeId->save();

        return redirect()->action([FloorTypeController::class, 'index']);

    }
    
    public function delete(Request $request)
    {
        // dd($request->id);
        // $this->request->delete($id);
        $floorType = FloorType::find($request->delete_id);
        if($floorType){
            $floorType->delete();
            return back()->with('message', 'Type deleted  successfully.');
        }else{
            return back()->with('message', 'Type Not Found.');
        }
        // return redirect()->route('admin.auth.user.deleted');
    }

}
