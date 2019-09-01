$("#add-item").on('submit', function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: '/dashboard',
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function () {
            $("#waiting-createTable").show();
        },
        success: function (data) {
            console.log(data);
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
