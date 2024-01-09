<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\PlotType;
use App\Category;
use App\Plot;
use App\Building;
use App\Room;
use App\WallType;

use Illuminate\Http\Request;
use DB;
use Auth;

class WallTypeController extends Controller
{
    public function index(Request $request){
        
        if($request->id){
            $getSwalltype = DB::table('wall_types')
            ->where('wall_type_id', '=',$request->id)
            ->get();
            return response()->json($getSwalltype);
        }else{
          $data =   WallType::all();
           return view('admin.types.wallType',compact('data'));
    
        }
        	
    }

    public function addWallType(Request $request){
        $this->validate($request, [
            'wall_type' => 'required',
        ]);

        $input = $request->all();
        // $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];

        WallType::create($input);
        return back()->with('message', 'New Type added successfully.');
    }

    public function update(Request $request)
    {

        // dd($request);
          $walltypeId = WallType::find($request->wall_typeID);
          
          $walltypeId->wall_type = $request->wall_type_value;   
         
          $walltypeId->save();

        return redirect()->action([WallTypeController::class, 'index']);

    }

    public function delete(Request $request)
    {
        
        // dd($request->id);
        // $this->request->delete($id);
        $WallType = WallType::find($request->delete_id);
        if($WallType){
            $WallType->delete();
            return back()->with('message', 'Type deleted  successfully.');
        }else{
            return back()->with('message', 'Type Not Found.');
        }
        // return redirect()->route('admin.auth.user.deleted');
    }
}
