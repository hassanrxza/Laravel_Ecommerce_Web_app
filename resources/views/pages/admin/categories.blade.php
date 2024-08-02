@extends('layouts.admin')


@section('content')


<h1 class="text-center mt-5">Manage Categories</h1>
<button type="button" class="btn btn-primary mt-5 mb-5" data-bs-toggle="modal" data-bs-target="#exampleModal"> Add Category</button>
<br><br><br>


<table class="table mt-2 datatable">
    <thead>
        <tr>
            <td>S. No</td>
            <td>Category Name</td>
            <td>Status</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{$category->name}}</td>
            <td><a class="currentStatus" id="{{ $category->id }}" style="cursor: pointer; color: black;">{{$category->status}}</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ url('/addCategory') }}" method="post">
          @csrf
        <div class="modal-body">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Category Name</label>
                <input type="text" class="form-control" name="categoryName">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </div>
      </form>
    </div>
  </div>


  <script>
    $(document).ready(function()
    {
      $.ajaxSetup({
        headers: 
        {'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr('content') }
      });

      $('.currentStatus').on('click', function()
      {
        let catId = $(this).attr('id');
        $.ajax({
          'url': 'updateStatus/' + catId,
          'type': 'POST',
          'success': function(data)
          {
            console.log(data)
            $('#' + catId).text(data);
          }


        })
      })
    })
  </script>


@endsection
