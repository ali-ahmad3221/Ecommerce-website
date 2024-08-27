@extends('admin.index')
@section('title', 'products')
@section('meta_keywords', 'Laravel,PHP, Web Development, Framework, devops')
@section('meta_description', 'This is an example page showing how to set dynamic meta keywords and description in Laravel.')
@section('content')

    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-3">
            <h2 style="color: #4B49AC;">Product Listing</h2>
            <button class="btn text-white" style="background-color: #4B49AC;" data-toggle="modal" data-target="#addProductModal">
                <i class="fas fa-plus"></i> Add Product
            </button>
        </div>

        <div style="overflow-x: auto;">
            <table class="table table-bordered text-center">
                <thead class="text-white fw-bold" style="background-color: #4b49ac; border:1px solid #4B49AC;">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Picture</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Category</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td id="id">{{$product?->id}}</td>
                            <td id="title">{{$product?->title}}</td>
                            <td id="keywords" style="display: none;">{{$product?->keywords}}</td>
                            <td id="descriptions" style="display: none;">{{$product?->description}}</td>
                            <td id="pic"><img src="{{asset('uploads/products/'.$product?->picture)}}" alt="product picture" srcset=""></td>
                            <td id="price">{{$product?->price}}</td>
                            <td id="qty">{{$product?->qty }}</td>
                            <td id="cats">{{$product?->cats}}</td>
                            <td id="type">{{$product?->type}}</td>
                            <td>
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewProductModal" onclick="openViewProductModal(this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editProductModal" onclick="openEditProductModal(this)">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="delThisProduct('{{ route('product.destroy', $product->id)}}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <p>No record found</p>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel" style="color: #4B49AC;">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('product.store')}}" id="productaddForm" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="productName">Name</label>
                            <input type="text" name="pname" class="form-control" id="productname" placeholder="Enter product name" value="">
                        </div>

                        <div class="form-group">
                            <label for="productKeywords">Keywords</label>
                            <input type="text" name="keywords" class="form-control" id="productKeywords" placeholder="Enter product keywords" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="productDescription">Descriptions</label>
                            <textarea type="text" name="description" class="form-control" id="productDescription" placeholder="Enter product description" value="" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="pqty">Quantity</label>
                            <input type="number" name="ppqty" class="form-control" id="qty" placeholder="Enter product qty" value="">
                        </div>
                        <div class="form-group">
                            <label for="product_pic">Picture</label>
                            <input type="file" name="pfile" id="pic"  class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label for="productprice">Price</label>
                            <input type="number" step="0.01" name="amount" class="form-control" id="price" placeholder="Enter price" value="">
                        </div>
                        <div class="form-group">
                            <label for="productCats">Categories</label>
                            <select class="form-control" name="product_cat">
                                <option value="" selected>Select category</option>
                                <option value="shoes">Shoes</option>
                                <option value="shirt">Shirt</option>
                                <option value="jacket">jacket</option>
                                <option value="bags">Bags</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="productType">Type</label>
                            <select class="form-control" name="product_types">
                                <option value="" selected>Select Type</option>
                                <option value="new-arrivals">New Arrivals</option>
                                <option value="hot-sales">Hot Sale</option>
                                <option value="best">Best</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel" style="color: #4B49AC;">Update Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="" id="producteditForm" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" id="product_id" value="" name="product_id">
                        <div class="form-group">
                            <label for="productName">Name</label>
                            <input type="text" name="name" class="form-control" id="productName" placeholder="Enter product name" value="">
                        </div>

                        <div class="form-group">
                            <label for="editproductKeywords">Keywords</label>
                            <input type="text" name="keywords" class="form-control" id="editproductKeywords"  value="">
                        </div>
                        <div class="form-group">
                            <label for="editproductDescription">Descriptions</label>
                            <textarea name="description" class="form-control" id="editproductDescription" value="" rows="3"></textarea>
                        </div>


                        <div class="form-group">
                            <label for="pqty">Quantity</label>
                            <input type="number" name="pqty" class="form-control" id="pqty" placeholder="Enter product qty" value="">
                        </div>
                        <div class="form-group">
                            <label for="product_pic">Picture</label>
                            <img src="" alt="product image" id="image" style="max-width: 100px; display: block; margin-top: 10px;">
                            <input type="file" name="file" id="product_pic"  class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label for="productprice">Price</label>
                            <input type="number" step="0.01" name="price" class="form-control" id="productprice" placeholder="Enter price" value="">
                        </div>
                        <div class="form-group">
                            <label for="productCats">Categories</label>
                            <select class="form-control" name="product_cats">
                                <option value="shoes">Shoes</option>
                                <option value="shirt">Shirt</option>
                                <option value="jacket">jacket</option>
                                <option value="bags">Bags</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="productType">Type</label>
                            <select class="form-control" name="product_type">
                                <option value="new-arrivals">New Arrivals</option>
                                <option value="hot-sales">Hot Sale</option>
                                <option value="best">Best</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- View Product Modal -->
    <div class="modal fade" id="viewProductModal" tabindex="-1" role="dialog" aria-labelledby="viewProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel" style="color: #4B49AC;">Product Details</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="card" style="max-width: 540px; margin: auto;">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="" alt="Product Image" class="card-img" id="p_image">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <p class="card-text"><strong>Title:</strong> <span id="product_name" class="ml-4"></span></p>
                                        <p class="card-text"><strong class="mr-4">Price:</strong> $<span id="product_price"></span></p>
                                        <p class="card-text"><strong>Quantity:</strong> <span id="p_qty" class="ml-4"></span></p>
                                        <p class="card-text"><strong>Category:</strong> <span id="product_cats" class="ml-4"></span></p>
                                        <p class="card-text"><strong>Type:</strong> <span id="product_type" class="ml-4"></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="deleteForm" action="" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>


    <script>

        function openEditProductModal(el) {
            let baseRoute = "{{ route('product.update', ':id') }}";
            let row = $(el).closest('tr');
            baseRoute = baseRoute.replace(':id', row.find('#id').text());
            document.getElementById('producteditForm').action = baseRoute;

            document.getElementById('product_id').value = row.find('#id').text();
            document.getElementById('productName').value  = row.find('#title').text();

            setTimeout(function() {
                document.getElementById('editproductKeywords').value = row.find('#keywords').text().trim();
                document.getElementById('editproductDescription').value = row.find('#descriptions').text().trim();
            }, 100);

            document.getElementById('image').src = row.find('#pic img').attr('src');
            document.getElementById('productprice').value = row.find('#price').text();
            document.getElementById('pqty').value  = row.find('#qty').text();
            document.querySelector('select[name="product_cats"]').value = row.find('#cats').text();
            document.querySelector('select[name="product_type"]').value  = row.find('#type').text();
        }

        function openViewProductModal(el) {
            let row = $(el).closest('tr');
            document.getElementById('product_id').value = row.find('#id').text();
            document.getElementById('product_name').innerText   = row.find('#title').text();
            document.getElementById('p_image').src = row.find('#pic img').attr('src');
            document.getElementById('product_price').innerText  = row.find('#price').text();
            document.getElementById('p_qty').innerText   = row.find('#qty').text();
            document.getElementById('product_cats').innerText   = row.find('#cats').text();
            document.getElementById('product_type').innerText   = row.find('#type').text();
        }

        function delThisProduct(route){
            if (confirm('Are you sure you want to delete this product?'))
            {
                let form = document.getElementById('deleteForm');
                form.action = route;
                form.submit();
            }
        }

    </script>
@endsection
