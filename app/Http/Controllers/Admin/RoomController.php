<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Room;
use App\Building;
use Auth;
use DB;
use App\Helpers\Helper;
use App\FloorRoom;
class RoomController extends Controller
{
    public function addCategory(Request $request)
    {
        
        $this->validate($request, [
            'title' => 'required',
        ]);

        //   $get_building= Building::latest()->first();
        //   dd($request);
           
        // $get_category_id = Category::latest()->first();
        //
        $inserted_id_array = array();
        for($i=1;$i<=$request->number_of_room;$i++)
        {

        
        //
        // $instanceData = Category::where('project_id',$request->project_id)->latest('id')->first();
        
        // if($instanceData){
        //     $instanceNum = $instanceData->instance_id + 1;
        // }else{
        //     $instanceNum = "1";
        // }    
        
        $instanceData = Category::where('project_id',$request->project_id)->where('project_revision',$request->project_revision_id)->where('parent_host',"Floor")->count();
        if($instanceData!=0)
        {
          $instanceData = $instanceData+1;
          if($instanceData<10)
          {
              $instanceNum = "0".$instanceData;
          }
        }
        else
        {
            $instanceNum = "01";
        }

        $user_id = Auth::user()->id;
           

        $Category = new Category();
        
        $Category->user_id = $user_id; 
        $Category->project_id = $request->project_id;
        $Category->title = $request->title;
        if($request->flotFlor_check == 'f')
        {
           if($i!=1)
            {
                // $empData = Category::latest('id')->first();
                // $empData = $empData->id+1;
                // $Category->title = "Room".$empData;

                $empData1 = Category::where('project_id',$request->project_id)->where('project_revision',$request->project_revision_id)->where('parent_host',"Floor")->count();
                
                $empData1 = $empData1+1;
                if($empData1<10)
                  {
                      $instanceNum = "0".$empData1;
                  }
                else
                {
                    $instanceNum = $empData1;
                }
                $Category->title = "Room".$instanceNum;
            }
            else
            {
                $empData1 = Category::where('project_id',$request->project_id)->where('project_revision',$request->project_revision_id)->where('parent_host',"Floor")->count();
                
                $empData1 = $empData1+1;
                if($empData1<10)
                  {
                      $instanceNum = "0".$empData1;
                  }
                else
                {
                    $instanceNum = $empData1;
                }
                
            }
        }
        else
        {
            if($i!=1)
            {
             $empData1 = Category::where('project_id',$request->project_id)->where('project_revision',$request->project_revision_id)->where('parent_host',"plot")->where('parent_id','!=',0)->count();
                
                $empData1 = $empData1+1;
                if($empData1<10)
                  {
                      $instanceNum = "0".$empData1;
                  }
                else
                {
                    $instanceNum = $empData1;
                }
                $Category->title = "Room".$instanceNum;
            }
            else
            {
                $empData1 = Category::where('project_id',$request->project_id)->where('project_revision',$request->project_revision_id)->where('parent_host',"plot")->where('parent_id','!=',0)->count();
                
                $empData1 = $empData1+1;
                if($empData1<10)
                  {
                      $instanceNum = "0".$empData1;
                  }
                else
                {
                    $instanceNum = $empData1;
                }
                
            }
        }
        //
        $instanceData = Category::where('project_id',$request->input('project_id'))->latest('id')->first();
        if($instanceData){
            $instanceNum = $instanceData->instance_id + 1;
        }else{
            $instanceNum = "1";
        } //
        $Category->instance_id = $instanceNum;
        $Category->project_revision = $request->project_revision_id;
        if($request->flotFlor_check == 'f')
        {
            if($request->parent_id1){
                $floordata =  Category::find($request->parent_id1);
                    
                if($request->flotFlor_check == 'p'){
                    $buildingdata =  Category::where('id', '=', $floordata->id)->get();
                }elseif($request->flotFlor_check == 'f'){
                    
                    if($floordata->parent_id > 0){
                        $buildingdata =  Category::where('id', '=', $floordata->parent_id)->get();
                        
                    }else{
                        $buildingdata =  Category::where('id', '=', $floordata->id)->get();
                    }
                    
                }else{
                    $buildingdata =  Category::where('id', '=', $floordata->id)->get();
                }
                
                $Category->parent_id = $request->parent_id1;
                
                    
            }else{
                   
                $floordata =  Category::find($request->parent_id);
                
                $buildingdata =  Category::where('id', '=', $floordata->parent_id)->get();
                $Category->parent_id = $request->parent_id;
                
            
           }
        }
        else
        {
            
            if($request->plot_parent){
                $floordata =  Category::find($request->plot_parent);
                    
                if($request->flotFlor_check == 'p'){
                    $buildingdata =  Category::where('id', '=', $floordata->id)->get();
                }elseif($request->flotFlor_check == 'f'){
                    
                    if($floordata->parent_id > 0){
                        $buildingdata =  Category::where('id', '=', $floordata->parent_id)->get();
                        
                    }else{
                        $buildingdata =  Category::where('id', '=', $floordata->id)->get();
                    }
                    
                }else{
                    
                    $buildingdata =  Category::where('id', '=', $floordata->id)->get();
                }
                
                $Category->parent_id = $request->plot_parent;
                
                    
            }else{
                   
                $floordata =  Category::find($request->parent_id);
                
                $buildingdata =  Category::where('id', '=', $floordata->plot_parent)->get();
                $Category->parent_id = $request->plot_parent;
                
            
           }
        }
    //  dd($buildingdata);
           
        $Category->type_name = $request->room_type;
        
        $Category->parent_host_csv =$floordata->title;
        $Category->family = 'Room';
        $Category->u_title = uniqid();
        $Category->target_area =  $request->room_area;

        if($request->flotFlor_check == 'p'){
            $Category->parent_host = 'Plot';
            $countarea = $buildingdata[0]->width * $buildingdata[0]->length;
            $area = ($countarea / 100) * $request->room_area;
        }else{
            $Category->parent_host = 'Floor';
            $area = ($buildingdata[0]->area / 100) * $request->room_area;
        }
        $Category->area = $area;

        $Category->save();
        
        

        $rooms = new Room();
        $rooms->floor_id = $Category->id;
        $rooms->room_type = $request->room_type;
        $rooms->room_area = $request->room_area;
        $rooms->save();
        // order update
        
        $inserted_id = $Category->id; 
        $inserted_id_array[] = $inserted_id;
        
        } // end for loop

        Category::where('parent_id', $request->parent_id1)->update(['sort_order' => 0]);
        $counter =1;
        $floor_data =  Category::where('parent_id', $request->parent_id1)->orderby('id','ASC')->get();

        


        foreach ($floor_data as $key => $val) {
            
            $sort_order = Helper::get_table_record_field('categories',$val->id)->sort_order;
            if($sort_order==0)
            {
                Category::where('id', $val->id)->update(['sort_order' => $counter]);
                if(isset($request->floor_room[0]))
                {
                    if($val->id==$request->floor_room[0])
                     {
                        foreach ($inserted_id_array as $key => $v) {
                           $counter++;
                            Category::where('id', $v)->update(['sort_order' => $counter]);
                        }
                    }
                }          
                
            }
            $counter++;
        }
        // Multiple Room 
        
        if(count($inserted_id_array)>0)
        {
            foreach ($inserted_id_array as $key => $v) {
                    if(!empty($request->floor_room))
                    {
                        foreach ($request->floor_room as $key => $val) {
                        $frooms = new FloorRoom();
                        $frooms->room_id = $v;
                        $frooms->room_ids = $val;
                        $frooms->save();
                    }
                    
                }
            }
        }
        
        //exit;
        return back()->with('success', 'New Room added successfully.');

    }


   
    public function addextcategory(Request $request)
    {
        
        
        $this->validate($request, [
            'title' => 'required',
        ]);

        //   $get_building= Building::latest()->first();
        //   dd($request);
           
        // $get_category_id = Category::latest()->first();
        //
        $inserted_id_array = array();
        for($i=1;$i<=$request->number_of_extroom;$i++)
        {

        
        //
        // $instanceData = Category::where('project_id',$request->project_id)->latest('id')->first();
        
        // if($instanceData){
        //     $instanceNum = $instanceData->instance_id + 1;
        // }else{
        //     $instanceNum = "1";
        // }    
        
        $instanceData = Category::where('project_id',$request->project_id)->where('project_revision',$request->project_revision_id)->where('parent_host',"Floor")->count();
        if($instanceData!=0)
        {
          $instanceData = $instanceData+1;
          if($instanceData<10)
          {
              $instanceNum = "0".$instanceData;
          }
        }
        else
        {
            $instanceNum = "01";
        }

        $user_id = Auth::user()->id;
           

        $Category = new Category();
        
        $Category->user_id = $user_id; 
        $Category->project_id = $request->project_id;
        $Category->title = $request->title;
        if($request->flotFlor_check == 'f')
        {
           if($i!=1)
            {
                // $empData = Category::latest('id')->first();
                // $empData = $empData->id+1;
                // $Category->title = "Room".$empData;

                $empData1 = Category::where('project_id',$request->project_id)->where('project_revision',$request->project_revision_id)->where('parent_host',"Floor")->count();
                
                $empData1 = $empData1+1;
                if($empData1<10)
                  {
                      $instanceNum = "0".$empData1;
                  }
                else
                {
                    $instanceNum = $empData1;
                }
                $Category->title = "Room".$instanceNum;
            }
            else
            {
                $empData1 = Category::where('project_id',$request->project_id)->where('project_revision',$request->project_revision_id)->where('parent_host',"Floor")->count();
                
                $empData1 = $empData1+1;
                if($empData1<10)
                  {
                      $instanceNum = "0".$empData1;
                  }
                else
                {
                    $instanceNum = $empData1;
                }
                
            }
        }
        else
        {
            if($i!=1)
            {
             $empData1 = Category::where('project_id',$request->project_id)->where('project_revision',$request->project_revision_id)->where('parent_host',"plot")->where('parent_id','!=',0)->count();
                
                $empData1 = $empData1+1;
                if($empData1<10)
                  {
                      $instanceNum = "0".$empData1;
                  }
                else
                {
                    $instanceNum = $empData1;
                }
                $Category->title = "Room".$instanceNum;
            }
            else
            {
                $empData1 = Category::where('project_id',$request->project_id)->where('project_revision',$request->project_revision_id)->where('parent_host',"plot")->where('parent_id','!=',0)->count();
                
                $empData1 = $empData1+1;
                if($empData1<10)
                  {
                      $instanceNum = "0".$empData1;
                  }
                else
                {
                    $instanceNum = $empData1;
                }
                
            }
        }
        //
        $instanceData = Category::where('project_id',$request->input('project_id'))->latest('id')->first();
        if($instanceData){
            $instanceNum = $instanceData->instance_id + 1;
        }else{
            $instanceNum = "1";
        } //
        $Category->instance_id = $instanceNum;
        $Category->project_revision = $request->project_revision_id;
        if($request->flotFlor_check == 'f')
        {
            if($request->parent_id1){
                $floordata =  Category::find($request->parent_id1);
                    
                if($request->flotFlor_check == 'p'){
                    $buildingdata =  Category::where('id', '=', $floordata->id)->get();
                }elseif($request->flotFlor_check == 'f'){
                    
                    if($floordata->parent_id > 0){
                        $buildingdata =  Category::where('id', '=', $floordata->parent_id)->get();
                        
                    }else{
                        $buildingdata =  Category::where('id', '=', $floordata->id)->get();
                    }
                    
                }else{
                    
                    $buildingdata =  Category::where('id', '=', $floordata->id)->get();
                }
                
                $Category->parent_id = $request->parent_id1;
                
                    
            }else{
                   
                $floordata =  Category::find($request->parent_id);
                
                $buildingdata =  Category::where('id', '=', $floordata->parent_id)->get();
                $Category->parent_id = $request->parent_id;
                
            }
        }
        else
        {
            
            if($request->plot_parent){
                $floordata =  Category::find($request->plot_parent);
                    
                if($request->flotFlor_check == 'p'){
                    $buildingdata =  Category::where('id', '=', $floordata->id)->get();
                }elseif($request->flotFlor_check == 'f'){
                    
                    if($floordata->parent_id > 0){
                        $buildingdata =  Category::where('id', '=', $floordata->parent_id)->get();
                        
                    }else{
                        $buildingdata =  Category::where('id', '=', $floordata->id)->get();
                    }
                    
                }else{
                    
                    $buildingdata =  Category::where('id', '=', $floordata->id)->get();
                }
                
                $Category->parent_id = $request->plot_parent;
                
                    
            }else{
                   
                $floordata =  Category::find($request->parent_id);
                
                $buildingdata =  Category::where('id', '=', $floordata->plot_parent)->get();
                $Category->parent_id = $request->plot_parent;
                
            
           }
        }
        //  dd($buildingdata);
           
        $Category->type_name = $request->extroom_type;
        $Category->plot_id = $request->plot_parent;
        $Category->parent_host_csv =$floordata->title;
        $Category->family = 'Room';
        $Category->u_title = uniqid();
        $Category->target_area =  $request->extroom_area;

        if($request->flotFlor_check == 'p'){
            $Category->parent_host = 'Plot';
            $countarea = $buildingdata[0]->width * $buildingdata[0]->length;
            $area = ($countarea / 100) * $request->extroom_area;
        }else{
            $Category->parent_host = 'Floor';
            $area = ($buildingdata[0]->area / 100) * $request->extroom_area;
        }
        $Category->area = $area;

        $Category->save();
        
        

        $rooms = new Room();
        $rooms->floor_id = $Category->id;
        $rooms->room_type = $request->extroom_type;
        $rooms->room_area = $request->extroom_area;
        $rooms->save();
        // order update
        
        $inserted_id = $Category->id; 
        $inserted_id_array[] = $inserted_id;
        
        } // end for loop

        Category::where('parent_id', $request->parent_id1)->update(['sort_order' => 0]);
        $counter =1;
        $floor_data =  Category::where('parent_id', $request->plot_parent)->orderby('id','ASC')->get();

        


        foreach ($floor_data as $key => $val) {
            
            $sort_order = Helper::get_table_record_field('categories',$val->id)->sort_order;
            if($sort_order==0)
            {
                Category::where('id', $val->id)->update(['sort_order' => $counter]);
                if(isset($request->floor_extroom[0]))
                {
                    if($val->id==$request->floor_extroom[0])
                     {
                        foreach ($inserted_id_array as $key => $v) {
                           $counter++;
                            Category::where('id', $v)->update(['sort_order' => $counter]);
                        }
                        
                        
                    }
                }          
                
            }
            $counter++;
            
            
            
        }
        // Multiple Room 
        
        if(count($inserted_id_array)>0)
        {
            foreach ($inserted_id_array as $key => $v) {
                    if(!empty($request->floor_extroom))
                    {
                        foreach ($request->floor_extroom as $key => $val) {
                        $frooms = new FloorRoom();
                        $frooms->room_id = $v;
                        $frooms->room_ids = $val;
                        $frooms->save();
                    }
                    
                }
            }
        }
        
        //exit;
        return back()->with('success', 'New Room added successfully.');

    }

    
    public function updateRoom(Request $request)
    {
        
        $userData = Category::find($request->id);
        $floordata =  Category::where('id', '=', $userData->parent_id)->get();
        
        if($floordata[0]->parent_id > 0){
            $buildingdata =  Category::where('id', '=', $floordata[0]->parent_id)->get();
            $countarea = $buildingdata[0]->width * $buildingdata[0]->length;
            $area = ($countarea / 100) * $request->room_area;
        }else{
            $buildingdata =  Category::where('id', '=', $floordata[0]->id)->get();
            $countarea = $buildingdata[0]->width * $buildingdata[0]->length;
            $area = ($countarea / 100) * $request->room_area;
            
        }
        
        
        
        $area = ($buildingdata[0]->area / 100) * $request->room_area;

        if($request->flotFlor_check == 'p'){
            $userData->parent_host = 'Plot';
        }else{
            $userData->parent_host = 'Floor';
        }
        $userData->title = request('room_title');
        $userData->parent_id = request('parent_id');
        $userData->type_name =request('room_type');
        $userData->target_area = $request->input('room_area');
        $userData->area = $area;
        $userData->save();

 
        $addPlot1 = Room::where('floor_id',$request->floor_id)->get();
        
        $addPlot = Room::find($addPlot1[0]->id);
        $addPlot->room_area = $request->input('room_area');
        $addPlot->room_type = $request->input('room_type');
        $addPlot->save();
        // floor room update

        DB::table('floor_rooms')->where('room_id', $request->id)->delete();
        if($request->pro_room)
        {
            foreach ($request->pro_room as $key => $val) {
                $frooms = new FloorRoom();
                $frooms->room_id = $request->id;
                $frooms->room_ids = $val;
                $frooms->save();
            }
        }

        $inserted_id_array[]= $request->id;
        $counter =1;
        $floor_data =  Category::where('parent_id', $userData->parent_id)->orderby('id','ASC')->get();

        


        foreach ($floor_data as $key => $val) {
            
            $sort_order = Helper::get_table_record_field('categories',$val->id)->sort_order;
            if($sort_order==0)
            {
                Category::where('id', $val->id)->update(['sort_order' => $counter]);
                if(isset($request->floor_extroom[0]))
                {
                    if($val->id==$request->floor_extroom[0])
                     {
                        foreach ($inserted_id_array as $key => $v) {
                           $counter++;
                            Category::where('id', $v)->update(['sort_order' => $counter]);
                        }
                        
                        
                    }
                }          
                
            }
            $counter++;
            
            
            
        }


        return response()->json('data Updated Successfully ');
    }


    public function updateExtRoom(Request $request)
    {
        
        $userData = Category::find($request->id);
        $floordata =  Category::where('id', '=', $userData->parent_id)->get();
        
        if($floordata[0]->parent_id > 0){
            $buildingdata =  Category::where('id', '=', $floordata[0]->parent_id)->get();
            $countarea = $buildingdata[0]->width * $buildingdata[0]->length;
            $area = ($countarea / 100) * $request->room_area;
        }else{
            $buildingdata =  Category::where('id', '=', $floordata[0]->id)->get();
            $countarea = $buildingdata[0]->width * $buildingdata[0]->length;
            $area = ($countarea / 100) * $request->room_area;
            
        }

        
        
        
        $area = ($buildingdata[0]->area / 100) * $request->room_area;

        if($request->flotFlor_check == 'p'){
            $userData->parent_host = 'Plot';
        }else{
            $userData->parent_host = 'Floor';
        }
        $userData->title = request('room_title');
        $userData->parent_id = request('parent_id');
        $userData->type_name =request('room_type');
        $userData->target_area = $request->input('room_area');
        $userData->area = $area;
        $userData->save();
        $inserted_id_array[]= $request->id;
 
        // $addPlot1 = Room::where('floor_id',$request->floor_id)->get();
        
        // $addPlot = Room::find($addPlot1[0]->id);
        // $addPlot->room_area = $request->input('room_area');
        // $addPlot->room_type = $request->input('room_type');
        // $addPlot->save();
        // // floor room update

        // DB::table('floor_rooms')->where('room_id', $request->id)->delete();
        // if($request->pro_room)
        // {
        //     foreach ($request->pro_room as $key => $val) {
        //         $frooms = new FloorRoom();
        //         $frooms->room_id = $request->id;
        //         $frooms->room_ids = $val;
        //         $frooms->save();
        //     }
        // }
        $counter =1;
        $floor_data =  Category::where('parent_id', $userData->parent_id)->orderby('id','ASC')->get();

        


        foreach ($floor_data as $key => $val) {
            
            $sort_order = Helper::get_table_record_field('categories',$val->id)->sort_order;
            if($sort_order==0)
            {
                Category::where('id', $val->id)->update(['sort_order' => $counter]);
                if(isset($request->floor_extroom[0]))
                {
                    if($val->id==$request->floor_extroom[0])
                     {
                        foreach ($inserted_id_array as $key => $v) {
                           $counter++;
                            Category::where('id', $v)->update(['sort_order' => $counter]);
                        }
                        
                        
                    }
                }          
                
            }
            $counter++;
            
            
            
        }


        return response()->json('data Updated Successfully ');
    }


     public function roomType(){
        // echo "HI";exit;
        $data = RoomType::all();
        return view('admin.types.roomType',compact('data'));
    }

     public function addRoomType(Request $request){
    $this->validate($request, [
            'room_type' => 'required',
        ]);

        $input = $request->all();
        // $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];

        RoomType::create($input);
        return back()->with('message', 'New Category added successfully.');
    }

    public function checkParent(Request $request){
        $response = Category::find($request->parent_id);
        return response()->json($response);
    }

    public function getFloorForAddRoom(Request $request){

        $response = Category::where('user_id',$request->user_id)->where('project_id',$request->project_id)->where('family','floor')->get();
        dd($response);
        return response()->json($response);
    }


}
