<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Category;
use App\Plot;
use App\Building;
use DB;
use Auth;
use App\BuildingType;
use App\RoomType;
use App\PlotType;
use App\Room;
use App\User;
use App\Project;
use App\Helpers\Helper;
use App\CSVFile;
use App\UserSetting;
use App\FloorRoom;
use App\SiteSetting;
class CategoryController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function showProjectDemo(Request $request)
    {
        // echo "HI";exit;
        $currenturl = url()->full();
        $getid = explode('/project-trees/demo/', $currenturl);
        // dd($getid);
        $id = Auth::user()->id;
        if ($id == 1) {
            $categories = Category::where('parent_id', '=', 0)
                ->where('project_id', '=', $getid[1])
                ->get();
            $allCategories = Category::get();
            $allPlot = Category::get();
            $buildings = Category::get();
            $floors = Category::where('user_id', '=', $id)->get();
            $buildingType = BuildingType::get();
            $roomType = RoomType::get();
            $plottype = PlotType::get();

            $plottypeSelect = Category::select('categories.id', 'plots.plot_id', 'plots.plot_type_name')
                ->leftJoin('plots', 'categories.id', '=', 'plots.plot_id')
                ->where('categories.user_id', '=', $id)
                ->orderBy('id', 'DESC')
                ->take(1)
                ->get();

            $buildingTypeSelect = Category::select('categories.id', 'buildings.plot_id', 'buildings.building_type')
                ->leftJoin('buildings', 'categories.id', '=', 'buildings.plot_id')
                ->where('categories.user_id', '=', $id)
                ->orderBy('id', 'DESC')
                ->take(1)
                ->get();

            $currenturl = url()->full();
            $projectId = explode('/project-trees/demo/', $currenturl);
            $mydir = 'storage/fbx/';
            $myfiles = array_diff(scandir($mydir), ['.', '..']);

            $csvFile = CSVFile::where('project_id', '=', $projectId[1])->get();

            //   dd('dsds');
            $values = [];
            $valuejs = [];
            $newArray = [];
            foreach ($myfiles as $value) {
                if (empty($newArray[$value[0]])) {
                    $newArray[$value[0]][] = $value[0];
                }
                $newArray[$value[0]][] = $value;
            }
            foreach ($newArray as $key => $value) {
                if ($value[0] == $projectId[1]) {
                    $values = $value;
                    $valuejs = $value[1];
                }
            }

            $objvalues = json_encode($valuejs);
            return view('category.categoryTreeview', compact('categories', 'allCategories', 'allPlot', 'buildings', 'floors', 'buildingType', 'roomType', 'plottype', 'values', 'objvalues', 'plottypeSelect', 'buildingTypeSelect', 'csvFile'));
        } else {
            $categories = Category::where('parent_id', '=', 0)
                ->where('project_id', '=', $getid[1])
                ->get();
            $allCategories = Category::where('user_id', '=', $id)
                ->where('project_id', '=', $getid[1])
                ->get();
            // $allPlot = Category::where('user_id', '=', $id)->where('project_id', '=', $getid[1])->get();
            // $buildings =  Category::where('user_id', '=', $id)->where('project_id', '=', $getid[1])->get();
            // // dd($buildings);exit;
            // $floors =  Category::where('user_id', '=', $id)->where('project_id', '=', $getid[1])->get();
            $allPlot = Category::where('user_id', '=', $id)
                ->where('project_id', '=', $getid[1])
                ->where('parent_id', 0)
                ->get();
            // dd($allPlot);
            $buildings = Category::where('user_id', '=', $id)
                ->where('project_id', '=', $getid[1])
                ->where('parent_host', 'Plot')
                ->get();

            // dd($buildings);
            $floors = Category::where('user_id', '=', $id)
                ->where('project_id', '=', $getid[1])
                ->where('parent_host', 'Building')
                ->get();

            $buildingType = BuildingType::get();
            $roomType = RoomType::get();
            $plottype = PlotType::get();
            $plottypeSelect = Category::select('categories.id', 'plots.plot_id', 'plots.plot_type_name')
                ->leftJoin('plots', 'categories.id', '=', 'plots.plot_id')
                ->where('categories.user_id', '=', $id)
                ->orderBy('id', 'DESC')
                ->take(1)
                ->get();

            $buildingTypeSelect = Category::select('categories.id', 'buildings.plot_id', 'buildings.building_type')
                ->leftJoin('buildings', 'categories.id', '=', 'buildings.plot_id')
                ->where('categories.user_id', '=', $id)
                ->orderBy('id', 'DESC')
                ->take(1)
                ->get();
            // dd($buildingTypeSelect);

            $currenturl = url()->full();
            $projectId = explode('/project-trees/demo/', $currenturl);

            $mydir = 'storage/fbx/';
            $myfiles = array_diff(scandir($mydir), ['.', '..']);

            $csvFile = CSVFile::where('project_id', '=', $projectId[1])->get();

            // $myfileCsv = $myfileCsvs;
            //   dd($csvFile[0]->file_path);
            $values = [];
            $valuejs = [];
            $newArray = [];
            foreach ($myfiles as $value) {
                if (empty($newArray[$value[0]])) {
                    $newArray[$value[0]][] = $value[0];
                }
                $newArray[$value[0]][] = $value;
            }
            foreach ($newArray as $key => $value) {
                if ($value[0] == $projectId[1]) {
                    $values = $value;
                    $valuejs = $value[1];
                }
            }

            $objvalues = json_encode($valuejs);
            return view('category.categoryTreeviewdemo', compact('categories', 'allCategories', 'allPlot', 'buildings', 'floors', 'buildingType', 'roomType', 'plottype', 'values', 'objvalues', 'plottypeSelect', 'buildingTypeSelect', 'csvFile', 'projectId'));
        }
    }
    public function showProject(Request $request)
    {
        $json_files1 = DB::table('json_files')
            ->select('pdf1_file', 'dwg1_file', 'process_fbx', 'process_fbx2', 'process_dwg1', 'process_pdf1', 'fbx1_message', 'manual', 'fbx1_file', 'fbx2_file', 'project_revision', 'fbx2_message', 'dwg1_message', 'pdf1_message')
            ->where('project_id', request()->segment(3))
            ->orderBy('id', 'desc')
            ->first();
        $manual_gen_file = DB::table('manual')
            ->select('manualgen', 'manualgdm', 'manualdwg', 'manualpdf')
            ->where('project_id', request()->segment(3))
            ->first();
        // $fbxfile =  DB::table('json_files')->select('fbx1_file')->where('project_id',request()->segment(3))->first();

        if ($json_files1 != null) {
            $fbxpath = $json_files1->fbx1_file;
            $fbx2path = $json_files1->fbx2_file;
            $pdf1_file = $json_files1->pdf1_file;
            $dwg1_file = $json_files1->dwg1_file;

            $msg = $json_files1->fbx1_message;
            $msg_fbx2 = $json_files1->fbx2_message;
            $msg_dwg = $json_files1->dwg1_message;
            $msg_pdf = $json_files1->pdf1_message;
            $project_revision = $json_files1->project_revision;
            // die($msg." ".$fbxpath." ".$manual_gen." ".$project_revision);
            $process_fbx = $json_files1->process_fbx;
            $process_fbx2 = $json_files1->process_fbx2;
            $process_dwg1 = $json_files1->process_dwg1;
            $process_pdf1 = $json_files1->process_pdf1;
        } else {
            $fbxpath = '';
            $msg = '';
            $msg_fbx2 = '';
            $msg_dwg = '';
            $msg_pdf = '';
            $project_revision = '';
            $fbx2path = '';

            $process_fbx = '';
            $process_fbx2 = '';
            $process_dwg1 = '';
            $process_pdf1 = '';
            $pdf1_file = '';
            $dwg1_file = '';
        }
        if ($manual_gen_file) {
            $manual_gen = $manual_gen_file->manualgen;
            $manual_gdm = $manual_gen_file->manualgdm;
            $manual_dwg = $manual_gen_file->manualdwg;
            $manual_pdf = $manual_gen_file->manualpdf;
        } else {
            $manual_gen = false;
            $manual_gdm = false;
            $manual_dwg = false;
            $manual_pdf = false;
        }

        // if($fbxfile) {
        //     $fbxpath =$json_files1->fbx1_file;
        // }else{
        //     $fbxpath = "";
        // }
        // if($project_record) {
        //     $msg =$json_files1->fbx1_message;
        // }else{
        //     $msg = "";
        // }

        // print_r($manual_gen_file);
        $sitesettings = SiteSetting::first();

        $currenturl = url()->full();
        $getid = explode('/project-trees/', $currenturl);
        $getid = request()->segment(3);
        $get_revision_id = request()->segment(4);
        //dd($getid);
        $id = Auth::user()->id;
        $csv_counter = Helper::count_record_csv('c_s_v_files', $id, $getid);
        $csv_counter = $csv_counter - 1;

        $u_name = Auth::user()->name;
        $project = Project::where('id', $getid)->first();
        $project_name = Helper::get_table_record_field('projects', $getid)->project_name;
        if ($id == 1) {
            $categories = Category::where('parent_id', '=', 0)
                ->where('project_id', '=', $getid)
                ->where('project_revision', '=', $get_revision_id)
                ->get();
            $allCategories = Category::get();
            $allPlot = Category::get();
            $buildings = Category::get();
            $floors = Category::where('user_id', '=', $id)->get();
            $buildingType = BuildingType::get();
            $roomType = RoomType::get();
            $plottype = PlotType::get();

            //  dd($roomType);

            $plottypeSelect = Category::select('categories.id', 'plots.plot_id', 'plots.plot_type_name')
                ->leftJoin('plots', 'categories.id', '=', 'plots.plot_id')
                ->where('categories.user_id', '=', $id)
                ->orderBy('id', 'DESC')
                ->take(1)
                ->get();

            $buildingTypeSelect = Category::select('categories.id', 'buildings.plot_id', 'buildings.building_type')
                ->leftJoin('buildings', 'categories.id', '=', 'buildings.plot_id')
                ->where('categories.user_id', '=', $id)
                ->orderBy('id', 'DESC')
                ->take(1)
                ->get();

            $currenturl = url()->full();
            $projectId = explode('/project-trees/', $currenturl);
            // $mydir = 'public/storage/fbx/';
            $mydir = base_path() . '/storage/fbx/';

            $myfiles = array_diff(scandir($mydir), ['.', '..']);

            $csvFile = CSVFile::where('project_id', '=', $projectId[1])->get();

            //   dd('dsds');
            $values = [];
            $valuejs = [];
            $newArray = [];
            foreach ($myfiles as $value) {
                if (empty($newArray[$value[0]])) {
                    $newArray[$value[0]][] = $value[0];
                }
                $newArray[$value[0]][] = $value;
            }
            foreach ($newArray as $key => $value) {
                if ($value[0] == $projectId[1]) {
                    $values = $value;
                    $valuejs = $value[1];
                }
            }

            $objvalues = json_encode($valuejs);

            $projectId = request()->segment(3);
            $user_project_id = Helper::get_table_record_field('projects', $projectId)->user_id;
            $csc_selectbox = CSVFile::where('project_id', $projectId)->get();

            $generate_button = 'false';
            $plot_button = 'false';
            $building_button = 'false';
            $floor_button = 'false';
            $room_button = 'false';
            //$check_count = Helper::count_record('c_s_v_files',$projectId);

            if (Auth::user()->user_type == 'Free') {
                $userSettingdata = UserSetting::where('type', 'Free')->first();
            } else {
                $userSettingdata = UserSetting::where('type', 'Premium')->first();
            }

            //$user_number_of_try = Helper::get_table_record_field('users',Auth::user()->id)->number_of_try;
            $check_count = Helper::count_record_user('c_s_v_files', 'user_id', $user_project_id);
            $user_number_of_try = $userSettingdata->number_of_try;
            if ($user_number_of_try <= $check_count) {
                $generate_button = 'true';
            }

            //
            //$max_plot_number = Helper::get_table_record_field('users',Auth::user()->id)->max_plot_number;
            $max_plot_number = $userSettingdata->max_plot_number;
            $max_plot_count = Helper::user_max_record_plot('categories', $user_project_id, $projectId, $get_revision_id);

            if ($max_plot_number <= $max_plot_count) {
                $plot_button = 'true';
            }
            //$max_building_number = Helper::get_table_record_field('users',Auth::user()->id)->max_building_number;
            $max_building_number = $userSettingdata->max_building_number;

            $max_building_count = Helper::user_max_record('categories', $user_project_id, $projectId, 'Plot');
            if ($max_building_number <= $max_building_count) {
                $building_button = 'true';
            }
            //$max_floor_number = Helper::get_table_record_field('users',Auth::user()->id)->max_floor_number;
            $max_floor_number = $userSettingdata->max_floor_number;
            $max_floor_count = Helper::user_max_record('categories', $user_project_id, $projectId, 'Building');
            if ($max_floor_number <= $max_floor_count) {
                $floor_button = 'true';
            }
            //$max_room_number = Helper::get_table_record_field('users',Auth::user()->id)->max_room_number;
            $max_room_number = $userSettingdata->max_room_number;
            $max_room_count = Helper::user_max_record('categories', $user_project_id, $projectId, 'Floor');
            if ($max_room_number <= $max_room_count) {
                $room_button = 'true';
            }

            return view('category.categoryTreeview', compact('project', 'csv_counter', 'sitesettings', 'categories', 'allCategories', 'allPlot', 'buildings', 'floors', 'buildingType', 'roomType', 'plottype', 'values', 'objvalues', 'plottypeSelect', 'buildingTypeSelect', 'csvFile', 'project_name', 'csc_selectbox', 'generate_button', 'project_name', 'plot_button', 'building_button', 'floor_button', 'room_button', 'u_name', 'msg', 'manual_gen', 'fbxpath', 'msg_fbx2', 'msg_dwg', 'msg_pdf', 'manual_gdm', 'manual_dwg', 'manual_pdf', 'fbx2path', 'process_fbx', 'process_fbx2', 'process_dwg1', 'process_pdf1', 'pdf1_file', 'dwg1_file'));
        } else {
            $categories = Category::where('parent_id', '=', 0)
                ->where('project_revision', '=', $get_revision_id)
                ->where('project_id', '=', $getid)
                ->orderBy('sort_order', 'ASC')
                ->get();
            //$categories = Category::where('parent_id', '=', 1850)->where('project_id', '=', 42)->get();

            //dd($categories);
            $allCategories = Category::where('user_id', '=', $id)
                ->where('project_revision', '=', $get_revision_id)
                ->where('project_id', '=', $getid)
                ->orderBy('sort_order', 'ASC')
                ->get();

            // $allPlot = Category::where('user_id', '=', $id)->where('project_id', '=', $getid[1])->get();
            // $buildings =  Category::where('user_id', '=', $id)->where('project_id', '=', $getid[1])->get();
            // // dd($buildings);exit;
            // $floors =  Category::where('user_id', '=', $id)->where('project_id', '=', $getid[1])->get();
            $allPlot = Category::where('user_id', '=', $id)
                ->where('project_revision', '=', $get_revision_id)
                ->where('project_id', '=', $getid)
                ->where('parent_id', 0)
                ->get();
            // dd($allPlot);
            $buildings = Category::where('user_id', '=', $id)
                ->where('project_revision', '=', $get_revision_id)
                ->where('project_revision', '=', $get_revision_id)
                ->where('project_id', '=', $getid)
                ->where('family', 'Building')
                ->get();

            // dd($buildings);
            $floors = Category::where('user_id', '=', $id)
                ->where('project_revision', '=', $get_revision_id)
                ->where('project_revision', '=', $get_revision_id)
                ->where('project_id', '=', $getid)
                ->where('parent_host', 'Building')
                ->get();

            $buildingType = BuildingType::get();
            $roomType = RoomType::get();
            $plottype = PlotType::get();
            $plottypeSelect = Category::select('categories.id', 'plots.plot_id', 'plots.plot_type_name')
                ->leftJoin('plots', 'categories.id', '=', 'plots.plot_id')
                ->where('categories.user_id', '=', $id)
                ->orderBy('id', 'DESC')
                ->take(1)
                ->get();

            $buildingTypeSelect = Category::select('categories.id', 'buildings.plot_id', 'buildings.building_type')
                ->leftJoin('buildings', 'categories.id', '=', 'buildings.plot_id')
                ->where('categories.user_id', '=', $id)
                ->orderBy('id', 'DESC')
                ->take(1)
                ->get();
            // dd($buildingTypeSelect);

            $currenturl = url()->full();
            $projectId = explode('/project-trees/', $currenturl);

            $projectId = request()->segment(3);

            $mydir = base_path() . '/storage/fbx/';
            if (!is_dir($mydir)) {
                mkdir($mydir, 0755, true);
            }
            $myfiles = array_diff(scandir($mydir), ['.', '..']);
            //  dd($myfiles);
            $csvFile = CSVFile::where('project_id', '=', $projectId)->get();

            // $myfileCsv = $myfileCsvs;
            //   dd($csvFile[0]->file_path);
            $values = [];
            $valuejs = [];
            $newArray = [];
            foreach ($myfiles as $value) {
                if (empty($newArray[$value[0]])) {
                    $newArray[$value[0]][] = $value[0];
                }
                $newArray[$value[0]][] = $value;
            }
            foreach ($newArray as $key => $value) {
                if ($value[0] == $projectId[1]) {
                    $values = $value;
                    $valuejs = $value[1];
                }
            }

            $objvalues = json_encode($valuejs);

            $csc_selectbox = CSVFile::where('project_id', $projectId)->get();

            $generate_button = 'false';
            $plot_button = 'false';
            $building_button = 'false';
            $floor_button = 'false';
            $room_button = 'false';
            //$check_count = Helper::count_record('c_s_v_files',$projectId);

            if (Auth::user()->user_type == 'Free') {
                $userSettingdata = UserSetting::where('type', 'Free')->first();
            } else {
                $userSettingdata = UserSetting::where('type', 'Premium')->first();
            }

            //$user_number_of_try = Helper::get_table_record_field('users',Auth::user()->id)->number_of_try;
            $check_count = Helper::count_record_user('c_s_v_files', 'user_id', Auth::user()->id);
            $user_number_of_try = $userSettingdata->number_of_try;
            if ($user_number_of_try <= $check_count) {
                $generate_button = 'true';
            }

            //
            //$max_plot_number = Helper::get_table_record_field('users',Auth::user()->id)->max_plot_number;
            $max_plot_number = $userSettingdata->max_plot_number;

            $max_plot_count = Helper::user_max_record_plot('categories', Auth::user()->id, $projectId, $get_revision_id);

            if ($max_plot_number <= $max_plot_count) {
                $plot_button = 'true';
            }
            //$max_building_number = Helper::get_table_record_field('users',Auth::user()->id)->max_building_number;
            $max_building_number = $userSettingdata->max_building_number;

            $max_building_count = Helper::user_max_record_building('categories', Auth::user()->id, $projectId, $get_revision_id, 'Plot');
            if ($max_building_number <= $max_building_count) {
                $building_button = 'true';
            }
            //$max_floor_number = Helper::get_table_record_field('users',Auth::user()->id)->max_floor_number;
            $max_floor_number = $userSettingdata->max_floor_number;
            $max_floor_count = Helper::user_max_record('categories', Auth::user()->id, $projectId, $get_revision_id, 'Building');
            if ($max_floor_number <= $max_floor_count) {
                $floor_button = 'true';
            }
            //$max_room_number = Helper::get_table_record_field('users',Auth::user()->id)->max_room_number;
            $max_room_number = $userSettingdata->max_room_number;
            $max_room_count = Helper::user_max_record_room('categories', Auth::user()->id, $projectId, $get_revision_id);
            if ($max_room_number <= $max_room_count) {
                $room_button = 'true';
            }
            return view('category.categoryTreeview', compact('project', 'sitesettings', 'csv_counter', 'categories', 'allPlot', 'buildings', 'floors', 'buildingType', 'roomType', 'plottype', 'values', 'objvalues', 'plottypeSelect', 'buildingTypeSelect', 'csvFile', 'projectId', 'generate_button', 'csc_selectbox', 'project_name', 'plot_button', 'building_button', 'floor_button', 'room_button', 'u_name', 'msg', 'manual_gen', 'fbxpath', 'msg_fbx2', 'msg_dwg', 'msg_pdf', 'manual_gdm', 'manual_dwg', 'manual_pdf', 'fbx2path', 'process_fbx', 'process_fbx2', 'process_dwg1', 'process_pdf1', 'pdf1_file', 'dwg1_file'));
        }
    }

    public function removeprojectfiles(Request $request)
    {
        $settings = SiteSetting::first();
        $user = Auth::user();

        $userid = $user->id;
        $csv_counter = Helper::count_record_csv('c_s_v_files', $userid, $request->project_id);
        $csv_counter = $csv_counter - 1;
        $file = public_path() . '/' . $settings->fbxfilepath . '/' . $request->project_id . '_' . $csv_counter . '_' . $request->user . '.fbx';
        if (file_exists($file)) {
            unlink($file);
        }
        $file = public_path() . '/' . $settings->pdffilepath . '/' . $request->project_id . '_' . $csv_counter . '_' . $request->user . '.fdf';
        if (file_exists($file)) {
            unlink($file);
        }
        $file = public_path() . '/' . $settings->dwgfilepath . '/' . $request->project_id . '_' . $csv_counter . '_' . $request->user . '.dwg';
        if (file_exists($file)) {
            unlink($file);
        }

        $file = public_path() . '/' . $settings->jsonfilepath . '/' . $request->project_id . '_' . $csv_counter . '_' . $request->user . '.json';
        if (file_exists($file)) {
            unlink($file);
        }

        $file = public_path() . '/' . $settings->csvfilepath . '/' . $request->project_id . '_' . $csv_counter . '_' . $request->user . '.csv';
        if (file_exists($file)) {
            unlink($file);
        }

        $project = Project::where('id', $request->project_id)->first();
        $project->is_locked = 'No';
        $project->save();
        return response()->json('true');
    }

    public function lockfile(Request $request)
    {
        $project = Project::where('id', $request->project_id)->first();
        $project->is_locked = 'Yes';
        $project->save();
        return response()->json('true');
    }
    public function showProject3Dview(Request $request)
    {
        // echo "HI";exit;
        $currenturl = url()->full();
        $getid = explode('/3d-view-model/', $currenturl);

        // dd($getid[1]);
        $id = Auth::user()->id;

        if ($id == 1) {
            // dd($getid[1]);
            $categories = Category::where('parent_id', '=', 0)
                ->where('project_id', '=', $getid[1])
                ->get();
            $allCategories = Category::get();
            $allPlot = Category::get();
            $buildings = Category::get();
            $floors = Category::where('user_id', '=', $id)->get();
            $buildingType = BuildingType::get();
            $roomType = RoomType::get();
            $plottype = PlotType::get();

            $plottypeSelect = Category::select('categories.id', 'plots.plot_id', 'plots.plot_type_name')
                ->leftJoin('plots', 'categories.id', '=', 'plots.plot_id')
                ->where('categories.user_id', '=', $id)
                ->orderBy('id', 'DESC')
                ->take(1)
                ->get();

            $buildingTypeSelect = Category::select('categories.id', 'buildings.plot_id', 'buildings.building_type')
                ->leftJoin('buildings', 'categories.id', '=', 'buildings.plot_id')
                ->where('categories.user_id', '=', $id)
                ->orderBy('id', 'DESC')
                ->take(1)
                ->get();

            $currenturl = url()->full();
            $projectId = explode('/3d-view-model/', $currenturl);
            //$mydir = 'public/storage/fbx/';
            $mydir = base_path() . '/storage/fbx/';
            $myfiles = array_diff(scandir($mydir), ['.', '..']);

            //   dd($myfiles);
            $values = [];
            $valuejs = [];
            $newArray = [];
            foreach ($myfiles as $value) {
                if (empty($newArray[$value[0]])) {
                    $newArray[$value[0]][] = $value[0];
                }
                $newArray[$value[0]][] = $value;
            }
            foreach ($newArray as $key => $value) {
                if ($value[0] == $projectId[1]) {
                    $values = $value;
                    $valuejs = $value[1];
                }
            }

            $objvalues = json_encode($valuejs);
            return view('category.category3Dview', compact('categories', 'allCategories', 'allPlot', 'buildings', 'floors', 'buildingType', 'roomType', 'plottype', 'values', 'objvalues', 'plottypeSelect', 'buildingTypeSelect'));
        } else {
            $categories = Category::where('parent_id', '=', 0)
                ->where('project_id', '=', $getid[1])
                ->get();
            $allCategories = Category::where('user_id', '=', $id)
                ->where('project_id', '=', $getid[1])
                ->get();
            // $allPlot = Category::where('user_id', '=', $id)->where('project_id', '=', $getid[1])->get();
            // $buildings =  Category::where('user_id', '=', $id)->where('project_id', '=', $getid[1])->get();
            // // dd($buildings);exit;
            // $floors =  Category::where('user_id', '=', $id)->where('project_id', '=', $getid[1])->get();
            $allPlot = Category::where('user_id', '=', $id)
                ->where('project_id', '=', $getid[1])
                ->where('parent_id', 0)
                ->get();
            // dd($allPlot);
            $buildings = Category::where('user_id', '=', $id)
                ->where('project_id', '=', $getid[1])
                ->where('parent_host', 'Plot')
                ->get();

            // dd($buildings);
            $floors = Category::where('user_id', '=', $id)
                ->where('project_id', '=', $getid[1])
                ->where('parent_host', 'Building')
                ->get();

            $buildingType = BuildingType::get();
            $roomType = RoomType::get();
            $plottype = PlotType::get();
            $plottypeSelect = Category::select('categories.id', 'plots.plot_id', 'plots.plot_type_name')
                ->leftJoin('plots', 'categories.id', '=', 'plots.plot_id')
                ->where('categories.user_id', '=', $id)
                ->orderBy('id', 'DESC')
                ->take(1)
                ->get();

            $buildingTypeSelect = Category::select('categories.id', 'buildings.plot_id', 'buildings.building_type')
                ->leftJoin('buildings', 'categories.id', '=', 'buildings.plot_id')
                ->where('categories.user_id', '=', $id)
                ->orderBy('id', 'DESC')
                ->take(1)
                ->get();
            // dd($buildingTypeSelect);

            $currenturl = url()->full();
            $projectId = explode('/3d-view-model/', $currenturl);

            //$mydir = base_path().'/public/storage/fbx/';
            $mydir = base_path() . '/storage/fbx/';
            $myfiles = array_diff(scandir($mydir), ['.', '..']);

            //   dd('dsds');
            $values = [];
            $valuejs = [];
            $newArray = [];
            foreach ($myfiles as $value) {
                if (empty($newArray[$value[0]])) {
                    $newArray[$value[0]][] = $value[0];
                }
                $newArray[$value[0]][] = $value;
            }
            foreach ($newArray as $key => $value) {
                if ($value[0] == $projectId[1]) {
                    $values = $value;
                    $valuejs = $value[1];
                }
            }

            $objvalues = json_encode($valuejs);
            return view('category.category3Dview', compact('categories', 'allCategories', 'allPlot', 'buildings', 'floors', 'buildingType', 'roomType', 'plottype', 'values', 'objvalues', 'plottypeSelect', 'buildingTypeSelect'));
        }
    }

    public function manageCategory(Request $request)
    {
        // dd($request);
        if ($request->id) {
            $allPlot = DB::table('categories')
                ->join('plots', 'categories.id', '=', 'plots.plot_id')
                ->where('categories.parent_id', '=', 0)
                ->where('plots.plot_id', '=', $request->id)
                ->get();
            $plotType = PlotType::get();
            $response = [
                'allPlot' => $allPlot,
                'plotType' => $plotType,
            ];
            return response()->json($response);
        } else {
            $categories = Category::where('parent_id', '=', 0)->get();
            $allCategories = Category::all();
            $allPlot = Category::where('parent_id', '=', 0)->get();
            $buildings = Category::where('parent_id', '=', 1)->get();

            $floors = Category::where('parent_id', '=', 2)->get();
            return view('category.categoryTreeview', compact('categories', 'allCategories', 'allPlot', 'buildings', 'floors'));
        }
    }

    public function duplicate(Request $request)
    {
        $roomdata = Category::where('id', $request->room_parent_id)->get();
        // dd($request);
        // check parent host

        $check_parent_host = '';
        $flag = 'true';
        $projectId = $request->project_id;
        //
        if (!empty($request->plot_parent_ids) && !empty($request->building_parent_ids)) {
            echo 'error';
            exit();
        }
        if (Auth::user()->user_type == 'Free') {
            $userSettingdata = UserSetting::where('type', 'Free')->first();
        } else {
            $userSettingdata = UserSetting::where('type', 'Premium')->first();
        }
        //
        if (!empty($request->building_parent_ids)) {
            $flag = 'false';
            $array_parent_host = [];

            for ($i = 0; $i < count($request->building_parent_ids); $i++) {
                $check_parent_host = Helper::get_table_record_field('categories', $request->building_ids[$i])->parent_host;
                $array_parent_host[] = $check_parent_host;
            }
            $allValuesAreTheSame = count(array_unique($array_parent_host)) === 1;
            if ($allValuesAreTheSame == 1) {
                $flag = 'true';
            }
        }
        if ($flag == 'false') {
            echo 'error';
            exit();
        }

        //if(!empty($request->building_parent_ids))

        if ($check_parent_host == 'plot') {
            // bulding duplicate
            $max_building_number = $userSettingdata->max_building_number;
            $user_project_id = Helper::get_table_record_field('projects', $projectId)->user_id;
            $get_revision_id = $request->project_revision_id;
            $max_building_count = Helper::user_max_record_building('categories', $user_project_id, $projectId, $get_revision_id, 'Plot');
            if ($max_building_number <= $max_building_count) {
                echo 'building_er';
                exit();
            }

            for ($i = 0; $i < count($request->building_parent_ids); $i++) {
                $request->building_parent_ids[$i];
                $request->building_ids[$i];

                //echo $request->building_parent_ids[$i].'';
                //echo $request->building_ids[$i]
                $parentBuildingData = Category::join('buildings', 'buildings.plot_id', 'categories.id')
                    ->where('categories.parent_id', $request->building_parent_ids[$i])
                    ->where('categories.id', $request->building_ids[$i])
                    ->get();

                $instanceData1 = Category::where('project_id', $parentBuildingData[0]->project_id)
                    ->latest('id')
                    ->first();
                if ($instanceData1) {
                    $instanceNum1 = $instanceData1->instance_id + 1;
                } else {
                    $instanceNum1 = '1';
                }

                $BuildingDuplicate = new Category();
                $BuildingDuplicate->user_id = $parentBuildingData[0]->user_id;
                $BuildingDuplicate->project_id = $parentBuildingData[0]->project_id;
                $BuildingDuplicate->project_revision = $parentBuildingData[0]->project_revision;
                $BuildingDuplicate->title = $parentBuildingData[0]->title;
                $BuildingDuplicate->parent_id = $parentBuildingData[0]->parent_id;
                $BuildingDuplicate->type_name = $parentBuildingData[0]->building_type;
                $BuildingDuplicate->parent_host = $parentBuildingData[0]->parent_host;
                $BuildingDuplicate->family = $parentBuildingData[0]->family;
                $BuildingDuplicate->number_of_floor = $parentBuildingData[0]->number_of_floor;
                $BuildingDuplicate->target_area = $parentBuildingData[0]->target_area;
                $BuildingDuplicate->instance_id = $instanceNum1;
                $BuildingDuplicate->area = $parentBuildingData[0]->area;
                $BuildingDuplicate->floor_type = $parentBuildingData[0]->floor_type;
                $BuildingDuplicate->floor_sort_order = $parentBuildingData[0]->floor_sort_order;
                $BuildingDuplicate->sort_order = $parentBuildingData[0]->sort_order;
                $BuildingDuplicate->basement_sort_order = $parentBuildingData[0]->basement_sort_order;

                $BuildingDuplicate->u_title = uniqid();

                $BuildingDuplicate->save();

                $BuildingDuplicateBuildingType = new Building();
                $BuildingDuplicateBuildingType->plot_id = $BuildingDuplicate->id;
                $BuildingDuplicateBuildingType->floor_height = $parentBuildingData[0]->floor_height;
                $BuildingDuplicateBuildingType->number_of_floor = $parentBuildingData[0]->number_of_floor;
                $BuildingDuplicateBuildingType->target_area = $parentBuildingData[0]->target_area;
                $BuildingDuplicateBuildingType->building_type = $parentBuildingData[0]->building_type;
                $BuildingDuplicateBuildingType->save();

                $buildingchildDatas1 = Category::where('parent_id', $parentBuildingData[0]->plot_id)->get();

                // $buildingchildDatas2 = [];
                foreach ($buildingchildDatas1 as $buildingchildData1) {
                    $instanceData2 = Category::where('project_id', $buildingchildData1->project_id)
                        ->latest('id')
                        ->first();
                    if ($instanceData2) {
                        $instanceNum2 = $instanceData2->instance_id + 1;
                    } else {
                        $instanceNum2 = '1';
                    }

                    $BuildingDuplicateFloor = new Category();
                    $BuildingDuplicateFloor->user_id = $parentBuildingData[0]->user_id;
                    $BuildingDuplicateFloor->project_id = $parentBuildingData[0]->project_id;
                    $BuildingDuplicateFloor->project_revision = $parentBuildingData[0]->project_revision;
                    $BuildingDuplicateFloor->title = $buildingchildData1->title;
                    $BuildingDuplicateFloor->parent_id = $BuildingDuplicate->id;
                    $BuildingDuplicateFloor->parent_host = $buildingchildData1->parent_host;
                    $BuildingDuplicateFloor->family = $buildingchildData1->family;
                    $BuildingDuplicateFloor->floor_number = $buildingchildData1->floor_number;
                    $BuildingDuplicateFloor->instance_id = $instanceNum2;
                    $BuildingDuplicateFloor->floor_type = $buildingchildData1->floor_type;
                    $BuildingDuplicateFloor->floor_sort_order = $buildingchildData1->floor_sort_order;
                    $BuildingDuplicateFloor->sort_order = $buildingchildData1->sort_order;
                    $BuildingDuplicateFloor->basement_sort_order = $buildingchildData1->basement_sort_order;
                    $BuildingDuplicateFloor->u_title = uniqid();
                    $BuildingDuplicateFloor->save();

                    $buildingchildDatas2 = Category::join('rooms', 'rooms.floor_id', 'categories.id')
                        ->where('categories.parent_id', $buildingchildData1->id)
                        ->get();

                    foreach ($buildingchildDatas2 as $buildingchildData2) {
                        $instanceData3 = Category::where('project_id', $buildingchildData2->project_id)
                            ->latest('id')
                            ->first();
                        if ($instanceData3) {
                            $instanceNum3 = $instanceData3->instance_id + 1;
                        } else {
                            $instanceNum3 = '1';
                        }

                        $BuildingDuplicateRoom = new Category();
                        $BuildingDuplicateRoom->user_id = $parentBuildingData[0]->user_id;
                        $BuildingDuplicateRoom->project_id = $parentBuildingData[0]->project_id;
                        $BuildingDuplicateRoom->title = $buildingchildData2->title;
                        $BuildingDuplicateRoom->parent_id = $BuildingDuplicateFloor->id;
                        $BuildingDuplicateRoom->type_name = $buildingchildData2->room_type;
                        $BuildingDuplicateRoom->parent_host = $buildingchildData2->parent_host;
                        $BuildingDuplicateRoom->family = $buildingchildData2->family;
                        $BuildingDuplicateRoom->target_area = $buildingchildData2->target_area;
                        $BuildingDuplicateRoom->instance_id = $instanceNum3;
                        $BuildingDuplicateRoom->area = $buildingchildData2->area;
                        $BuildingDuplicateRoom->u_title = uniqid();
                        $BuildingDuplicateRoom->floor_type = $buildingchildData2->floor_type;
                        $BuildingDuplicateRoom->floor_sort_order = $buildingchildData2->floor_sort_order;
                        $BuildingDuplicateRoom->basement_sort_order = $buildingchildData2->basement_sort_order;
                        $BuildingDuplicateRoom->duplicate_id = $buildingchildData2->floor_id;
                        $BuildingDuplicateRoom->save();
                        $room_inserted_id = $BuildingDuplicateRoom->id;
                        $BuildingDuplicateRoomType = new Room();
                        $BuildingDuplicateRoomType->floor_id = $BuildingDuplicateRoom->id;
                        $BuildingDuplicateRoomType->room_area = $buildingchildData2->room_area;
                        $BuildingDuplicateRoomType->room_type = $buildingchildData2->room_type;
                        $BuildingDuplicateRoomType->save();

                        $room_data_id = DB::select(
                            "SELECT c.id from categories c inner join
                                               floor_rooms fr ON fr.room_ids = c.duplicate_id
                                               WHERE fr.room_id =" . $buildingchildData2->floor_id,
                        );
                        if ($room_data_id) {
                            //print_r($room_data_id);
                            // die();inner

                            foreach ($room_data_id as $key => $v) {
                                // $inserted_id_array .= Helper::get_table_record_field('categories',$val->room_ids)->id.",";
                                $frooms = new FloorRoom();

                                $frooms->room_id = $room_inserted_id;
                                //$cate_title = Helper::get_table_record_field('categories',$v->room_ids)->u_title;
                                //$category_parent_data =  DB::table('categories')->where('project_id',$parentData[0]->project_id)->where('project_revision',$parentData[0]->project_revision)->where('u_title',$cate_title)->first();
                                $frooms->room_ids = $v->id;
                                $frooms->save();
                                //echo $category->id;
                            }
                        }

                        // $room_data_id =  DB::table('floor_rooms')->where('room_id' ,$buildingchildData2->floor_id)->get();
                        // //echo $buildingchildData2->floor_id.'---';
                        // if($room_data_id)
                        // {

                        //     foreach ($room_data_id as $key => $val) {
                        //        // $inserted_id_array .= Helper::get_table_record_field('categories',$val->room_ids)->id.",";
                        //         $frooms = new FloorRoom();
                        //         $frooms->room_id = $BuildingDuplicateRoom->id;
                        //         $frooms->room_ids = $val->room_ids;
                        //         $frooms->save();
                        //         //echo $category->id;
                        //     }
                        // }
                    }
                }
            } // end for loop
        }
        //else if($request->room_parent_id && $roomdata[0]->parent_host == 'Floor' ){
        elseif ($check_parent_host == 'Floor') {
            //$max_room_number = Helper::get_table_record_field('users',Auth::user()->id)->max_room_number;
            $user_project_id = Helper::get_table_record_field('projects', $projectId)->user_id;
            $get_revision_id = $request->project_revision_id;
            $max_room_number = $userSettingdata->max_room_number;
            $max_room_count = Helper::user_max_record_room('categories', Auth::user()->id, $projectId, $get_revision_id);
            //$max_room_count = Helper::user_max_record('categories',$user_project_id,$projectId,"Floor");
            if ($max_room_number <= $max_room_count) {
                echo 'room_er';
                exit();
            }
            for ($i = 0; $i < count($request->building_parent_ids); $i++) {
                $request->building_parent_ids[$i];
                $request->building_ids[$i];

                //$RoomParentData = Category::join('rooms', 'rooms.floor_id', 'categories.id')->where('categories.id', $request->building_ids[$i])->get();

                //$RoomParentData = Category::join('rooms', 'rooms.floor_id', 'categories.id')->where('categories.id', $request->building_ids[$i])->get();
                $RoomParentData = Category::where('id', $request->building_ids[$i])->get();
                $instanceData4 = Category::where('project_id', $RoomParentData[0]->project_id)
                    ->latest('id')
                    ->first();

                $RoomParentData1 = Category::join('rooms', 'rooms.floor_id', 'categories.id')
                    ->where('categories.id', $request->room_parent_id)
                    ->get();

                if ($instanceData4) {
                    $instanceNum4 = $instanceData4->instance_id + 1;
                } else {
                    $instanceNum4 = '1';
                }

                $RoomDuplicateRoom = new Category();
                $RoomDuplicateRoom->user_id = $RoomParentData[0]->user_id;
                $RoomDuplicateRoom->project_id = $RoomParentData[0]->project_id;
                $RoomDuplicateRoom->project_revision = $RoomParentData[0]->project_revision;
                $RoomDuplicateRoom->title = $RoomParentData[0]->title;
                $RoomDuplicateRoom->parent_id = $RoomParentData[0]->parent_id;
                $RoomDuplicateRoom->type_name = $RoomParentData[0]->room_type;
                $RoomDuplicateRoom->parent_host = $RoomParentData[0]->parent_host;
                $RoomDuplicateRoom->family = $RoomParentData[0]->family;
                $RoomDuplicateRoom->target_area = $RoomParentData[0]->target_area;
                $RoomDuplicateRoom->area = $RoomParentData[0]->area;
                $RoomDuplicateRoom->instance_id = $instanceNum4;
                $RoomDuplicateRoom->floor_type = $RoomParentData[0]->floor_type;
                $RoomDuplicateRoom->floor_sort_order = $RoomParentData[0]->floor_sort_order;
                $RoomDuplicateRoom->basement_sort_order = $RoomParentData[0]->basement_sort_order;

                $RoomDuplicateRoom->u_title = uniqid();

                $RoomDuplicateRoom->duplicate_id = $RoomParentData1[0]->floor_id;

                $RoomDuplicateRoom->save();
                $room_inserted_id = $RoomDuplicateRoom->id;
                $RoomDuplicateRoomType = new Room();
                $RoomDuplicateRoomType->floor_id = $RoomDuplicateRoom->id;
                $RoomDuplicateRoomType->room_area = $RoomParentData[0]->room_area;
                $RoomDuplicateRoomType->room_type = $RoomParentData[0]->room_type;
                $RoomDuplicateRoomType->save();
                // Floor Room
                $room_data_id = DB::select(
                    "SELECT c.id from categories c inner join
                                               floor_rooms fr ON fr.room_ids = c.duplicate_id
                                               WHERE fr.room_id =" . $RoomParentData1[0]->floor_id,
                );
                if ($room_data_id) {
                    //print_r($room_data_id);
                    // die();inner

                    foreach ($room_data_id as $key => $v) {
                        // $inserted_id_array .= Helper::get_table_record_field('categories',$val->room_ids)->id.",";
                        $frooms = new FloorRoom();

                        $frooms->room_id = $room_inserted_id;
                        //$cate_title = Helper::get_table_record_field('categories',$v->room_ids)->u_title;
                        //$category_parent_data =  DB::table('categories')->where('project_id',$parentData[0]->project_id)->where('project_revision',$parentData[0]->project_revision)->where('u_title',$cate_title)->first();
                        $frooms->room_ids = $v->id;
                        $frooms->save();
                        //echo $category->id;
                    }
                }
                // $room_data_id =  DB::table('floor_rooms')->where('room_id' ,$RoomParentData[0]->id)->get();
                //  if($room_data_id)
                //  {

                //      foreach ($room_data_id as $key => $val) {
                //         // $inserted_id_array .= Helper::get_table_record_field('categories',$val->room_ids)->id.",";
                //          $frooms = new FloorRoom();
                //          $frooms->room_id = $RoomDuplicateRoom->id;
                //          $frooms->room_ids = $val->room_ids;
                //          $frooms->save();
                //          //echo $category->id;
                //      }
                //  }
            } // end for loop
        } elseif ($request->room_parent_id && $roomdata[0]->parent_host == 'Plot') {
            $RoomParentData = Category::join('rooms', 'rooms.floor_id', 'categories.id')
                ->where('categories.id', $request->room_parent_id)
                ->get();
            // dd($RoomParentData);

            $instanceData4 = Category::where('project_id', $RoomParentData[0]->project_id)
                ->latest('id')
                ->first();
            if ($instanceData4) {
                $instanceNum4 = $instanceData4->instance_id + 1;
            } else {
                $instanceNum4 = '1';
            }

            $RoomDuplicateRoom = new Category();
            $RoomDuplicateRoom->user_id = $RoomParentData[0]->user_id;
            $RoomDuplicateRoom->project_id = $RoomParentData[0]->project_id;
            $RoomParentData->project_revision = $RoomParentData[0]->project_revision;
            $RoomDuplicateRoom->title = $RoomParentData[0]->title;
            $RoomDuplicateRoom->parent_id = $RoomParentData[0]->parent_id;
            $RoomDuplicateRoom->type_name = $RoomParentData[0]->room_type;
            $RoomDuplicateRoom->parent_host = $RoomParentData[0]->parent_host;
            $RoomDuplicateRoom->family = $RoomParentData[0]->family;
            $RoomDuplicateRoom->target_area = $RoomParentData[0]->target_area;
            $RoomDuplicateRoom->area = $RoomParentData[0]->area;
            $RoomDuplicateRoom->instance_id = $instanceNum4;
            $RoomDuplicateRoom->u_title = uniqid();
            $RoomDuplicateRoom->floor_type = $RoomParentData[0]->floor_type;
            $RoomDuplicateRoom->floor_sort_order = $RoomParentData[0]->floor_sort_order;
            $RoomDuplicateRoom->basement_sort_order = $RoomParentData[0]->basement_sort_order;
            $RoomDuplicateRoom->duplicate_id = $RoomParentData[0]->id;
            $RoomDuplicateRoom->save();
            $room_inserted_id = $RoomDuplicateRoom->id;
            $RoomDuplicateRoomType = new Room();
            $RoomDuplicateRoomType->floor_id = $RoomDuplicateRoom->id;
            $RoomDuplicateRoomType->room_area = $RoomParentData[0]->room_area;
            $RoomDuplicateRoomType->room_type = $RoomParentData[0]->room_type;
            $RoomDuplicateRoomType->save();

            $room_data_id = DB::select(
                "SELECT c.id from categories c inner join
                                               floor_rooms fr ON fr.room_ids = c.duplicate_id
                                               WHERE fr.room_id =" . $RoomParentData[0]->id,
            );
            if ($room_data_id) {
                //print_r($room_data_id);
                // die();inner

                foreach ($room_data_id as $key => $v) {
                    // $inserted_id_array .= Helper::get_table_record_field('categories',$val->room_ids)->id.",";
                    $frooms = new FloorRoom();

                    $frooms->room_id = $room_inserted_id;
                    //$cate_title = Helper::get_table_record_field('categories',$v->room_ids)->u_title;
                    //$category_parent_data =  DB::table('categories')->where('project_id',$parentData[0]->project_id)->where('project_revision',$parentData[0]->project_revision)->where('u_title',$cate_title)->first();
                    $frooms->room_ids = $v->id;
                    $frooms->save();
                    //echo $category->id;
                }
            }

            // $room_data_id =  DB::table('floor_rooms')->where('room_id' ,$RoomParentData[0]->id)->get();
            //         if($room_data_id)
            //         {

            //             foreach ($room_data_id as $key => $val) {
            //                // $inserted_id_array .= Helper::get_table_record_field('categories',$val->room_ids)->id.",";
            //                 $frooms = new FloorRoom();
            //                 $frooms->room_id = $RoomDuplicateRoom->id;
            //                 $frooms->room_ids = $val->room_ids;
            //                 $frooms->save();
            //                 //echo $category->id;
            //             }
            //         }
        }
        //else if($request->floor_parent_id){
        elseif ($check_parent_host == 'Building') {
            //$max_floor_number = Helper::get_table_record_field('users',Auth::user()->id)->max_floor_number;
            $max_plot_number = $userSettingdata->max_plot_number;
            $projectId = $request->project_id;
            $user_project_id = Helper::get_table_record_field('projects', $projectId)->user_id;
            $get_revision_id = $request->project_revision_id;
            $max_floor_number = $userSettingdata->max_floor_number;
            //$max_floor_count = Helper::user_max_record('categories',$user_project_id,$projectId,"Building");
            $max_floor_count = Helper::user_max_record('categories', Auth::user()->id, $projectId, $get_revision_id, 'Building');
            if ($max_floor_number <= $max_floor_count) {
                echo 'floor_er';
                exit();
            }
            // floor duplicate

            for ($i = 0; $i < count($request->building_parent_ids); $i++) {
                $request->building_parent_ids[$i];
                $request->building_ids[$i];

                $BuildingData = Category::find($request->building_parent_ids[$i]);

                $FloorParentData = Category::where('id', $request->building_ids[$i])->get();

                $instanceData5 = Category::where('project_id', $FloorParentData[0]->project_id)
                    ->latest('id')
                    ->first();
                if ($instanceData5) {
                    $instanceNum5 = $instanceData5->instance_id + 1;
                } else {
                    $instanceNum5 = '1';
                }
                //

                if ($FloorParentData[0]->floor_type == 'L') {
                    $f1 = Category::where('parent_id', $request->building_parent_ids[$i])
                        ->where('floor_type', 'L')
                        ->latest('id')
                        ->first();

                    $f_title = $f1->title;
                    $f_title = trim($f1->title, 'L');

                    $floor_title = (int) $f_title + 1;
                    $sort_order = $floor_title;
                    $floor_title = 'L' . $floor_title;
                    $floor_number = $sort_order;
                    $floor_type = 'L';
                    $basement_sort_order = 10000000;
                } else {
                    // dd($request->building_parent_ids[$i]);
                    $f1 = Category::where('parent_id', $request->building_parent_ids[$i])
                        ->where('floor_type', 'B')
                        ->latest('id')
                        ->first();

                    $f_title = $f1->title;
                    $f_title = trim($f1->title, 'B-');
                    $floor_title = (int) $f_title + 1;
                    $basement_sort_order = $floor_title;
                    $floor_title = 'B-' . $floor_title;
                    $floor_number = '-' . $basement_sort_order;
                    $floor_type = 'B';
                    $sort_order = 10000000;
                }

                //
                $FloorDuplicateFloor = new Category();
                $FloorDuplicateFloor->user_id = $FloorParentData[0]->user_id;
                $FloorDuplicateFloor->project_id = $FloorParentData[0]->project_id;
                $FloorDuplicateFloor->project_revision = $FloorParentData[0]->project_revision;
                $FloorDuplicateFloor->title = $floor_title;
                $FloorDuplicateFloor->parent_id = $BuildingData->id;
                $FloorDuplicateFloor->parent_host = $FloorParentData[0]->parent_host;
                $FloorDuplicateFloor->family = $FloorParentData[0]->family;
                $FloorDuplicateFloor->floor_number = $floor_number;
                $FloorDuplicateFloor->instance_id = $instanceNum5;
                $FloorDuplicateFloor->floor_type = $floor_type;
                $FloorDuplicateFloor->floor_sort_order = $sort_order;
                $FloorDuplicateFloor->basement_sort_order = $basement_sort_order;
                $FloorDuplicateFloor->u_title = uniqid();
                $FloorDuplicateFloor->save();

                $FloorchildDatas = Category::join('rooms', 'rooms.floor_id', 'categories.id')
                    ->where('categories.parent_id', $FloorParentData[0]->id)
                    ->get();

                foreach ($FloorchildDatas as $FloorchildData) {
                    $instanceData6 = Category::where('project_id', $FloorchildData->project_id)
                        ->latest('id')
                        ->first();
                    if ($instanceData6) {
                        $instanceNum6 = $instanceData6->instance_id + 1;
                    } else {
                        $instanceNum6 = '1';
                    }

                    $RoomDuplicateRoom = new Category();
                    $RoomDuplicateRoom->user_id = $FloorchildData->user_id;
                    $RoomDuplicateRoom->project_id = $FloorchildData->project_id;
                    $RoomDuplicateRoom->project_revision = $FloorchildData->project_revision;
                    $RoomDuplicateRoom->title = $FloorchildData->title;
                    $RoomDuplicateRoom->parent_id = $FloorDuplicateFloor->id;
                    $RoomDuplicateRoom->type_name = $FloorchildData->room_type;
                    $RoomDuplicateRoom->parent_host = $FloorchildData->parent_host;
                    $RoomDuplicateRoom->family = $FloorchildData->family;
                    $RoomDuplicateRoom->target_area = $FloorchildData->target_area;
                    $RoomDuplicateRoom->area = $FloorchildData->area;
                    $RoomDuplicateRoom->instance_id = $instanceNum6;
                    $RoomDuplicateRoom->u_title = uniqid();

                    $RoomDuplicateRoom->duplicate_id = $FloorchildData->floor_id;
                    $RoomDuplicateRoom->save();

                    $room_inserted_id = $RoomDuplicateRoom->id;

                    $FloorDuplicateRoomType = new Room();
                    $FloorDuplicateRoomType->floor_id = $RoomDuplicateRoom->id;
                    $FloorDuplicateRoomType->room_area = $FloorchildData->room_area;
                    $FloorDuplicateRoomType->room_type = $FloorchildData->room_type;
                    $FloorDuplicateRoomType->save();

                    $room_data_id = DB::select(
                        "SELECT c.id from categories c inner join
                                               floor_rooms fr ON fr.room_ids = c.duplicate_id
                                               WHERE fr.room_id =" . $FloorchildData->floor_id,
                    );
                    // exit;
                    if ($room_data_id) {
                        //print_r($room_data_id);
                        // die();inner

                        foreach ($room_data_id as $key => $v) {
                            // $inserted_id_array .= Helper::get_table_record_field('categories',$val->room_ids)->id.",";
                            $frooms = new FloorRoom();

                            $frooms->room_id = $room_inserted_id;
                            //$cate_title = Helper::get_table_record_field('categories',$v->room_ids)->u_title;
                            //$category_parent_data =  DB::table('categories')->where('project_id',$parentData[0]->project_id)->where('project_revision',$parentData[0]->project_revision)->where('u_title',$cate_title)->first();
                            $frooms->room_ids = $v->id;
                            $frooms->save();
                            //echo $category->id;
                        }
                    }
                }
            } // end for loop
        } else {
            // Multiple plot

            $max_plot_number = $userSettingdata->max_plot_number;
            $projectId = $request->project_id;
            $project_revision_id = $request->project_revision_id;

            $user_project_id = Helper::get_table_record_field('projects', $projectId)->user_id;

            $max_plot_count = Helper::user_max_record_plot('categories', $user_project_id, $projectId, $project_revision_id);

            if ($max_plot_number <= $max_plot_count) {
                echo 'plot_er';
                exit();
            }

            foreach ($request->plot_parent_ids as $key => $val) {
                //$parentData = Category::join('plots', 'plots.plot_id', 'categories.id')->where('categories.id',$request->plot_parent_id)->get();
                $parentData = Category::join('plots', 'plots.plot_id', 'categories.id')
                    ->where('categories.id', $val)
                    ->get();

                // dd($parentData);
                $instanceData7 = Category::where('project_id', $parentData[0]->project_id)
                    ->latest('id')
                    ->first();
                if ($instanceData7) {
                    $instanceNum7 = $instanceData7->instance_id + 1;
                } else {
                    $instanceNum7 = '1';
                }

                $plotDuplicate = new Category();
                $plotDuplicate->user_id = $parentData[0]->user_id;
                $plotDuplicate->project_id = $parentData[0]->project_id;
                $plotDuplicate->project_revision = $parentData[0]->project_revision;
                $plotDuplicate->title = $parentData[0]->title;
                $plotDuplicate->parent_id = $parentData[0]->parent_id;
                $plotDuplicate->type_name = $parentData[0]->plot_type_name;
                $plotDuplicate->parent_host = $parentData[0]->parent_host;
                $plotDuplicate->family = $parentData[0]->family;
                $plotDuplicate->width = $parentData[0]->width;
                $plotDuplicate->height = $parentData[0]->height;
                $plotDuplicate->instance_id = $instanceNum7;
                $plotDuplicate->length = $parentData[0]->length;
                $plotDuplicate->floor_type = $parentData[0]->floor_type;
                $plotDuplicate->floor_sort_order = $parentData[0]->floor_sort_order;
                $plotDuplicate->basement_sort_order = $parentData[0]->basement_sort_order;

                $plotDuplicate->u_title = uniqid();
                $plotDuplicate->save();

                $plotDuplicatePlot = new Plot();
                $plotDuplicatePlot->plot_id = $plotDuplicate->id;
                $plotDuplicatePlot->width = $parentData[0]->width;
                $plotDuplicatePlot->height = $parentData[0]->height;
                $plotDuplicatePlot->length = $parentData[0]->length;
                $plotDuplicatePlot->plot_type_name = $parentData[0]->plot_type_name;
                $plotDuplicatePlot->save();

                $childDatas1 = Category::join('buildings', 'buildings.plot_id', 'categories.id')
                    ->where('categories.parent_id', $parentData[0]->plot_id)
                    ->get();

                $childDatas2 = [];
                foreach ($childDatas1 as $childData1) {
                    $instanceData8 = Category::where('project_id', $childData1->project_id)
                        ->latest('id')
                        ->first();
                    if ($instanceData8) {
                        $instanceNum8 = $instanceData8->instance_id + 1;
                    } else {
                        $instanceNum8 = '1';
                    }
                    $plotDuplicateBuilding = new Category();
                    $plotDuplicateBuilding->user_id = $parentData[0]->user_id;
                    $plotDuplicateBuilding->project_id = $parentData[0]->project_id;
                    $plotDuplicateBuilding->project_revision = $parentData[0]->project_revision;
                    $plotDuplicateBuilding->title = $childData1->title;
                    $plotDuplicateBuilding->parent_id = $plotDuplicate->id;
                    $plotDuplicateBuilding->type_name = $childData1->building_type;
                    $plotDuplicateBuilding->parent_host = $childData1->parent_host;
                    $plotDuplicateBuilding->family = $childData1->family;
                    $plotDuplicateBuilding->number_of_floor = $childData1->number_of_floor;
                    $plotDuplicateBuilding->target_area = $childData1->target_area;
                    $plotDuplicateBuilding->area = $childData1->area;
                    $plotDuplicateBuilding->instance_id = $instanceNum8;
                    $plotDuplicateBuilding->u_title = uniqid();
                    $plotDuplicateBuilding->floor_type = $childData1->floor_type;
                    $plotDuplicateBuilding->floor_sort_order = $childData1->floor_sort_order;
                    $plotDuplicateBuilding->basement_sort_order = $childData1->basement_sort_order;

                    $plotDuplicateBuilding->save();

                    $plotDuplicateBuildingType = new Building();
                    $plotDuplicateBuildingType->plot_id = $plotDuplicateBuilding->id;
                    $plotDuplicateBuildingType->floor_height = $childData1->floor_height;
                    $plotDuplicateBuildingType->number_of_floor = $childData1->number_of_floor;
                    $plotDuplicateBuildingType->target_area = $childData1->target_area;
                    $plotDuplicateBuildingType->building_type = $childData1->building_type;
                    $plotDuplicateBuildingType->save();

                    $childDatas2 = Category::where('parent_id', $childData1->plot_id)->get();

                    //   $childDatas3 = [];
                    foreach ($childDatas2 as $childData2) {
                        $instanceData9 = Category::where('project_id', $childData2->project_id)
                            ->latest('id')
                            ->first();
                        if ($instanceData9) {
                            $instanceNum9 = $instanceData9->instance_id + 1;
                        } else {
                            $instanceNum9 = '1';
                        }

                        $plotDuplicateFloor = new Category();
                        $plotDuplicateFloor->user_id = $parentData[0]->user_id;
                        $plotDuplicateFloor->project_id = $parentData[0]->project_id;
                        $plotDuplicateFloor->project_revision = $parentData[0]->project_revision;
                        $plotDuplicateFloor->title = $childData2->title;
                        $plotDuplicateFloor->parent_id = $plotDuplicateBuilding->id;
                        $plotDuplicateFloor->parent_host = $childData2->parent_host;
                        $plotDuplicateFloor->family = $childData2->family;
                        $plotDuplicateFloor->floor_number = $childData2->floor_number;
                        $plotDuplicateFloor->instance_id = $instanceNum9;
                        $plotDuplicateFloor->floor_type = $childData2->floor_type;
                        $plotDuplicateFloor->floor_sort_order = $childData2->floor_sort_order;
                        $plotDuplicateFloor->basement_sort_order = $childData2->basement_sort_order;

                        $plotDuplicateFloor->u_title = uniqid();
                        $plotDuplicateFloor->save();

                        $childDatas3 = Category::join('rooms', 'rooms.floor_id', 'categories.id')
                            ->where('categories.parent_id', $childData2->id)
                            ->get();

                        foreach ($childDatas3 as $childData3) {
                            $instanceData10 = Category::where('project_id', $childData3->project_id)
                                ->latest('id')
                                ->first();
                            if ($instanceData10) {
                                $instanceNum10 = $instanceData10->instance_id + 1;
                            } else {
                                $instanceNum10 = '1';
                            }

                            $plotDuplicateRoom = new Category();
                            $plotDuplicateRoom->user_id = $parentData[0]->user_id;
                            $plotDuplicateRoom->project_id = $parentData[0]->project_id;
                            $plotDuplicateRoom->project_revision = $parentData[0]->project_revision;
                            $plotDuplicateRoom->title = $childData3->title;
                            $plotDuplicateRoom->parent_id = $plotDuplicateFloor->id;
                            $plotDuplicateRoom->type_name = $childData3->room_type;
                            $plotDuplicateRoom->parent_host = $childData3->parent_host;
                            $plotDuplicateRoom->family = $childData3->family;
                            $plotDuplicateRoom->target_area = $childData3->target_area;
                            $plotDuplicateRoom->instance_id = $instanceNum10;
                            $plotDuplicateRoom->area = $childData3->area;
                            $plotDuplicateRoom->u_title = uniqid();
                            $plotDuplicateRoom->floor_type = $childData3->floor_type;
                            $plotDuplicateRoom->floor_sort_order = $childData3->floor_sort_order;
                            $plotDuplicateRoom->basement_sort_order = $childData3->basement_sort_order;
                            ///
                            $plotDuplicateRoom->duplicate_id = $childData3->floor_id;
                            ///
                            $plotDuplicateRoom->save();

                            $room_inserted_id = $plotDuplicateRoom->id;

                            $plotDuplicateRoomType = new Room();
                            $plotDuplicateRoomType->floor_id = $plotDuplicateRoom->id;
                            $plotDuplicateRoomType->room_area = $childData3->room_area;
                            $plotDuplicateRoomType->room_type = $childData3->room_type;
                            $plotDuplicateRoomType->save();

                            $room_data_id = DB::select(
                                "SELECT c.id from categories c inner join
                                               floor_rooms fr ON fr.room_ids = c.duplicate_id
                                               WHERE fr.room_id =" . $childData3->floor_id,
                            );
                            if ($room_data_id) {
                                //print_r($room_data_id);
                                // die();inner

                                foreach ($room_data_id as $key => $v) {
                                    // $inserted_id_array .= Helper::get_table_record_field('categories',$val->room_ids)->id.",";
                                    $frooms = new FloorRoom();

                                    $frooms->room_id = $room_inserted_id;
                                    //$cate_title = Helper::get_table_record_field('categories',$v->room_ids)->u_title;
                                    //$category_parent_data =  DB::table('categories')->where('project_id',$parentData[0]->project_id)->where('project_revision',$parentData[0]->project_revision)->where('u_title',$cate_title)->first();
                                    $frooms->room_ids = $v->id;
                                    $frooms->save();
                                    //echo $category->id;
                                }
                            }
                        }
                    }
                }
                //echo $request->plot_parent_id;
                $childDatas4 = Category::where('parent_id', $val)
                    ->where('parent_host', 'Plot')
                    ->where('family', 'Room')
                    ->get();
                // dd($request);
                //dd($childDatas4);

                foreach ($childDatas4 as $childData4) {
                    //print_r($childData4);
                    // die();

                    $instanceData10 = Category::where('project_id', $childData4->project_id)
                        ->latest('id')
                        ->first();
                    if ($instanceData10) {
                        $instanceNum10 = $instanceData10->instance_id + 1;
                    } else {
                        $instanceNum10 = '1';
                    }
                    $p_u_title = uniqid();
                    $plotDuplicateRoom = new Category();
                    $plotDuplicateRoom->user_id = $parentData[0]->user_id;
                    $plotDuplicateRoom->project_id = $parentData[0]->project_id;
                    $plotDuplicateRoom->project_revision = $parentData[0]->project_revision;

                    $plotDuplicateRoom->title = $childData4->title;
                    $plotDuplicateRoom->parent_id = $plotDuplicate->id;
                    $plotDuplicateRoom->type_name = $childData4->room_type;
                    $plotDuplicateRoom->parent_host = $childData4->parent_host;
                    $plotDuplicateRoom->family = $childData4->family;
                    $plotDuplicateRoom->target_area = $childData4->target_area;
                    $plotDuplicateRoom->instance_id = $instanceNum10;
                    $plotDuplicateRoom->area = $childData4->area;
                    ///
                    $plotDuplicateRoom->duplicate_id = $childData4->id;
                    ///
                    $plotDuplicateRoom->u_title = uniqid();
                    $plotDuplicateRoom->floor_type = $childData4->floor_type;
                    $plotDuplicateRoom->floor_sort_order = $childData4->floor_sort_order;
                    $plotDuplicateRoom->basement_sort_order = $childData4->basement_sort_order;

                    $plotDuplicateRoom->save();

                    $room_inserted_id = $plotDuplicateRoom->id;

                    $plotDuplicateRoomType = new Room();
                    $plotDuplicateRoomType->floor_id = $plotDuplicateRoom->id;
                    $plotDuplicateRoomType->room_area = $childData4->room_area;
                    $plotDuplicateRoomType->room_type = $childData4->room_type;
                    $plotDuplicateRoomType->save();

                    //$room_inserted_id = $plotDuplicateRoomType->id;
                    //echo '__';
                    //exit;
                    // Plot Room
                    //echo $childData4->id.'---ROOM ID---'.$room_inserted_id.'__';
                    //echo $room_inserted_id;
                    //exit;

                    $room_data_id = DB::select(
                        "SELECT c.id from categories c inner join
                                               floor_rooms fr ON fr.room_ids = c.duplicate_id
                                               WHERE fr.room_id =" . $childData4->id,
                    );
                    if ($room_data_id) {
                        //print_r($room_data_id);
                        // die();inner

                        foreach ($room_data_id as $key => $v) {
                            // $inserted_id_array .= Helper::get_table_record_field('categories',$val->room_ids)->id.",";
                            $frooms = new FloorRoom();

                            $frooms->room_id = $room_inserted_id;
                            //$cate_title = Helper::get_table_record_field('categories',$v->room_ids)->u_title;
                            //$category_parent_data =  DB::table('categories')->where('project_id',$parentData[0]->project_id)->where('project_revision',$parentData[0]->project_revision)->where('u_title',$cate_title)->first();
                            $frooms->room_ids = $v->id;
                            $frooms->save();
                            //echo $category->id;
                        }
                    }
                }
                //exit;
                // Plot Room

                //   dd($childDatas3);
            } // end foreach
            return redirect()
                ->back()
                ->with('message', 'project duplicated Successfully');
        }
    }

    public function manageChildCategory(Request $request)
    {
        // dd($request);
        // echo "hi";exit;
        if ($request->parent_child_val) {
            $buildings = DB::table('categories')
                ->join('buildings', 'categories.id', '=', 'buildings.plot_id')
                ->where('categories.parent_id', '=', $request->parent_child_val)
                ->where('buildings.plot_id', '=', $request->id)
                ->get();

            $floor = DB::table('categories')
                ->where('parent_id', '=', $request->parent_child_val)
                ->where('id', '=', $request->id)
                ->get();

            $room = DB::table('categories')
                ->join('rooms', 'categories.id', '=', 'rooms.floor_id')
                ->where('categories.parent_id', '=', $request->parent_child_val)
                ->where('rooms.floor_id', '=', $request->id)
                ->get();
            // dd($room);
            $buildingType = BuildingType::get();
            $roomType = RoomType::get();

            $response = [
                'buildings' => $buildings,
                'floor' => $floor,
                'room' => $room,
                'buildingType' => $buildingType,
                'roomType' => $roomType,
            ];
            return response()->json($response);
        }
    }

    public function getPlotTypes(Request $request)
    {
        $plottype = PlotType::get();
        return response()->json($plottype);
    }
    public function getBuildingTypes(Request $request)
    {
        $BuildingType = BuildingType::get();
        return response()->json($BuildingType);
    }

    public function getRoomTypes(Request $request)
    {
        $RoomType = RoomType::where('type', 'normal')->get();
        return response()->json($RoomType);
    }
    public function getextRoomTypes(Request $request)
    {
        $RoomType = RoomType::where('type', 'external')->get();
        return response()->json($RoomType);
    }

    public function getplot(Request $request)
    {
        // dd($request);

        if ($request->plot_primary_id) {
            // get building id
            $plot_data = Category::find($request->plot_primary_id);
            $allPlots = Category::where('user_id', '=', $request->user_id)
                ->where('project_id', '=', $request->project_id)
                ->where('parent_id', 0)
                ->get();
            $response = [
                'allPlots' => $allPlots,
                'plot_data' => $plot_data,
            ];
            return response()->json($response);
        }
    }
    public function getCateId(Request $request)
    {
        $cate_id = DB::table('categories')
            ->latest('id')
            ->first();
        $cate_id = $cate_id->id + 1;
        $response = [
            'cate_id' => $cate_id . ' ' . substr(str_shuffle('0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ'), 0, 4),
        ];
        return response()->json($response);
    }
    public function getbuilding(Request $request)
    {
        // dd($request->building_parent_id);
        if ($request->building_primiry_id) {
            $building_data = Category::find($request->building_primiry_id);
            $allbuildings = Category::where('parent_id', $request->building_parent_id)
                ->where('family', 'Building')
                ->get();
            // dd($allbuildings);
            $response = [
                'allbuildings' => $allbuildings,
                'building_data' => $building_data,
            ];
            return response()->json($response);
        }
    }

    public function getfloor(Request $request)
    {
        // dd($request);
        // dd($request->building_parent_id);
        if ($request->floor_primary_id) {
            $floor_data = Category::find($request->floor_primary_id);
            $allfloors = Category::where('parent_id', $request->floor_parent_id)->get();
            // dd($allfloors);
            $response = [
                'allfloors' => $allfloors,
                'floor_data' => $floor_data,
            ];
            return response()->json($response);
        }
    }

    public function getParentfloor(Request $request)
    {
        $parentFloor = Category::where('plot_id', $request->plot_frimary_id)
            ->where('project_id', $request->project_id)
            ->get();
        // dd($allfloors);
        $response = [
            'parentFloor' => $parentFloor,
        ];
        return response()->json($response);
    }

    public function geteditbuilding(Request $request)
    {
        // dd($request->building_parent_id);
        if ($request->parent_child_val) {
            $building_data = Category::where('id', $request->parent_child_val)->get();
            // dd($building_data);
            $allbuildings = Category::where('parent_id', 0)
                ->where('user_id', $building_data[0]->user_id)
                ->where('project_id', $building_data[0]->project_id)
                ->get();
            // dd($allbuildings);
            $response = [
                'building_data' => $building_data,
                'allbuildings' => $allbuildings,
            ];
            return response()->json($response);
        }
    }
    public function geteditfloor(Request $request)
    {
        // dd($request->building_parent_id);
        if ($request->floor_child_val) {
            $floor_data = Category::where('id', $request->floor_child_val)->get();
            $allfloors = Category::where('parent_id', $floor_data[0]->parent_id)
                ->where('family', 'Building')
                ->get();
            // dd($allfloors);
            $response = [
                'floor_data' => $floor_data,
                'allfloors' => $allfloors,
            ];
            return response()->json($response);
        }
    }

    public function geteditroom(Request $request)
    {
        // dd($request);
        if ($request->room_child_val) {
            $floor_data = Category::where('id', $request->room_child_val)->get();
            $allfloors = Category::where('project_id', $request->project_id)
                ->where('project_revision', $request->project_revision)
                ->where('parent_id', $floor_data[0]->parent_id)
                ->get();
            //$allfloors = Category::where('project_id', $request->project_id)->where('project_revision', $request->project_revision)->get();
            $roomRecord = Category::where('id', $request->select_radio)->first();

            // only this show query show the plot floor
            // $floorRecord = Category::where('project_id', $request->project_id)->where('plot_id',$request->room_child_val)->where('family','Floor')->get();
            $floorRecord = Category::where('project_id', $request->project_id)
                ->where('project_revision', $request->project_revision)
                ->where('family', 'Floor')
                ->get();
            // $pro_room = FloorRoom::where('room_id', $roomRecord)->get();

            // $pro_room = DB::table('floor_rooms')
            //           ->join('categories', 'floor_rooms.room_id', '=', 'categories.id')
            //           ->where('floor_rooms.room_id',$request->select_radio)
            //           ->get();

            $pro_room = Category::where('project_id', $request->project_id)
                ->where('family', 'Room')
                ->where('project_revision', $request->project_revision)
                ->get();

            //  dd($floorRecord);

            $response = [
                'floor_data' => $floor_data,
                'allfloors' => $allfloors,
                'floorRecord' => $floorRecord,
                'roomRecord' => $roomRecord,
                'pro_room' => $pro_room,
            ];
            return response()->json($response);
        }
    }

    public function getRoomRecord(Request $request)
    {
        if ($request->select_radio) {
            $roomRecord = Category::where('id', $request->select_radio)->first();

            $response = [
                'roomRecord' => $roomRecord,
            ];
            return response()->json($response);
        }
    }

    public function addCategory(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);
        $input = $request->all();
        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];

        Category::create($input);
        return back()->with('message', 'New Category added successfully.');
    }

    public function addPlot(Request $request)
    {
        //   dd($request);
        $userid = Auth::user()->id;
        $input['user_id'] = $userid;

        $instanceData = Category::where('project_id', $request->input('project_id'))
            ->latest('id')
            ->first();
        if ($instanceData) {
            $instanceNum = $instanceData->instance_id + 1;
        } else {
            $instanceNum = '1';
        }

        $addPlotName = new Category();
        $addPlotName->user_id = $userid;
        $addPlotName->project_id = $request->input('project_id');
        $addPlotName->title = $request->input('title');
        $addPlotName->width = $request->input('width');
        $addPlotName->height = $request->input('height');
        $addPlotName->length = $request->input('length');
        $addPlotName->parent_id = 0;
        $addPlotName->instance_id = $instanceNum;
        $addPlotName->type_name = $request->parent_id;
        $addPlotName->project_revision = $request->project_revision_id;
        $addPlotName->family = 'Plot';
        $addPlotName->u_title = uniqid();
        $addPlotName->save();

        $addPlot = new Plot();
        $addPlot->plot_id = $addPlotName->id;
        $addPlot->width = $request->input('width');
        $addPlot->width = $request->input('width');
        $addPlot->height = $request->input('height');
        $addPlot->length = $request->input('length');
        $addPlot->plot_type_name = $request->input('parent_id');
        $addPlot->save();
        return redirect()
            ->back()
            ->with('message', 'New Rerord added successfully');
    }

    public function updatePlot(Request $request)
    {
        //   dd($request);
        $userData = Category::find($request->id);
        $userData->title = request('title');
        $userData->type_name = request('parent_id');
        $userData->width = $request->input('width');
        $userData->height = $request->input('height');
        $userData->length = $request->input('length');
        $userData->save();

        $addPlot = Plot::find($request->plot_id);
        $addPlot->plot_type_name = $userData->type_name;
        $addPlot->width = $request->input('width');
        $addPlot->height = $request->input('height');
        $addPlot->length = $request->input('length');
        $addPlot->save();
        return response()->json('data Updated Successfully ');
    }

    public function addBuildings(Request $request)
    {
        //   dd($request);

        //   $get_last_id = Plot::latest()->first();

        $empData = Category::latest('id')->first();

        $instanceData = Category::where('project_id', $request->input('project_id'))
            ->latest('id')
            ->first();
        if ($instanceData) {
            $instanceNum = $instanceData->instance_id + 1;
        } else {
            $instanceNum = '1';
        }

        $get_category_id = Category::where('parent_id', 0)
            ->latest()
            ->first();
        //   dd($get_category_id->title);

        //   dd($area);

        $user_id = Auth::user()->id;
        $addCategory = new Category();
        $addCategory->user_id = $user_id;
        $addCategory->project_id = $request->input('project_id');
        $addCategory->title = $request->input('title');
        $addCategory->instance_id = $instanceNum;
        if ($request->parent_id1) {
            $get_last_id = Category::find($request->parent_id1);
            //    dd($get_last_id);
            $countArea = $get_last_id->length * $get_last_id->width;
            $area = ($countArea / 100) * $request->target_area;
            $addCategory->parent_id = $request->input('parent_id1');
        } else {
            $get_last_id = Category::find($request->parent_id);
            $countArea = $get_last_id->length * $get_last_id->width;
            $area = ($countArea / 100) * $request->target_area;
            $addCategory->parent_id = $request->input('parent_id');
        }
        $addCategory->type_name = $request->building_type;
        $addCategory->parent_host = 'plot';
        $addCategory->parent_host_csv = $get_last_id->title;
        $addCategory->number_of_floor = $request->input('number_of_floor');
        $addCategory->target_area = $request->input('target_area');
        $addCategory->area = (int) $area;
        $addCategory->family = 'Building';
        $addCategory->u_title = uniqid();
        $addCategory->project_revision = $request->project_revision_id;
        $addCategory->save();
        $building_inserted_id = $addCategory->id;

        $addBuildings = new Building();
        $addBuildings->plot_id = $addCategory->id;
        $addBuildings->floor_height = $request->input('floor_height');
        $addBuildings->number_of_floor = $request->input('number_of_floor');
        $addBuildings->target_area = $request->input('target_area');
        $addBuildings->area = (int) $area;
        $addBuildings->building_type = $request->input('building_type');
        $addBuildings->save();

        // auto roof floor added

        $instanceData = Category::where('project_id', $request->input('project_id'))
            ->latest('id')
            ->first();
        if ($instanceData) {
            $instanceNum = $instanceData->instance_id + 1;
        } else {
            $instanceNum = '1';
        }

        $get_building = Building::latest()->first();

        $get_category_id = Category::where('id', $get_building->plot_id)
            ->latest()
            ->first();

        //   dd($get_category_id->title);
        $user_id = Auth::user()->id;
        // L0
        $addfloor = new Category();
        $addfloor->user_id = $user_id;
        $addfloor->project_id = $request->input('project_id');

        $empDatat = $empData->id + 1;
        $lastname = $empDatat . ' ' . substr(str_shuffle('0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ'), 0, 4);
        $addfloor->title = 'FLoor ' . $lastname;
        $addfloor->sort_order = 0;

        $addfloor->instance_id = $instanceNum;
        if ($request->parent_id1) {
            $roomdata = Category::find($building_inserted_id);
            $addfloor->parent_id = $building_inserted_id;
        } else {
            $roomdata = Category::find($building_inserted_id);
            $addfloor->parent_id = $building_inserted_id;
        }
        $addfloor->parent_host = 'Building';
        $addfloor->floor_type = 'L';

        $addfloor->parent_host_csv = 'L0';
        $addfloor->family = 'Floor';
        $addfloor->u_title = uniqid();
        $addfloor->plot_id = $request->building_parent_id_val;
        $addfloor->floor_sort_order = 1;
        $addfloor->basement_sort_order = 10000000;
        $addfloor->project_revision = $request->project_revision_id;
        $addfloor->floor_number = 0;

        $addfloor->save();
        // Roof floor
        $instanceData = Category::where('project_id', $request->input('project_id'))
            ->latest('id')
            ->first();
        if ($instanceData) {
            $instanceNum = $instanceData->instance_id + 1;
        } else {
            $instanceNum = '1';
        }
        $addfloor = new Category();
        $addfloor->user_id = $user_id;
        $addfloor->project_id = $request->input('project_id');

        $empDatat = $empData->id + 2;
        $lastname = $empDatat . ' ' . substr(str_shuffle('0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ'), 0, 4);
        $addfloor->title = 'Roof ' . $lastname;

        $addfloor->instance_id = $instanceNum;
        if ($request->parent_id1) {
            $roomdata = Category::find($building_inserted_id);
            $addfloor->parent_id = $building_inserted_id;
        } else {
            $roomdata = Category::find($building_inserted_id);
            $addfloor->parent_id = $building_inserted_id;
        }
        $addfloor->parent_host = 'Building';
        $addfloor->parent_host_csv = 'Roof floor';
        $addfloor->family = 'Floor';
        $addfloor->u_title = uniqid();
        $addfloor->plot_id = $request->building_parent_id_val;
        $addfloor->basement_sort_order = 1000000000;
        $addfloor->project_revision = $request->project_revision_id;
        $addfloor->floor_number = 10000;

        $addfloor->save();
        // end here
        return redirect()
            ->back()
            ->with('message', 'New Rerord added successfully');
    }

    public function updateBuildings(Request $request)
    {
        // dd($request);
        if ($request->idss) {
            $countarea = $request->length * $request->width;
            $buildingDatas = Category::where('parent_id', $request->idss)->get();
            //   dd($floorDatas);
            $totalareas = [];
            foreach ($buildingDatas as $buildingData) {
                $totalarea = ($buildingData->target_area / 100) * $countarea;
                $userData = Category::find($buildingData->id);
                $userData->area = $totalarea;
                $userData->save();

                $floorDatas = Category::where('parent_id', $buildingData->id)->get();
                foreach ($floorDatas as $floorData) {
                    $roomDatas = Category::where('parent_id', $floorData->id)->get();
                    foreach ($roomDatas as $roomData) {
                        $roomupdate = Category::find($roomData->id);
                        $area = ($userData->area / 100) * $roomData->target_area;
                        $roomupdate->area = $area;
                        $roomupdate->save();
                    }
                }
            }
        } else {
            $userData = Category::find($request->id);

            $plotData = Category::where('id', $userData->parent_id)->get();
            $countarea = $plotData[0]->length * $plotData[0]->width;
            $totalarea = ($request->target_area / 100) * $countarea;
            //   dd($totalarea);
            $userData->title = request('building_title');
            $userData->type_name = request('building_type');
            $userData->number_of_floor = request('number_of_floor');
            $userData->target_area = request('target_area');
            $userData->area = $totalarea;
            $userData->parent_id = $request->plotselect;
            $userData->save();

            $addBuildings = Building::find($request->plot_idss);
            $addBuildings->building_type = $userData->type_name;
            $addBuildings->floor_height = $request->input('floor_height');
            $addBuildings->number_of_floor = $request->input('number_of_floor');
            $addBuildings->target_area = $request->input('target_area');
            $addBuildings->area = $totalarea;
            $addBuildings->save();
            return response()->json('Building Updated Successfully ');
        }
    }
    public function deletePlot(Request $request)
    {
        foreach ($request->plot_parent_ids as $key => $val) {
            $getparent = Category::find($val);
            // dd($val);
            $getchilds = Category::where('parent_id', '=', $getparent->id)->get();

            $getparent->delete();
            $getchilds1 = [];
            foreach ($getchilds as $getchild) {
                $project1 = Category::find($getchild->id);
                $getchilds1 = Category::where('parent_id', '=', $getchild->id)->get();
                $project1->delete();

                $getchilds2 = [];
                foreach ($getchilds1 as $getchild1) {
                    $project2 = Category::find($getchild1->id);
                    $getchilds2 = Category::where('parent_id', '=', $getchild1->id)->get();
                    $project2->delete();
                    foreach ($getchilds2 as $getchild2) {
                        $project3 = Category::find($getchild2->id);
                        $project3->delete();
                    }
                }
            }
        }
        return response()->json('data deleted');
    }

    public function deleteChild(Request $request)
    {
        for ($i = 0; $i < count($request->building_parent_ids); $i++) {
            //$getchild = Category::where('id', '=',$request->plot_id_del)->get();
            $getchild = Category::where('id', '=', $request->building_ids[$i])->get();
            //print_r($getchild);
            $fllordata = Category::where('parent_id', '=', $request->floor_val)->get();

            //if($request->id && $getchild[0]->parent_host == 'plot'){
            if ($request->building_ids[$i] && $getchild[0]->parent_host == 'plot') {
                $project1 = Category::find($getchild[0]->id);
                $project1->delete();
                $getchilds1 = Category::where('parent_id', '=', $getchild[0]->id)->get();
                $getchilds2 = [];

                foreach ($getchilds1 as $getchild1) {
                    $project2 = Category::find($getchild1->id);
                    $getchilds2 = Category::where('parent_id', '=', $getchild1->id)->get();
                    $project2->delete();

                    foreach ($getchilds2 as $getchild2) {
                        $project3 = Category::find($getchild2->id);
                        $project3->delete();
                    }
                }
            } elseif ($request->floor_val && $fllordata[0]->parent_host == 'Building') {
                //  echo $request->room_child_val;exit;
                //$getchild1 = Category::find($request->room_child_val);
                //echo $request->building_ids[$i];
                //$getchild1 = Category::find($request->building_ids[$i]);
                //$getchilds2 = Category::where('parent_id', '=',$getchild1->id)->get();
                $for_d_id = $request->building_ids[$i];

                $floor_title_L0 = Helper::get_table_record_field('categories', $request->building_ids[$i])->title;
                if ($floor_title_L0 == 'L0') {
                    return response()->json('error');
                }
                $check_floor_type = Helper::get_table_record_field('categories', $request->building_ids[$i])->floor_type;
                $floor_title = Helper::get_table_record_field('categories', $request->building_ids[$i])->title;
                $parent_id = Helper::get_table_record_field('categories', $request->building_ids[$i])->parent_id;
                if ($check_floor_type == 'L') {
                    $data_fetch_record = Category::where('parent_id', '=', $parent_id)
                        ->where('floor_type', '=', 'L')
                        ->where('id', '>', $request->building_ids[$i])
                        ->orderBy('id', 'ASC')
                        ->get();
                    if (count($data_fetch_record) > 0) {
                        $f_title = $floor_title;
                        $counter = trim($floor_title, 'L');

                        foreach ($data_fetch_record as $key => $value) {
                            $floor_title = (int) $f_title + $counter;
                            $floor_title = 'L' . $floor_title;

                            //echo $floor_title."==".$value->id;
                            Category::where('parent_id', '=', $parent_id)
                                ->where('floor_type', '=', 'L')
                                ->where('id', '=', $value->id)
                                ->update(['title' => $floor_title]);
                            $counter++;
                        }
                    }
                } else {
                    $data_fetch_record = Category::where('parent_id', '=', $parent_id)
                        ->where('floor_type', '=', 'B')
                        ->where('id', '>', $request->building_ids[$i])
                        ->orderBy('id', 'ASC')
                        ->get();
                    if (count($data_fetch_record) > 0) {
                        $f_title = $floor_title;
                        $counter = trim($floor_title, 'B-');

                        foreach ($data_fetch_record as $key => $value) {
                            $floor_title = (int) $f_title + $counter;
                            $floor_title = 'B-' . $floor_title;

                            //echo $floor_title."==".$value->id;
                            Category::where('parent_id', '=', $parent_id)
                                ->where('floor_type', '=', 'B')
                                ->where('id', '=', $value->id)
                                ->update(['title' => $floor_title]);
                            $counter++;
                        }
                    }
                }

                $getchild1 = Category::find($for_d_id);
                $getchilds2 = Category::where('parent_id', '=', $getchild1->id)->get();
                $getchild1->delete();
                foreach ($getchilds2 as $getchild2) {
                    $project1 = Category::find($getchild2->id);
                    $project1->delete();
                }
            } else {
                //$fllordata = Category::where('id', '=',$request->room_child_val)->get();
                $fllordata = Category::where('id', '=', $request->building_ids[$i])->get();

                $getchild1 = Category::find($fllordata[0]->id);

                $getchild1->delete();
            }
        } // end for loop
        return response()->json('data deleted');
    }
    public function getRoom(Request $request)
    {
        // $empData['data'] = Category::whereIn('parent_id', function($query) use($request) {
        //     $query->select('id')
        //     ->from('categories')
        //     ->whereIn('parent_host', ['Floor', 'Building'])
        //     ->where('parent_id', '=', $request->id);
        // })->orderBy('sort_order','ASC')->get();

        $empData['data'] = Category::where('family', 'Room')
            ->where('parent_id', '=', $request->id)
            ->orderBy('sort_order', 'ASC')
            ->get();

        return response()->json($empData);
    }
    public function getextRoom(Request $request)
    {
        $empData['data'] = Category::where('family', 'Room')
            ->where('parent_id', '=', $request->id)
            ->orderBy('sort_order', 'ASC')
            ->get();

        return response()->json($empData);
    }

    public function getPlotRoom(Request $request)
    {
        $empData['data'] = Category::where('parent_id', '=', $request->id)
            ->where('family', '=', 'Room')
            ->orderBy('sort_order', 'ASC')
            ->get();

        return response()->json($empData);
    }

    public function getStackRooms(Request $request)
    {
        $empData['data'] = Category::where('parent_id', '=', $request->id)
            ->where('family', '=', 'StackedRoom')
            ->orderBy('sort_order', 'ASC')
            ->get();

        return response()->json($empData);
    }

    public function getPlotBuilding(Request $request)
    {
        $empData['data'] = Category::where('project_id', '=', $request->id)
            ->where('family', '=', 'building')
            ->orderBy('sort_order', 'ASC')
            ->get();

        return response()->json($empData);
    }

    public function getExternalRoom(Request $request)
    {
        $empData['data'] = Category::where('family', 'external')
            ->where('project_id', '=', $request->id)
            ->orderBy('sort_order', 'ASC')
            ->get();

        return response()->json($empData);
    }

    public function getEditPlotRoom(Request $request)
    {
        $empData['data'] = Category::select('categories.id', 'categories.title')

            ->where('categories.parent_id', '=', $request->id)
            ->where('categories.parent_host', '=', 'Plot')
            ->where('categories.id', '!=', $request->room_id)
            ->where('categories.family', '=', 'Room')
            ->orderBy('categories.sort_order', 'ASC')
            ->get();
        $empData['rooms'] = FloorRoom::where('room_id', $request->room_id)->get();
        return response()->json($empData);
    }
    public function getEditFloorRoom(Request $request)
    {
        $empData['data'] = Category::select('categories.id', 'categories.title')

            ->where('categories.parent_id', '=', $request->id)
            ->where('categories.parent_host', '=', 'Floor')
            ->where('categories.id', '!=', $request->room_id)
            ->where('categories.family', '=', 'Room')
            ->orderBy('categories.sort_order', 'ASC')
            ->get();
        $empData['rooms'] = FloorRoom::where('room_id', $request->room_id)->get();
        return response()->json($empData);
    }

    public function getRoomArea(Request $request)
    {
        $empData['data'] = RoomType::where('room_type', '=', $request->id)->get();

        return response()->json($empData);
    }
    public function getBuildingTypesArea(Request $request)
    {
        $empData['data'] = BuildingType::where('building_type', '=', $request->id)->get();

        return response()->json($empData);
    }
    public function projectSetting()
    {
        $id = Auth::user()->id;
        $user = User::where('id', $id)->first();
        if ($user->user_type == 'Free') {
            $data = UserSetting::where('type', 'Free')->first();
        } else {
            $data = UserSetting::where('type', 'Premium')->first();
        }

        $check_count = Helper::count_record_user('c_s_v_files', 'user_id', Auth::user()->id);

        $remaining_count = $data->number_of_try - $check_count;

        $SiteSetting = SiteSetting::first();
        return view('category.projectSetting', compact('data', 'remaining_count', 'user', 'SiteSetting'));
    }
    public function fileNameUpdate(Request $request)
    {
        CSVFile::where('project_id', '=', $request->project_id)
            ->where('user_id', '=', $request->user_id)
            ->where('id', '=', $request->file_id)
            ->update(['file_name' => $request->file_name]);
        return redirect()
            ->back()
            ->with('message', 'File name change successfully');
    }
    public function postFloorSort(Request $request)
    {
        // $instanceData = Category::where('id',$request->floor_ids[0])->first();

        // if($instanceData->floor_type=='B')
        // {
        //     Category::where('parent_id', '=',$request->floor_ids[0])->where('floor_type','B')->update(['sort_order' => 0]);
        //     $floor_t = 'B';
        // }
        // else
        // {
        //     Category::where('parent_id', '=',$request->floor_ids[0])->where('floor_type','L')->update(['sort_order' => 0]);
        //     $floor_t = 'L';
        // }

        $b = 1;
        $l = 0;
        $j = 1;
        $floor_ids_count = count($request->floor_ids);

        foreach ($request->floor_ids as $key => $val) {
            //
            $instanceData = Category::where('id', $val)->first();
            //echo $val."---";
            //

            if ($instanceData->floor_type == 'B') {
                DB::table('categories')
                    ->where('id', $val)
                    ->update([
                        'basement_sort_order' => $b,
                        'title' => 'B' . $b,
                        'floor_number' => $b,
                    ]);
                //echo $val."===".$b."B=>";
                $b++;
            }
            if ($instanceData->floor_type == 'L') {
                DB::table('categories')
                    ->where('id', $val)
                    ->update([
                        'floor_sort_order' => $l,
                        'title' => 'L' . $l,
                        'floor_number' => $l,
                    ]);
                //echo $val."->".$l."L=>";
                $l++;
            }
        }
    }
    public function getProjectData(Request $request)
    {
        $empData['data'] = Project::where('id', '=', $request->project_id)->first();

        return response()->json($empData);
    }
    public function getLastCategoryId()
    {
        $empData = Category::latest('id')->first();
        $empData = $empData->id + 1;
        return $empData . ' ' . substr(str_shuffle('0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ'), 0, 4);
    }
    public function getLastRoomId(Request $request)
    {
        $empData = Category::where('project_id', $request->project_id)
            ->where('project_revision', $request->project_revision_id)
            ->where('parent_host', 'Floor')
            ->count();
        if ($empData != 0) {
            $empData = $empData + 1;
            if ($empData < 9) {
                $empData = '0' . $empData;
            } else {
                $empData = $empData;
            }
        } else {
            $empData = '01';
        }
        return $empData . ' ' . substr(str_shuffle('0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ'), 0, 4);
    }

    public function getLastExtRoomId(Request $request)
    {
        $empData = Category::where('project_id', $request->project_id)
            ->where('project_revision', $request->project_revision_id)
            ->where('parent_host', 'Floor')
            ->count();
        if ($empData != 0) {
            $empData = $empData + 1;
            if ($empData < 9) {
                $empData = '0' . $empData;
            } else {
                $empData = $empData;
            }
        } else {
            $empData = '01';
        }
        return $empData . ' ' . substr(str_shuffle('0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ'), 0, 4);
    }

    public function genDetailModel(Request $request)
    {
        echo $request->project_revision_id;
        echo $request->project_id;
        die();
    }

    private function updateJson($tag, $pid)
    {
        switch ($tag) {
            case 'manualcheck':
                DB::table('json_files')
                    ->where('project_id', $pid)
                    ->update(['process_fbx' => 1]);
                break;
            case 't_gdm2':
                DB::table('json_files')
                    ->where('project_id', $pid)
                    ->update(['process_fbx2' => 1]);
                break;
            case 't_gdwgs':
                DB::table('json_files')
                    ->where('project_id', $pid)
                    ->update(['process_dwg1' => 1]);
                break;
            case 't_pdf':
                DB::table('json_files')
                    ->where('project_id', $pid)
                    ->update(['process_pdf1' => 1]);
                break;
            default:
                echo 'No tag coming';
        }
    }
    public function manualgen(Request $request)
    {
        //working here
        $this->updateJson($request->tag_id, $request->project_id);
        if ($request->tag_id == 'manualcheck') {
            $manulstatuschnage = DB::table('manual')
                ->where('project_id', $request->project_id)
                ->update(['manualgen' => $request->status]);
            $column_name = 'manualgen';
        } elseif ($request->tag_id == 't_gdm2') {
            $manulstatuschnage = DB::table('manual')
                ->where('project_id', $request->project_id)
                ->update(['manualgdm' => $request->status]);
            $column_name = 'manualgdm';
        } elseif ($request->tag_id == 't_gdwgs') {
            $manulstatuschnage = DB::table('manual')
                ->where('project_id', $request->project_id)
                ->update(['manualdwg' => $request->status]);
            $column_name = 'manualdwg';
        } elseif ($request->tag_id == 't_pdf') {
            $manulstatuschnage = DB::table('manual')
                ->where('project_id', $request->project_id)
                ->update(['manualpdf' => $request->status]);
            $column_name = 'manualpdf';
        }

        if ($manulstatuschnage) {
            echo 'updated';
        } else {
            DB::table('manual')->insert([
                'project_id' => $request->project_id,
                $column_name => $request->status,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            echo 'created : ' . $column_name;
        }
    }
    // public function downloadjsonfile(Request $request)
    // {
    //     $fbxfile =  DB::table('json_files')->select('fbx1_file')->where('project_id',$request->pid)->first();
    //      if($fbxfile) {
    //         $fbxpath =$fbxfile->fbx1_file;
    //          if(file_exists($fbxpath)){
    //                return response()->download($fbxpath);
    //          }else{
    //              return redirect()->back()->with('message', 'Not found any file to download!');
    //          }
    //     }

    // }
    public function downloadjsonfile(Request $request)
    {
        if ($request->ftype == 'json') {
            $pidtable = DB::table('json_files')
                ->select('json0')
                ->where('id', $request->pid)
                ->first();
        } elseif ($request->ftype == 'json1') {
            $pidtable = DB::table('json_files')
                ->select('json1_file')
                ->where('id', $request->pid)
                ->first();
        } elseif ($request->ftype == 'json2') {
            $pidtable = DB::table('json_files')
                ->select('json2_file')
                ->where('id', $request->pid)
                ->first();
        } elseif ($request->ftype == 'fbx1') {
            $pidtable = DB::table('json_files')
                ->select('fbx1_file')
                ->where('project_id', $request->id)
                ->orderBy('id', 'desc')
                ->first();
        } elseif ($request->ftype == 'fbx2') {
            $pidtable = DB::table('json_files')
                ->select('fbx2_file')
                ->where('project_id', $request->id)
                ->orderBy('id', 'desc')
                ->first();
        } elseif ($request->ftype == 'dwgs') {
            $pidtable = DB::table('json_files')
                ->select('dwg1_file')
                ->where('project_id', $request->id)
                ->orderBy('id', 'desc')
                ->first();
        } elseif ($request->ftype == 'pdf') {
            $pidtable = DB::table('json_files')
                ->select('pdf1_file')
                ->where('project_id', $request->id)
                ->orderBy('id', 'desc')
                ->first();
        }

        if ($pidtable) {
            if ($request->ftype == 'json') {
                $jsonpath = $pidtable->json0;
                if (file_exists($jsonpath)) {
                    return response()->download($jsonpath);
                } else {
                    return redirect()
                        ->back()
                        ->with('Downlaod_message', 'JSON file does not exist');
                }
            } elseif ($request->ftype == 'json1') {
                $jsonpath = $pidtable->json1_file;
                if (file_exists($jsonpath)) {
                    return response()->download($jsonpath);
                } else {
                    return redirect()
                        ->back()
                        ->with('Downlaod_message', 'JSON1 file does not exist');
                }
            } elseif ($request->ftype == 'json2') {
                $jsonpath = $pidtable->json2_file;
                if (file_exists($jsonpath)) {
                    return response()->download($jsonpath);
                } else {
                    return redirect()
                        ->back()
                        ->with('Downlaod_message', 'JSON2 file does not exist');
                }
            } elseif ($request->ftype == 'fbx1') {
                $fbxpath = $pidtable->fbx1_file;
                if (file_exists($fbxpath)) {
                    return response()->download($fbxpath);
                } else {
                    return redirect()
                        ->back()
                        ->with('Downlaod_message', 'fbx file does not exist!');
                }
            } elseif ($request->ftype == 'fbx2') {
                $fbxpath = $pidtable->fbx2_file;
                if (file_exists($fbxpath)) {
                    return response()->download($fbxpath);
                } else {
                    return redirect()
                        ->back()
                        ->with('Downlaod_message', 'fbx1 file does not exist!');
                }
            } elseif ($request->ftype == 'dwgs') {
                $fbxpath = $pidtable->dwg1_file;
                if (file_exists($fbxpath)) {
                    return response()->download($fbxpath);
                } else {
                    return redirect()
                        ->back()
                        ->with('Downlaod_message', 'DWGS file does not exist!');
                }
            } elseif ($request->ftype == 'pdf') {
                $fbxpath = $pidtable->pdf1_file;
                if (file_exists($fbxpath)) {
                    return response()->download($fbxpath);
                } else {
                    return redirect()
                        ->back()
                        ->with('Downlaod_message', 'PDF file does not exist!');
                }
            }
        } else {
            return redirect()
                ->back()
                ->with('Downlaod_message', 'Something Went Wrong!');
        }
    }

    public function updatemsgbar(Request $request)
    {
        $json_files1 = DB::table('json_files')
            ->select('fbx1_message', 'fbx2_message', 'dwg1_message', 'pdf1_message', 'process_fbx', 'process_fbx2', 'process_dwg1', 'process_pdf1')
            ->where('project_id', $request->project_id)
            ->orderBy('id', 'desc')
            ->first();
        if ($json_files1) {
            $gcm_bar = $json_files1->fbx1_message != '' ? $json_files1->fbx1_message : 0;
            $gdm_bar = $json_files1->fbx2_message != '' ? $json_files1->fbx2_message : 0;
            $gdd_bar = $json_files1->dwg1_message != '' ? $json_files1->dwg1_message : 0;
            $gpd_bar = $json_files1->pdf1_message != '' ? $json_files1->pdf1_message : 0;
            echo json_encode([$gcm_bar, $gdm_bar, $gdd_bar, $gpd_bar]);
        }
    }
}
