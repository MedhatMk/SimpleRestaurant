@extends('layouts.app')

@section('nav')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('item.index') }}">{{ __('Items') }}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('cat.index') }}">{{ __('Categories') }}</a>
    </li>
@endsection

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
            <div class="btn btn-outline-primary" style="float: right">
                    @sortablelink('price', 'Sort by Price')
                </div>
            <form action="{{ route('item.filter') }}" method="get">
                <div class="input-group mb-3">
                    <select name="category" class="form-select" aria-label="Default select example">
                        <option value="">Select a category</option>
                        @foreach($cats as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-outline-secondary" type="submit">Apply Filter</button>
                </div>
            </form>

            <div class="list-group">
                @foreach($menu as $item)
                    <div  style="margin-bottom: 0.5em" class="list-group-item list-group-item-action " aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1"><strong>Name:</strong> {{$item->name}}</h5>
                      <strong>$ {{$item->price}}</strong>
                    </div>
                    <p class="mb-1"><strong>Description:</strong> {{$item->description}}</p>
                    <small><strong>Category:</strong> {{$item->category->name}}</small>
                        <div style="float: right; display: inline-flex" role="group" aria-label="Basic mixed styles example">
                            <a style="margin: 0.2em" href="{{route('item.edit',$item->id)}}" type="button" class="btn btn-outline-primary" >Edit</a>
                           <a  style="margin: 0.2em">
                               <form  method="POST" action="{{route('item.delete',$item['id'])}}">
                                   @csrf
                                   @method("DELETE")
                                   <button type="submit" class="btn btn-outline-danger">Delete</button>
                               </form>
                           </a>

                        </div>
                  </div>
                @endforeach
                    <center class="mt-5">
                        {{  $menu->withQueryString()->links() }}
                    </center>
                </div>
        </div>
    </div>
</div>
@endsection
