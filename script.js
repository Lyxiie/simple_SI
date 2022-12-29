$(document).ready(function() {
    //hilangkan tombol cari
    $('#tombol-cari').hide();
    //buat event

    $('#keyword').on('keyup', function() {
        //memunculkan icon loading
        $('.loader').show();


        //ajax menggunakan load
        // $('#container').load('mahasiswa.php?keyword=' + $('#keyword').val());


        $.get('mahasiswa.php?keyword=' + $('#keyword').val(), function(data) {
            $('#container').html(data);
            $('.loader').hide();
        });
    });
});