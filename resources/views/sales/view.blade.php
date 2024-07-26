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
                                        <h1>JABBAR & BROTHERS</h1>

                                        <div class="mt-sm-5 mt-4">
                                            <h6 class="text-muted text-uppercase fw-semibold">Industrial Area, Sirki Road, Quetta</h6>
                                            <p class="text-muted mb-1" id="address-details">NTN: 2645388-6</p>
                                            <p class="text-muted mb-0" id="zip-code"><span>0331-8358638 | </span> jaffarqta92@gmail.com</p>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 mt-sm-0 mt-3">
                                        <h3>Sales Tax Invoice</h3>
                                    </div>
                                </div>
                            </div>
                            <!--end card-header-->
                        </div><!--end col-->
                        <div class="col-lg-12 ">

                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Inv #</p>
                                        <h5 class="fs-14 mb-0">{{$sale->id}}</h5>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Date</p>
                                        <h5 class="fs-14 mb-0">{{date("d M Y" ,strtotime($sale->date))}}</h5>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Customer</p>
                                        <h5 class="fs-14 mb-0">{{$sale->customer->title}}</h5>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Printed On</p>
                                        <h5 class="fs-14 mb-0"><span id="total-amount">{{ date("d M Y") }}</span></h5>
                                        {{-- <h5 class="fs-14 mb-0"><span id="total-amount">{{ \Carbon\Carbon::now()->format('h:i A') }}</span></h5> --}}
                                    </div>
                                    <!--end col-->
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
                                                <th scope="col" class="text-start">Product</th>
                                                <th scope="col" class="text-start">Unit</th>
                                                <th scope="col" class="text-end">Qty</th>
                                                <th scope="col" class="text-end">Price</th>
                                                <th scope="col" class="text-end">Discount</th>
                                                <th scope="col" class="text-end">Tax (Exc)</th>
                                                <th scope="col" class="text-end">TP</th>
                                                <th scope="col" class="text-end">GST%</th>
                                                <th scope="col" class="text-end">GST</th>
                                                <th scope="col" class="text-end">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody id="products-list">
                                           @foreach ($sale->details as $key => $product)
                                               <tr>
                                                <td>{{$key+1}}</td>
                                                <td class="text-start">{{$product->product->name}}</td>
                                                <td class="text-start">{{$product->unit->name}}</td>
                                                <td class="text-end">{{number_format($product->qty / $product->unitValue)}}</td>
                                                <td class="text-end">{{number_format($product->price, 2)}}</td>
                                                <td class="text-end">{{number_format($product->discount, 2)}}</td>
                                                <td class="text-end">{{number_format($product->te, 2)}}</td>
                                                <td class="text-end">{{number_format($product->tp, 2)}}</td>
                                                <td class="text-end">{{number_format($product->gst, 2)}}</td>
                                                <td class="text-end">{{number_format($product->gstValue, 2)}}</td>
                                                <td class="text-end">{{number_format($product->amount, 1)}}</td>
                                               </tr>
                                           @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="5" class="text-end">Total</th>
                                                <th class="text-end">{{number_format($sale->details->sum('discount'),2)}}</th>
                                                <th class="text-end">{{number_format($sale->details->sum('te'),2)}}</th>
                                                <th class="text-end"></th>
                                                <th class="text-end"></th>
                                                <th class="text-end">{{number_format($sale->details->sum('gstValue'),2)}}</th>
                                                <th class="text-end">{{number_format($sale->details->sum('amount'),2)}}</th>
                                            </tr>
                                            @php
                                            $due = $sale->details->sum('amount') - $sale->payments->sum('amount');
                                            $paid = $sale->payments->sum('amount');
                                            @endphp
                                            <tr>
                                                <th colspan="10" class="text-end">Paid</th>
                                                <th class="text-end">{{number_format($paid,2)}}</th>
                                            </tr>
                                            <tr>
                                                <th colspan="10" class="text-end">Due</th>
                                                <th class="text-end">{{number_format($due,2)}}</th>
                                            </tr>
                                            <tr>
                                                <th colspan="10" class="text-end">Previous Balance</th>
                                                <th class="text-end">{{number_format($balance,2)}}</th>
                                            </tr>
                                            <tr>
                                                <th colspan="10" class="text-end">Net Account Balance</th>
                                                <th class="text-end">{{number_format($balance + $due,2)}}</th>
                                            </tr>
                                        </tfoot>
                                    </table><!--end table-->
                                </div>
                            </div>
                            <div class="card-footer">
                                @if ($sale->notes != "")
                                <p><strong>Notes: </strong>{{$sale->notes}}</p>
                                @endif
                               <p class="text-center urdu"><strong>نوٹ: مال آپ کے آرڈر کے مطابق بھیجا جا رہا ہے۔ مال ایکسپائر یا خراب ہونے کی صورت میں واپس نہیں لیا جائے گا۔ دکاندار سیلزمین کے ساتھ کسی قسم کے ذاتی لین دین کا ذمہ دار خود ہوگا۔</strong></p>

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
<link href='https://fonts.googleapis.com/css?family=Noto Nastaliq Urdu' rel='stylesheet'>
<style>
    .urdu {
        font-family: 'Noto Nastaliq Urdu';font-size: 12px;
    }
    </style>
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

