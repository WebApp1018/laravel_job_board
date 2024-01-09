<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\UserSetting;
use Auth;
use DB;
use App\Helpers\Helper;
use App\SiteSetting;

class UserSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = UserSetting::all();

        return view('admin.userssetting.index', compact('users'));
    }

    public function sitesettings()
    {
        //
        $settings = SiteSetting::first();

        return view('admin.userssetting.site', compact('settings'));
    }

    public function addsitesettings(Request $request)
    {
        $settings = SiteSetting::first();
        $settings->homepagetext1= $request->homepagetext1;
        $settings->homepagetext2= $request->homepagetext2;
        $settings->homepagetext3= $request->homepagetext3;
        $settings->subscriptiontxt= $request->subscriptiontxt;
        $settings->address= $request->address;
        $settings->sidebar= $request->sidebar;
        $settings->sidebartwo= $request->sidebartwo;
        $settings->navigationlist= $request->navigationlist;
        $settings->dpanel= $request->dpanel;
        $settings->email= $request->email;
        $settings->viewblogs= $request->viewblogs;
        $settings->dupbutton= $request->dupbutton;
        $settings->propbutton= $request->propbutton;
        $settings->basebutton= $request->basebutton;
        $settings->usertype= $request->usertype;
        $settings->viewsignup= $request->viewsignup;
        $settings->jsonfilepath= $request->jsonfilepath;
        $settings->csvfilepath= $request->csvfilepath;
        $settings->pdffilepath= $request->pdffilepath;
        $settings->fbxfilepath= $request->fbxfilepath;
        $settings->dwgfilepath= $request->dwgfilepath;
        
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
            $settings->hiwi = '/blog_images'.'/'.$input['imagename'];

        }

        if ($request->file('hero')) {
           
           

            $image = $request->file('hero');
            $input['imagename'] =$image->hashName();
            // $destinationPath = public_path('/thumbnail');
            // $img = Image::make($image->path());
            // $img->resize(100, 100, function ($constraint) {
            //     $constraint->aspectRatio();
            // })->save($destinationPath.'/'.$input['imagename']);
    
            $destinationPath = public_path('/blog_images');
            $image->move($destinationPath, $input['imagename']);
            $settings->hero = '/blog_images'.'/'.$input['imagename'];

        }



        $settings->save();
        return redirect()->back()->with('message', 'Recorde Update Successfully');
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
        $user = UserSetting::where('id',$id)->first();

        return view('admin.userssetting.edit', compact('user'));
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
        //
        //dd($request);
        DB::table('user_settings')
                    ->where('id', $request->id)
                    ->update([
                        'max_plot_number' => $request->max_plot_number,
                        'max_building_number' => $request->max_building_number,
                        'max_floor_number' => $request->max_floor_number,
                        'max_room_number' => $request->max_room_number,
                        'number_of_try' => $request->number_of_try,
                        'number_of_user' => $request->number_of_user,
                    ]);
        return redirect()->back()->with('message', 'Recorde Update Successfully');
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
