@extends('layouts.app')
@section('content')
    @if(session('success'))
    <script>
        window.onload = function() {
            alert('{{ session('success') }}');
        };
    </script>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{route('item.create')}}" type="button" class="btn btn-success btn-lg" style="margin-bottom: 1em">Create Item</a>
            <div class="list-group">
                @foreach($menu as $item)
                    <a href="#" style="margin-bottom: 0.1em" class="list-group-item list-group-item-action " aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">{{$item->name}}</h5>
                      <strong>$ {{$item->price}}</strong>
                    </div>
                    <p class="mb-1">{{$item->description}}</p>
                    <small>{{$item->category->name}}</small>
                        <div style="float: right" role="group" aria-label="Basic mixed styles example">
                          <a href="{{route('item.edit',$item->id)}}" type="button" class="btn btn-outline-primary" style="margin-right: 0.2em">Edite</a>
                       <a style="">
                           <form style="display:inline" method="POST" action="{{route('item.delete',$item['id'])}}">
                           @csrf
                           @method("DELETE")
                           <button type="submit" class="btn btn-outline-danger">Delete</button>
                       </form>
                       </a>

                        </div>
                  </a>
                @endforeach


                </div>
        </div>
    </div>
</div>
@endsection
