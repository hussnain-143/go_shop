<!-- Bootstrap JS -->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<!--plugins-->

<script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
<script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
<script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
<script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{ asset('assets/plugins/chartjs/js/Chart.min.js')}}"></script>
<script src="{{ asset('assets/plugins/chartjs/js/Chart.extension.js')}}"></script>
<script src="{{ asset('assets/snackbar/dist/js-snackbar.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="https://developercodez.com/developerCorner/parsley/parsley.min.js"></script>
<script src="{{ asset('jQuery_multi_select/src/jquery.multi-select.min.js') }}"></script>

<script src="{{ asset('assets/js/index.js')}}"></script>
<!--app JS-->
<script src="{{ asset('assets/js/app.js')}}"></script>
<!--Password show & hide js -->
<script>
    $(document).ready(function () {

        $("#show_hide_password a").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("bx-hide");
                $('#show_hide_password i').removeClass("bx-show");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("bx-hide");
                $('#show_hide_password i').addClass("bx-show");
            }
        });
    });
</script>
<script>
    $(document).ready(function () {

        $('#formSubmit').on('submit', function (e) {
            e.preventDefault();

            let formData = new FormData(this);
            let loading = '<button class="btn btn-primary" type="button" disabled=""> <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Loading...</button>'

            let submitBtn = '<input type="submit" class="btn btn-primary px-4" value="Save"/>'

            $('#submitButton').html(loading);

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                },
                success: function (response) {
                    SnackBar({
                        status: "success",
                        message: response.message,
                        position: "tr"
                    });

                    if(response.url){
                        window.location.href = response.url

                    }else{
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000); // 2-second delay for message visibility
                    }

                },
                error: function (xhr) {
                    SnackBar({
                        status: xhr.responseJSON.status,
                        message: xhr.responseJSON.message,
                        position: "tr"
                    })
                    $('#submitButton').html(submitBtn);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $("#photo").on("change", function (event) {
            var file = event.target.files[0];

            if (file) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $("#imagepreview").attr("src", e.target.result).show();
                };

                reader.readAsDataURL(file);
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>
<script>
    $(document).ready(function () {
        var table = $('#example2').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print']
        });

        table.buttons().container()
            .appendTo('#example2_wrapper .col-md-6:eq(0)');
    });
</script>
<script>
    function Update(item) {

        $('#parent_category_id option').show();

        $('#id').val(item.id);
        $('#text').val(item.text);
        $('#link').val(item.link);
        $('#name').val(item.name);
        $('#slug').val(item.slug);
        $('#value').val(item.value);
        $('#tax').val(item.tax);
        $('#attribute_id').val(item.attribute_id).change();
        $('#category_id').val(item.category_id).change();
        $('#parent_category_id').val(item.parent_category_id).change();

            // Ensure that the current category is not shown in the parent category list
        $('#parent_category_id option').each(function() {
            if ($(this).val() == item.id) {
                $(this).hide(); 
            }
    });
        if (item.image) {
            let imageUrl = "{{ asset('') }}" + item.image;
            $('#imagepreview').attr('src', imageUrl).show();
        } else {
            $('#imagepreview').attr('src', '{{ asset('assets/logo/goshop.png') }}').show();
        }
    }
    function emptyModel() {

        $('#parent_category_id option').show();

        $('#id').val('');
        $('#text').val('');
        $('#link').val('');
        $('#name').val('');
        $('#slug').val('');
        $('#imagepreview').hide();
        $('#value').val('');
        $('#tax').val('');
        $('#parent_category_id').val('');
        $('#category_id').val('').change();
        $('#attribute_id').val('').change();
    }

    function Delete(item, table_name) {


        const id = item.id;
        if (!id || !table_name) {
            console.error("Missing item ID or table name.");
            return;
        }

        $.ajax({
            url: `/admin/${table_name}/delete/${id}`,
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content') // Ensure CSRF token is included
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
            },
            success: function (response) {
                console.log(response); // Check if response is received

                if (response.status === 200) {
                    SnackBar({
                        status: "success",
                        message: response.message,
                        position: "br"
                    });

                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                } else {
                    SnackBar({
                        status: response.status,
                        message: response.message || "Deletion failed.",
                        position: "br"
                    });
                }
            },
            error: function (xhr) {
                SnackBar({
                    status: xhr.responseJSON?.status || 'error',
                    message: xhr.responseJSON?.message || 'Something went wrong.',
                    position: "br"
                });
            }
        });
    }

</script>
<script type="text/javascript">
        $(function(){
            $('#attribute').multiSelect();
            $('#line-wrap-example').multiSelect({
                positionMenuWithin: $('.position-menu-within')
            });
            $('#categories').multiSelect({
                noneText: 'All categories',
                presets: [
                    {
                        name: 'All categories',
                        all: true
                    },
                    {
                        name: 'My categories',
                        options: ['a', 'c']
                    }
                ]
            });
            $('#modal-example').multiSelect({
                'modalHTML': '<div class="multi-select-modal">'
            });
        });
        </script>
