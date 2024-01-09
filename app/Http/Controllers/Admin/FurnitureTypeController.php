<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\PlotType;
use App\Category;
use App\Plot;
use App\Building;
use App\Room;
use App\FurnitureType;

use Illuminate\Http\Request;
use DB;
use Auth;

class FurnitureTypeController extends Controller
{
    public function index(Request $request){
        
        if($request->id){
            $getSwalltype = DB::table('furniture_types')
            ->where('id', '=',$request->id)
            ->get();
            return response()->json($getSwalltype);
        }else{
          $data =   FurnitureType::all();
           return view('admin.types.furnitureType',compact('data'));
    
        }
        	
    }

    public function addFurnitureType(Request $request){
        $this->validate($request, [
            'furniture_type' => 'required',
        ]);

        $input = $request->all();
        // $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];

        FurnitureType::create($input);
        return back()->with('message', 'New Type added successfully.');
    }

    public function update(Request $request)
    {

        // dd($request);
          $furnituretypeId = FurnitureType::find($request->furniture_typeID);
          
          $furnituretypeId->furniture_type = $request->furniture_type_value;   
         
          $furnituretypeId->save();

        return redirect()->action([FurnitureTypeController::class, 'index']);

    }

    public function delete(Request $request)
    {
        
        // dd($request->id);
        // $this->request->delete($id);
        $furnitureType = FurnitureType::find($request->delete_id);
        if($furnitureType){
            $furnitureType->delete();
            return back()->with('message', 'Type deleted  successfully.');
        }else{
            return back()->with('message', 'Type Not Found.');
        }
        // return redirect()->route('admin.auth.user.deleted');
    }
}
