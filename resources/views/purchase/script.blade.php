<script>
    (function ($) {
        'use strict';

        let purchase = $('input[name = "purchase"]').val();

        $(document).ready(function () {
            $(document).on('click', '.add_row', function () {
                $("#row_modal tr").clone().appendTo('.table_body');
                $('.datepicker').daterangepicker({
                    locale: {format: 'YYYY-MM-DD'},
                    singleDatePicker: true,
                });
            });
            $(document).on('click', '.remove_row', function () {
                $(this).closest('tr').remove();
                netTotal();
                grandTotal();
            });
            $(document).on('change', '.medicine_id', function () {
                let i = 0, id = 0, selector = '';
                id = $(this).val();
                selector = $(this);
                $.each($('.medicine_id'), function () {
                    if (id == $(this).val()) {
                        i++;
                    }
                });
                if (i >= 2) {
                    toastr.warning('This Product is Already Selected');
                    selector.val('');
                }
            });
            $(document).on('change', '#contact_id', function () {
                let val = $(this).val();
                if (val == 1)
                {
                    $('.paid_div').hide();
                    $('.due_div').hide();
                }
                else {
                    $('.paid_div').show();
                    $('.due_div').show();
                }
            });
            $(document).on('change', '.medicine_id,.discount_type,.vat_type', function () {

                if ($(this).hasClass('product')) {
                    stock(this);
                    price(this);
                }
                if (purchase == 0)
                    quantity(this);

                sub_total(this);
                netTotal();
                discount();
                vat();
                grandTotal();
            });
            $(document).on('keyup', '.quantities,.prices,.discount,.vat,.discount_amount,.vat_amount', function () {
                if (purchase == 0)
                    quantity(this);

                sub_total(this);
                netTotal();
                discount();
                vat();
                grandTotal();
            });
            $(document).on('keyup', '.paid_amount', function () {
                let grand_total = 0, paid_amount = 0, due_amount = 0;
                grand_total = $('.total_amount').val();
                paid_amount = $(this).val();

                if (paid_amount > grand_total) {
                    toastr.warning('Your Total Amount is ' + grand_total);
                    $(this).val(0)
                }

                due_amount = grand_total - paid_amount;

                $('.due_amount').val(parseFloat(due_amount).toFixed(2));
            });
            $(document).on('click', '.pos_area a', function () {
                let req = 1;
                let id = $(this).data('id');
                $('.pos_table tr').each(function () {
                    var tr_id = $(this).attr('id');
                    if (tr_id == id) {
                        toastr.warning('Medicine is Already Selected');
                        req = 0;
                    }
                });
                if (req == 1) {
                    $.ajax({
                        method: 'POST',
                        url: '{{ route('select.medicine') }}',
                        data: {
                            _token: csrf,
                            id: id,
                        },
                        success: function (response) {
                            if (response.error) {
                                toastr.error('Something Went Wrong');
                            } else {
                                $('.pos_table tbody').append(response);
                                netTotal();
                                grandTotal();
                            }
                        }
                    });
                }
            });

            $(document).on('keyup', 'input[name = "medicine_name"]', function () {

                $.ajax({
                    method: 'POST',
                    url: '{{ route('search.medicine') }}',
                    data: {
                        _token: csrf,
                        name: $(this).val(),
                    },
                    success: function (response) {
                        if (response.error) {
                            toastr.error('Something Went Wrong');
                        } else {
                            $('.pos_div .row').html(response);
                        }
                    }
                });
            });
        });

        function stock(el) {
            let stock = $(el).find(':selected').data('stock');
            if (purchase == 0)
                $(el).closest('tr').find('.quantities').prop('max', stock);
        }

        function price(el) {
            let price = 0, purchase_price = 0;

            if (purchase == 0) {
                price = parseFloat($(el).find(':selected').data('price')).toFixed(2);
                if (purchase_price < price) {
                    $(el).closest('tr').find('.prices').addClass('red_border')
                }
            } else {
                price = parseFloat($(el).find(':selected').data('purchase_price')).toFixed(2);
            }

            $(el).closest('tr').find('.prices').val(price);
        }

        function quantity(el) {
            let qty_selector = $(el).closest('tr').find($('.quantities'));
            let stock = parseInt(qty_selector.attr("max"));

            let qty = parseInt(qty_selector.val());

            if (stock < qty) {
                qty_selector.addClass('red_border');
                toastr.warning('In Your Stock You Have only ' + stock + ' items');
            } else {
                qty_selector.removeClass('red_border');
            }
        }

        function sub_total(el) {
            let price = $(el).closest('tr').find($('.prices')).val();
            let quantity = parseInt($(el).closest('tr').find($('.quantities')).val());

            let sub_total = 0;

            if (price && quantity)
                sub_total = parseFloat(price * quantity).toFixed(2);

            $(el).closest('tr').find($('.sub_totals')).val(sub_total);
        }

        function netTotal() {
            let amount = 0;
            $.each($('.sub_totals'), function (key, value) {
                let val = 0;
                if (parseFloat($(this).val()) > 0)
                    val = parseFloat($(this).val());

                amount += val;
            });
            $('.net_total').val(parseFloat(amount).toFixed(2));
        }

        function discount() {
            let type = parseInt($('.discount_type').val());
            let discount = parseFloat($('.discount').val()).toFixed(2);

            let total = parseFloat($('.net_total').val());

            if (discount > 0) {
                if (type == 0) {
                    $('.discount_amount').val(discount);
                } else {
                    discount = (total * discount) / 100;
                    // (price * tax)/100
                    $('.discount_amount').val(parseFloat(discount).toFixed(2));
                }
            }
        }

        function vat() {
            let type = parseInt($('.vat_type').val());
            let vat = parseFloat($('.vat').val()).toFixed(2);
            if (!vat)
                vat = 0;
            let total = parseFloat($('.net_total').val());

            if (vat > 0) {
                if (type == 0) {
                    $('.vat_amount').val(vat);
                } else {
                    vat = (total * vat) / 100;
                    // (price * tax)/100
                    $('.vat_amount').val(parseFloat(vat).toFixed(2));
                }
            }
        }

        function grandTotal() {
            let sub_total = parseFloat($('.net_total').val());

            console.log(sub_total);
            let tax = parseFloat($('.vat_amount').val());

            let discount = parseFloat($('.discount_amount').val());

            let grand_total = (sub_total + tax) - discount;
            let paid_amount = parseFloat($('.paid_amount').val()).toFixed(2);

            let due = grand_total - paid_amount;

            $('.total_amount').val(parseFloat(grand_total).toFixed(2));
            $('.due_amount').val(parseFloat(due).toFixed());
        }
    })(jQuery)
</script>
