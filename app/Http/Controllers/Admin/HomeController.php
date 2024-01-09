<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Project;
use App\ProjectRevision;
use Auth;
use DB;
use App\Helpers\Helper;
use App\SiteSetting;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->id) {
            $getSingleProducts = DB::table('projects')
                ->where('id', '=', $request->id)
                ->get();
            return response()->json($getSingleProducts);
        } else {
            $plot_types = DB::table('plot_types')->get();
            $building_types = DB::table('building_types')->get();
            $room_types = DB::table('room_types')->get();
            $floor_types = DB::table('floor_types')->get();

            $mode = $request->mode ? $request->mode : 'all';
            $userid = Auth::user()->id;
            if (Auth::user()->id == 1) {
                // echo 'aaa' ; die;
                $mode_cond = '';
                if ($mode == 'sketch') $mode_cond = "WHERE p.mode == 'Sketch' ";
                if ($mode == 'data') $mode_cond = "WHERE p.mode == 'Data' ";

                $allProject = DB::select("SELECT u.name,u.email,p.project_name,p.description,p.id
                  FROM projects p
                  LEFT JOIN users u
                  ON p.user_id = u.id ".$mode_cond."Order By id desc");

                // dd(count($allProject));
                return view('admin.adminDashboard.index', compact('allProject', 'mode', 'plot_types', 'building_types', 'room_types', 'floor_types'));
            } else {
                //echo 'bbb' ; die;
                $allProject = DB::table('projects')->where('user_id', '=', $userid);
                if ($mode == 'sketch') $allProject = $allProject->where('mode', 'Sketch');
                if ($mode == 'data') $allProject = $allProject->where('mode', 'Data');
                $allProject = $allProject->orderby('id', 'desc')->get();
                //dd($allProject);
                return view('admin.user.project.index', compact('allProject', 'mode', 'plot_types', 'building_types', 'room_types', 'floor_types'));
            }
        }
    }

    public function models()
    {
        $sitesettings = SiteSetting::first();
        return view('admin.models', compact('sitesettings'));
    }

    public function new3dviewer()
    {
        $sitesettings = SiteSetting::first();
        return view('admin.3D_view.new3d', compact('sitesettings'));
    }

    public function threeDview(Request $request)
    {
        if ($request->id) {
            $getSingleProducts = DB::table('projects')
                ->where('id', '=', $request->id)
                ->get();
            return response()->json($getSingleProducts);
        } else {
            $userid = Auth::user()->id;
            if (Auth::user()->id == 1) {
                $allProject = DB::select("SELECT u.name,u.email,p.project_name,p.description,p.id
                FROM projects p
                LEFT JOIN users u
                ON p.user_id = u.id");

                // dd($allProject);exit;
                return view('admin.3D_view.index', compact('allProject'));
            } else {
                $allProject = DB::table('projects')
                    ->where('user_id', '=', $userid)
                    ->get();
                return view('admin.3D_view.index', compact('allProject'));
            }
        }
    }

    public function store(Request $request)
    {
        $userid = Auth::user()->id;
        $addProject = new Project();
        $addProject->user_id = $userid;
        $addProject->project_name = $request->input('project_name');
        $addProject->description = $request->input('description');
        $addProject->location = $request->input('location');
        $addProject->current_revision = $request->input('current_revision');
        $addProject->mode = $request->input('mode');
        $addProject->status = 0;
        $addProject->save();

        $inserted_id = $addProject->id;
        $pr = new ProjectRevision();
        $pr->project_id = $inserted_id;
        $pr->revision = 1;
        $pr->save();
        //

        return response()->json([
            'result' => 'success'
        ]);
        // return back()->with('message', 'New Project added successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request);
        $projectId = Project::find($request->id);

        $projectId->project_name = request('project_name');
        $projectId->description = request('description');
        $projectId->location = request('location');
        $projectId->current_revision = request('current_revision');
        $projectId->status = 0;
        $projectId->save();

        //  return back()->with('message', 'Project Updated added successfully.');
    }
    public function destroy(Request $request)
    {
        // dd($request->id);
        // $this->request->delete($id);

        $project = Project::find($request->id);
        $project->delete();

        // return redirect()->route('admin.auth.user.deleted');

        return back()->with('message', 'Project deleted  successfully.');
    }
    public function Projectupdate(Request $request)
    {
        //dd($request);
        $projectId = Project::find($request->id);

        $projectId->project_name = request('project_name');
        $projectId->description = request('description');
        $projectId->location = request('location');
        $projectId->current_revision = request('current_revision');
        $projectId->status = 0;
        $projectId->save();
        return redirect()
            ->back()
            ->with('message', 'project duplicated Successfully');
        //  return back()->with('message', 'Project Updated added successfully.');
    }
}
