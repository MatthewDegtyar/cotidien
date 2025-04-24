jQuery(function($) {
    // When a user selects a variation option (radio button change)
    $('input[type="radio"].variation-option').change(function() {
        // Get the selected option value
        var selectedOption = $(this).val();
        
        // Find the label for the current attribute and update the selected option text
        var label = $(this).closest('tr').find('.selected-option-value');
        label.text(selectedOption);  // Set the text to the selected option
        
        // If it's a color option, the color box will be displayed as well (optional)
        if ($(this).closest('.variation-options').hasClass('color-options')) {
            label.css('color', selectedOption); // This can be adjusted to display the color name/hex value
        }
    });
});
