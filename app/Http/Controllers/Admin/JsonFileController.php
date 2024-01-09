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

use App\JsonFile;

use App\Building;

use App\Helpers\Helper;

use Illuminate\Support\Facades\Storage;

use File;

use App\ProjectRevision;

use App\FloorRoom;

use App\Plot;

use App\Room;

use App\SiteSetting;



class JsonFileController extends Controller

{



  

    public function index()

    {    



        $data =  JsonFile::select(

            "json_files.id", 

            "json_files.user_id",

            "json_files.project_id", 

             "json_files.created_at", 

            "json_files.updated_at", 

            "json_files.json0",

            "json_files.process_fbx",

            "json_files.fbx1_file",

            "json_files.json1_file",

            "json_files.process_fbx2",

            "json_files.fbx2_file",

            "json_files.json2_file",

            "json_files.process_dwg1",

            "json_files.dwg1_file",

            "json_files.process_pdf1",

            "json_files.pdf1_file",

            "json_files.conceptual_message",

            "json_files.fbx1_message",

            "json_files.fbx2_message",

            "json_files.dwg1_message",

            "json_files.pdf1_message",

            "json_files.project_revision",

            "json_files.valid",

            "projects.project_name as project_name")

            ->leftJoin("projects", "projects.id", "=", "json_files.project_id")

            ->get();



            return view('admin.json.index',compact('data'));



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



        $project = JsonFile::find($request->id);

        

        $project->delete();



        // return redirect()->route('admin.auth.user.deleted');

       

        return back()->with('message', 'Project deleted  successfully.');



        

    }

}