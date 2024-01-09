<?php

namespace App\Http\Controllers;

use App\Blogs;
use App\Faqs;
use App\SiteSetting;
use App\Subscriptions;
use Illuminate\Http\Request;
use DB;
class PagesController extends Controller
{
    //

    public function home()
    {

         $faqs = Faqs::get();
         $settings =  SiteSetting::first();
    	return view('pages.home', compact('faqs' , 'settings'));
    }

    public function addsubscription(Request $request){

        $this->validate($request, [
            'email' => 'required|unique:subscriptions,email',
        ],
        [
         'email.required'=> 'Email is Required', // custom message
         'email.unique'=> 'Already subscribed on this email', // custom message
        ]);
        Subscriptions::create(['email'=>$request->email]);
        return back()->with('message', 'Subscription added  successfully.');
    }

    public function latestblog(){

        $settings =  SiteSetting::first();

        if($settings->viewblogs!='show'){
            return back();
        }
        $blogs =  Blogs::where('status' ,1)->orderBy('id', 'desc')->skip(0)->take(2)->get()->toArray();
        $new =  Blogs::where('status' ,1)->orderBy('id', 'desc')->skip(2)->take(4)->get()->toArray();
        return view('pages.latestblog', compact('blogs' , 'new'));
       
    }

    public function allblogs(){
        $settings =  SiteSetting::first();

        if($settings->viewblogs!='show'){
            return back();
        }

        $blogs =  Blogs::where('status' ,1)->orderBy('id', 'desc')->paginate(12);
       
    	return view('pages.allblogs', compact('blogs'));
    }


    public function blogDetail($slug){
        $settings =  SiteSetting::first();

        if($settings->viewblogs!='show'){
            return back();
        }
        $blog =array();
        if(isset($slug)){
           $blog =   Blogs::where('status' ,1)->where('slug' , $slug)->get()->first();
        }
        $new =  Blogs::where('status' ,1)->orderBy('id', 'desc')->skip(0)->take(10)->get();
        return view('pages.blogDetail', compact('blog' , 'new'));
    }



    public function support()
    {
    	$content = DB::table('pages')->latest('id')->first();
        return view('pages.support',compact('content')); 
    }
    public function faq()
    {
    	$content = DB::table('pages')->latest('id')->first();
        
        return view('pages.faq',compact('content')); 
    }
    public function about()
    {
    	$content = DB::table('pages')->latest('id')->first();
        
        return view('pages.about',compact('content')); 
    }
    public function feature()
    {
    	$content = DB::table('pages')->latest('id')->first();
        
        return view('pages.feature',compact('content')); 
    }
}
