@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Targets</h3>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new">Create New</button>
                </div>
                <div class="card-body">
                    <table class="table" id="buttons-datatables">
                        <thead>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Unit</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($targets as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->customer->title }}</td>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ number_format($item->qty) }}</td>
                                    <td>{{ $item->unit->name }}</td>
                                    <td>{{ date('d M Y', strtotime($item->start)) }}</td>
                                    <td>{{ date('d M Y', strtotime($item->end)) }}</td>
                                    <td>
                                        <a href="{{ route('target.delete', $item->id) }}"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Default Modals -->

    <div id="new" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Create Target</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <form action="{{ route('targets.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mt-2">
                            <label for="product">Product</label>
                            <select name="productID" id="product" required class="selectize">
                                <option value=""></option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label for="customer">Customer</label>
                            <select name="customerID" id="customer" class="selectize">
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label for="unit">Unit</label>
                            <select name="unitID" id="unit" class="form-control">
                                @foreach ($units as $unit)
                                    <option value="{{$unit->id}}">{{$unit->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label for="qty">Qty</label>
                            <input type="number" name="qty" required id="qty"
                                class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="start">Start</label>
                            <input type="date" name="startDate" required id="start" value="{{ date('Y-m-d') }}"
                                class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="end">End</label>
                            <input type="date" name="endDate" required id="end" value="{{ date('Y-m-d') }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/libs/datatable/datatable.bootstrap5.min.css') }}" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="{{ asset('assets/libs/datatable/responsive.bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/libs/datatable/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/selectize/selectize.min.css') }}">
@endsection

@section('page-js')
    <script src="{{ asset('assets/libs/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
    <script src="{{ asset('assets/libs/selectize/selectize.min.js') }}"></script>
    <script>
        $(".selectize").selectize();
    </script>
@endsection
