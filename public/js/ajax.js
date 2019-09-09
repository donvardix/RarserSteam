$("#addItem").on('click', function (e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let appId = $("#appId").val();
    let nameItem = $("#nameItem").val();
    $.ajax({
        type: 'POST',
        url: '/dashboard',
        data: {
            "appId": appId,
            "nameItem": nameItem
        },
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function () {
            $("#waiting-createTable").show();
        },
        success: function () {
            $("#waiting-createTable").hide();
            $("#success-createTable").show();
            setTimeout(function () {
                $("#success-createTable").hide();
            }, 2000);
        },
        error: function () {
            $("#waiting-createTable").hide();
            $("#error-createTable").show();
            setTimeout(function () {
                $("#error-createTable").hide();
            }, 2000);
        }
    });
});

$('#parser').on('click', function () {
    $.ajax({
        url: '/parser',
        type: 'GET',
        cache: false,
        dataType: 'json',
        beforeSend: function () {
            $("#waiting-parser").show();
        },
        success: function () {
            $("#waiting-parser").hide();
            $("#success-parser").show();
            setTimeout(function () {
                $("#success-parser").hide();
            }, 2000);
        }
    });
});
