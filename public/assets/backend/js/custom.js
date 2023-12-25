
"use strict";
let csrf = $('.csrf').val();
function readURL(input, image_for) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#img_'+ image_for).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$(".image_pick").change(function () {
    var image_for = $(this).attr('data-image-for');
    readURL(this, image_for);
});

$(document).ready(function (){
    $(document).on('change','.custom-switch-input',function (){
        let table = $(this).data('table');
        let id = $(this).data('id');
        let url = $('.status_change').val();
        let status = 0;

        if ($(this).is(':checked'))
            status = 1;

        $.ajax({
            url : url,
            method : 'POST',
            data : {
                id : id,
                table : table,
                status : status,
                _token : csrf,
            },
            success : function (response){
                if (response.success)
                    toastr.success(response.success)
                else
                    toastr.error(response.error);
            }
        })
    });
    $(document).on('click','.trash_btn',function (){
        if (confirm("Are You Sure?"))
        {
            let selector = $(this).closest('td').find('.trash_form');
            selector.submit();
        }
    });
    $(document).on('keyup','.slug_generator',function (){
        let text = $(this).val();
        let slug = text.replaceAll(' ','-').toLowerCase();
        let field = $(this).closest('.row').find('.slug');
        field.val(slug);
    });

    $("#table").DataTable({
        bLengthChange: true,
        "bDestroy": true,

        dom: 'Blfrtip',
        buttons : [
            {
                extend: 'copyHtml5',
                text: '<i class="far fa-copy"></i>',
                title: 'Stock Report',
                titleAttr: 'Copy',
                footer: true,
                exportOptions: {
                    columns: ':visible',
                }
            },
            {
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel"></i>',
                titleAttr: 'Excel',
                title: 'Stock Report',
                margin: [10, 10, 10, 0],
                footer: true,
                exportOptions: {
                    columns: ':visible',
                },

            },
            {
                extend: 'csvHtml5',
                text: '<i class="fa fa-file-csv"></i>',
                titleAttr: 'CSV',
                title: 'Stock Report',
                footer: true,
                exportOptions: {
                    columns: ':visible',
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fa fa-file-pdf"></i>',
                title: 'Stock Report',
                titleAttr: 'PDF',
                footer: true,
                exportOptions: {
                    columns: ':visible',
                },
                orientation: 'landscape',
                pageSize: 'A4',
                margin: [0, 0, 0, 0],
                alignment: 'center',
                header: true,
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i>',
                titleAttr: 'Print',
                alignment: 'center',
                title: 'Stock Report',
                exportOptions: {
                    columns: ':visible',
                },
                header: true,
                footer: true,
            },
        ],
    });
});
