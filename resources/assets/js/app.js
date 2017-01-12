'use strict';

$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#media').change(function(e){
        $('#mediaLabel').text('Выбрано изображение ' + e.currentTarget.files[0].name);
    });

    $('#mediaUploadForm').submit(function (e) {
        e.preventDefault();

        var formData = new FormData();
        formData.append('media', $('#media')[0].files[0]);
        formData.append('filename', $('#fileName').val());

        $.ajax('media', {
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false
        });
    });
});