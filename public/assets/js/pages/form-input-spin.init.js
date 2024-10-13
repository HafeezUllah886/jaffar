$(document).ready(function() {
    // Handle click events for all plus and minus buttons
    $('[class^="plus"], [class^="minus"]').on('click', function() {
        console.log("working");

        // Extract the number from the class name (e.g., "plus-1" becomes "1")
        var classNumber = $(this).attr('class').split('-')[1];
        var $quantityInput = $(`.quantity-${classNumber}`);

        var currentValue = parseInt($quantityInput.val());
        var maxValue = parseInt($quantityInput.attr('max')) || Infinity;
        var minValue = parseInt($quantityInput.attr('min')) || 1;
        console.log(currentValue);
        // Check if it's a plus button or minus button
        if ($(this).hasClass('plus')) {
            console.log('Plus');
            if (currentValue < maxValue) {
                $quantityInput.val(currentValue + 1);
            }
        } else if ($(this).hasClass('minus')) {
            console.log('minus');
            if (currentValue > minValue) {
                $quantityInput.val(currentValue - 1);
            }
        }
    });
});
