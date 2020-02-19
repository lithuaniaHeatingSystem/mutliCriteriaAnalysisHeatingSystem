$(document).ready(() => {
    // display is positive input if checked input are checked according to type id
    function checkedOrUncheckedIsPositive(isCheckedInput) {
        let currentPositive = $(".is_positive[data_is_positive_id_type='" + isCheckedInput.attr('data_is_checked_id_type') + "']");
        if (isCheckedInput.find('input').is(':checked')) {
            currentPositive
                .fadeIn()
        } else {
            currentPositive.fadeOut();
            currentPositive.find('input')
                .prop('checked', false)
        }
    }

    $('.is_checked').each(function () {
        // initialize with default value
        checkedOrUncheckedIsPositive($(this));

        // listener on change when isChecked input
        $(this).change(function () {
            checkedOrUncheckedIsPositive($(this));
        })
    });
})