@extends('layout.app')
@section('content')
<h1>Web App is in Production Mode</h1>
@endsection
@section('page-js')
       <!-- apexcharts -->
       <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
       <!-- Dashboard init -->
       <script src="{{ asset('assets/js/pages/dashboard-crm.init.js') }}"></script>
@endsection

