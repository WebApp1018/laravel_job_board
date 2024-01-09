<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RoomType;
use App\Proximity;
use DB;
use App\WallType;
use App\FloorType;
use App\RailingType;
use App\CeilingType;
use App\LightsType;
use App\DoorType;
use App\WindowType;
use App\FurnitureType;
use App\RoomTypeAdd;

use App\Category;
use Auth;
use App\Http\Helpers\Helper;

class RoomTypeController extends Controller
{
    public function index(){
  
         
         $data =  RoomType::select(
                                "categories.id",
                                "room_types.id",
                                "room_types.room_type",
                                "room_types.room_area",
                                "categories.type_name as roomType"
                                    )
                        ->leftJoin("categories","categories.type_name", "=",  "room_types.room_type")
                        ->where('room_types.type' , 'normal')
                        ->groupBy("room_types.room_type")->orderBy("room_types.id","asc")
                       ->get();

    	return view('admin.types.roomType',compact('data'));
    }

    public function extroomtype(){
  
        $data =  RoomType::select(
                               "categories.id",
                               "room_types.id",
                               "room_types.room_type",
                               "room_types.room_area",
                               "categories.type_name as roomType"
                                   )
                        
                       ->leftJoin("categories","categories.type_name", "=",  "room_types.room_type")
                       ->where('room_types.type' , 'external')
                       ->groupBy("room_types.room_type")->orderBy("room_types.id","asc")
                      
                       ->get();

       return view('admin.types.extroomType',compact('data'));
   }
   
   public function stackroomtype(){
            $data =  RoomType::select(
                "categories.id",
                "room_types.id",
                "room_types.room_type",
                "room_types.room_area",
                "categories.type_name as roomType"
                    )
        
        ->leftJoin("categories","categories.type_name", "=",  "room_types.room_type")
        ->where('room_types.type' , 'stack')
        ->groupBy("room_types.room_type")->orderBy("room_types.id","asc")

        ->get();

        return view('admin.types.stackroomType',compact('data'));
   }

     public function addEditRoomType(Request $request){
      // dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'room_area' => 'required',
            // 'type' => 'required',
        ]);
        // $input = $request->all();
        // dd($input);
        //update
        // echo $request->lights["lights"]["0"];
        // dd($request->all());
        $checkotherroom = RoomType::where('room_type',$request->input('name'))->where('id','!=',$request->id)->first();
        if($checkotherroom){
          return back()->with('message', 'Room Alredy Exist Please Set Unique Room Type!');
        }
        $plotId = RoomType::find($request->id);
        if($plotId && empty($checkotherroom)){
          $plotId->room_type = $request->input('name');
          $plotId->room_area = $request->input('room_area'); 
          $plotId->default_value = $request->input('default');   
          $plotId->wall_type = $request->input('wall_type');
          $plotId->floor_finish = $request->input('floor_type');
          $plotId->railing_type = $request->input('railing_type');
          $plotId->ceiling_type = $request->input('ceiling_type');
          $plotId->window_type = $request->input('window_obj');
          $plotId->save();
          $roomTypeAdd = RoomTypeAdd::where('parent_id',$request->id)->first();
          if($roomTypeAdd){
            foreach ($request->object_type as $object_types => $object_value  ){
                foreach($object_value as $key => $values){
                  if($values != null){
                    $updatetable = DB::table('room_type_adds')->where('id', $key)->limit(1)->update(array('parent_id' => $plotId->id,'parent_type' => $plotId->room_type, 'type' => $object_types, 'object_type' => $values));
                    $roomTypeAdd = RoomTypeAdd::where('id',$key)->where('parent_id',$request->id)->first();
                    if(!$roomTypeAdd){
                      DB::table('room_type_adds')->insert(array('parent_id' => $plotId->id,'parent_type' => $plotId->room_type, 'type' => $object_types, 'object_type' => $values));
                    }
                }
              }
            }
            // die(); 
            $idObjDels = array_map('intval', explode(',', $request->id_obj_del));
            RoomTypeAdd::destroy($idObjDels);
          }
          //temperary 
          else{
            // die("else part");
            foreach ($request->object_type as $object_types => $object_value  ){
                foreach($object_value as $values){
                  if($values != null){
                    $roomTypeAdd = new RoomTypeAdd;
                    $roomTypeAdd->parent_id = $request->input('id');
                    $roomTypeAdd->parent_type = $request->input('name');
                    $roomTypeAdd->type = $object_types;
                    $roomTypeAdd->object_type = $values;
                    $roomTypeAdd->save();
                  }
                }
            }
          }
          // die();
          if($plotId->type=='external'){
            return redirect()->action([RoomTypeController::class, 'extroomtype'])->with('message', 'Ext.Room Type updated successfully.');
          } else if($plotId->type=='stack'){
            return redirect()->action([RoomTypeController::class, 'stackroomtype'])->with('message', 'Stack Room updated successfully.');
          }else{
            return redirect()->action([RoomTypeController::class, 'index'])->with('message', 'Room updated successfully.');
          }
        }
        //add
        else{
          $checkpreviousroom = RoomType::where('room_type',$request->input('name'))->where('type',$request->input('type_room'))->first();
          if($checkpreviousroom){
              return redirect()->action([RoomTypeController::class, 'index'])->with('message', 'Type Alredy Exist.');
          }
          else{
            $RoomType = new RoomType;
            $RoomType->room_type = $request->input('name');
            $RoomType->type = $request->input('type_room');
            $RoomType->room_area = $request->input('room_area');
            $RoomType->default_value = $request->input('default');  
            $RoomType->wall_type = $request->input('wall_type');
            $RoomType->floor_finish = $request->input('floor_type');
            $RoomType->railing_type = $request->input('railing_type');
            $RoomType->ceiling_type = $request->input('ceiling_type');
            $RoomType->save();
            foreach ($request->object_type as $object_types => $object_value  ){
              foreach($object_value as $values){
                if($values != null){
                  $roomTypeAdd = new RoomTypeAdd;
                  $roomTypeAdd->parent_id = $RoomType->id;
                  $roomTypeAdd->parent_type = $RoomType->room_type;
                  $roomTypeAdd->type = $object_types;
                  $roomTypeAdd->object_type = $values;
                  $roomTypeAdd->save();
                }
              }
            }
            if($RoomType->type=='external'){
              return redirect()->action([RoomTypeController::class, 'extroomtype'])->with('message', 'New Ext.Room Type added successfully.');
            } else if($RoomType->type=='stack'){
              return redirect()->action([RoomTypeController::class, 'stackroomtype'])->with('message', 'New Stack Room added successfully.');
            }else{
              return redirect()->action([RoomTypeController::class, 'index'])->with('message', 'New Room added successfully.');
            }
          }
        }
        
          // $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
          //  $st = RoomType::create($input);
          //  dd($st);
          //  die();
        
    }
// deleting objects of room-type/ext room-type/stack-room
    public function delObjOfRoom(Request $request)
    { 
      echo($request->id);
    }

    public function destroy(Request $request)
    {
        // dd($request->id);
        // $this->request->delete($id);

        $RoomType = RoomType::find($request->id);
        
        $RoomType->delete();

        // return redirect()->route('admin.auth.user.deleted');
       
        return back()->with('message', 'RoomType deleted  successfully.');

        
    }
    // public function update(Request $request)
    // {
    //     // dd($request);
    //       $plotId = RoomType::find($request->id);
          
          

    //       if($plotId->type=='external'){
    //         return redirect()->action([RoomTypeController::class, 'extroomtype']);
    //       } else if($plotId->type=='stack'){
    //         return redirect()->action([RoomTypeController::class, 'stackroomtype']);
    //       }else{
    //         return redirect()->action([RoomTypeController::class, 'index']);
    //       }
        

    // }

    public function showEditRoom(Request $request){
      // die();
      // dd($request);
        $type = $request->type;
        // $plot = RoomType::Where('id', '=',$request->id)->first();
        $wall_types = WallType::all();
        $floortypes = FloorType::all();
        $railingtypes = RailingType::all();
        $ceilingtypes = CeilingType::all();
        $lighttypes = LightsType::all();
        $doortypes = DoorType::all();
        $windowtypes = WindowType::all();
        $furntypes = FurnitureType::all();
        return view('admin.types.editroom',compact('wall_types','floortypes','railingtypes','ceilingtypes','lighttypes','doortypes','windowtypes','furntypes','type'));
    }


     public function edit(Request $request)
    {

        // echo "HI";exit;
        // dd($request);
        $plot = RoomType::Where('id', '=',$request->id)->first();
        $wall_types = WallType::all();
        $floortypes = FloorType::all();
        $railingtypes = RailingType::all();
        $ceilingtypes = CeilingType::all();
        $lighttypes = LightsType::all();
        $doortypes = DoorType::all();
        $windowtypes = WindowType::all();
        $furntypes = FurnitureType::all();
        $roomtypeadds = RoomTypeAdd::where('parent_id',$request->id)->get();

        // $plot_types = PlotType::all()->pluck('title', 'id');

        // print_r($getSingleProducts);exit;

        return view('admin.types.editroom',compact('plot','wall_types','floortypes','railingtypes','ceilingtypes','lighttypes','doortypes','windowtypes','furntypes','roomtypeadds'));
    }

    public function addRoomWindow(Request $request){

      $id = Auth::user()->id;
         
      $currenturl = url()->full();
      $getid = request()->pid;
      $get_revision_id = request()->rid;

      $dataaa['plot'] =  Category::where('project_id', '=', $getid)->where('user_id', $id )->where('family', 'plot' )->first();
        
      $dataaa['buildings'] =  Category::where('project_revision', '=', $get_revision_id)->where('project_id', '=', $getid)->where('family', 'Building')->get();

      if(count($dataaa['buildings']) <= 0){
        return redirect()-> route('admin.add.plot.window',['pid' => request()->pid,'rid'=>request()->rid])->with('error', "You can't add room if building not exist.") ;

      }

      $bid = request()->bid ?? $dataaa['buildings'][0]->id;

      $dataaa['building_id'] = $bid;

      $dataaa['building'] =  Category::where('id', $bid)->first();
      
      $dataaa['floor'] =  Category::where('project_revision', '=', $request->rid)
      ->where('family', '!=','StackedRoom')->where('project_id', '=',$request->pid)->where('parent_id', '=',$bid)->get() ;

      if(count($dataaa['floor']) <= 0){

    
        return redirect()-> route('admin.add.floor.window',['pid' => request()->pid,'rid'=>request()->rid])->with('error', "You can't add room if floor not exist.") ;

      }

      // dd($dataaa['building']);
      // die();
      
      $floor_id = request()->floor_id ?? $dataaa['floor'][0]->id;

      $dataaa['floor_id'] = $floor_id;

      $dataaa['stack_room'] =  Category::where('family', 'StackedRoom')->where('parent_id',$floor_id)->get();
      $dataaa['room'] =  Category::where('family', 'Room')->where('parent_id', '=',$floor_id)->get();
        
      $dataaa['selected_floor'] =  Category::where('id','=',$floor_id)->get();
       
      // dd($dataaa['floor']);

      $data                       =   array();
      $getSingleProducts          =   DB::table('plot_types')->select('*')->get();
      $dataaa['type']             =   $getSingleProducts->toArray();
      //print_r( $dataaa['plot_types']); die;
      
      $building_types             =   DB::table('building_types')->select('*')->get();
      $dataaa['building_types']   =   $building_types->toArray();
      
      $room_types                 =   DB::table('room_types')->select('*')->where('type','normal')->get();
      $dataaa['room_types']       =   $room_types->toArray();
      

      $stack_room_types                 =   DB::table('room_types')->select('*')->where('type','stack')->get();
      $dataaa['stack_room_types']       =   $stack_room_types->toArray();

      // echo "<pre>";
      // echo $getid ."<br>";
      // echo $get_revision_id."<br>";
      // print_r($dataaa['buildings'][0]['floor']);
      //dd($dataaa);
      if(count($dataaa['floor']) > 0){
        // echo "edit room";
        return view('admin.room_window.editRoomWindow', compact('dataaa'));
        // return view('admin.room_window.addRoomWindow', compact('dataaa'));
      }else{
        return view('admin.room_window.addRoomWindow', compact('dataaa'));
      }
     
    }
//Proximity for room
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
   public function instanceNumber($projectId){
       $instanceData = Category::where('project_id',$projectId)->latest('id')->first();
      if($instanceData){
          $instanceNum = $instanceData->instance_id + 1;
      }else{
          $instanceNum = "1";
      }
      return $instanceNum;
   }
    public function getStackedRooms($title){
      return Category::where('title', '=',$title)->where('family', '=','StackedRoom')->get();
    }
    public function addRoom(Request $request){
      if($request->proximity){
          $this->updatProximity($request->proximity); 
      }
        $userid = Auth::user()->id;
        $input['user_id'] = $userid;

        //add rooms
        $rooms = $request->input('rooms');
        $floor = $request->input('floor');
        

        $stacked_rooms = $request->input('stacked_rooms');
        ///get the list of 
        $floors =  Category::where('project_revision', '=', $request->project_revision_id)->where('project_id', '=',$request->project_id)->where('id', '=',$request->floor_number)->first();
        $floors->title = $request->floor_name;
        $floors->save();

    if(isset($stacked_rooms)){
      $floors =  Category::where('project_revision', '=', $request->project_revision_id)
      ->where('family', '!=','StackedRoom')->where('parent_id', '=',$request->building_id)->where('project_id', '=',$request->project_id)->get() ;
    
        for($i = 1; $i<= count($stacked_rooms['title']); $i++){
          if( $stacked_rooms['delete'][$i] != "delete"){
            if(isset($stacked_rooms['id'][$i])){
              $Category =  Category::where('id',$stacked_rooms['id'][$i])->first();
              $stackedRooms = $this->getStackedRooms($Category->title);
              foreach($stackedRooms as $stack){
                $Category =  Category::where('id',$stack->id)->first();
                $Category->title = $stacked_rooms['title'][$i];
                $Category->type_name =  $stacked_rooms['type'][$i];
                $Category->target_area = $stacked_rooms['room_area'][$i];
                $Category->area_percentage = $stacked_rooms['range'][$i];
                $Category->area = $stacked_rooms['room_area'][$i];
                $Category->save();
              }
            }else{
              foreach($floors as $floor){
                $Category = new Category();
                $Category->user_id = $userid; 
                $Category->project_revision = $request->project_revision_id; 
                $Category->project_id = $request->project_id;
                $Category->title = $stacked_rooms['title'][$i];
                $Category->parent_id = $floor->id;  
                $Category->type_name =  $stacked_rooms['type'][$i];
                $Category->instance_id = $this->instanceNumber($request->project_id);
                $Category->parent_host_csv = $request->floor_name;
                $Category->family = 'StackedRoom';
                $Category->u_title = uniqid();
                $Category->target_area = $stacked_rooms['room_area'][$i];
                $Category->area_percentage = $stacked_rooms['range'][$i];
                $Category->area = $stacked_rooms['room_area'][$i];
                $Category->save();
                $stackroom_inserted_id = $Category->id;
                  if(isset($request->proximity[$i])){
                      $this->updatProximity($request->proximity,$stackroom_inserted_id);
                  }
              }
            }
          }
      }
     
    }
            
        if(isset($rooms)){
          for($i = 1; $i<= count($rooms['title']); $i++){
            if( $rooms['delete'][$i] != "delete"){
              if(isset($rooms['id'][$i])){
                $CategoryRoom =  Category::where('id',$rooms['id'][$i])->first();
                $CategoryRoom->user_id = $userid; 
                $CategoryRoom->project_revision = $request->project_revision_id; 
                $CategoryRoom->project_id = $request->project_id;
                $CategoryRoom->title = $rooms['title'][$i];
                $CategoryRoom->parent_id = $request->floor_number; 
                $CategoryRoom->type_name =  $rooms['type'][$i];
                
                $CategoryRoom->parent_host_csv = $request->floor_name;
                $CategoryRoom->family = 'Room';
                $CategoryRoom->u_title = uniqid();
                $CategoryRoom->target_area = $rooms['room_area'][$i];
                $CategoryRoom->area_percentage = $rooms['range'][$i];
                $CategoryRoom->area = $rooms['room_area'][$i];
                $CategoryRoom->save();
                
              }else{
                $CategoryRoom = new Category();
                $CategoryRoom->user_id = $userid; 
                $CategoryRoom->project_revision = $request->project_revision_id; 
                $CategoryRoom->project_id = $request->project_id;
                $CategoryRoom->title = $rooms['title'][$i];
                $CategoryRoom->parent_id = $request->floor_number; 
                $CategoryRoom->type_name =  $rooms['type'][$i];
                $CategoryRoom->instance_id = $this->instanceNumber($request->project_id);
                
                $CategoryRoom->parent_host_csv = $request->floor_name;
                $CategoryRoom->family = 'Room';
                $CategoryRoom->u_title = uniqid();
                $CategoryRoom->target_area = $rooms['room_area'][$i];
                $CategoryRoom->area_percentage = $rooms['range'][$i];
                $CategoryRoom->area = $rooms['room_area'][$i];
                $CategoryRoom->save();

                $room_inserted_id = $CategoryRoom->id;
                        if(isset($request->room_proximity[$i])){
                            $this->updatProximity($request->room_proximity,$room_inserted_id);
                        }
              }
            }
          }
      }
       

        return redirect()->action([CategoryController::class, 'showProject'], ['id' => $request->project_id,'rid'=>$request->project_revision_id])->with('message', 'New Rerord added successfully');

    }
  
}
 
