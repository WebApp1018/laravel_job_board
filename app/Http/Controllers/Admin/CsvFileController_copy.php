<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Auth;
use DB;
use App\Project;
use App\Category;
use App\CSVFile;
use App\Building;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Storage;
use File;
use App\ProjectRevision;
use App\FloorRoom;
use App\Plot;
use App\Room;
class CsvFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportCsv2(Request $request){
        
        
        $user = Auth::user();
        
        $user_info = DB::table('categories')->where('project_id' ,$request->project_id)->first();
        //echo $userid = Helper::get_table_record_field('categories',$request->project_id)->user_id;
        $userid = $user_info->user_id;
        //$userid = $user->id;
    
        //dd($request);
        
        $categories =  Category::select(
                                    "categories.id", 
                                    "categories.project_id", 
                                    "categories.title", 
                                    'categories.type_name',
                                    'categories.parent_host_csv',
                                    'categories.family',
                                    'categories.number_of_floor',
                                    'categories.target_area',
                                    'categories.area',
                                    'categories.floor_number',
                                    'categories.width',
                                    'categories.height',
                                    'categories.length',
                                    'buildings.floor_height',
                                    'categories.parent_id',
                                    'categories.instance_id',
                                   
                    )
                    ->leftJoin("projects", "projects.id", "=", "categories.id")
                    // ->leftJoin("plots", "plots.plot_id", "=", "categories.id")
                    ->leftJoin("buildings", "buildings.id", "=", "categories.parent_id")
                     ->where('categories.project_id', '=', $request->project_id)
                     ->where('categories.project_revision', '=', $request->project_revision_id)
                    ->where('categories.user_id', '=', $userid)->get();
        
        $get_plot_data =  DB::table('plots')->where('plot_id' ,$categories[0]->id)->get();
       
        $get_plot_data =  DB::table('plots')->where('plot_id' ,$categories[0]->id)->get();

        //$path = storage_path('app/public/csv/'.$request->project_id.'_'.$user->name.'');
        //$path = storage_path('csv/'.$request->revesion_id);
        $user_info = DB::table('categories')->where('id' ,$request->project_id)->first();
        
        $user_data = DB::table('users')->where('id' ,$user_info->user_id)->first();
       
        $u_name = Auth::user()->name;
        $path = public_path('storage/csv/'.$request->project_id.'_'.$request->project_revision_id.'_'.$user_data->name.'');
        //echo $request->revesion_id;
        //$path = storage_path('csv/'.$request->project_id.'_'.$csv_counter.'_'.$user->name.'');
        
       
        $fileName = $user->ein.'.csv';
        $file = fopen($path.$fileName, 'w');
        $columns = array('object Name','Project ID','Family Type','Instance ID','Parent Host','Family','Target Area','Area Percentage from parent','length'
            ,'width','Allowed Height','Floor Number','Floor Height','SetBack Distance','Room proximity');
        fputcsv($file, $columns);
         $i = 0;
         
        
      
        // $get = in_array($categories, $get_plot_type);
        $host_instance = '';
        $instance_host = '';
        $data = [];
        $inserted_id_array = '';
        foreach($categories as $key => $category){
            $idddd ='';
            $unique_id = ++$i;
            if($category->parent_id !=0){
                $plot_data_id =  DB::table('categories')->where('id' ,$category->parent_id)->first();
                $idddd =  $plot_data_id->id;
                $instance_host = $plot_data_id->instance_id;
            }else{
                $instance_host = '';
            }
            
            
            // $countArea = $category->width *  $category->height;
            
            // $area = $countArea / $category->number_of_floor;
            //  dd($area);
            $inserted_id_array = "";
            $room_data_id =  DB::table('floor_rooms')->where('room_id' ,$category->id)->get();
                if($room_data_id)
                {
                    foreach ($room_data_id as $key => $val) {
                        $inserted_id_array .= Helper::get_table_record_field('categories',$val->room_ids)->id.",";
                    
                    }
                }
            

            $data = [
                'Object Name' =>$category->title,  
                'Project ID' => $category->project_id,  
                'Family Type' => $category->type_name,
                'Instance ID' => $category->instance_id,
                // 'Parent Host' => $idddd,
                'Parent Host' => $instance_host,
                'Family' => $category->family,
                'Area' => $category->area,
                'Area Percentage from parent' => $category->target_area,
                'length' => $category->length,
                'width' => $category->width,
                'Allowed Height' => $category->height,
                'Floor Number' => $category->floor_number,
                'Floor Height' => $category->number_of_floor,
                'SetBack Distance' => '',
                'Room proximity' => $inserted_id_array
            ];
            
            
            $host_instance =  $unique_id;
            $array = str_replace('"', '', $data);
            
            // $chaild = DB::table('categories')->where('parent_id',$category->id)->get()->toArray();
            // echo "<pre>";
            // print_r($chaild);exit;
            fputcsv($file, $array,);
            
      }
        // fputcsv($file, $data);
        fclose($file);
        $symlink = '/'.$request->project_id.'_'.$user->name.'';
        $revision_id = explode('_', $request->revesion_id);
        //print_r($revision_id);
        //exit;
        $file_newName = $request->project_id.'_'.$revision_id[1].'_'.$user->name.'.csv';
        $file_newName_json = $request->project_id.'_'.$revision_id[1].'_'.$user->name.'.json';
        //$file_newName = $request->revesion_id;
        
        // dd($symlink);
        // $fileModel = new CSVFile;
        // $fileModel->user_id = $user->id;
        // $fileModel->project_id = $request->project_id;
        // $fileModel->name = $user->name;
        // $fileModel->email =$user->email;
        // $fileModel->file_path = $symlink.$fileName;
        // $fileModel->save();
        // return redirect()->route('/admin/');

    
        $myArray = json_decode(json_encode($categories), true);

     //return response()->download("storage/app/public/csv".$fileModel->file_path, $file_newName , $myArray);
       return response()->download(base_path()."/public/storage/csv".$request->revesion_id,$file_newName,$myArray);

}
        public function exportJson2(Request $request){
        
        
        $user = Auth::user();
        $userid = Helper::get_table_record_field('categories',$request->project_id)->user_id;
        $user_info = DB::table('categories')->where('project_id' ,$request->project_id)->first();
        //echo $userid = Helper::get_table_record_field('categories',$request->project_id)->user_id;
        $userid = $user_info->user_id;
        //$userid = $user->id;
        //$userid = $user->id;
    
        //dd($request);
        $categories =  Category::select(
                                    "categories.id", 
                                    "categories.project_id", 
                                    "categories.title", 
                                    'categories.type_name',
                                    'categories.parent_host_csv',
                                    'categories.family',
                                    'categories.number_of_floor',
                                    'categories.target_area',
                                    'categories.area',
                                    'categories.floor_number',
                                    'categories.width',
                                    'categories.height',
                                    'categories.length',
                                    'buildings.floor_height',
                                    'categories.parent_id',
                                    'categories.instance_id',
                                 
                                    
                                   
                    )
                    ->leftJoin("projects", "projects.id", "=", "categories.project_id")
                    // ->leftJoin("plots", "plots.plot_id", "=", "categories.id")
                    ->leftJoin("buildings", "buildings.id", "=", "categories.parent_id")
                     ->where('categories.project_id', '=', $request->project_id)
                     ->where('categories.project_revision', '=', $request->project_revision_id)
                    ->where('categories.user_id', '=', $userid)->get();
        
        $get_plot_data =  DB::table('plots')->where('plot_id' ,$categories[0]->id)->get();
       
        $get_plot_data =  DB::table('plots')->where('plot_id' ,$categories[0]->id)->get();

        //$path = storage_path('app/public/csv/'.$request->project_id.'_'.$user->name.'');
        //$path = storage_path('json/'.$request->revesion_id);
        
        $user_info = DB::table('categories')->where('project_id' ,$request->project_id)->first();
        
        $user_data = DB::table('users')->where('id' ,$user_info->user_id)->first();
       
        $u_name = Auth::user()->name;
        $path = public_path('storage/json/'.$request->project_id.'_'.$request->project_revision_id.'_'.$user_data->name.'');
        
        //echo $request->revesion_id;
        //$path = storage_path('csv/'.$request->project_id.'_'.$csv_counter.'_'.$user->name.'');
        
       
        $fileName = $user->ein.'.json';
        $file = fopen($path.$fileName, 'w');
        // $columns = array('object Name','Project ID','Family Type','Instance ID','Parent Host','Family','Target Area','Area Percentage from parent','length'
        //     ,'width','Allowed Height','Floor Number','Floor Height','SetBack Distance','Room proximity');
        // fputcsv($file, $columns);
         $i = 0;
         
        
      
        // $get = in_array($categories, $get_plot_type);
        $host_instance = '';
        $instance_host = '';
        $data = [];
        $record_data = [];
        $inserted_id_array = '';

        foreach($categories as $key => $category){
            $idddd ='';
            $unique_id = ++$i;
            if($category->parent_id !=0){
                $plot_data_id =  DB::table('categories')->where('id' ,$category->parent_id)->first();
                $idddd =  $plot_data_id->id;
                $instance_host = $plot_data_id->instance_id;
            }else{
                $instance_host = '';
            }
            
            
            // $countArea = $category->width *  $category->height;
            
            // $area = $countArea / $category->number_of_floor;
            //  dd($area);
            
             
            $room_data_id =  DB::table('floor_rooms')->where('room_id' ,$category->id)->get();
            
                if($room_data_id)
                {

                    foreach ($room_data_id as $key => $val) {
                        
                        $inserted_id_array .= Helper::get_table_record_field('categories',$val->room_ids)->id.",";
                    
                    }
                }

            $data = [
                'Object Name' =>$category->title,  
                'Project ID' => $category->project_id,  
                'Family Type' => $category->type_name,
                'Instance ID' => $category->instance_id,
                // 'Parent Host' => $idddd,
                'Parent Host' => $instance_host,
                'Family' => $category->family,
                'Area' => $category->area,
                'Area Percentage from parent' => $category->target_area,
                'length' => $category->length,
                'width' => $category->width,
                'Allowed Height' => $category->height,
                'Floor Number' => $category->floor_number,
                'Floor Height' => $category->number_of_floor,
                'SetBack Distance' => '',
                'Room proximity' => $inserted_id_array
            ];
            
            
            $host_instance =  $unique_id;
            $array = str_replace('"', '', $data);
            
            // $chaild = DB::table('categories')->where('parent_id',$category->id)->get()->toArray();
            // echo "<pre>";
            // print_r($chaild);exit;
            //fputcsv($file, $array,);
            //fputs($file, $array);
            //print_r($array);
            $record_data[] = $array;
      }

        
        file_put_contents($path.$fileName,json_encode($record_data));
        $symlink = '/'.$request->project_id.'_'.$user->name.'';
        $revision_id = explode('_', $request->revesion_id);
        //$file_newName = $request->project_id.'_'.$revision_id[1].'_'.$user->name.'.csv';
        $file_newName_json = $request->project_id.'_'.$revision_id[1].'_'.$user->name.'.json';
        
        $file_json = explode('.', $request->revesion_id);

        $file_json =  $file_json[0].'.json';

        $myArray = json_decode(json_encode($categories), true);
        
     //return response()->download("storage/app/public/csv".$fileModel->file_path, $file_newName , $myArray);
       return response()->download(base_path()."/public/storage/json".$file_json,$file_newName_json,$myArray);

}



        public function exportCsv(Request $request){


            $user = Auth::user();

            $userid = $user->id;


            $categories =  Category::select(
                                        "categories.id", 
                                        "categories.project_id", 
                                        "categories.title", 
                                        'categories.type_name',
                                        'categories.parent_host_csv',
                                        'categories.family',
                                        'categories.number_of_floor',
                                        'categories.target_area',
                                        'categories.area',
                                        'categories.floor_number',
                                        'categories.width',
                                        'categories.height',
                                        'categories.length',
                                        'buildings.floor_height',
                                        'categories.parent_id',
                                        'categories.instance_id',
                                     
                                        
                                       
                                    )
                        ->leftJoin("projects", "projects.id", "=", "categories.id")
                        //->leftJoin("plots", "plots.plot_id", "=", "categories.id")
                        //->leftJoin("rooms", "rooms.floor_id", "=", "categories.id")
                        ->leftJoin("buildings", "buildings.id", "=", "categories.parent_id")
                         ->where('categories.project_id', '=', $request->project_id)
                         ->where('categories.project_revision', '=', $request->project_revision_id)
                        ->where('categories.user_id', '=', $userid)->get();
            
                $get_plot_data =  DB::table('plots')->where('plot_id' ,$categories[0]->id)->get();
           
             $get_plot_data =  DB::table('plots')->where('plot_id' ,$categories[0]->id)->get();
            // create revision
             $csv_counter = Helper::count_record_csv('c_s_v_files',$userid,$request->project_id);
            $csv_counter = $csv_counter+1;
            //
            //$path = storage_path('app/public/csv/'.$request->project_id.'_'.$user->name.'');
            //$path = storage_path('csv/'.$request->project_id.'_'.$csv_counter.'_'.$user->name.'');
            //$path_json = storage_path('json/'.$request->project_id.'_'.$csv_counter.'_'.$user->name.'');
            //$path = storage_path('app/public/storage/csv/');
            $path = public_path('storage/csv/'.$request->project_id.'_'.$csv_counter.'_'.$user->name.'');
            $path_json = public_path('storage/json/'.$request->project_id.'_'.$csv_counter.'_'.$user->name.'');
            // $path = app_path().'/app/public/storage/csv/'.$request->project_id.'_'.$user->name.'';
            //dd($path);

            
            $fileName = $user->ein.'.csv';
            //$fileName = $request->project_id.'_'.$csv_counter.'_'.$user->name.'.csv';
           //echo $path.$fileName;
           //exit;
            $fileName_json = $request->project_id.'_'.$csv_counter.'_'.$user->name.'.json';
            //$fileName_json = $user->ein.'.json';
            $file = fopen($path.$fileName, 'w');
            // New Req
            $csv_counter_prv = Helper::count_record_csv('c_s_v_files',$userid,$request->project_id);
            $path_2 = public_path('storage/csv/'.$request->project_id.'_'.$csv_counter_prv.'_'.$user->name.'');
            if (file_exists( public_path() . '/storage/csv/'.$request->project_id.'_'.$csv_counter_prv.'_'.$user->name.'.csv'))
            {
                $file_pre = fopen($path_2.$fileName, 'w');
                $fileName_json_2 = $request->project_id.'_'.$csv_counter_prv.'_'.$user->name.'.json';
            }

            // if (file_exists( public_path() . '/storage/csv/'.$file_name))
            //     
            // }
            // end here
            //$file_json = fopen($path_json.$fileName_json, 'w');

            $columns = array('object Name','Project ID','Family Type','Instance ID','Parent Host','Family','Target Area','Area Percentage from parent','length'
                ,'width','Allowed Height','Floor Number','Floor Height','SetBack Distance','Room proximity');
            fputcsv($file, $columns);
            if (file_exists( public_path() . '/storage/csv/'.$request->project_id.'_'.$csv_counter_prv.'_'.$user->name.'.csv'))
            {
                fputcsv($file_pre, $columns);
            }
             $i = 0;
             
            
          
            // $get = in_array($categories, $get_plot_type);
            $host_instance = '';
            $new_host = '';
            $data = [];
            $data_json = [];
             $i =1;

            //$project_revision_data = ProjectRevision::where('project_id',$request->project_id)->latest('id')->first();

            $project_counter = Helper::count_record_csv('c_s_v_files',$userid,$request->project_id);
            
            $next_project_revision_id = $project_counter+1;
            

            
            foreach($categories as $category){

                
                $idddd ='';
               
                if($category->parent_id !=0){

                    $plot_data_id =  DB::table('categories')->where('id' ,$category->parent_id)->first();
                    
                    $idddd =  $plot_data_id->id;
                 
                    $instance_host = $plot_data_id->instance_id;

                    //
                    
                    //
                }else{
                    $instance_host = '';
                }
                
                $unique_id = ++$i;
                
                // $countArea = $category->width *  $category->height;
                
                // $area = $countArea / $category->number_of_floor;
                //  dd($area);

                
                // echo "<pre>";
                // print_r($data);
                $inserted_id_array = "";
                
                $room_data_id =  DB::table('floor_rooms')->where('room_id' ,$category->id)->get();
                if($room_data_id)
                {
                    foreach ($room_data_id as $key => $val) {
                        $inserted_id_array .= Helper::get_table_record_field('categories',$val->room_ids)->instance_id.",";

                        
                    //echo $val->room_ids."====";
                       // echo $inserted_id_array;
                    }
                }
                
                $data = [ 
                    'Object Name' =>$category->title,  
                    'Project ID' => $category->project_id,  
                    'Family Type' => $category->type_name,
                    'Instance ID' => $category->instance_id,
                    // 'Parent Host' => $idddd,
                    'Parent Host' => $instance_host,
                    'Family' => $category->family,
                    'Area' => $category->area,
                    'Area Percentage from parent' => $category->target_area,
                    'length' => $category->length,
                    'width' => $category->width,
                    'Allowed Height' => $category->height,
                    'Floor Number' => $category->floor_number,
                    'Floor Height' => $category->number_of_floor,
                    'SetBack Distance' => '',
                    'Room proximity' => rtrim($inserted_id_array,',')
                ];
                
                $array = str_replace('"', '', $data);
                // echo "<pre>";
                // print_r($data);exit;
                fputcsv($file, $array,);
                if (file_exists( public_path() . '/storage/csv/'.$request->project_id.'_'.$csv_counter_prv.'_'.$user->name.'.csv'))
                {
                    fputcsv($file_pre, $array,);
                }
                $data_json[] = $array;
                // print_r($array);
                
                //$cate_title = Helper::get_table_record_field('categories',$category_data->parent_id)->title;
                //
                if($next_project_revision_id!=1)
                {

                    $category_data =  DB::table('categories')->where('id',$category->id)->first();
                    if($category_data->parent_id!=0)
                    {
                        
                        //$category_parent_data =  DB::table('categories')->where('project_id',$category->project_id)->where('project_revision',1)->where('id',$category_data->id)->first();
                        //echo $category_data->parent_id;
                        $cate_title = Helper::get_table_record_field('categories',$category_data->parent_id)->u_title;

                        //echo $cate_title;

                        $category_parent_data =  DB::table('categories')->where('project_id',$category->project_id)->where('project_revision',$next_project_revision_id)->where('u_title',$cate_title)->first();
                       // echo $category_data->parent_id.'____'.$cate_title.'---';
                        
                        $BuildingDuplicate = new Category();
                        $BuildingDuplicate->user_id = $category_data->user_id;
                        $BuildingDuplicate->instance_id = $category_data->instance_id;
                        $BuildingDuplicate->project_id = $category_data->project_id;
                        $BuildingDuplicate->title = $category_data->title;
                        $BuildingDuplicate->u_title = $category_data->u_title;
                        $BuildingDuplicate->parent_id = $category_parent_data->id;
                        if(isset($category_data->building_type))
                        {
                            $category_data->type_name =$category_data->building_type;
                        }
                        $BuildingDuplicate->parent_host = $category_data->parent_host;
                        $BuildingDuplicate->family = $category_data->family;
                        $BuildingDuplicate->number_of_floor = $category_data->number_of_floor;
                        $BuildingDuplicate->target_area = $category_data->target_area;
                        $BuildingDuplicate->area = $category_data->area;
                        $BuildingDuplicate->project_revision = $next_project_revision_id;
                        $BuildingDuplicate->floor_number = $category_data->floor_number;
                        $BuildingDuplicate->floor_type = $category_data->floor_type;
                        $BuildingDuplicate->floor_sort_order = $category_data->floor_sort_order;
                        $BuildingDuplicate->basement_sort_order = $category_data->basement_sort_order;
                        $BuildingDuplicate->sort_order = $category_data->sort_order;
                        $BuildingDuplicate->save();
                        // building
                        
                        if($category_data->parent_host=='plot' || $category_data->parent_host=='Plot')
                        {
                            
                            if($category_data->family!='Room')
                            {
                                $building_data = DB::table('buildings')->where('plot_id',$category->id)->first();
                                $addBuildings = new Building();
                                $addBuildings->plot_id = $BuildingDuplicate->id;
                                $addBuildings->floor_height = $building_data->floor_height;
                                $addBuildings->number_of_floor = $building_data->number_of_floor;
                                $addBuildings->target_area = $building_data->target_area;
                                $addBuildings->area = $building_data->area;
                                $addBuildings->building_type = $building_data->building_type;
                                $addBuildings->save();
                            }
                            else
                            {
                            //echo $category->id.'+++';
                            // Promi
                            $building_data = DB::table('rooms')->where('floor_id',$category->id)->first();
                            $rooms = new Room();
                            $rooms->floor_id = $BuildingDuplicate->id;
                            $rooms->room_type = $building_data->room_type;
                            $rooms->room_area = $building_data->room_area;
                            $rooms->save();

                            // floor room start
                            
                                $room_data_id =  DB::table('floor_rooms')->where('room_id' ,$category->id)->get();
                                if($room_data_id)
                                {

                                    foreach ($room_data_id as $key => $val) {
                                       // $inserted_id_array .= Helper::get_table_record_field('categories',$val->room_ids)->id.",";
                                        $frooms = new FloorRoom();
                                        $frooms->room_id = $BuildingDuplicate->id;
                                       
                                         $cate_title = Helper::get_table_record_field('categories',$val->room_ids)->u_title;
                                       
                                        $category_parent_data =  DB::table('categories')->where('project_id',$category->project_id)->where('project_revision',$next_project_revision_id)->where('u_title',$cate_title)->first();
            
                                        $frooms->room_ids = $category_parent_data->id;
                                        $frooms->save();
                                        //echo $category->id;
                                    }
                                }
                            }
                        }
                        // Room
                        
                        if($category_data->parent_host=='Floor')
                        {
                            $building_data = DB::table('rooms')->where('floor_id',$category->id)->first();
                            $rooms = new Room();
                            $rooms->floor_id = $BuildingDuplicate->id;
                            $rooms->room_type = $building_data->room_type;
                            $rooms->room_area = $building_data->room_area;
                            $rooms->save();

                            // floor room start

                            $room_data_id =  DB::table('floor_rooms')->where('room_id' ,$category->id)->get();
                            if($room_data_id)
                            {

                                foreach ($room_data_id as $key => $val) {
                                   // $inserted_id_array .= Helper::get_table_record_field('categories',$val->room_ids)->id.",";
                                    $frooms = new FloorRoom();
                                    $frooms->room_id = $BuildingDuplicate->id;
                                   // echo $val->room_id;
                                    echo $val->room_ids.'---';
                                    $cate_title = Helper::get_table_record_field('categories',$val->room_ids)->u_title;
                                    echo $cate_title.'------';
                                    $category_parent_data =  DB::table('categories')->where('project_id',$category->project_id)->where('project_revision',$next_project_revision_id)->where('u_title',$cate_title)->first();
        
                                    $frooms->room_ids = $category_parent_data->id;
                                    $frooms->save();
                                    //echo $category->id;
                                }
                            }
                        }
                        
                    }
                    else
                    {
                        $BuildingDuplicate = new Category();
                        $BuildingDuplicate->user_id = $category_data->user_id;
                        $BuildingDuplicate->project_id = $category_data->project_id;
                        $BuildingDuplicate->title = $category_data->title;
                        $BuildingDuplicate->u_title = $category_data->u_title;
                        $BuildingDuplicate->parent_id = $category_data->parent_id;
                        $BuildingDuplicate->instance_id = $category_data->instance_id;
                        if(isset($category_data->building_type))
                        {
                            $BuildingDuplicate->type_name =$category_data->building_type;
                        }
                        $BuildingDuplicate->parent_host = $category_data->parent_host;
                        $BuildingDuplicate->family = $category_data->family;
                        $BuildingDuplicate->number_of_floor = $category_data->number_of_floor;
                        $BuildingDuplicate->target_area = $category_data->target_area;
                        $BuildingDuplicate->area = $category_data->area;
                        $BuildingDuplicate->project_revision = $next_project_revision_id;
                        $BuildingDuplicate->floor_number = $category_data->floor_number;
                        $BuildingDuplicate->save();
                        //

                        $addPlot = new Plot();
                        $addPlot->plot_id = $BuildingDuplicate->id;
                        $addPlot->width = $category_data->width;
                        $addPlot->height = $category_data->height;
                        $addPlot->length = $category_data->length;
                        $addPlot->plot_type_name = $category_data->type_name;
                        $addPlot->save();
                    }
                }
            }
            
            // fputcsv($file, $data);
            fclose($file);
            $symlink = '/'.$request->project_id.'_'.$csv_counter.'_'.$user->name.'';

           
            File::put(public_path('/storage/json/'.$fileName_json), json_encode($data_json));
            if (file_exists( public_path() . '/storage/json/'.$request->project_id.'_'.$csv_counter_prv.'_'.$user->name.'.json'))
            {
                File::put(public_path('/storage/json/'.$fileName_json_2), json_encode($data_json));
            }
            // create file name
            //
              $instanceData1 = CSVFile::where('project_id',$request->project_id)->where('user_id',$user->id)->latest('id')->first();
                if($instanceData1){
                    $instanceNum1 = $instanceData1->id + 1;
                }else{
                    $instanceNum1 = 1;
                }

           
            // dd($symlink);
            $fileModel = new CSVFile;
            $fileModel->user_id = $user->id;
            $fileModel->project_id = $request->project_id;
            $fileModel->name = $user->name;
            $fileModel->email =$user->email;
            $fileModel->project_revision =$next_project_revision_id;
            $fileModel->file_name ="Revision_".$next_project_revision_id;
            $fileModel->file_path = $symlink.$fileName;
            $fileModel->save();
            // Now insert project revion table

            $csv_counter = Helper::get_table_record_field('project_revisions',$userid,$request->project_id);

            $revision_id = ProjectRevision::where('project_id',$request->project_id)->latest('id')->first();
            
            if($next_project_revision_id!=1)
            {
                $pr = new ProjectRevision();
                $pr->project_id =$request->project_id;
                $pr->revision =$next_project_revision_id;
                $pr->save();
            }
           
            
            // return redirect()->route('/admin/');
    } 
  
    public function index()
    {    

         $userid = Auth::user()->id;

         if ($userid == 1) {
             $allcsvFile =  CSVFile::select(
                                        "c_s_v_files.id", 
                                        "c_s_v_files.name",
                                        "c_s_v_files.email", 
                                         "c_s_v_files.created_at", 
                                        "c_s_v_files.updated_at", 
                                        "c_s_v_files.file_path",
                                        "projects.project_name as project_name")
                        ->leftJoin("projects", "projects.id", "=", "c_s_v_files.project_id")
                        ->get();
         }else{
            $allcsvFile =  CSVFile::select(
                                        "c_s_v_files.id", 
                                        "c_s_v_files.name",
                                        "c_s_v_files.project_id",
                                        "c_s_v_files.project_revision",
                                        "c_s_v_files.email", 
                                        "c_s_v_files.created_at", 
                                        "c_s_v_files.updated_at", 
                                        "c_s_v_files.file_path",
                                        "projects.project_name as project_name")
                        ->leftJoin("projects", "projects.id", "=", "c_s_v_files.project_id")
                        ->where('c_s_v_files.user_id', '=', $userid)->get();
          
            
         }
         
            return view('admin.csv.index',compact('allcsvFile'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy(Request $request)
    {
        // dd($request);
        // $this->request->delete($id);

        $project = CSVFile::find($request->id);
        
        $project->delete();

        // return redirect()->route('admin.auth.user.deleted');
       
        return back()->with('message', 'Project deleted  successfully.');

        
    }
}