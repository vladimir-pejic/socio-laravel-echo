$('[id^=show-likes-]').click(function () {
    $('.modal-content').empty();
   let model = $(this).attr('data-model');
   let id = $(this).attr('data-id');
   let url = '/likes/' + model + '/' + id;
    $.ajax({
        type: "get",
        url: url,
        data: {"_method": "get", "_token": $('meta[name="csrf-token"]').attr('content')},
        success: function (response) {
            $('.modal-content').html(response.html);
        }
    });
});