<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Page;
use Auth;
use App\Helpers\Helper;
use DB;
class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.index');
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
    public function destroy($id)
    {
        //
    }
    public function add_company()
    {
        $data = Page::all();

        return view('admin.pages.addCompany',compact('data'));
    }
    public function companyStore(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);
        if ($request->logo) {
            $validatedData = $request->validate([
                'logo' => 'mimes:png',
            ]);
           $path='/';
           $fileName = 'logo.png';
           $request->logo->move($path,$fileName);

           
            DB::table('pages')
            ->where('id', $request->id)
            ->update([
            'title' => $request->title,
            'logo' => '/'.$fileName,
            
            ]);
        }
        else
        {
            DB::table('pages')
        ->where('id', $request->id)
        ->update([
        'title' => $request->title,
        
        
        ]);

        }
        return view('admin.pages.index');
        //return back()->with('message', 'New Category added successfully.');
    }
    public function add_feature_content()
    {
        $data = Page::all();
        
        return view('admin.pages.featureContent',compact('data'));
    }
    public function featureContent(Request $request)
    {
        $this->validate($request, [
            'feature_content' => 'required',
        ]);


        DB::table('pages')
        ->where('id', $request->id)
        ->update([
        'feature_content' => $request->feature_content,
        ]);

        return view('admin.pages.index');
        //return back()->with('message', 'New Category added successfully.');
    }
    public function add_faq_content()
    {
        $data = Page::all();
        
        return view('admin.pages.faqContent',compact('data'));
    }
    public function faqContent(Request $request)
    {
        $this->validate($request, [
            'faq_content' => 'required',
        ]);

        DB::table('pages')
        ->where('id', $request->id)
        ->update([
        'faq_content' => $request->faq_content,
        ]);

        return view('admin.pages.index');
        //return back()->with('message', 'New Category added successfully.');
    }
    public function add_support_content()
    {
        $data = Page::all();
        
        return view('admin.pages.supportContent',compact('data'));
    }
    public function supportContent(Request $request)
    {
        $this->validate($request, [
            'support_content' => 'required',
        ]);

        DB::table('pages')
        ->where('id', $request->id)
        ->update([
        'support_content' => $request->support_content,
        ]);

        return view('admin.pages.index');
        //return back()->with('message', 'New Category added successfully.');
    }
    public function add_landing_content()
    {
        $data = Page::all();
        
        return view('admin.pages.landingContent',compact('data'));
    }
    public function landingContent(Request $request)
    {
        $this->validate($request, [
            'landing_content' => 'required',
        ]);

        DB::table('pages')
        ->where('id', $request->id)
        ->update([
        'landing_content' => $request->landing_content,
        ]);

        return view('admin.pages.index');
        //return back()->with('message', 'New Category added successfully.');
    }
}
