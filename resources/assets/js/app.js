'use strict';

$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var default_label = $('#mediaLabel').text();
    var current_page = 1;
    var modal = $('#mediaModal');

    $('#media').change(function (e) {
        $('#mediaLabel').text('Выбрано изображение ' + e.currentTarget.files[0].name);
    });

    $('#mediaUploadForm').submit(function (e) {
        e.preventDefault();

        var form_data = new FormData();
        form_data.append('media', $('#media')[0].files[0]);
        form_data.append('filename', $('#fileName').val());

        $.ajax('media', {
                type: 'POST',
                data: form_data,
                processData: false,
                contentType: false
            })
            .fail(function (response) {
                var output = '';
                var resObject = response.responseJSON;

                if (422 === response.status) {
                    $.each(resObject, function (iter, error) {
                        output += error;
                    });
                } else {
                    output = '<li>'
                        + (response.hasOwnProperty('message') ? response.message : 'Неопознанная ошибка')
                        + '</li>';
                }

                $('#serverMessages').html(output);
            })
            .done(function (response) {
                $('#mediaUploadForm').get(0).reset();
                $('#mediaLabel').text(default_label);
                $('#serverMessages').text(response.message);

                $('#gallery').append(response.html);
            });
    });

    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
            current_page++;
            $.get('media?page=' + current_page, function (response) {
                $('#gallery').append(response.html);
            });
        }
    });

    $('#showRandBtn').click(function (e) {
        var $el = $(this);

        $.get('media/random', function (response) {
            modal.find('.modal-body').html('<img class="img-responsive center-block" src="' + response.path + '">');
            modal.modal('show');
        });

    });
});