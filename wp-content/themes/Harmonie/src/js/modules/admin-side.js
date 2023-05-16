
jQuery(document).ready(function ($) {
    var consumerkey = 'ck_424f4352ac9115b68df89763c96c901af6acc31f';
    var consumerSecret = 'cs_69cad981e180efc58ff6cf1144d2405a8e47d53d';

    $('.details-group-field').after('<div class="gr_spinner"><span class="spinner"></span></div>');

    $(document).on('change', '#product-select select', function () {
        var productID = $(this).val();
        var $titleField = $(this).closest('.acf-row').find('#f-title-field input');
        var $descField = $(this).closest('.acf-row').find('#f-desc-field textarea');
        var $groupField = $(this).closest('.acf-row').find('.details-group-field');

        $(this).closest('.acf-row').find(".spinner").addClass("is-active");
        $groupField.hide();

        $.ajax({
            url: harmoniedata.root_url + '/wp-json/wc/v3/products/' + productID + '?consumer_key=' + consumerkey + '&consumer_secret=' + consumerSecret,
            method: 'GET',
            success: (Product) => {
                descVal = $('<div>').html(Product.short_description).text();
                $titleField.val(Product.name);
                $descField.val(descVal);
                console.log(Product);
                $(this).closest('.acf-row').find(".spinner").removeClass("is-active");
                $groupField.show();
            },
            error: (Response) => {
                console.log(Response);
            }
        });
    });



    $('#sale-end-date .acf-input-wrap').prepend(`
    <div class="date-wrong-notice" style="display: inline-flex; margin-bottom: 11px; padding: 5px; background: #ff42006b; width: auto; border-radius: 4px; font-size: 14px; }">
        <span>
            la date de fin de la vente ne peut être antérieure à la date d aujourd hui
        </span>
    </div>`);

    $('#sale-end-date .acf-input-wrap .date-wrong-notice').hide();

    // Get the hidden input element
    var hiddenInput = $('#sale-end-date input[type="hidden"]')[0];

    // Create a new mutation observer
    var observer = new MutationObserver(function (mutations) {
        mutations.forEach(function (mutation) {
            if (mutation.type === 'attributes' && mutation.attributeName === 'value') {
                // Get the new value of the hidden input
                var newValue = $(mutation.target).val();

                // Check if the new value is after today
                var today = new Date();
                var saleEndDate = new Date(newValue);
                if (saleEndDate < today) {
                    // If the sale end date is before today, print "wrong"
                    $('#publishing-action #publish').prop('disabled', true);
                    $('#sale-end-date .acf-input-wrap .date-wrong-notice').show();

                } else {
                    $('#publishing-action #publish').prop('disabled', false);
                    $('#sale-end-date .acf-input-wrap .date-wrong-notice').hide();
                }
            }
        });
    });

    // Start observing the hidden input for attribute changes
    observer.observe(hiddenInput, { attributes: true });

});