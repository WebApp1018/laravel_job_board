<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Building;
use App\Helpers\Helper;
use Auth;
use DB;

class FloorController extends Controller
{

      public function addCategory(Request $request)
    {
      $empData = Category::latest('id')->first();
      $empData = $empData->id+1;
    	$lastname = $empData." ".substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 4);
        if($request->input('floor_type')=='a_floor')
        {

          if($request->input('parent_id'))
          {

            $f1 = Category::where('parent_id',$request->input('parent_id'))->where('floor_type',"L")->latest('id')->first();
            if(empty($f1))
            {
                  $floor_title = 'Floor '.$lastname;
                  $sort_order = 1;
                  $floor_number = 0;
            }
            else
            {
                  $f_title = $f1->title;
                  $f_title = trim($f1->title, 'L');
                  
                  $floor_title = (int)$f_title+1;
                  $sort_order = $floor_title;
                  $floor_title = 'Floor '.$lastname;
                  $floor_number = $sort_order;
            }
            $floor_type = "L";
          }
          else
          {

              $f1 = Category::where('parent_id',$request->input('parent_id1'))->where('floor_type',"L")->latest('id')->first();
              if(empty($f1))
              {
                  $floor_title = 'Floor '.$lastname;
                    $sort_order = 1;
              }
              else
              {
                    $f_title = $f1->title;
                    $f_title = trim($f1->title, 'L');
                    
                    $floor_title = (int)$f_title+1;
                    $sort_order = $floor_title;
                    $floor_title = 'Floor '.$lastname;
              }
              $floor_type = "L";

          }
          $basement_sort_order = 10000000;
        }
        
        if($request->input('floor_type')=='b_floor')
        {
          
          if($request->input('parent_id'))
          {
            $f1 = Category::where('parent_id',$request->input('parent_id'))->where('floor_type',"B")->latest('id')->first();
            if(empty($f1))
            {
                  $floor_title = 'Basement '.$lastname;
                  $basement_sort_order = 1;
                  $floor_number = -1;
            }
            else
            {
                  $f_title = $f1->title;
                  $f_title = trim($f1->title, 'B-');
                  
                  $floor_title = (int)$f_title+1;
                   $basement_sort_order = $floor_title;
                   $floor_title = 'Basement '.$lastname;
                  $floor_number = '-'.$basement_sort_order;
            }
            $floor_type = "B";
          }
          else
          {
            $f1 = Category::where('parent_id',$request->input('parent_id1'))->where('floor_type',"B")->latest('id')->first();
            if(empty($f1))
            {
                  $floor_title = 'Basement '.$lastname;
                  $basement_sort_order = 1;
            }
            else
            {
                  $f_title = $f1->title;
                  $f_title = trim($f1->title, 'B-');
                   
                  $floor_title = (int)$f_title+1;
                  $basement_sort_order = $floor_title;
                  $floor_title = 'Basement '.$lastname;
                  
            }
            $floor_type = "B";
          }
          $sort_order = 10000000;
        }
        if($request->input('floor_type')=='r_floor')
        {
            $floor_title = 'Roof '.$lastname;
            $basement_sort_order = 1000000000;
            $floor_number = 10000;
            $floor_type = "";
            $sort_order = 0;
        }
        
        $instanceData = Category::where('project_id',$request->input('project_id'))->latest('id')->first();
        if($instanceData){
            $instanceNum = $instanceData->instance_id + 1;
        }else{
            $instanceNum = "1";
        } 
        
           $get_building= Building::latest()->first();
         
           $get_category_id = Category::where('id', $get_building->plot_id)->latest()->first();
           
        //   dd($get_category_id->title);
          $user_id = Auth::user()->id;

          $addfloor = new Category();
          $addfloor->user_id = $user_id;
          $addfloor->project_id = $request->input('project_id');
          //$addfloor->title =$request->input('title');
          $addfloor->title = $floor_title;
          $addfloor->instance_id =$instanceNum;
          if($request->parent_id1){
          $roomdata =  Category::find($request->parent_id1);
          $addfloor->parent_id = $request->input('parent_id1');
          }else{
           $roomdata =  Category::find($request->parent_id);
           $addfloor->parent_id = $request->input('parent_id');
          }

          $addfloor->parent_host ='Building';
          $addfloor->parent_host_csv = $roomdata->title;
          $addfloor->family = 'Floor';
          $addfloor->u_title = uniqid();
          $addfloor->plot_id = $request->building_parent_id_val;
          $addfloor->floor_number =  $request->floor_number;
          $addfloor->floor_type =  $floor_type;
          $addfloor->floor_sort_order =  $sort_order;
          $addfloor->basement_sort_order =  $basement_sort_order;
          $addfloor->project_revision = $request->project_revision_id;
          $addfloor->floor_number =  $floor_number;
          $addfloor->save();
        return back()->with('success', 'New Floor added successfully.');

    }
    public function updateFloor(Request $request){
          
        //   dd($request);
          $userData = Category::find($request->id);
          $userData->parent_id = request('buildingselectId');   
          $userData->title = request('floor_title');   
          $userData->floor_number = request('floor_number');
          $userData->save();
    }

    public function addFloor(Request $request){
       $user_id = Auth::user()->id;
        $empData = Category::latest('id')->first();
        $groundFloor = $request->input('groundFloor');
        $basement = $request->input('basement');
        // dd($request->all());
        if($request->has('groundFloor')){
          for($i = 1; $i<= count($groundFloor); $i++){
            $empData = Category::latest('id')->first();
            $empData = $empData->id+1;
            $lastname = $empData." ".substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 4);
        
            
            $f1 = Category::where('parent_id',$request->input('parent_id'))->where('floor_type',"L")->latest('id')->first();
            if(empty($f1))
            {
                  $floor_title = 'Floor '.$lastname;
                  $sort_order = 1;
                  $floor_number = 0;
            }else{
                  $f_title = $f1->title;
                  $f_title = trim($f1->title, 'L');
                  
                  $floor_title = (int)$f_title+1;
                  $sort_order = $floor_title;
                  $floor_title = 'Floor '.$lastname;
                  $floor_number = $sort_order;
            }
                $floor_type = "L";
                $basement_sort_order = 10000000;

                $instanceData = Category::where('project_id',$request->input('project_id'))->latest('id')->first();
                if($instanceData){
                    $instanceNum = $instanceData->instance_id + 1;
                }else{
                    $instanceNum = "1";
                } 
    
                $addfloor = new Category();
                $addfloor->user_id = $user_id;
                $addfloor->project_id = $request->input('project_id');
                $addfloor->title = $floor_title;
                $addfloor->instance_id = $instanceNum;
                $addfloor->parent_id = $request->input('building_id');
                $roomdata =  Category::find($addfloor->parent_id);
    
                $addfloor->parent_host ='Building';
                $addfloor->parent_host_csv = $roomdata->title;
                $addfloor->family = 'Floor';
                $addfloor->u_title = uniqid();
    
                $addfloor->plot_id = $request->building_parent_id_val;
                $addfloor->floor_number =  $request->floor_number;  //count number of floor
    
                $addfloor->floor_type =  $floor_type;
                $addfloor->floor_sort_order =  $sort_order;
                $addfloor->basement_sort_order =  $basement_sort_order;
                $addfloor->project_revision = $request->project_revision_id;
                $addfloor->floor_number =  $floor_number;
                $addfloor->save();

          }
        }
        if($request->has('basement')){
          // echo "basement";die;
          for($j = 1; $j<= count($basement); $j++){
              $empData = Category::latest('id')->first();

              $empData = $empData->id+1;
              $lastname = $empData." ".substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 4);
              
              $f1 = Category::where('parent_id',$request->input('parent_id'))->where('floor_type',"B")->latest('id')->first();
              if(empty($f1)){
                    $floor_title = 'Basement '.$lastname;
                    $basement_sort_order = 1;
                    $floor_number = -1;
              }else{
                    $f_title = $f1->title;
                    $f_title = trim($f1->title, 'B-');
                    
                    $floor_title = (int)$f_title+1;
                    $basement_sort_order = $floor_title;
                    $floor_title = 'Basement '.$lastname;
                    $floor_number = '-'.$basement_sort_order;
              }

              $floor_type = "B";
              $instanceData = Category::where('project_id',$request->input('project_id'))->latest('id')->first();
              if($instanceData){
                  $instanceNum = $instanceData->instance_id + 1;
              }else{
                  $instanceNum = "1";
              } 

              $addfloor = new Category();
              $addfloor->user_id = $user_id;
              $addfloor->project_id = $request->input('project_id');
              $addfloor->title = $floor_title;
              $addfloor->instance_id = $instanceNum;
              $addfloor->parent_id = $request->input('building_id');
              $roomdata =  Category::find($addfloor->parent_id);

              $addfloor->parent_host ='Building';
              $addfloor->parent_host_csv = $roomdata->title;
              $addfloor->family = 'basement';
              $addfloor->u_title = uniqid();

              $addfloor->plot_id = $request->building_parent_id_val;
              $addfloor->floor_number =  $request->floor_number;  //count number of floor

              $addfloor->floor_type =  $floor_type;
              $addfloor->floor_sort_order =  $sort_order;
              $addfloor->basement_sort_order =  $basement_sort_order;
              $addfloor->project_revision = $request->project_revision_id;
              $addfloor->floor_number =  $floor_number;
              $addfloor->save();
          }
        }
        if($request->has('roof')){
          $empData = Category::latest('id')->first();
          $empData = $empData->id+1;
         
            $lastname = $empData." ".substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 4);
            $floor_title = 'Roof '.$lastname;
            $basement_sort_order = 1000000000;
            $floor_number = 10000;
            $floor_type = "";
            $sort_order = 0;

            $instanceData = Category::where('project_id',$request->input('project_id'))->latest('id')->first();
            if($instanceData){
                $instanceNum = $instanceData->instance_id + 1;
            }else{
                $instanceNum = "1";
            } 

            $addfloor = new Category();
            $addfloor->user_id = $user_id;
            $addfloor->project_id = $request->input('project_id');
            $addfloor->title = $floor_title;
            $addfloor->instance_id = $instanceNum;
            $addfloor->parent_id = $request->input('building_id');
            $roomdata =  Category::find($addfloor->parent_id);

            $addfloor->parent_host ='Building';
            $addfloor->parent_host_csv = $roomdata->title;
            $addfloor->family = 'roof';
            $addfloor->u_title = uniqid();

            $addfloor->plot_id = $request->building_parent_id_val;
            $addfloor->floor_number =  $request->floor_number;  //count number of floor

            $addfloor->floor_type =  $floor_type;
            $addfloor->floor_sort_order =  $sort_order;
            $addfloor->basement_sort_order =  $basement_sort_order;
            $addfloor->project_revision = $request->project_revision_id;
            $addfloor->floor_number =  $floor_number;
            $addfloor->save();
           
        }
        return redirect()->action([CategoryController::class, 'showProject'], ['id' => $request->project_id,'rid'=>$request->project_revision_id])->with('message', 'New Rerord added successfully');

    }
    public function addFloorWindow(Request $request){

      $dataaa['plot'] =   Category::where('project_revision', '=', $request->rid)->where('project_revision', '=',$request->rid)->where('project_id', '=',$request->pid)
      ->where('family', 'plot')->get();

      $dataaa['buildings'] =  Category::where('project_revision', '=', $request->rid)->where('project_revision', '=',$request->rid)->where('project_id', '=',$request->pid)
      ->where('family', 'Building')->get();
      
      $i=0;
      foreach($dataaa['buildings'] as $buildings){
        $dataaa['buildings'][$i]['floor'] =  Category::where('project_revision', '=', $request->rid)->where('project_revision', '=',$request->rid)->where('project_id', '=',$request->pid)
        ->where('family', 'floor')->where('parent_id', '=',$buildings->id)->get();

        $dataaa['buildings'][$i]['basement'] =  Category::where('project_revision', '=', $request->rid)->where('project_revision', '=',$request->rid)->where('project_id', '=',$request->pid)
        ->where('family', 'basement')->where('parent_id', '=',$buildings->id)->get();

        $dataaa['buildings'][$i]['roof'] =  Category::where('project_revision', '=', $request->rid)->where('project_revision', '=',$request->rid)->where('project_id', '=',$request->pid)
        ->where('family', 'roof')->where('parent_id', '=',$buildings->id)->get();
        
        $i=$i+1;
      }
      
      if(count($dataaa['plot']) <= 0){
        return redirect()-> route('admin.add.plot.window',['pid' => request()->pid,'rid'=>request()->rid])->with('error', "You can't add floor if plot not exist.") ;

      }
      // dd($dataaa['buildings']);
      // die();
      if(count($dataaa['buildings']) > 0){
        // return view('admin.floor_window.addFloorWindow', compact('dataaa'));
        return view('admin.floor_window.editFloorWindow', compact('dataaa'));
      }else{
        return view('admin.floor_window.addFloorWindow', compact('dataaa'));
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

  public function cloneStackedRoom($id, $cloneId){
      $stackedRooms = Category::where('family', 'StackedRoom')->where('parent_id',$cloneId)->get();
      if($stackedRooms){
          foreach($stackedRooms as $stackedRoom){
                $stacked = $stackedRoom->replicate();
                $stacked->instance_id =  $this->instanceNumber($stackedRoom->project_id);
                $stacked->parent_id = $id;
                $stacked->push();
          }
      }
  }
    public function updateFloorWindow(Request $request){

        $user_id = Auth::user()->id;
        $empData = Category::latest('id')->first();
        $groundFloor = $request->input('groundFloor');
        $basement = $request->input('groundbasement');
        // dd($request->all());
        if(isset($groundFloor['no'])){
          for($i = 0; $i <= count($groundFloor['no']); $i++){
            if(!isset($groundFloor['id'][$i]) && isset($groundFloor['no'][$i])){
              
              $empData = Category::latest('id')->first();
              $empData = $empData->id+1;
              $lastname = $empData." ".substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 4);
               $f1 = Category::where('parent_id',$request->input('parent_id'))->where('floor_type',"L")->latest('id')->first();
              if(empty($f1))
              {
                    $floor_title = 'Floor '.$i;
                    $sort_order = 1;
                    $floor_number = $i;
              }else{
                    $f_title = $f1->title;
                    $f_title = trim($f1->title, 'L');
                    
                    $floor_title = (int)$f_title+1;
                    $sort_order = $floor_title;
                    $val = $i + 1; 
                    $floor_title = 'Floor '.$i;
                    $floor_number = $i;
              }
                  $floor_type = "L";
                  $basement_sort_order = 10000000;

      
                  $addfloor = new Category();
                  $addfloor->user_id = $user_id;
                  $addfloor->project_id = $request->input('project_id');
                  $addfloor->title = $floor_title;
                  $addfloor->instance_id =  $this->instanceNumber($request->input('project_id'));
                  $addfloor->parent_id = $request->input('building_id');
                  $roomdata =  Category::find($addfloor->parent_id);
      
                  $addfloor->parent_host ='Building';
                  $addfloor->parent_host_csv = $roomdata->title;
                  $addfloor->family = 'Floor';
                  $addfloor->u_title = uniqid();
      
                  $addfloor->plot_id = $request->building_parent_id_val;
                  $addfloor->floor_number =  $floor_number;  //count number of floor
      
                  $addfloor->floor_type =  $floor_type;
                  $addfloor->floor_sort_order =  $sort_order;
                  $addfloor->basement_sort_order =  $basement_sort_order;
                  $addfloor->project_revision = $request->project_revision_id;
                  $addfloor->save();
                  //clone stacked room
                  if(isset($groundFloor['id'])){
                    $count = count($groundFloor['id']);
                    if($count && $count == $i){
                      $this->cloneStackedRoom($addfloor->id,$groundFloor['id'][0]);  
                    }
                  }else if(isset($groundFloor['no']) && isset($basement['id'])){
                    $this->cloneStackedRoom($addfloor->id,$basement['id'][0]);
                  }else{
                    $this->cloneStackedRoom($addfloor->id,$request->roof_id);
                  }
            }
          }
        }
        if(isset($basement['no'])){
          for($j = 0; $j <= count($basement['no']); $j++){
            if(!isset($basement['id'][$j]) && isset($basement['no'][$j])){
              $empData = Category::latest('id')->first();

              $empData = $empData->id+1;
              $val = $j + 1;
              $floor_title = 'Basement '.$val;
              $basement_sort_order = $floor_title;
                    $floor_number = '-'.$basement_sort_order;
                    $basement_sort_order = $floor_title;
                   
             
              $floor_type = "B";
            

              $addfloor = new Category();
              $addfloor->user_id = $user_id;
              $addfloor->project_id = $request->input('project_id');
              $addfloor->title = $floor_title;
              $addfloor->instance_id = $this->instanceNumber($request->input('project_id'));
              $addfloor->parent_id = $request->input('building_id');
              $roomdata =  Category::find($addfloor->parent_id);

              $addfloor->parent_host ='Building';
              $addfloor->parent_host_csv = $roomdata->title;
              $addfloor->family = 'basement';
              $addfloor->u_title = uniqid();

              $addfloor->plot_id = $request->building_parent_id_val;
              $num = "-".($j+1);

              $addfloor->floor_number =  $num;  //count number of floor

              $addfloor->floor_type =  $floor_type;
              $addfloor->basement_sort_order =  $basement_sort_order;
              $addfloor->project_revision = $request->project_revision_id;
             
              $addfloor->save();
              //clone stacked room
              if(isset($basement['id'])){
                $count = count($basement['id']);
                if($count){
                  $this->cloneStackedRoom($addfloor->id,$basement['id'][0]);  
                }
              }else if(isset($basement['no']) && isset($groundFloor['id'])){
                $this->cloneStackedRoom($addfloor->id,$groundFloor['id'][0]);
              }else{
                $this->cloneStackedRoom($addfloor->id,$request->roof_id);
              }
          }
          // echo "basement5657";die;

        }
      }

        if($request->has('roof') && !$request->has('roof_id')){
            $empData = Category::latest('id')->first();
            $empData = $empData->id+1;
         
            $floor_title = 'Roof '.$request->floor_number;
            $basement_sort_order = 1000000000;
            $floor_number = $request->floor_number;
            $floor_type = "";
            $sort_order = 0;

            $addfloor = new Category();
            $addfloor->user_id = $user_id;
            $addfloor->project_id = $request->input('project_id');
            $addfloor->title = $floor_title;
            $addfloor->instance_id = $this->instanceNumber($request->input('project_id'));
            $addfloor->parent_id = $request->input('building_id');
            $roomdata =  Category::find($addfloor->parent_id);

            $addfloor->parent_host ='Building';
            $addfloor->parent_host_csv = $roomdata->title;
            $addfloor->family = 'roof';
            $addfloor->u_title = uniqid();

            $addfloor->plot_id = $request->building_parent_id_val;
            $addfloor->floor_number =  $request->floor_number;  //count number of floor

            $addfloor->floor_type =  $floor_type;
            $addfloor->floor_sort_order =  $sort_order;
            $addfloor->basement_sort_order =  $basement_sort_order;
            $addfloor->project_revision = $request->project_revision_id;
            $addfloor->save();
            
            if(isset($basement['id']) || isset($groundFloor['id'])){
                if(isset($groundFloor['id'])){
                  $this->cloneStackedRoom($addfloor->id,$groundFloor['id'][0]);  
              
                }else{
                  $this->cloneStackedRoom($addfloor->id,$basement['id'][0]);  
              
                }
            }
        }
        // return redirect()->action([CategoryController::class, 'showProject'], ['id' => $request->project_id,'rid'=>$request->project_revision_id])->with('message', 'New Rerord added successfully');

      return redirect()->action([CategoryController::class, 'showProject'], ['id' => $request->project_id,'rid'=>$request->project_revision_id])->with('message', 'New Rerord added successfully');
 
      return view('admin.floor_window.addFloorWindow', compact('dataaa'));
    }
}
