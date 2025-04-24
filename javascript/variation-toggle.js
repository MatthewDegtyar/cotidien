jQuery(function($) {
    // When a variation option is clicked
    $('input[type="radio"].variation-option input').change(function() {
        var selectedVariation = $(this).val();
        
        // Trigger variation change to update the add to cart button and other related info
        $('form.variations_form').trigger('check_variations');
    });
});
