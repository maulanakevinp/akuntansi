document.addEventListener("keydown", function(event) {
    if (event.keyCode == 27) {
        $('.alert-dismissible').remove();
        $(".modal").modal('hide');
    }
});

$(document).on("change", "input", function(event) {
    $(this).attr('value', this.value);
    $(this).removeClass('is-invalid');
    $(this).parent().parent().find('.invalid-feedback').remove();
    $('.alert-dismissible').remove();
});

$(document).on("change", "select", function(event) {
    $(this).attr('value', this.value);
    $(this).removeClass('is-invalid');
    $(this).parent().parent().find('.invalid-feedback').remove();
    $('.alert-dismissible').remove();
});

$(document).on("change", "textarea", function(event) {
    $(this).html(event.target.value);
    $(this).removeClass('is-invalid');
    $(this).parent().parent().find('.invalid-feedback').remove();
    $('.alert-dismissible').remove();
});

$(document).on("click", "input[type='checkbox']", function() {
    $(this).tooltip('hide');
    $(this).attr('checked', $(this).prop('checked'));
});

$(document).on('click', '.hapus-data', function(event) {
    event.preventDefault();
    $('#modal-hapus').modal('show');
    $('#nama-hapus').html('Apakah Anda yakin ingin menghapus ' + $(this).data('nama') + '???');
    $('#form-hapus').attr('action', $(this).data('action'));
});

function alertSuccess(pesan) {
    $('.notifikasi').html(`
        <div class="alert alert-success alert-dismissible fade show">
            <span class="alert-icon"><i class="fas fa-check-circle"></i> <strong>Berhasil</strong></span>
            <span class="alert-text">
                ${pesan}
            </span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    `);
}

function alertFail(pesan) {
    $('.notifikasi').html(`
        <div class="alert alert-danger alert-dismissible fade show">
            <span class="alert-icon"><i class="fas fa-times-circle"></i> <strong>Berhasil</strong></span>
            <span class="alert-text">
                ${pesan}
            </span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    `);
}

function alertError() {
    $('.notifikasi').html(`
        <div class="alert alert-danger alert-dismissible fade show">
            <span class="alert-icon"><i class="fas fa-times-circle"></i> <strong>Gagal</strong></span>
            <span class="alert-text">
                <ul id="pesanError">
                </ul>
            </span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    `);
}

function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function hanyaHuruf(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if ((charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && charCode > 32)
        return false;
    return true;
}

function uploadImage(inputFile) {
    if (inputFile.files && inputFile.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(inputFile).siblings('img').attr("src", e.target.result);
        }
        reader.readAsDataURL(inputFile.files[0]);
    }
}

function kriteria() {
    switch ($("#kriteria").val()) {
        case 'periode':
            $("#periode").show();
            $("#rentang-waktu").hide();
            $("#bulan").hide();
            break;
        case 'rentang-waktu':
            $("#periode").hide();
            $("#rentang-waktu").show();
            $("#bulan").hide();
            break;
        case 'bulan':
            $("#periode").hide();
            $("#rentang-waktu").hide();
            $("#bulan").show();
            break;
    }
}

function angka(str) {
    let res = str.replace('Rp. ', '');
    let angka = res.replaceAll('.', '');
    let nilai = parseFloat(angka);
    if (isNaN(nilai)) {
        nilai = 0;
    }
    return nilai;
}

function jumlah(nama) {
    let nilai = 0;
    $(`.${nama}`).each(function() {
        nilai += angka($(this).html());
    });
    return nilai;
}