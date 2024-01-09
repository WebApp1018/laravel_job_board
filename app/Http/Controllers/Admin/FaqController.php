<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Faqs;
use DB;
use App\Category;
use MicrosoftAzure\Storage\Blob\Models\Blob;

class FaqController extends Controller
{
    public function index(){
  
         
         $data =  Faqs::get();

    	return view('admin.faq.faq',compact('data'));
    }

     public function addFaq(Request $request){
    $this->validate($request, [
            'question' => 'required',
            'answer' => 'required',
        ]);

        $input = $request->all();
        // $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
           $formdata = [];

           $formdata['question'] = $request->question;
           $formdata['answer'] = $request->answer;

        


        Faqs::create($formdata);


        return back()->with('message', 'New faq added successfully.');
    }

    public function destroy(Request $request)
    {
        // dd($request->id);
        // $this->request->delete($id);

        $Faqs = Faqs::find($request->id);
        
        $Faqs->delete();

        // return redirect()->route('admin.auth.user.deleted');
       
        return back()->with('message', 'faq deleted  successfully.');

        
    }
    public function update(Request $request)
    {
        // dd($request);

        $this->validate($request, [
            'question' => 'required',
            'answer' => 'required',
        ]);


          $plotId = Faqs::find($request->id);
          
          $plotId->question = $request->input('question');
          $plotId->answer = $request->input('answer');  



         
          $plotId->save();

        return redirect()->action([FaqController::class, 'index']);

    }


     public function edit(Request $request)
    {

        // echo "HI";exit;
        // dd($request);
        $faq = Faqs::Where('id', '=',$request->id)->first();
        

        // $plot_types = PlotType::all()->pluck('title', 'id');

        // print_r($getSingleProducts);exit;

        return view('admin.faq.editfaq',compact('faq'));
    }
}
