function infiniteLoadMore(url, loader_class, table_body) {
    $.ajax({
        beforeSend: function () {
            $('.' + loader_class).show();
        },
        datatype: "html",
        type: "get",
        url: url,
        data: {
            _token: "{{ csrf_token() }}"
        },
        success: function (response) {
            // console.log('body resp :',response);
            if (response.html == '') {
                $('.' + loader_class).text("No more data ...");
                return;
            }

            $('.' + loader_class).hide();
            $("#" + table_body).append(response.html);
        },
        complete: function () {
            $('.' + loader_class).hide();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            $('.' + loader_class).hide();
        }
    });
}
