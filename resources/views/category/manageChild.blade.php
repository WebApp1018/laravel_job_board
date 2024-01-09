<ul>

    @foreach($childs as $child)
   
        @if($child->parent_host=="Building")
          
         <li>
          <input type="checkbox" data-parent="{{$child->parent_host}}" id="child_id_{{$child->id}}" class="child_id floor_class" name="fav_language_b[]" data-id="{{$child->parent_id}}" data-sort="{{$child->sort_order}}"  value="{{$child->id}}" vals="{{$child->parent_id}}">
            {{ $child->title }}

            @if(count($child->childs))

                @include('category.manageChild',['childs' => $child->childs])

            @endif

        </li>
        @else
         <li>
          <input type="checkbox" data-parent="{{$child->parent_host}}" id="child_id_{{$child->id}}" class="child_id" name="fav_language_b[]" data-id="{{$child->parent_id}}"   value="{{$child->id}}" vals="{{$child->parent_id}}">
            {{ $child->title }}

            @if(count($child->childs))

                @include('category.manageChild',['childs' => $child->childs])

            @endif

        </li>
        @endif
    @endforeach

</ul>