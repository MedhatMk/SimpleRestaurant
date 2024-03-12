@extends('layouts.app')

@section('content')
<!-- Include SweetAlert2 -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <a href="{{route('item.index')}}" style="margin-left: 3em" class="btn btn-dark">Back</a>

 <form  method="POST" action="{{(isset($item))?route('cat.update',['id' => $item->id]):route('cat.store')}}"   style="padding: 3em">
     @csrf
     {{isset($item)?method_field('PUT'):''}}
  <fieldset >
      <strong><legend>{{isset($item)?'Edit / '.$item->name :'Create'}}</legend></strong>
    <div class="mb-3">
      <label class="form-label">Category Title</label>
      <input name='name' type="text" class="form-control" placeholder="Item Name" value="@if(old('name')){{old('name')}}@elseif(isset($item->name)){{$item->name}}@endif" required>
    </div>
      <button type="submit" class="btn btn-success">Submit</button>
    </div>

  </fieldset>
</form>

@endsection
