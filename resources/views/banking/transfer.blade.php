@extends('layouts.header')

@section('content')
<style>
.transferAmount {
    padding: var(--tblr-card-cap-padding-y) var(--tblr-card-cap-padding-x);
}

.amountTransfer {
    margin-left: 19px;
    width: 95% !important;
}

.submitButton {
    width: 90%;
    background-color: #206bc4 !important;
    margin-top: 26px !important;
    margin-bottom: 29px !important;
    margin-left: -209px !important;
}

.transferEmail {
    width: 95% !important;
    margin-left: 19px;
}

.transfer-label {
    margin-left: 20px;
    margin-top: 21px;
}
</style>
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                </div>
            </div>
        </div>
    </div>
    <form enctype="multipart/form-data" class="needs-validation" id="transferform" novalidate>
        {{csrf_field()}}
        <div class="col-md-6 col-lg-4">
            <div class="card" style="margin-left: 76%;margin-right:-134%;width: auto;">
                <div class="card-header">
                    <h3 class="card-title">Transfer Money</h3>
                </div>
                <div class="col-md-12">
                    <label class="form-label transfer-label">Email</label>
                    <input type="text" class="form-control transferEmail" id="email" name="email"
                        placeholder="Enter email">
                </div>
                <div class="col-md-12">
                    <label class="form-label transferAmount">Amount</label>
                    <input type="text" class="form-control amountTransfer" id="transfer_amount" name="transfer_amount"
                        placeholder="Enter Amount to transfer" required>
                </div>
                <div class="col-md-12 offset-md-4">
                    <button type="submit" class="btn btn-primary submitButton">Transfer</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section('script')
<script>
$('#transferData').addClass("active");
$('#transferform').on('submit', (function(e) {
    e.preventDefault();
    var form = $('#transferform')[0];
    var formData = new FormData(form);
    var id = $("#id").val();
    var validation = 1;
    if (validation == 1) {
        $.ajax({
            url: '/add-transfer',
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            Z_index: 2000,
            processData: false,
            beforeSend: function() {
                $("#verify").show();
                $("#savebtn").hide();

            },
            success: function(response) {
                console.log("resss", response)
                if (response.status == true) {

                    $.notify({
                        icon: 'fas fa-check text-success',
                        message: response.message,
                    }, {
                        type: 'green',
                        z_index: 2000,
                        placement: {
                            from: "top",
                            align: "right"
                        },
                        mouse_over: 'pause',
                        delay: 800000,
                    });
                    setTimeout(function() {
                        window.location.href = "/transfer";
                    }, 2000);

                }
                if (response.status == false) {
                    $.notify({
                        icon: 'fas fa-exclamation-triangle',
                        title: 'There was an error',
                        message: '<ol class="pl-3 small"><li>' + response.message +
                            '</li></ol>',
                    }, {
                        type: 'danger',
                        placement: {
                            from: "top",
                            align: "right"
                        },
                        offset: {
                            x: 20,
                            y: 20
                        },
                        delay: 2000,
                        z_index: 2000,
                        animate: {
                            enter: 'animated bounceInDown',
                            exit: 'animated fadeOutUp'
                        },
                        // onShow: showOverlay,
                        // onClose: hideOverlay,
                        template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert border alert-{0}" role="alert">' +
                            '<span data-notify="icon" class="text-danger"></span> ' +
                            '<span data-notify="title" class="text-danger">{1}</span> ' +
                            '<div data-notify="message" class="mt-2 text-danger">{2}</div>' +
                            '<div class="progress" data-notify="progressbar">' +
                            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                            '</div>' +
                            '<a href="{3}" target="{4}" data-notify="url"></a>' +
                            '</div>'
                    });
                }
            }
        });
    }
}));
</script>
@endsection