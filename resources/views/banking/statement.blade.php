@extends('layouts.header')

@section('content')
<div class="container-xl">
    <div class="row row-deck row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Statement of account</h3>
                </div>
                <div id="search-user" class="data-table-custom">
                    <table class="table table-striped table-bordered table-hover datatable" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl.No </th>
                                <th>DATETIME</th>
                                <th>AMOUNT</th>
                                <th>TYPE</th>
                                <th>DETAILS</th>
                                <th>BALANCE</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>            
                </div>

                
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('script')
<script>
$('#statementData').addClass("active");
    $('#statement').addClass("active");
    $(document).ready(function(){
        var table = $('.datatable').DataTable({
            processing: true,
			serverSide: true,
            bDestroy: true,
            bSearchable:true,
            deferRender: true,
            dom: 'Bflrtip',
            buttons: [ 'copy', 'excel', 'pdf' ],
            language: {
                searchPlaceholder: 'Search ...',
                sSearch: '',
              lengthMenu: '_MENU_ show entries',
            },
            scrollX: true,
            ajax: {
                url: "{{ route('statement') }}"
                },   
                columns: [
                {data: 'DT_RowIndex',orderable: false, searchable: false},
                {data: 'created_at', name: 'created_at'},
                {data: 'amount', name: 'amount'},
                {data: 'type', name: 'type'},
                {data: 'details', name: 'details'},
                {data: 'balance', name: 'balance'},
            
                ]
        });
    });
</script>
@endsection