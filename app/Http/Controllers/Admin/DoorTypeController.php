<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\PlotType;
use App\Category;
use App\Plot;
use App\Building;
use App\Room;
use App\DoorType;

use Illuminate\Http\Request;
use DB;
use Auth;

class DoorTypeController extends Controller
{
    public function index(Request $request){
        
        if($request->id){
            $getDoortype = DB::table('door_types')
            ->where('id', '=',$request->id)
            ->get();
            return response()->json($getDoortype);
        }else{
          $data =   DoorType::all();
           return view('admin.types.doorType',compact('data'));
    
        }
        	
    }

    public function adddoorType(Request $request){
        $this->validate($request, [
            'door_type' => 'required',
        ]);

        $input = $request->all();
        // $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];

        DoorType::create($input);
        return back()->with('message', 'New Type added successfully.');
    }

    public function update(Request $request)
    {

        // dd($request);
          $doortypeId = DoorType::find($request->door_typeID);
          
          $doortypeId->door_type = $request->door_type_value;   
         
          $doortypeId->save();

        return redirect()->action([DoorTypeController::class, 'index']);

    }

    public function delete(Request $request)
    {
        // dd($request->id);
        // $this->request->delete($id);
        $doorType = DoorType::find($request->delete_id);
        if($doorType){
            $doorType->delete();
            return back()->with('message', 'Type deleted  successfully.');
        }else{
            return back()->with('message', 'Type Not Found.');
        }
    }
}
