@extends('layouts.header')

@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card" style="margin-left: 76%;margin-right:-134%;width: auto;">
            <div class="card-header">
                <h3 class="card-title">Welcome {{$data->name}}</h3>
            </div>
            <table class="table card-table table-vcenter">
                <tbody>
                    <tr>
                        <td style="color:#87919d;">YOUR ID</td>
                        <td>{{$data->email}}</td>
                        <td class="w-50">
                        </td>
                    </tr>
                    <tr>
                        <td style="color:#87919d;">YOUR BALANCE</td>
                        @if(isset($total_balance)==false)
                        <td>0</td>
                        @else
                        <td>{{$total_balance}} INR</td>
                        @endif
                        <td class="w-50">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
$('#homeData').addClass("active");
</script>
@endsection