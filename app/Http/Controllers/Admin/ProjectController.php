<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project;
use App\ProjectRevision;
use Auth;
use DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    
    
        if($request->id){
            $getSingleProducts = DB::table('projects')
            ->where('id', '=',$request->id)
            ->get();
            // dd($getSingleProducts);
            return response()->json($getSingleProducts);
        }else{
           
            $allProject = Project::all();

            // dd($allProject);
            
            return view('user.project.index',compact('allProject'));
    
        }
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
       
        
        $addProject = new Project();
        $addProject->user_id = Auth()->user()->id;
        $addProject->project_name = $request->input('project_name');
        $addProject->description = $request->input('description');
        $addProject->location = $request->location;
        $addProject->mode = $request->mode;
        $addProject->JSON0_S = $request->json;
        $addProject->status = 0;

        $addProject->save();
        // 
        
        return response()->json([
            'result' => 'success'
        ]);
        // return back()->with('message', 'New Project added successfully.');
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
    public function update(Request $request)
    {
        // dd($request);
          $projectId = Project::find($request->id);
          
          $projectId->project_name = request('project_name');   
          $projectId->description = request('description');
          
          $projectId->status = 0;   
          $projectId->save();

        //  return back()->with('message', 'Project Updated added successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
