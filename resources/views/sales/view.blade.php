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
                                        <img src="{{asset('assets/images/logo.png')}}" style="width:250px;">
                                        <div class="mt-sm-5 mt-4">
                                            <div class="row">
                                                <div class="col-6">
                                                    <h6 class="text-muted text-uppercase fw-semibold">Industrial Area, Sirki Road, Quetta</h6>
                                                    <p class="text-muted mb-1" id="address-details">NTN: 2645388-6</p>
                                                    <p class="text-muted mb-0" id="zip-code"><span>0331-8358638 | </span> jaffarqta92@gmail.com</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Customer</p>
                                                    <h5 class="fs-14 mb-0"> <span class="text-muted">M/S :</span> {{$sale->customer->title}}</h5>
                                                    <h5 class="fs-14 mb-0"> <span class="text-muted">CNIC :</span> {{$sale->customer->cnic ?? "NA"}} | <span class="text-muted">Contact :</span> {{$sale->customer->contact ?? "NA"}}</h5>
                                                    <h5 class="fs-14 mb-0"> <span class="text-muted">NTN #</span> {{$sale->customer->ntn ?? "NA"}} | <span class="text-muted">STRN #</span> {{$sale->customer->strn ?? "NA"}}</h5>
                                                    <h5 class="fs-14 mb-0"> <span class="text-muted">Address :</span> {{$sale->customer->address ?? "NA"}}</h5>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 mt-sm-0 mt-3">
                                        <h3>Sales Tax Invoice</h3>
                                        <p> <span class="text-muted text-uppercase fw-semibold mt-0 m-0 p-0">Inv # </span><span class="fs-14 m-0 p-0">{{$sale->id}}</span></p>
                                        <p> <span class="text-muted text-uppercase fw-semibold mt-0 m-0 p-0">Date : </span><span class="fs-14 m-0 p-0">{{date("d M Y" ,strtotime($sale->date))}}</span></p>
                                        <p> <span class="text-muted text-uppercase fw-semibold mt-0 m-0 p-0">Order Booker : </span><span class="fs-14 m-0 p-0">{{$sale->orderbooker->name}}</span></p>
                                    </div>
                                </div>
                            </div>
                            <!--end card-header-->
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
                                                <th scope="col" class="text-end">T-Qty</th>
                                                <th scope="col" class="text-end">Price</th>
                                                <th scope="col" class="text-end">Discount</th>
                                                <th scope="col" class="text-end">Tax (Inc)</th>
                                                <th scope="col" class="text-end">RP</th>
                                                <th scope="col" class="text-end">GST%</th>
                                                <th scope="col" class="text-end">GST</th>
                                            </tr>
                                        </thead>
                                        <tbody id="products-list">
                                           @foreach ($sale->details as $key => $product)
                                               <tr class="border-1 border-dark">
                                                <td class="m-1 p-1 border-1 border-dark">{{$key+1}}</td>
                                                <td class="text-start m-1 p-1 border-1 border-dark">{{$product->product->name}}</td>
                                                <td class="text-start m-1 p-1 border-1 border-dark">{{$product->unit->name}}</td>
                                                <td class="text-end m-1 p-1 border-1 border-dark">{{number_format($product->qty / $product->unitValue)}}</td>
                                                <td class="text-end m-1 p-1 border-1 border-dark">{{number_format($product->qty)}}</td>
                                                <td class="text-end m-1 p-1 border-1 border-dark">{{number_format($product->price, 2)}}</td>
                                                <td class="text-end m-1 p-1 border-1 border-dark">{{number_format($product->discount, 2)}}</td>
                                                <td class="text-end m-1 p-1 border-1 border-dark">{{number_format($product->ti, 2)}}</td>
                                                <td class="text-end m-1 p-1 border-1 border-dark">{{number_format($product->tp, 2)}}</td>
                                                <td class="text-end m-1 p-1 border-1 border-dark">{{number_format($product->gst, 2)}}</td>
                                                <td class="text-end m-1 p-1 border-1 border-dark">{{number_format($product->gstValue, 2)}}</td>
                                               </tr>
                                           @endforeach
                                        </tbody>
                                        <tfoot>
                                            @php
                                                $totalDisc = $sale->details->sum('discount');
                                                $totalTi = $sale->details->sum('ti');
                                                $totalGstVal = $sale->details->sum('gstValue');

                                                $due = $sale->net - $sale->payments->sum('amount');
                                                $paid = $sale->payments->sum('amount');
                                            @endphp
                                            <tr class="border-1 border-dark">
                                                <th colspan="6" class="text-end">Total</th>
                                                <th class="text-end">{{number_format($totalDisc,2)}}</th>
                                                <th class="text-end">{{number_format($totalTi,2)}}</th>
                                                <th class="text-end"></th>
                                                <th class="text-end"></th>
                                                <th class="text-end">{{number_format($totalGstVal,2)}}</th>
                                            </tr>
                                            <tr class="m-0 p-0">
                                                <th colspan="10" class="text-end p-0 m-0">Tax Exclusive</th>
                                                <th class="text-end p-0 m-0">{{number_format($totalTi - $totalGstVal,2)}}</th>
                                            </tr>
                                            <tr class="m-0 p-0">
                                                <th colspan="10" class="text-end p-0 m-0">Sales Tax</th>
                                                <th class="text-end p-0 m-0">{{number_format($totalGstVal,2)}}</th>
                                            </tr>
                                            <tr class="m-0 p-0">
                                                <th colspan="10" class="text-end p-0 m-0">Gross</th>
                                                <th class="text-end p-0 m-0 border-2 border-start-0 border-end-0 border-dark">{{number_format($totalTi,2)}}</th>
                                            </tr>
                                            <tr class="m-0 p-0">
                                                <th colspan="10" class="text-end p-0 m-0">WH Tax {{$sale->wh}}% (+)</th>
                                                <th class="text-end p-0 m-0">{{number_format($sale->whValue,2)}}</th>
                                            </tr>
                                            <tr class="m-0 p-0">
                                                <th colspan="10" class="text-end p-0 m-0">Discount (-)</th>
                                                <th class="text-end p-0 m-0 ">{{number_format($sale->discount,2)}}</th>
                                            </tr>
                                            <tr class="m-0 p-0">
                                                <th colspan="10" class="text-end p-0 m-0">Fright (-)</th>
                                                <th class="text-end p-0 m-0 ">{{number_format($sale->fright,2)}}</th>
                                            </tr>
                                            <tr class="m-0 p-0">
                                                <th colspan="10" class="text-end p-0 m-0">Fright (+)</th>
                                                <th class="text-end p-0 m-0 ">{{number_format($sale->fright1,2)}}</th>
                                            </tr>
                                            <tr class="m-0 p-0">
                                                <th colspan="10" class="text-end p-0 m-0">Net Bill</th>
                                                <th class="text-end p-0 m-0 border-2 border-start-0 border-end-0 border-dark">{{number_format($sale->net,2)}}</th>
                                            </tr>
                                            <tr class="m-0 p-0">
                                                <th colspan="10" class="text-end p-0 m-0">Paid</th>
                                                <th class="text-end p-0 m-0">{{number_format($paid,2)}}</th>
                                            </tr>
                                            <tr class="m-0 p-0">
                                                <th colspan="10" class="text-end p-0 m-0">Due</th>
                                                <th class="text-end p-0 m-0">{{number_format($due,2)}}</th>
                                            </tr>
                                            <tr class="m-0 p-0">
                                                <th colspan="10" class="text-end p-0 m-0">Previous Balance</th>
                                                <th class="text-end p-0 m-0">{{number_format(spotBalanceBefore($sale->customerID, $sale->refID),2)}}</th>
                                            </tr>
                                            <tr class="m-0 p-0">
                                                <th colspan="10" class="text-end p-0 m-0">Net Account Balance</th>
                                                <th class="text-end p-0 m-0">{{number_format(spotBalance($sale->customerID, $sale->refID),2)}}</th>
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

