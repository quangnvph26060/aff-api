<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <title>AFFILATE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="https://quanlycongviec.site/libs/assets/images/favicon.ico">

    <!-- plugin css -->
    <link
        href="https://quanlycongviec.site/libs/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css"
        rel="stylesheet" type="text/css" />

    <!-- preloader css -->
    <link rel="stylesheet" href="{{asset('css/preloader.min.css')}}" type="text/css" />

    <!-- Bootstrap Css -->
        <link href="{{asset('css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />

    <!-- Icons Css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- App Css-->
    <link href="{{asset('css/app.min.css')}}" id="app-style" rel="stylesheet"
        type="text/css" />
    <link href="https://quanlycongviec.site/libs/assets/libs/choices.js/public/assets/styles/choices.min.css"
        rel="stylesheet" type="text/css" />

    <!-- validator -->
     <script src="{{asset('validator/validator.js')}}"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

    <!-- <body data-layout="horizontal"> -->
    <!-- Begin page -->
    <div id="layout-wrapper">
    @include('layouts.header')

        <!-- ========== Left Sidebar Start ========== -->
        @include('layouts.siderbar-menu')
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
       <div class="content">
            @yield('content')
       </div>

        <input type="hidden" id="mission-id">
        <style>
            .modal-comment .active {
                color: green;
            }

            div#staticBackdrop {
                z-index: 4444444;
            }
        </style>
        <!-- End Page-content -->
        @include('layouts.footer')


    </div>
    <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    <!-- Right Sidebar -->

     <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://quanlycongviec.site/libs/assets/libs/jquery/jquery.min.js"></script>
    <script src="https://quanlycongviec.site/libs/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://quanlycongviec.site/libs/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="https://quanlycongviec.site/libs/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="https://quanlycongviec.site/libs/assets/libs/node-waves/waves.min.js"></script>
    <script src="https://quanlycongviec.site/libs/assets/libs/feather-icons/feather.min.js"></script>
    <!-- pace js -->
    <script src="https://quanlycongviec.site/libs/assets/libs/pace-js/pace.min.js"></script>

    <!-- apexcharts -->
    <script src="https://quanlycongviec.site/libs/assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- Plugins js-->
    <script
        src="https://quanlycongviec.site/libs/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script
        src="https://quanlycongviec.site/libs/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
    <!-- dashboard init -->

    <script src="{{asset('ckeditor5-build-classic/ckeditor.js')}}"></script>
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script> -->
     <script src="https://quanlycongviec.site/libs/assets/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('js')
    <script>
        $(function () {
            $('.confirm').click(function (e) {
                e.preventDefault();
                var href = $(this).attr('href');
                Swal.fire({
                    title: 'Bạn có chắc chắn?',
                    showCancelButton: true,
                    icon: 'warning',
                    confirmButtonText: 'Đồng ý',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                })
            })
        })
        $("input[data-type='currency']").on({
            keyup: function () {
                formatCurrency($(this));
            },
            blur: function () {
                formatCurrency($(this), "blur");
            }
        });


        function formatNumber(n) {
            // format number 1000000 to 1,234,567
            return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }


        function formatCurrency(input, blur) {
            // appends $ to value, validates decimal side
            // and puts cursor back in right position.

            // get input value
            var input_val = input.val();

            // don't validate empty input
            if (input_val === "") { return; }

            // original length
            var original_len = input_val.length;

            // initial caret position
            var caret_pos = input.prop("selectionStart");

            // check for decimal
            if (input_val.indexOf(".") >= 0) {

                // get position of first decimal
                // this prevents multiple decimals from
                // being entered
                var decimal_pos = input_val.indexOf(".");

                // split number by decimal point
                var left_side = input_val.substring(0, decimal_pos);
                var right_side = input_val.substring(decimal_pos);

                // add commas to left side of number
                left_side = formatNumber(left_side);

                // validate right side
                right_side = formatNumber(right_side);

                // On blur make sure 2 numbers after decimal
                // if (blur === "blur") {
                // right_side += "00";
                // }

                // Limit decimal to only 2 digits
                right_side = right_side.substring(0, 2);

                // join number by .
                input_val = left_side + "." + right_side;

            } else {
                // no decimal entered
                // add commas to number
                // remove all non-digits
                input_val = formatNumber(input_val);
                input_val = input_val;

                // final formatting
                // if (blur === "blur") {
                // input_val += ".00";
                // }
            }

            // send updated string to input
            input.val(input_val);

            // put caret back in the right position
            var updated_len = input_val.length;
            caret_pos = updated_len - original_len + caret_pos;
            input[0].setSelectionRange(caret_pos, caret_pos);
        }
    </script>
    <!-- choices js -->
    <script src="https://quanlycongviec.site/libs/assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="https://quanlycongviec.site/libs/assets/js/pages/form-advanced.init.js"></script>
    <script>
        function openModel(id, keyword) {
            $('#keyword').html(keyword);
            $('.modal-comment').html("<center><img width='50px' src='/images/loading-waiting.gif'></center>");
            $.ajax({
                url: "/customer/mission/" + id + "/comments",
                method: 'GET',
                success: function (data) {
                    if (data.success) {
                        $('#mission-id').val(id);
                        var comments = data.data;
                        var div = "";
                        for (var i = 0; i < comments.length; i++) {
                            var className = comments[i].is_user ? "active" : "in-active";
                            div += "<div class='row'>" + "<p>" + "<b class='" + className + "'>" + comments[i].sender_name + " - " + "<span>" + comments[i].time + "</span>" + "</b>" + "</p>" + "<p>" + comments[i].message + "</p>" + "</div><hr style='margin-top: 0px'>";
                        }
                        setTimeout(() => {
                            $('.modal-comment').html(div);
                        }, 300);
                    } else {
                        Swal.fire({
                            title: data.message,
                            showCancelButton: true,
                            icon: 'warning',
                        });
                    }
                }
            })
        }
        $('#send-cmt').click(function () {
            var message = $('#message-send').val();
            if (message == '') {
                Swal.fire({
                    title: "Bạn cần nhập nội dung",
                    showCancelButton: true,
                    icon: 'warning',
                });
            } else {
                $.ajax({
                    url: "https://quanlycongviec.site/admin/mission/comment",
                    method: 'POST',
                    data: {
                        _token: "A7FDigGF6lv8cWwAlcN45ZM9qciwSYrmpAWN3BcM",
                        message: message,
                        mission_id: $('#mission-id').val()
                    },
                    success: function (data) {
                        if (data.success) {
                            $('#message-send').val("");
                            var comment = data.data;
                            $('.modal-comment').append("<div class='row'>" + "<p>" + "<b class='active'>" + comment.sender_name + " - " + "<span>" + comment.time + "</span>" + "</b>" + "</p>" + "<p>" + comment.message + "</p>" + "</div><hr style='margin-top: 0px'>");
                        } else {
                            Swal.fire({
                                title: data.message,
                                showCancelButton: true,
                                icon: 'warning',
                            });
                        }
                    }
                })
            }
        });
    </script>
</body>

</html>
