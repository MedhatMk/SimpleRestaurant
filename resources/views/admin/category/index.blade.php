@extends('layouts.app')
@section('content')
    @if(session('success'))
    <script>
        window.onload = function() {
            alert('{{ session('success') }}');
        };
    </script>
@endif
@section('nav')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('item.index') }}">{{ __('Items') }}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('cat.index') }}">{{ __('Categories') }}</a>
    </li>
@endsection
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{route('cat.create')}}" type="button" class="btn btn-success btn-lg" style="margin-bottom: 1em">Create Category</a>
            <div class="list-group">
                @foreach($cats as $item)
                    <div  style="margin-bottom: 0.5em" class="list-group-item list-group-item-action " aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">{{$item->name}}</h5>
                    </div>
                        <div style="float: right; display: inline-flex" role="group" aria-label="Basic mixed styles example">
                            <a href="{{route('cat.edit',$item->id)}}" type="button" class="btn btn-outline-primary" >Edite</a>
                           <a >
                               <form  method="POST" action="{{route('cat.delete',$item['id'])}}">
                                   @csrf
                                   @method("DELETE")
                                   <button type="submit" class="btn btn-outline-danger">Delete</button>
                               </form>
                           </a>

                        </div>
                  </div>
                @endforeach


                </div>
        </div>
    </div>
</div>
@endsection
