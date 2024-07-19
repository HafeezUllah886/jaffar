@extends('layout.popups')
@section('content')
        <div class="row justify-content-center">
            <div class="col-xxl-9">
                <div class="card" id="demo">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end d-print-none p-2 mt-4">
                                <a href="javascript:window.print()" class="btn btn-success ml-4"><i class="ri-printer-line mr-4"></i> Print</a>
                            </div>
                            <div class="card-header border-bottom-dashed p-4">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <img src="{{ asset('assets/images/logo-dark.png') }}" class="card-logo card-logo-dark" alt="logo dark" height="30">

                                        {{-- <div class="mt-sm-5 mt-4">
                                            <h6 class="text-muted text-uppercase fw-semibold">Address</h6>
                                            <p class="text-muted mb-1" id="address-details">Quetta, Pakistan</p>
                                            <p class="text-muted mb-0" id="zip-code"><span>Zip-code:</span> 87300</p>
                                        </div> --}}
                                    </div>
                                    <div class="flex-shrink-0 mt-sm-0 mt-3">
                                        <h3>Production Receipt</h3>
                                    </div>
                                </div>
                            </div>
                            <!--end card-header-->
                        </div><!--end col-->
                        <div class="col-lg-12 ">

                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-lg-2 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Production #</p>
                                        <h5 class="fs-14 mb-0">{{$production->id}}</h5>
                                    </div>
                                    <div class="col-lg-4 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Product</p>
                                        <h5 class="fs-14 mb-0">{{$production->product->name}}</h5>
                                    </div>
                                    <div class="col-lg-2 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Quantity</p>
                                        <h5 class="fs-14 mb-0">{{ number_format($production->qty / $production->unit->value, 2) }} {{ $production->unit->name }}</h5>
                                    </div>
                                    <div class="col-lg-2 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Batch No.</p>
                                        <h5 class="fs-14 mb-0"><span id="total-amount">{{ $production->batchNumber }}</span></h5>
                                    </div>
                                    <div class="col-lg-2 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Date</p>
                                        <h5 class="fs-14 mb-0">{{date("d M Y" ,strtotime($production->date))}}</h5>
                                    </div>
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-body-->
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="card-body p-4">
                                <div class="table-responsive">
                                    <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                        <thead>
                                            <tr class="table-active">
                                                <th scope="col" style="width: 50px;">#</th>
                                                <th scope="col" class="text-start">Item</th>
                                                <th scope="col" class="text-end">Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody id="products-list">
                                           @foreach ($production->details as $key => $item)
                                               <tr>
                                                <td>{{$key+1}}</td>
                                                <td class="text-start">{{$item->material->name}}</td>
                                                <td class="text-end">{{number_format($item->qty / $item->unit->value, 2)}} {{ $item->unit->name }}</td>
                                               </tr>
                                           @endforeach
                                        </tbody>

                                    </table><!--end table-->
                                </div>
                            </div>

                            <!--end card-body-->
                        </div><!--end col-->

                    </div><!--end row-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->

@endsection

@section('page-css')
<link rel="stylesheet" href="{{ asset('assets/libs/datatable/datatable.bootstrap5.min.css') }}" />
<!--datatable responsive css-->
<link rel="stylesheet" href="{{ asset('assets/libs/datatable/responsive.bootstrap.min.css') }}" />

<link rel="stylesheet" href="{{ asset('assets/libs/datatable/buttons.dataTables.min.css') }}">
@endsection
@section('page-js')
    <script src="{{ asset('assets/libs/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/buttons.print.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/vfs_fonts.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/pdfmake.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/jszip.min.js')}}"></script>

    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
@endsection

