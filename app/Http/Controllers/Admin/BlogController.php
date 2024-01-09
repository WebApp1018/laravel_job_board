<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blogs;
use DB;
use App\Category;
use App\Subscriptions;
use MicrosoftAzure\Storage\Blob\Models\Blob;

class BlogController extends Controller
{
    public function index(){
  
         
         $data =  Blogs::get();

    	return view('admin.blog.blog',compact('data'));
    }


    public function subscriptions(){
  
         
        $data = Subscriptions::get();

       return view('admin.blog.subscriptions',compact('data'));
   }


   public function destroysubscriptions(Request $request)
   {
       // dd($request->id);
       // $this->request->delete($id);

       $Blogs = Subscriptions::find($request->id);
       
       $Blogs->delete();
      
       return back()->with('message', 'Subscriptions deleted  successfully.');

       
   }

     public function addBlog(Request $request){
    $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        $input = $request->all();
        // $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
           $formdata = [];
           $formdata['status'] = 1;
           $formdata['title'] = $request->title;
           $formdata['description'] = $request->description;

        if ($request->file('image')) {
           
           

            $image = $request->file('image');
            $input['imagename'] =$image->hashName();
            // $destinationPath = public_path('/thumbnail');
            // $img = Image::make($image->path());
            // $img->resize(100, 100, function ($constraint) {
            //     $constraint->aspectRatio();
            // })->save($destinationPath.'/'.$input['imagename']);
    
            $destinationPath = public_path('/blog_images');
            $image->move($destinationPath, $input['imagename']);
            $formdata['image'] = '/blog_images'.'/'.$input['imagename'];

        }


        Blogs::create($formdata);


        return back()->with('message', 'New blog added successfully.');
    }

    public function destroy(Request $request)
    {
        // dd($request->id);
        // $this->request->delete($id);

        $Blogs = Blogs::find($request->id);
        
        $Blogs->delete();

        // return redirect()->route('admin.auth.user.deleted');
       
        return back()->with('message', 'blog deleted  successfully.');

        
    }
    public function update(Request $request)
    {
        // dd($request);

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);


          $plotId = Blogs::find($request->id);
          
          $plotId->title = $request->input('title');
          $plotId->status = $request->input('status');
          $plotId->description = $request->input('description');  

          if ($request->file('image')) {
           
           

            $image = $request->file('image');
            $input['imagename'] =$image->hashName();
            // $destinationPath = public_path('/thumbnail');
            // $img = Image::make($image->path());
            // $img->resize(100, 100, function ($constraint) {
            //     $constraint->aspectRatio();
            // })->save($destinationPath.'/'.$input['imagename']);
    
            $destinationPath = public_path('/blog_images');
            $image->move($destinationPath, $input['imagename']);
            $plotId->image = '/blog_images'.'/'.$input['imagename'];

        }


         
          $plotId->save();

        return redirect()->action([BlogController::class, 'index']);

    }


     public function edit(Request $request)
    {

        // echo "HI";exit;
        // dd($request);
        $blog = Blogs::Where('id', '=',$request->id)->first();
        

        // $plot_types = PlotType::all()->pluck('title', 'id');

        // print_r($getSingleProducts);exit;

        return view('admin.blog.editblog',compact('blog'));
    }
}
