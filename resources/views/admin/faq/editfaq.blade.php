@extends('layouts.admin')
@section('content')

<div style="padding-top: 20px" class="container-fluid">

    <div class="card">
        <div class="card-header">
           Edit FAQ
        </div>

        <div class="card-body">
            <form  action="{{ route('admin.update.faqs') }}" method="POST" enctype="multipart/form-data">
                 @csrf
              
                 
                 <div class="form-group ">
                    <label for="name">Question*</label>
                    <input type="text" name="question" class="form-control" value="{{$faq->question}}" required>
                    <p class="helper-block">

                    </p>
                </div>
                <div class="form-group ">
                    <label for="name">Answer*</label>
                    <textarea name="answer" class="form-control"  required>{{$faq->answer}}</textarea>
                    <p class="helper-block">

                    </p>
                </div>
              


                    <input type="hidden" id="id" name="id" class="form-control" value="{{$faq->id}}">
                  
                 <p class="helper-block">
                 </p>
             </div>
             <div>
                <input class="btn btn-primary" type="submit" value="Save" style="position:relative;left: 10px;">

            </div>
            <br>
        </form>
    </div>
</div>

</div>

    


@endsection