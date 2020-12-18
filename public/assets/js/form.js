
$(document).on('submit', 'form', function(event) {
    event.preventDefault();
    const form = $(this);
    const url = $(this).attr('action');
    $.ajax({
        url: url,
        type: 'POST',
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function(){
            $(form).find('button[type="submit"]').attr('disabled','disabled');
            $(form).find('button[type="submit"]').html(`<img height="20px" src="${BASEURL}/assets/img/loading.gif" alt=""> Loading ...`);
        },
        success: function(response){
            $(form).find('button[type="submit"]').html('SIMPAN');
            $(form).find('button[type="submit"]').removeAttr('disabled');
            alertSuccess(response.message);
            setTimeout(() => {
                $(".notifikasi").html('');
            }, 3000);
            if (response.redirect) {
                location.href = response.redirect;
            }
        },
        error: function (response) {
            console.clear();
            $(form).find('button[type="submit"]').html('SIMPAN');
            $(form).find('button[type="submit"]').removeAttr('disabled');
            alertError();
            let focus = true;
            $.each(response.responseJSON.errors, function (i, e) {
                console.log(i);
                $('#pesanError').append(`<li>${e}</li>`);
                if (!$(`[name="${i}"]`).hasClass('is-invalid')) {
                    $(`[name="${i}"]`).addClass('is-invalid');
                    $(`[name="${i}"]`).parent().parent().find('.invalid-feedback').html(e);
                    if (focus) {
                        $(`[name="${i}"]`).focus();
                        focus = false;
                    }
                }
            });
        }
    });
});
