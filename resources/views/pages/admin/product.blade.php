@extends('layouts.admin')


@section('content')


<h1 class="text-center mt-5">Manage Product</h1>
<button type="button" class="btn btn-primary mt-5 mb-5 bi bi-plus" data-bs-toggle="modal" data-bs-target="#exampleModal"> Add Product</button>
<button type="button" class="btn btn-primary mt-5 mb-5 bi bi-plus" data-bs-toggle="modal" data-bs-target="#exampleModal"> import Product</button>
<br><br><br>


<table class="table mt-2 datatable">
    <thead>
        <tr>
            <td>Code</td>
            <td>Product Name</td>
            <td>Product Category</td>
            <td>Price</td>
            <td>Quantity</td>
            <td>Image</td>
            <td>Status</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach ( $products as $product )
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->title }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->quantity }}</td>
            <td>{{ $product->image }}</td>
            <td>{{ $product->status }}</td>
            <td><a href="" id="{{ $product->id }}" class="editProduct" data-bs-toggle="modal" data-bs-target="#editModal"><i class="bi bi-pencil-square"></i></a></td>
        </tr>

        @endforeach
    </tbody>
</table>


{{-- Add Modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Product Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Product Title</label>
                        <input type="text" class="form-control" name="productName">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Product Category</label>
                        <select name="productCat" id="" class="form-control">
                            <option value="" selected disabled> --- Select Category ---</option>
                            @foreach ($categories as $category )
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Price</label>
                                <input type="text" class="form-control" name="productPrice">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Quantity</label>
                                <input type="text" class="form-control" name="productQty">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="categoryInput" class="form-label">Product Image</label>
                            <input type="file" name="productImage" class="form-control">
                        </div>

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


{{-- Edit Modal --}}

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Product Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Product Title</label>
                        <input type="text" class="form-control" name="editProductName" id="editProductName">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Product Category</label>
                        <select name="editProductCat" id="editProductCat" class="form-control">
                            <option value="" selected disabled> --- Select Category ---</option>
                            @foreach ($categories as $category )
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Price</label>
                                <input type="text" class="form-control" name="editProductPrice" id="editProductPrice">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Quantity</label>
                                <input type="text" class="form-control" name="editProductQty" id="editProductQty">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="categoryInput" class="form-label">Product Image</label>
                            <input type="file" name="editProductImage" class="form-control" id="editProductImage">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
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

      $('.editProduct').on('click', function()
      {
        const prodId = $(this).attr('id');

        $.ajax({
            'url': "product/" + prodId + "/edit/" ,
            'type': 'GET',
            'success': function (data)
            {
                $.each(data, function (k, v)
                {
                    $('#editProductName').val(v["title"]);
                    $('#editProductCat').val(v['categoryId']);
                    $('#editProductPrice').val(v['price']);
                    $('#editProductQty').val(v['quantity']);
                })
            }
        })
      })

    })
</script>

@endsection
