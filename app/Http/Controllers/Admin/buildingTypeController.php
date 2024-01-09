<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\BuildingType;
use App\WallType;
use App\RailingType;
use App\FloorType;
use App\MassType;
use App\RoofType;
use DB;
class buildingTypeController extends Controller
{
    public function index(){
    // 	$data = BuildingType::all();
    	
    	 $data =  BuildingType::select(
                                        "categories.id",
                                        "building_types.id",
                                        "building_types.building_type",
                                        "building_types.floor_height",
                                        "building_types.number_of_floor",
                                        "building_types.target_area",
                                        "categories.type_name as buildingType"
                                    )
                        ->leftJoin("categories","categories.type_name", "=",  "building_types.building_type")->groupBy("building_types.building_type")->orderBy("building_types.id","asc")
                       ->get();

    	return view('admin.types.buildingType',compact('data'));
    }
    public function showbuildingedit(Request $request){
        $wall_types = WallType::all();
        $railingtypes = RailingType::all();
        $floor = FloorType::all();
        $mass =MassType::all();
        $rooftypes =RoofType::all();
        return view('admin.types.editBuildingType',compact('wall_types','railingtypes','floor','mass','rooftypes'));
    }
     public function addEditBuildingType(Request $request){
            $this->validate($request, [
                    'name' => 'required',
                    'default' => 'required',
                ]);
        // dd($request->all());
        //edit
        $plotId = BuildingType::find($request->id);
        $checkotherbuilding = BuildingType::where('building_type',$request->input('name'))->where('id','!=',$request->id)->first();
        if($checkotherbuilding){
          return back()->with('message', 'Building Type Alredy Exist Please Set Unique Building Type!');
        }
        if($plotId && empty($checkotherbuilding)){
            $plotId->building_type = $request->input('name');
        //   $plotId->floor_height = $request->input('floor_height');
        //   $plotId->number_of_floor = $request->input('number_of_floor');
          $plotId->default_value = $request->input('default');   
          $plotId->ext_wall = $request->input('ext_wall');   
          $plotId->room_wall = $request->input('room_wall');   
          $plotId->corri_wall = $request->input('corri_wall');   
          $plotId->soil_slab = $request->input('soil_slab');   
          $plotId->roof_slab = $request->input('roof_slab');   
          $plotId->gen_slab = $request->input('gen_slab');   
          $plotId->railing_type = $request->input('railing_type');  
          $plotId->roof_type = $request->input('roof_type');   
          $plotId->mass_type = $request->input('mass_type');   
         
          $plotId->save();

        return redirect()->action([buildingTypeController::class, 'index']);
        }else{
            $checkprevious = BuildingType::where('building_type',$request->input('name'))->first();
            // dd($checkprevious);
            if($checkprevious){

                return back()->with('message', 'Building Type Alredy Exist.');
            }else{
                $buildingType = new BuildingType();
                $buildingType->building_type = $request->input('name');
                $buildingType->default_value = $request->input('default');
                $buildingType->ext_wall = $request->input('ext_wall');
                $buildingType->room_wall = $request->input('room_wall');
                $buildingType->corri_wall = $request->input('corri_wall');
                $buildingType->soil_slab = $request->input('soil_slab');
                $buildingType->roof_slab = $request->input('roof_slab');
                $buildingType->gen_slab = $request->input('gen_slab');
                $buildingType->railing_type = $request->input('railing_type');
                $buildingType->roof_type = $request->input('roof_type');  
                $buildingType->mass_type = $request->input('mass_type');
                $buildingType->created_at = date('Y-m-d H:i:s');
                $buildingType->updated_at = date('Y-m-d H:i:s');
                $buildingType->save();
                return redirect()->action([buildingTypeController::class, 'index']);
            }
        }

        
        // BuildingType::create($input);
        // return back()->with('message', 'New Category added successfully.');
    }
     public function destroy(Request $request)
    {
        // dd($request->id);
        // $this->request->delete($id);

        $RoomType = BuildingType::find($request->id);
        $RoomType->delete();

        // return redirect()->route('admin.auth.user.deleted');
       
        return back()->with('message', 'RoomType deleted  successfully.');

        
    }

    //   public function update(Request $request)
    // {
    //     // dd($request->all());
    //       $plotId = BuildingType::find($request->id);
    //       $checkotherbuilding = BuildingType::where('building_type',$request->input('name'))->where('id','!=',$request->id)->first();
    //       if($checkotherbuilding){
    //         return back()->with('message', 'Building Type Alredy Exist Please Set Unique Building Type!');
    //       }else{
    //         $plotId->building_type = $request->input('name');
    //     //   $plotId->floor_height = $request->input('floor_height');
    //     //   $plotId->number_of_floor = $request->input('number_of_floor');
    //     //   $plotId->target_area = $request->input('target_area');   
    //       $plotId->ext_wall = $request->input('ext_wall');   
    //       $plotId->room_wall = $request->input('room_wall');   
    //       $plotId->corri_wall = $request->input('corri_wall');   
    //       $plotId->soil_slab = $request->input('soil_slab');   
    //       $plotId->roof_slab = $request->input('roof_slab');   
    //       $plotId->gen_slab = $request->input('gen_slab');   
    //       $plotId->railing_type = $request->input('railing_type');   
    //       $plotId->mass_type = $request->input('mass_type');   
         
    //       $plotId->save();

    //     return redirect()->action([buildingTypeController::class, 'index']);

    //       }
          
    // }


     public function edit(Request $request)
    {

    
        $building_type = DB::table('building_types')
            ->where('id', '=',$request->id)
            ->get();
        $wall_types = WallType::all();
        $railingtypes = RailingType::all();
        $floor = FloorType::all();
        $mass = MassType::all();
        $rooftypes = RoofType::all();
        return view('admin.types.editBuildingType',compact('building_type','wall_types','railingtypes','floor','mass','rooftypes'));
    }
}
