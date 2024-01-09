<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\PlotType;
use App\Category;
use App\Plot;
use App\Building;
use App\Room;
use App\WindowType;

use Illuminate\Http\Request;
use DB;
use Auth;

class WindowTypeController extends Controller
{
    public function index(Request $request){
        
        if($request->id){
            $getSwalltype = DB::table('window_types')
            ->where('id', '=',$request->id)
            ->get();
            return response()->json($getSwalltype);
        }else{
          $data =   WindowType::all();
           return view('admin.types.windowType',compact('data'));
    
        }
        	
    }

    public function addWindowType(Request $request){
        $this->validate($request, [
            'window_type' => 'required',
        ]);
        $input = $request->all();
        // $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];

        WindowType::create($input);
        return back()->with('message', 'New Type added successfully.');
    }

    public function update(Request $request)
    {

        // dd($request);
          $windowtypeId = windowType::find($request->window_typeID);
          
          $windowtypeId->window_type = $request->window_type_value;   
         
          $windowtypeId->save();

        return redirect()->action([WindowTypeController::class, 'index']);

    }

    public function delete(Request $request)
    {
        
        // dd($request->id);
        // $this->request->delete($id);
        $windowType = WindowType::find($request->delete_id);
        if($windowType){
            $windowType->delete();
            return back()->with('message', 'Type deleted  successfully.');
        }else{
            return back()->with('message', 'Type Not Found.');
        }
        // return redirect()->route('admin.auth.user.deleted');
    }
}
