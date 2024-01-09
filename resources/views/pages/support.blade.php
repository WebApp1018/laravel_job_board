@extends('layouts.page_layout')
@section('content')

  <div class="container">
    <div class="row">
      <div class="col-12">
        
        <?php 
        echo html_entity_decode($content->support_content); ?>
        
      </div>
    </div>
  </div>
@endsection
