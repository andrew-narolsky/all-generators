(function (jQuery) {
    'use strict';

    $('#add_faq_block').on('click', function (e) {
        e.preventDefault();
        for(let i = 1; i <= $('.faq-row').length; i++) {
            if (i == $('.faq-row').length) {
                let index = i + 1;
                let html = `<div class="faq-row faq-row-${index}">
                    <div class="form-group">
                        <label class="input__label" style="display: flex; justify-content: space-between; align-items: center">Question
                            <button class="btn btn-danger btn-sm delete-row" data-id="${index}">
                                <i class="fas fas fa-trash-alt"></i>
                            </button>
                        </label>
                        <input type="text" class="form-control input-style" name="blocks[6][faq][${index}][question]" value="">
                    </div>
                    <div class="form-group">
                        <label class="input__label">Answer</label>
                        <textarea class="form-control ckeditor" id="ckeditor_6_${index}" name="blocks[6][faq][${index}][answer]" rows="3"></textarea>
                    </div>
                </div>`;
                $('.faq-row-' + i).after(html);
                CKEDITOR.replace('ckeditor_6_' + index);
                return false;
            }
        }
    });

    $('.faqs').on('click', '.delete-row', function (e) {
        e.preventDefault();
        let id = parseInt($(this).data('id'));
        if (!id || id == 1) {
            return false;
        }
        swal({
            title: 'Are you sure?',
            text: "Do You won't remove this row!",
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
                $('.faq-row-' + id).remove();
            }
        });
    })

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

    $('ul.nav.nav-collapse a').each(function () {
        if ($(this)[0].href == document.location.href) {
            $(this).closest('.collapse').addClass('show');
            $(this).closest('.nav-item.active').find('a[data-toggle="collapse"]').removeClass('collapsed');
        }
    });
})();
