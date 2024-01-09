@extends('layouts.admin')
@section('content')

<div style="padding-top: 20px" class="container-fluid">

    <div class="card">
        <div class="card-header">
           Edit Blog
        </div>

        <div class="card-body">
            <form  action="{{ route('admin.update.blog') }}" method="POST" enctype="multipart/form-data">
                 @csrf
              
                 
                 <div class="form-group ">
                    <label for="name">Title*</label>
                    <input type="text" name="title" class="form-control" value="{{$blog->title}}" required>
                    <p class="helper-block">

                    </p>
                </div>
                <div class="form-group ">
                    <label for="name">Description*</label>
                    <textarea name="description" class="form-control ckeditor"  required>{{$blog->description}}</textarea>
                    <p class="helper-block">

                    </p>
                </div>
                <div class="form-group ">
                    <label for="name">Image</label>
                    <input type="file" name="image" class="form-control">
                    <p class="helper-block">

                    </p>
                </div>

                <div class="form-group ">
                    <label for="name">Status*</label>
                    <select class="form-control" name="status" required>
                        <option @if($blog->status==1) selected @endif value="1">Active</option>
                        <option  @if($blog->status==0) selected @endif  value="0">Inactive</option>
                    </select>
                    <p class="helper-block">

                    </p>
                </div>
                    <input type="hidden" id="id" name="id" class="form-control" value="{{$blog->id}}">
                  
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