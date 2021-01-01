
$(function () {
    var base_url = "http://localhost/iws/public/";
    $('#province-selected-master').on('change', function() {
        $('#city-selected-master').empty().append('<option value="">Pilih Kota</option>');
        $.ajax({
            url: base_url + "master/district/get-list-city/"+this.value,
            method: 'get',
            success : function(data) {
                var parse_data = JSON.parse(data);
                if(parse_data.length > 0) {
                    $('#city-selected-master').prop('disabled', false);
                    for(var index in parse_data) {
                        $("#city-selected-master").append('<option value="'+ parse_data[index].id +'">'+ parse_data[index].name +'</option>');
                    }
                } else {
                    $('#city-selected-master').prop('disabled', true);
                }
            },
            error : function(err){
                $('#city-selected-master').prop('disabled', true);
            }
        });
    });

    $('#city-selected-master').on('change', function() {
        $('#district-selected-master').empty().append('<option value="">Pilih Kecamatan</option>');
        $.ajax({
            url: base_url + "master/village/get-list-district/"+this.value,
            method: 'get',
            success : function(data) {
                var parse_data = JSON.parse(data);
                if(parse_data.length > 0) {
                    $('#district-selected-master').prop('disabled', false);
                    for(var index in parse_data) {
                        $("#district-selected-master").append('<option value="'+ parse_data[index].id +'">'+ parse_data[index].name +'</option>');
                    }
                } else {
                    $('#district-selected-master').prop('disabled', true);
                }
            },
            error : function(err){
                $('#district-selected-master').prop('disabled', true);
            }
        });
    });

    $('#district-selected-master').on('change', function() {
        $('#village-selected-master').empty().append('<option value="">Pilih Kelurahan</option>');
        $.ajax({
            url: base_url + "master/village/get-list-village/"+this.value,
            method: 'get',
            success : function(data) {
                var parse_data = JSON.parse(data);
                if(parse_data.length > 0) {
                    $('#village-selected-master').prop('disabled', false);
                    for(var index in parse_data) {
                        $("#village-selected-master").append('<option value="'+ parse_data[index].id +'">'+ parse_data[index].name +'</option>');
                    }
                } else {
                    $('#village-selected-master').prop('disabled', true);
                }
            },
            error : function(err){
                $('#village-selected-master').prop('disabled', true);
            }
        });
    });

    $('#province-selected').on('change', function() {
        $('#city-selected').empty().append('<option value="">Pilih Kota</option>');
        $.ajax({
            url: base_url + "master/district/get-list-city/"+this.value,
            method: 'get',
            success : function(data) {
                var parse_data = JSON.parse(data);
                if(parse_data.length > 0) {
                    $('#city-selected').prop('disabled', false);
                    for(var index in parse_data) {
                        $("#city-selected").append('<option value="'+ parse_data[index].id +'">'+ parse_data[index].name +'</option>');
                    }
                } else {
                    $('#city-selected').prop('disabled', true);
                }
            },
            error : function(err){
                $('#city-selected').prop('disabled', true);
            }
        });
    });

    $('#city-selected').on('change', function() {
        $('#district-selected').empty().append('<option value="">Pilih Kecamatan</option>');
        $.ajax({
            url: base_url + "master/village/get-list-district/"+this.value,
            method: 'get',
            success : function(data) {
                var parse_data = JSON.parse(data);
                if(parse_data.length > 0) {
                    $('#district-selected').prop('disabled', false);
                    for(var index in parse_data) {
                        $("#district-selected").append('<option value="'+ parse_data[index].id +'">'+ parse_data[index].name +'</option>');
                    }
                } else {
                    $('#district-selected').prop('disabled', true);
                }
            },
            error : function(err){
                $('#district-selected').prop('disabled', true);
            }
        });
    });

    $('#district-selected').on('change', function() {
        $('#village-selected').empty().append('<option value="">Pilih Kelurahan</option>');
        $.ajax({
            url: base_url + "master/village/get-list-village/"+this.value,
            method: 'get',
            success : function(data) {
                var parse_data = JSON.parse(data);
                if(parse_data.length > 0) {
                    $('#village-selected').prop('disabled', false);
                    for(var index in parse_data) {
                        $("#village-selected").append('<option value="'+ parse_data[index].id +'">'+ parse_data[index].name +'</option>');
                    }
                } else {
                    $('#village-selected').prop('disabled', true);
                }
            },
            error : function(err){
                $('#village-selected').prop('disabled', true);
            }
        });
    });

    // $("select").select2();
    $('#sorting-table').DataTable( {
        "dom": '<"toolbar">frtip',
        "ordering": false,
        "info":     false,
        language: { search: "", searchPlaceholder: "Pencarian"  },
    } );
    $("div.toolbar").html('<a class="float-right btn btn-success" href="#">Sembunyikan Detail</a>');

    var alert = $('div.alert[auto-close]');
    alert.each(function() {
        var that = $(this);
        var time_period = that.attr('auto-close');
        setTimeout(function() {
            that.alert('close');
        }, time_period);
    });
});
