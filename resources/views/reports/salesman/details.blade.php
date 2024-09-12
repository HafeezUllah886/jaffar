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
                                    </div>
                                    <div class="flex-shrink-0 mt-sm-0 mt-3">
                                        <h3>Sales Man Report</h3>
                                    </div>
                                </div>
                            </div>
                            <!--end card-header-->
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Sales Man</p>
                                        <h5 class="fs-14 mb-0">{{ $salesman->name }}</h5>
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">From</p>
                                        <h5 class="fs-14 mb-0">{{ date('d M Y', strtotime($from)) }}</h5>
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">To</p>
                                        <h5 class="fs-14 mb-0">{{ date('d M Y', strtotime($to)) }}</h5>
                                    </div>
                                    <!--end col-->
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
                                                <th scope="col">Inv #</th>
                                                <th scope="col" class="text-start">Customer</th>
                                                <th scope="col">Date</th>
                                                <th scope="col" class="text-end">Amount</th>
                                                <th scope="col" class="text-end">Paid</th>
                                                <th scope="col" class="text-end">Due</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @php
                                                $totalAmount = 0;
                                                $totalPaid = 0;
                                                $totalDue = 0;
                                            @endphp
                                        @foreach ($sales as $key => $sale)
                                        @php
                                            $amount = $sale->net;
                                            $paid = $sale->payments->sum('amount');
                                            $due = $amount - $paid;
                                            $totalAmount += $amount;
                                            $totalPaid += $paid;
                                            $totalDue += $due;
                                        @endphp
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $sale->id }}</td>
                                                <td class="text-start">{{ $sale->customer->title }}</td>
                                                <td>{{ date("d M Y", strtotime($sale->date)) }}</td>
                                                <td class="text-end">{{ number_format($amount,2) }}</td>
                                                <td class="text-end">{{ number_format($paid,2) }}</td>
                                                <td class="text-end">{{ number_format($due,2) }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4" class="text-end">Total</th>
                                                <th class="text-end">{{number_format($totalAmount, 2)}}</th>
                                                <th class="text-end">{{number_format($totalPaid, 2)}}</th>
                                                <th class="text-end">{{number_format($totalDue, 2)}}</th>
                                            </tr>
                                        </tfoot>
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



