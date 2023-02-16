<x-layout>

    <div class="container">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-xs-6">
                            <h2>Manage <b>Warehouses</b> - Warehouse - {{ $warehouses->count() }}</h2>
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
                            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i
                                    class="material-icons">&#xE147;</i> <span>Add New Warehouse</span></a>
                            <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i
                                    class="material-icons">&#xE15C;</i> <span>Delete</span></a>
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
                            <th>Address</th>
                            <th>Type</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($warehouses as $warehouse)
                            <tr>
                                <td>
                                    <span class="custom-checkbox">
                                        <input type="checkbox" class="warehouse-checkbox"
                                            data-id="{{ $warehouse->id }}">
                                        <label for="checkbox5"></label>
                                    </span>
                                </td>
                                <td>{{ $warehouse->id }}</td>
                                <td>{{ $warehouse->name }}</td>
                                <td>{{ $warehouse->address }}</td>
                                <td>{{ $warehouse->type }}</td>
                                <td>{{ $warehouse->status }}</td>
                                <td>
                                    <a href="#editWarehouseModal" id="edit" data-warehouseid="{{ $warehouse->id }}"
                                        class="edit" data-toggle="modal"><i class="material-icons"
                                            data-toggle="tooltip" title="Edit">&#xE254;</i></a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="clearfix">
                    {{-- @if ($products->count() > 0)
                        {{ $products->links() }}
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
    <!-- Add Modal HTML -->
    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="api/warehouse">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add Warehouse</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input name="name" value="Cronic" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <input name="status" value="1" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>address</label>
                            <input name="address" value="Los Angeles" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <input name="type" value="modern" type="text" class="form-control" required>
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
    <div id="editWarehouseModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editWarehouseForm" data-id="">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Warehouse</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input name="name" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input name="address" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <input name="type" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <input name="status" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="id" class="form-control">
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
    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Employee</h4>
                        <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete these Records?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" id="delete-warehouses" class="btn btn-danger" value="Delete">
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>

<script>
    $('#delete-warehouses').click(function() {
        var warehouseIds = [];
        $('.warehouse-checkbox:checked').each(function() {
            warehouseIds.push($(this).data('id'));
        });
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'DELETE',
            url: 'api/warehouse/delete',
            data: {
                warehouseIds: warehouseIds
            },
            success: function(data) {
                // remove the deleted warehouses from the table
                $('.warehouse-checkbox:checked').closest('tr').remove();
            },
            error: function(error) {
                alert(error.responseJSON.message);
            }
        });
    });
</script>

<script>
    $('#select-all').change(function() {
        $('.warehouse-checkbox').prop('checked', this.checked);
    });
</script>



<script>
    $(document).ready(function() {
        // When the edit button is clicked
        $(document).on("click", ".edit", function() {
            // Get the row data
            var $row = $(this).closest("tr");
            var name = $row.find("td:eq(2)").text();
            var address = $row.find("td:eq(3)").text();
            var type = $row.find("td:eq(4)").text();
            var status = $row.find("td:eq(5)").text();
            var id = $row.find("td:eq(1)").text();

            // Fill the form with the selected data
            $("input[name='name']").val(name);
            $("input[name='address']").val(address);
            $("input[name='type']").val(type);
            $("input[name='status']").val(status);
            $("input[name='id']").val(id);

            // Set the data-id attribute of the form to the selected warehouse ID
            $("#editWarehouseForm").attr("data-id", id);

            // Show the modal
            $("#editWarehouseModal").modal("show");
        });
    });
</script>
<script>
    // When the form is submitted
    $("#editWarehouseForm").submit(function(e) {
        e.preventDefault();

        // Get the form data
        var formData = $(this).serialize();
        var warehouseid = $(this).data("id");

        // Send the data to the server
        $.ajax({
            type: 'POST',
            url: 'api/warehouses/update/' + warehouseid,
            data: formData,
            success: function(data) {
                // Handle the response from the server
                if (data.status == 'success') {
                    // Update the table with the new data
                    var $row = $("#editWarehouseModal").closest("tr");
                    $row.find("td:eq(1)").text(data.name);
                    $row.find("td:eq(2)").text(data.address);
                    $row.find("td:eq(3)").text(data.type);
                    $row.find("td:eq(4)").text(data.status);

                    // Hide the modal
                    $("#editWarehouseModal").modal("hide");

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
