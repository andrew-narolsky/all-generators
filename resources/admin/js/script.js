(function (jQuery) {
    'use strict';

    $(document).ready(function(){
        if ($('.ckeditor').length) {
            // Editor
            let editor = CKEDITOR.replace('ckeditor');
            CKFinder.setupCKEditor(editor);
        }
    });

    // Sortable
    $('.sortable_button').click(function(e) {
        swal("This feature will disappear soon!", {
            buttons: false,
            timer: 3000,
        });
    });

    // Delete
    $('#block_list').on('click', '.delete_item', function() {
        let block_id = $(this).data('id');
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            buttons:{
                confirm: {
                    text : 'Yes, delete it!',
                    className : 'btn btn-success'
                },
                cancel: {
                    visible: true,
                    className: 'btn btn-danger'
                }
            }
        }).then((Delete) => {
            if (Delete) {
                let data = {
                    block_id: block_id,
                    template_id: $('#edit_template').data('template'),
                    _token: $('*[name="_token"]').val()
                }

                $.ajax({
                    type: 'POST',
                    url: '/admin/delete-block',
                    data: data,
                    beforeSend: function () {
                        $('body').addClass('loading-block');
                    },
                    success: function (data) {
                        $('#block_list').html(data);
                        setTimeout(function () {
                            $('body').removeClass('loading-block');
                        }, 500);
                    },
                    error: function () {
                        console.log('error');
                        setTimeout(function () {
                            $('body').removeClass('loading-block');
                        }, 500);
                    }
                });

                swal({
                    title: 'Deleted!',
                    text: 'Block has been deleted.',
                    type: 'success',
                    buttons : {
                        confirm: {
                            className : 'btn btn-success'
                        }
                    }
                });
            } else {
                swal.close();
            }
        });
    });

    // Change button status
    $('*[name="block_id"]').on('change', function () {
        if (parseInt($(this).val())) {
            $('#add_block').removeAttr('disabled');
        } else {
            if (!$('#add_block').attr('disabled')) {
                $('#add_block').attr('disabled', 'disabled');
            }
        }
    });

    $('#add_block').on('click', function (e) {
        e.preventDefault();
        let block_id = $('*[name="block_id"]').val();

        let data = {
            block_id: block_id,
            template_id: $('#edit_template').data('template'),
            _token: $('*[name="_token"]').val()
        }

        $.ajax({
            type: 'POST',
            url: '/admin/add-block',
            data: data,
            beforeSend: function () {
                $('body').addClass('loading-block');
            },
            success: function (data) {
                $('#block_list').html(data);
                setTimeout(function () {
                    $('body').removeClass('loading-block');
                }, 500);
            },
            error: function () {
                console.log('error');
                setTimeout(function () {
                    $('body').removeClass('loading-block');
                }, 500);
            }
        });
    });
})();
