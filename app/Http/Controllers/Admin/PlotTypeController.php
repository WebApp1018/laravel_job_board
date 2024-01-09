<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\PlotType;
use App\Category;
use App\Plot;
use App\Building;
use App\Room;
use App\WallType;
use App\Proximity;
use App\FloorType;

use App\Http\Helpers\Helper;
use Illuminate\Http\Request;
use DB;
use Auth;
class PlotTypeController extends Controller
{
    public function index(Request $request){
        if($request->id){
            $getSingleplot = DB::table('plot_types')
            ->where('id_plot', '=',$request->id)
            ->get();
            return response()->json($getSingleProducts);
        }else{
          $data =   PlotType::select('*')->orderBy("plot_types.id_plot","asc")
                    ->get();
                    // echo '<pre>';
                    // print_r($data);
                    // die();
           return view('admin.types.plotType',compact('data'));
    
        }


    	
    }
    
    
public function userPlotList(Request $request){
   // print_r('asdf');die;
        if($request->id){
            $getSingleplot = DB::table('plot_types')
            ->where('id', '=',$request->id)
            ->get();
            return response()->json($getSingleProducts);
        }else{
            $getSingleProducts          =   DB::table('user_plots')->select('*')->get();
            $data            =   $getSingleProducts->toArray();
            //$getSingleProducts          =   DB::table('user_plots')->where('user_id', '=',$request->id)->select('*')->get();
            
           //$user_plot_list   =   $getSingleProducts->toArray();
            /*$final_array    =   array();
             foreach($user_plot_list as $key){
                 $listArray['user_plote_id']    =   $key->user_plote_id;
                 $listArray['plot_type_name']   =   $key->plot_type_name;
                 $listArray['user_id']          =   $key->user_id;
                 $listArray['width']            =   $key->width;
                 $listArray['height']           =   $key->height;
                 $listArray['length']           =   $key->length;
                 $listArray['created_at']       =   $key->created_at;
                 $listArray['updated_at']       =   $key->updated_at;
                 $final_array[] = $listArray;
                 //print_r($final_array);die;
             }
            */
            
           //return view('admin.types.user_plot_list',compact('data'));
           return view('admin.plot_window.user_plot_list',compact('data'));
    
        }

    	
    }
    public function showAddPlotType(){
        $wall_types = WallType::all();
        $floor = FloorType::all();
        return view('admin.types.editType',compact('wall_types','floor'));
    }

    public function addEditPlotType(Request $request){
        $this->validate($request, [
            'name' => 'required',
        ]);
        // dd($request->all());
        $plotId = PlotType::where('id_plot','=',$request->id)->first();
        $checkotherplot = PlotType::where('plot_type',$request->input('name'))->where('id_plot','!=',$request->id)->first();
        if($checkotherplot){
            return back()->with('message', 'Type Exist, Enter Different Type');
        }
        if($plotId && empty($checkotherplot)){
            $plotId->def_len = $request->input('def_len');
            $plotId->def_width = $request->input('def_width');
            $plotId->def_height = $request->input('def_height');
            $plotId->plot_type = $request->input('name');   
            $plotId->road_wall = $request->input('road_wall');   
            $plotId->neigbr_wall = $request->input('Neigbr_wall');   
            $plotId->gen_wall = $request->input('gen_wall');   
            $plotId->soil_slab = $request->input('soil_slab');   
            $plotId->save();
            return redirect()->action([PlotTypeController::class, 'index'])->with('message', 'Plot Type updated successfully.');;
        }else{
            $checkName = PlotType::where('plot_type',$request->input('name'))->first();
            if($checkName){
                return back()->with('message', 'Plot Already Exist.');
            }else{
                $plottype = new PlotType();
                $plottype->plot_type = $request->input('name');
                $plottype->road_wall = $request->input('road_wall');
                $plottype->def_width = $request->input('def_width');
                $plottype->def_len = $request->input('def_len');
                $plottype->def_height = $request->input('def_height');
                $plottype->neigbr_wall = $request->input('Neigbr_wall');
                $plottype->gen_wall = $request->input('gen_wall');
                $plottype->soil_slab = $request->input('soil_slab');
                $plottype->created_at = date('Y-m-d H:i:s');
                $plottype->updated_at = date('Y-m-d H:i:s');
                $plottype->save();
                return redirect()->action([PlotTypeController::class, 'index'])->with('message', 'New Plot Type added successfully.');
            }
        }
    }
    
    public function destroy(Request $request)
    {
        // dd($request->id);
        // $this->request->delete($id);

        $RoomType = PlotType::find($request->id_plot);
        $RoomType->delete();

        // return redirect()->route('admin.auth.user.deleted');
       
        return back()->with('message', 'Plot deleted  successfully.');

        
    }

    //  public function update(Request $request)
    // {
    //     // dd($request);
    //       $plotId = PlotType::where('id_plot','=',$request->id)->first();
          
          

    // }

    public function removeProximity(Request $request){
        if($request->cat_id && $request->cat_id_prox){
            Proximity::where('cat_id_prox',$request->cat_id_prox)->where('cat_id', $request->cat_id)->delete();
            return 'true';
        }
    }
     public function edit(Request $request)
    {

        // echo "HI";exit;
        // dd($request);
        $plot_types = DB::table('plot_types')
            ->where('id_plot', '=',$request->id)
            ->get();

        $wall_types = WallType::all();
        $floor = FloorType::all();
        // dd($walltypes);

        // $plot_types = PlotType::all()->pluck('title', 'id');

        // print_r($getSingleProducts);exit;

        return view('admin.types.editType',compact('plot_types','wall_types','floor'));
    }
    
    public function addPlotWindow(Request $request){

        $id = Auth::user()->id;

        $currenturl = url()->full();
        $getid = request()->pid;
        $get_revision_id = request()->rid;
        $userid = Auth::user()->id;
        $project_revisionID= DB::table('categories')->select('project_revision')->where('project_id', '=', $getid)->orderBy('id', 'DESC')->first();
        
        if($project_revisionID){
            $project_revisionID = $project_revisionID->project_revision;
        }else{
            $project_revisionID = 0;
        }
        

        $dataaa                     =   array();
        
        $dataaa['plot'] =  Category::where('project_id', '=', $getid)->where('user_id', $userid )->where('family', 'plot' )->first();
        
        $dataaa['building'] =  Category::where('categories.project_id', '=', $getid)->where('categories.user_id', $userid )->where('categories.family', 'Building' )->where('categories.project_revision', '=', $project_revisionID)->get();

        // $dataaa['proximity'] = Proximity::where('cat_id','=',$dataaa['building']['id'])->get();
        // echo "<pre>";
        // dd($dataaa['building']);
        //die();
        $dataaa['extroom'] =  Category::where('project_id', '=', $getid)->where('user_id', $userid )->where('family', 'external' )->where('project_revision', '=', $project_revisionID)->get();
       if( $dataaa['plot']){

           $dataaa['plots'] =  Plot::where('plot_id', '=', $dataaa['plot']['id'])->first();
       }

        $getSingleProducts          =   DB::table('plot_types')->select('*')->get();
        $dataaa['type']             =   $getSingleProducts->toArray();
        
        $building_types             =   DB::table('building_types')->select('*')->get();
        $dataaa['building_types']   =   $building_types->toArray();
        $room_types                 =   DB::table('room_types')->select('*')->where('type', 'external')->get();
        $dataaa['room_types']       =   $room_types->toArray();
        
        $cate_id = DB::table('categories')->latest('id')->first();
        $cate_id = $cate_id->id+1;
        $dataaa['plot_name'] = 'Plot'.$cate_id." ".substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 4);
        
        if($dataaa['plot']){
            return view('admin.plot_window.editPlotWindow', compact('dataaa'));
        }else{
            return view('admin.plot_window.addPlotWindow', compact('dataaa'));
        }
        
    }    
    public function instanceNumber($projectId){
        $instanceData = Category::where('project_id',$projectId)->latest('id')->first();
       if($instanceData){
           $instanceNum = $instanceData->instance_id + 1;
       }else{
           $instanceNum = "1";
       }
       return $instanceNum;
    }
    public function addPlot(Request $request){
        // add Plot 
        $userid = Auth::user()->id;
        $input['user_id'] = $userid;
         /*
            Add Plot
        */
        $addPlotName = new Category();
        $addPlotName->user_id = $userid;
        $addPlotName->project_id = $request->input('project_id');
        $addPlotName->title = $request->input('ploat_name');
        $addPlotName->width = $request->input('plot_width');
        $addPlotName->height = $request->input('plot_heigth');
        $addPlotName->length = $request->input('plot_length');
        $addPlotName->parent_id = 0;
        $addPlotName->target_area =  ($addPlotName->length * $addPlotName->width);
                
        $addPlotName->instance_id = $this->instanceNumber($request->project_id);
        $addPlotName->type_name = $request->plot_type_name;
        $addPlotName->project_revision = $request->project_revision_id;
        $addPlotName->family = 'Plot';
        $addPlotName->u_title = uniqid();
        $addPlotName->save();
      
         

        $addPlot = new Plot();
        $addPlot->plot_id = $addPlotName->id;
        $addPlot->width = $request->input('plot_width');
        $addPlot->height = $request->input('plot_heigth');
        $addPlot->length = $request->input('plot_length');
        $addPlot->plot_type_name = $request->input('plot_type_name');
        $addPlot->save();
    

        /* Add Building */
    
        $buildings = $request->input('buildings');
        if(isset($buildings['title']) && count($buildings['title']) > 0){
            $building_total = count($buildings['title']);
            for($i = 1; $i<= $building_total; $i++){
                $addCategory = new Category();
                $addCategory->user_id = $userid;
                $addCategory->project_id = $request->input('project_id');
                $addCategory->title = $buildings['title'][$i];
                $addCategory->instance_id = $this->instanceNumber($request->project_id);
                $countArea = ($addPlotName->length * $addPlotName->width);
                $area = ($countArea / 100) * $buildings['target_area'][$i];
                $addCategory->parent_id =   $addPlotName->id;
                $addCategory->type_name =  $buildings['type'][$i];
                $addCategory->parent_host ='plot';
                $addCategory->parent_host_csv =$addPlotName->title; //target_area 
                $addCategory->target_area = $buildings['target_area'][$i];
                $addCategory->area_percentage = $buildings['range'][$i];

                
                $addCategory->area = (int)$area;
                $addCategory->family = 'Building';
                $addCategory->u_title = uniqid();
                $addCategory->project_revision = $request->project_revision_id;
                $addCategory->save();
    
    
                $building_inserted_id = $addCategory->id;
        
                $addBuildings = new Building();
                $addBuildings->plot_id = $addCategory->id;
                $addBuildings->area = (int)$area;
                $addBuildings->building_type = $buildings['type'][$i];
                $addBuildings->save();
            
            }

        }
        

         //Add Ext Room
         $extRooms = $request->input('extRooms');
         if(isset($extRooms['title']) && count($extRooms['title']) > 0){
             $extRooms_total = count($extRooms['title']);
             for($j = 1; $j  <= $extRooms_total; $j++){
                 if(isset($extRooms['id'][$j]) ){
 
                    $Category = Category::where('id',$extRooms['id'][$j])->first();
                    $Category->title = $extRooms['title'][$j];
                    $Category->parent_id = $addPlotName->id;
        
                    $Category->type_name = $extRooms['type'][$j]; 
                    $Category->plot_id = $addCategory->id;
                    $Category->target_area = $extRooms['target_area'][$j];
                    $Category->project_revision = $request->project_revision_id;
                    $Category->save();
         
                    $rooms = Room::where('floor_id',$extRooms['id'][$j])->first();
                    $rooms->floor_id =   $Category->id;
                    $rooms->room_type =  $extRooms['type'][$j]; 
                    $rooms->room_area = $extRooms['target_area'][$j];
                    $rooms->save();

                 }else{
                     
                    $Category = new Category();
                    $Category->user_id = $userid; 
                    $Category->project_id = $request->project_id;
                    $Category->title = $extRooms['title'][$j];
                    $Category->parent_id = $addPlotName->id;
                    $Category->project_revision = $request->project_revision_id;
                    $Category->instance_id = $this->instanceNumber($request->project_id);

                    $Category->type_name = $extRooms['type'][$j]; 
                    $Category->plot_id = $addCategory->id;
                    $Category->family = 'external';
                    $Category->u_title = uniqid();
                    $Category->target_area = $extRooms['target_area'][$j];
                    $Category->area_percentage = $extRooms['range'][$j];

                    $Category->save();

                    $rooms = new Room();
                    $rooms->floor_id =   $Category->id;
                    $rooms->room_type =  $extRooms['type'][$j]; 
                    $rooms->room_area = $extRooms['target_area'][$j];
                    $rooms->save();

                    ////need to add ext room proximity here
                 }
             }
        }

        return redirect()->action([CategoryController::class, 'showProject'], ['id' => $request->project_id,'rid'=>$request->project_revision_id])->with('message', 'New Rerord added successfully');
  
    }
    function removePrevious($id){
        if($id){
            Proximity::where('cat_id', $id)->delete();
        }
       
    }
    function updatProximity($proximities,$id = Null){
        if($id){
            $this->removePrevious($id);
            foreach($proximities as $key=>$proximity){
                foreach($proximity as $prox){
                    $proximityData = Category::where('id',$prox)->first();
                    $proximity = new Proximity;
                    $proximity->cat_id = $id;
                    $proximity->cat_id_prox = $proximityData->id;
                    $proximity->title_prox = $proximityData->title;
                    $proximity->type = $proximityData->family;
                    $proximity->save();
                }
            }
        }else{
            foreach($proximities as $key=>$proximity){
                $this->removePrevious($key);
                
                foreach($proximity as $prox){
                    $proximityData = Category::where('id',$prox)->first();
                    if($proximityData){

                        $proximity = new Proximity;
                        $proximity->cat_id = $key;
                        $proximity->cat_id_prox = $proximityData->id;
                        $proximity->title_prox = $proximityData->title;
                        $proximity->type = $proximityData->family;
                        $proximity->save();
                    }
                }
            }
        }
    }
    public function updatePlotWindow(Request $request){
        // echo ($building_total);
        if($request->proximity){
           $this->updatProximity($request->proximity); 
        }
           
         $userid = Auth::user()->id;
         $input['user_id'] = $userid;
 

        /*
            Add Plot
        */
        $addPlotName = Category::find($request->input('id'));
        $addPlotName->title = $request->input('ploat_name');
        $addPlotName->width = $request->input('plot_width');
        $addPlotName->height = $request->input('plot_heigth');
        $addPlotName->length = $request->input('plot_length');
        $addPlotName->type_name = $request->input('plot_type_name');
        $addPlotName->target_area =  ($addPlotName->length * $addPlotName->width);
          
        $addPlotName->parent_id = 0;
        $addPlotName->family = 'Plot';
        $addPlotName->u_title = uniqid();
        $addPlotName->save();
    
        
        $addPlot = Plot::where('plot_id',$request->input('id'))->first();
        $addPlot->width = $request->input('plot_width');
        $addPlot->height = $request->input('plot_heigth');
        $addPlot->length = $request->input('plot_length');
        $addPlot->plot_type_name = $request->input('plot_type_name');
        $addPlot->save();
     
 
         /* Add Building */
     
        $buildings = $request->input('buildings');

        
       
        
        if(isset($buildings['title']) && count($buildings['title']) > 0){
            $building_total = count($buildings['title']);
            
            for($i = 1; $i <= $building_total; $i++){
                

                if( $buildings['delete'][$i] != "delete"){
                    if(isset($buildings['id'][$i])){

                        $bid = $buildings['id'][$i];
                        $addCategory =  Category::where('id',$bid)->first();
                        $addCategory->title = $buildings['title'][$i];
                        $countArea = ($addPlotName->length * $addPlotName->width);
                        $area = ($countArea / 100) * $buildings['target_area'][$i];
                        $addCategory->parent_id =  $addPlotName->id;
                        $addCategory->type_name =  $buildings['type'][$i];
                        $addCategory->parent_host_csv =$addPlotName->title; //target_area 
                        $addCategory->target_area = $buildings['target_area'][$i];
                        $addCategory->area_percentage = $buildings['range'][$i];

                        
                        $addCategory->area =   (int)$area;
                        $addCategory->save();
            
                        $building_inserted_id = $addCategory->id;

                        
                        $addBuildings =  Building::where('plot_id',$buildings['id'][$i])->first();
                        if($addBuildings){
                            $addBuildings->area =  (int)$area;
                            $addBuildings->building_type = $buildings['type'][$i];
                            $addBuildings->save();
                        }

                    }else{

                        $addCategory = new Category();
                        $addCategory->user_id = $userid;
                        $addCategory->project_id = $request->input('project_id');
                        $addCategory->title = $buildings['title'][$i];
                        $countArea = ($addPlotName->length * $addPlotName->width);
                        $area = ($countArea / 100) * $buildings['target_area'][$i];
                        $addCategory->parent_id =   $addPlotName->id;
                        $addCategory->type_name =  $buildings['type'][$i];
                        $addCategory->parent_host ='plot';
                        $addCategory->instance_id = $this->instanceNumber($request->project_id);
       
                        $addCategory->parent_host_csv =$addPlotName->title; //target_area 
                        $addCategory->target_area = $buildings['target_area'][$i];
                        $addCategory->area_percentage = $buildings['range'][$i];

                        
                        $addCategory->area =    (int)$area;
                        $addCategory->family = 'Building';
                        $addCategory->u_title = uniqid();
                        $addCategory->project_revision = $request->project_revision_id;
                        $addCategory->save();
            
            
                        $building_inserted_id = $addCategory->id;
                        if(isset($request->building_proximity[$i])){
                            $this->updatProximity($request->building_proximity,$building_inserted_id);
                        }
                        $addBuildings = new Building();
                        $addBuildings->plot_id = $request->input('id');
                        $addBuildings->area = (int)$area;
                        $addBuildings->building_type = $buildings['type'][$i];
                        $addBuildings->save();
                    }
                }
            }
        }

 
         //Add Ext Room
        $extRooms = $request->input('extRooms');
        if(isset($extRooms['title']) && count($extRooms['title']) > 0){
            $extRooms_total = count($extRooms['title']);
            for($j = 1; $j  <= $extRooms_total; $j++){
                if(isset($extRooms['id'][$j]) and $extRooms['delete'][$j]!="delete"){

                    $Category = Category::where('id',$extRooms['id'][$j])->first();
                    $Category->title = $extRooms['title'][$j];
                    $Category->parent_id = $addPlotName->id;
        
                    $Category->type_name = $extRooms['type'][$j]; 
                    $Category->plot_id =   $request->input('id');
                    $Category->target_area = $extRooms['target_area'][$j];
                    $Category->area_percentage = $extRooms['range'][$j];

                    $Category->save();

                }elseif($extRooms['delete'][$j] != "delete"){
                    
                    $Category = new Category();
                    $Category->user_id = $userid; 
                    $Category->project_id = $request->project_id;
                    $Category->title = $extRooms['title'][$j];
                    $Category->parent_id = $addPlotName->id;


                    $Category->type_name = $extRooms['type'][$j]; 
                    $Category->plot_id = $addCategory->id;
                    $Category->instance_id = $this->instanceNumber($request->project_id);
       
                    
                    $Category->family = 'external';
                    $Category->u_title = uniqid();
                    $Category->target_area = $extRooms['target_area'][$j];
                    $Category->project_revision = $request->project_revision_id;
                    $Category->area_percentage = $extRooms['range'][$j];

                    $Category->save();
                    if(isset($request->ext_proximity[$i])){
                        $this->updatProximity($request->ext_proximity,$Category->id);
                    }
                    $rooms = new Room();
                    $rooms->floor_id =   $Category->id;
                    $rooms->room_type =  $extRooms['type'][$j]; 
                    $rooms->room_area = $extRooms['target_area'][$j];
                    $rooms->save();
                }
            }
        }
         return redirect()->action([CategoryController::class, 'showProject'], ['id' => $request->project_id,'rid'=>$request->project_revision_id])->with('message', 'New Rerord added successfully');
 
        return view('admin.plot_window.updatePlotWindow',compact('data'));
    }

    public function deleteBuilding(Request $request){


            $this->removePrevious($request->id);
            $getparent = Category::find($request->id);
            // dd($val);
            $getchilds = Category::where('parent_id', '=',$getparent->id)->get();
            
            $getparent->delete();
            $getchilds1 = [];
            foreach($getchilds as $getchild){
                $project1 = Category::find( $getchild->id);
                $getchilds1 = Category::where('parent_id', '=',$getchild->id)->get();
                $project1->delete();
            
                $getchilds2 = [];
                foreach($getchilds1 as $getchild1){
                    $project2 = Category::find($getchild1->id);
                    $getchilds2 = Category::where('parent_id', '=',$getchild1->id)->get();
                    $project2->delete();
                    foreach($getchilds2 as $getchild2){
                        $project3 = Category::find($getchild2->id);
                        $project3->delete();
                    } 
                }
            }
        return response()->json('data deleted');
    }

    public function deleteExtroom(Request $request){
        
        $rooms  = Category::find($request->id);
        if($rooms->family== 'StackedRoom'){
            Category::where('title', '=',$rooms->title)->where('family', '=','StackedRoom')->get();
        }else{
            $rooms->delete();
        }
        return response()->json('data deleted');

    }

}
