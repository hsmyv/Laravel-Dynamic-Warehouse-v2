<x-layout>

    <div class="container">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-xs-6">
                            <h2>Warehouse - {{$warehouse->name}} - {{$warehouse->products->count()}}</h2>
                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session()->get('error') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-xs-6">
                            <a  href="#transaction" class="btn btn-primary" data-toggle="modal"><span>Transaction</span></a>
                            <a href="#addProductModal" class="btn btn-success" data-toggle="modal"><i
                                    class="material-icons">&#xE147;</i> <span>Add New Product</span></a>
                            <a  href="#deleteProductModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>
                            <a  href="/warehouses" class="btn btn-success" data-toggle="modal"><span>Warehouse</span></a>

                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>
                                <span class="custom-checkbox">
                                    <label for="select-all">All</label>
                                    <input type="checkbox" id="select-all">
                                </span>
                            </th>
                            <th>id</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Warehouse</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Sell</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($warehouse->products as $product)
                            <tr>
                                <td>
                                    <span class="custom-checkbox">
                                        <input type="checkbox" class="product-checkbox" data-id="{{ $product->id }}">
                                        <label for="checkbox5"></label>
                                    </span>
                                </td>
                                <td>{{$product->id}}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->id }}</td>
                                <td>{{ $product->warehouse->id }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->sell }}</td>
                                <td>{{ $product->status }}</td>

                                <td>
                                             <a href="#editProductModal" id="edit" data-productid="{{ $product->id }}"
                                        class="edit" data-toggle="modal"><i class="material-icons"
                                            data-toggle="tooltip" title="Edit">&#xE254;</i></a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="clearfix">
                    {{-- @if ($warehouse->products->count() > 0)
                        {{ $warehouse->products->links() }}
                    @else
                        <p>No products found</p>
                    @endif --}}
                     {{-- <div class="hint-text">Showing <b>{{ $products->currentPage() }}</b> out of <b></b> entries</div>
                    <ul class="pagination">
                        <li class="page-item"><a href="{{ $products->previousPageUrl() }}">Previous</a></li>
                        <li class="page-item"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item active"><a   class="page-link">3</a></li>
                        <li class="page-item"><a href="#" class="page-link">4</a></li>
                        <li class="page-item"><a href="#" class="page-link">5</a></li>
                        <li class="page-item"><a href="{{ $products->nextPageUrl() }}" class="page-link">Next</a></li>
                    </ul> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="addProductModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="/api/product">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add Product</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input name="name" value="apple" type="text" class="form-control" required>
                        </div>
                        {{-- <div class="form-group">
                            <label>Category</label>
                            <input name="category_id" type="text" class="form-control" required>
                        </div> --}}
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Warehouse</label>
                            <select name="warehouse_id">
                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input name="quantity" value="10" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input name="price" value="10" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Sell</label>
                            <input name="sell" value="20" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <input name="status" value="1" type="text" class="form-control" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="editProductModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editProductForm">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Product</h4>
                        <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input name="name" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <input name="category_id" type="text" class="form-control" required>
                        </div>
                         <div class="form-group">
                            <label>Warehouse</label>
                            <input name="warehouse_id" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input name="quantity" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input name="price" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Sell</label>
                            <input name="sell" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <input name="status" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input name="id" type="hidden" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-info" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deleteProductModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Product</h4>
                        <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete these Records?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" id="delete-products" class="btn btn-danger" value="Delete">
                    </div>
                </form>
            </div>
        </div>
    </div>

        <!-- Transaction Modal HTML -->
    <div id="transaction" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form  method="POST" action="{{route('product.send')}}">
                    <div class="modal-header">
                        <h4 class="modal-title">Transaction Products</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="sender_warehouse_id" value="{{$warehouse->id}}">
                        <div class="form-group">
                            <label>Product name</label>
                            <select name="product_name">
                                @foreach ($warehouse->products as $product)
                                    <option value="{{ $product->name }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                         <div class="form-group">
                            <label>Receiver Warehouse</label>
                            <select name="warehouse_id">
                                @foreach ($warehouses as $warehouse)
                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input name="quantity" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-info" value="Send">
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>

<script>
    $('#delete-products').click(function() {
        var productIds = [];
        $('.product-checkbox:checked').each(function() {
            productIds.push($(this).data('id'));
        });
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'DELETE',
            url: '/api/product/delete',
            data: {
                productIds: productIds
            },
            success: function(data) {
                // remove the deleted products from the table
                $('.product-checkbox:checked').closest('tr').remove();
            },
            error: function(error) {
                alert(error.responseJSON.message);
            }
        });
    });
</script>

<script>
    $('#select-all').change(function() {
        $('.product-checkbox').prop('checked', this.checked);
    });
</script>
<script>
    $(document).ready(function() {
        // When the edit button is clicked
        $(document).on("click", ".edit", function() {
            // Get the row data
            var $row = $(this).closest("tr");
            var name = $row.find("td:eq(2)").text();
            var category_id = $row.find("td:eq(3)").text();
            var warehouse_id = $row.find("td:eq(4)").text();
            var quantity = $row.find("td:eq(5)").text();
            var price = $row.find("td:eq(6)").text();
            var sell = $row.find("td:eq(7)").text();
            var status = $row.find("td:eq(8)").text();
            var id = $row.find("td:eq(1)").text();

            // Fill the form with the selected data
            $("input[name='name']").val(name);
            $("input[name='category_id']").val(category_id);
            $("input[name='warehouse_id']").val(warehouse_id);
            $("input[name='quantity']").val(quantity);
            $("input[name='price']").val(price);
            $("input[name='sell']").val(sell);
            $("input[name='status']").val(status);
            $("input[name='id']").val(id);

            // Set the data-id attribute of the form to the selected Product ID
            $("#editProductForm").attr("data-id", id);

            // Show the modal
            $("#editProductModal").modal("show");
        });
    });
</script>
<script>
    // When the form is submitted
    $("#editProductForm").submit(function(e) {
        e.preventDefault();

        // Get the form data
        var formData = $(this).serialize();
        var productid = $(this).data("id");

        // Send the data to the server
        $.ajax({
            type: 'POST',
            url: '/api/products/update/' + productid,
            data: formData,
            success: function(data) {
                // Handle the response from the server
                if (data.status == 'success') {
                    // Update the table with the new data
                    var $row = $("#editProductModal").closest("tr");
                    $row.find("td:eq(1)").text(data.name);
                    $row.find("td:eq(2)").text(data.category_id);
                    $row.find("td:eq(3)").text(data.warehouse_id);
                    $row.find("td:eq(4)").text(data.quantity);
                    $row.find("td:eq(5)").text(data.price);
                    $row.find("td:eq(6)").text(data.sell);
                    $row.find("td:eq(7)").text(data.status);

                    // Hide the modal
                    $("#editProductModal").modal("hide");

                    // Reload the page to show the updated data
                    location.reload();
                } else {
                    // Show an error message
                    location.reload();

                }
            }
        });
    });
</script>



