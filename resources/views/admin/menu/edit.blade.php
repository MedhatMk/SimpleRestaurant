@extends('layouts.app')

@section('content')
<!-- Include SweetAlert2 -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <a href="{{route('item.index')}}" style="margin-left: 3em" class="btn btn-dark">Back</a>

 <form  method="POST" action="{{(isset($item))?route('item.update',['id' => $item->id]):route('item.store')}}"   style="padding: 3em">
     @csrf
     {{isset($item)?method_field('PUT'):''}}
  <fieldset >
      <strong><legend>{{isset($item)?'Edit / '.$item->name :'Create'}}</legend></strong>
    <div class="mb-3">
      <label class="form-label">Item Title</label>
      <input name='name' type="text" class="form-control" placeholder="Item Name" value="@if(old('name')){{old('name')}}@elseif(isset($item->name)){{$item->name}}@endif" required>
    </div>

    <div class="mb-3" >
      <label class="form-label">Description</label>
    <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3">  @if(old('description')){{old('description')}}@elseif(isset($item->description)){{$item->description}}@endif</textarea>
    </div>

      <div class="mb-3">
      <label class="form-label">Category</label>
      <select name="category_id" class="form-select">
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
      </select>
      <label class="form-label">Price</label>
{{--      <input name='price' type="text" class="form-control" placeholder="Item Price"  value="@if(old('price')){{old('price')}}@elseif(isset($item->price)){{$item->price}}@endif" required>--}}

          <div class="input-group">
      <input name='price' type="number" step="0.01" class="form-control" placeholder="Item Price"  value="@if(old('price')){{old('price')}}@elseif(isset($item->price)){{$item->price}}@endif" required>
          <span class="input-group-text">$</span>
          <span class="input-group-text">0.00</span>
    </div>
      </div>    <button type="submit" class="btn btn-success">Submit</button>

  </fieldset>
</form>

@endsection
