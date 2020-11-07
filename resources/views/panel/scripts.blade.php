
<!-- BEGIN CORE PLUGINS -->

<script src="{{ asset('js/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{ asset('assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{ asset('assets/layouts/layout4/scripts/layout.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/layouts/layout4/scripts/demo.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/layouts/global/scripts/quick-sidebar.min.js') }}" type="text/javascript"></script>

<script>
$(document).ready(function(){
    function load_unseen_notification(view = '')
    {
        $.ajax({
            url:"{{ url('notif-read') }}",
            method:"GET",
            data:{view:view},
            dataType:"json",
            success:function(data)
            {
                $('.notif-data').html(data.notification);
                if(data.unseen_notification > 0)
                {
                    $('.count').html(data.unseen_notification);
                }
            }
        });
    }

    // Run Ajax
    load_unseen_notification();

    $(document).on('click', '.dropdown-toggle', function(){
        $('.count').html('');
        load_unseen_notification('yes');
    });

    // Jika Menu Notifikasi Close, Maka Akan Panggil Fungsi Ini
    // $('.dropdown').on('hide.bs.dropdown', function () {
    //     setInterval(function(){
    //     load_unseen_notification();
    //     }, 5000);
    // })
});

// Ajax Untuk Load Semua Data
function load_unseen_notification_all(view = '')
{
    $.ajax({
        url:"{{ url('notif-read-all') }}",
        method:"GET",
        data:{view:view},
        dataType:"json",
        success:function(data)
        {
            $('.notif-data').html(data.notification);
            if(data.unseen_notification > 0)
            {
                $('.count').html(data.unseen_notification);
            }
        }
    });
}
function loadmorebutton() {
    $("#load-more-btn").removeAttr('onmouseover');
    $("#load-more-btn").html('<i class="fa fa-spinner fa-spin fa-2x"></i>');
    setTimeout(function(){
        $("#load-more-btn").hide();
        load_unseen_notification_all('yes');
    }, 5000);
}
</script>
