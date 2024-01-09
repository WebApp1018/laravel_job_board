<ul>

    @foreach($childs as $child)

        <li>
          <input type="radio" id="child_id" class="child_id"  value="{{$child->id}}" vals="{{$child->parent_id}}">
            {{ $child->title }}

            @if(count($child->childs))

                @include('category.manageChild',['childs' => $child->childs])

            @endif

        </li>

    @endforeach

</ul>