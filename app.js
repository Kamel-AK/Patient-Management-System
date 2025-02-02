/**
 * This code snippet is responsible for handling various functionalities related to search and adding patients.
 * It includes event listeners, AJAX requests, and input validation.
 */
// Initialize variables
var search_bar = $("#search");
var suggestionBox = $("#suggestionBox");
var back_btn = $("#back-btn");
var add_page_btn = $("#add-page-btn");
var data_page_btn = $("#data-page-btn");
/**
 * Event listener for input in the search bar.
 * Shows or hides the suggestion box based on the input value.
 */
search_bar.on("input", function () {
    var value = $(this).val();
    if (!value) {
        suggestionBox.fadeOut();
        return;
    }
    suggestionBox.fadeIn();
});
/**
 * Event listener for blur event on the search bar.
 * Clears the input value and hides the suggestion box.
 */
search_bar.on('blur', () => {
    search_bar.val("");
    suggestionBox.hide();
})
/**
 * Event listener for click event on the back button.
 * Redirects the user to the search.html page after a small delay.
 */
back_btn.on('click', () => {
    setTimeout(() => {
        window.location.href = 'search.html';
    }, 0);
})
/**
 * Event listener for click event on the add page button.
 * Redirects the user to the add-page.html page after a small delay.
 */
add_page_btn.on('click', () => {
    setTimeout(() => {
        window.location.href = 'add-page.html';
    }, 0);
})

data_page_btn.on('click', () => {
    setTimeout(() => {
        window.location.href = 'data.php';
    }, 0);
})
/**
 * Event listener for input in the Patient_name_input field.
 * Validates the input and allows only letters and spaces.
 */

// Get the input element by its id
let input = $("#Patient_name_input");
// Add an input event listener to the input element
input.on("input", function (event) {
    // Get the input value
    let value = input.val();

    // Create a regular expression to match only letters and spaces
    let regex = /^[A-Za-z\u0600-\u06FF ]+$/;

    // Check if the input value matches the regular expression
    if (!regex.test(value)) {
        // If not, remove the last character from the input value
        input.val(value.slice(0, -1));
    }
});
/**
 * Event listener for click event on the add button.
 * Validates the input fields and sends an AJAX request to add-patient.php.
 */
var add_btn = $("#add-btn");
add_btn.on('click', () => {
    var Patient_name_input = $('#Patient_name_input')
    var file_number = $('#file_number')
    if (Patient_name_input.val() == "") {
        $("#Label1").html("please enter the name ");
        return
    }
    if (file_number.val() == "") {
        $("#Label2").html("please enter the file number");
        return
    } else {
        $("#Label1").html("Patient name");
        $("#Label2").html("File number");
        Patient_name_input.prop("disabled", true);
        file_number.prop("disabled", true);
        add_btn.html("Sending....")
        var Patient_name_input_value = Patient_name_input.val()
        let names = Patient_name_input_value.split(" ");
        let f_name, s_name, l_name;
        if (names.length === 3) {
            [f_name, s_name, l_name] = names;
        } else if (names.length === 2) {
            [f_name, l_name] = names;
        }
        console.log(f_name);
        console.log(s_name);
        console.log(l_name);
        var file_number_value = file_number.val()
        console.log(file_number_value);
        $.ajax({
            type: "Get",
            url: "add-patient.php",
            data: { first_name: f_name, second_name: s_name, last_name: l_name, file_number: file_number_value },
            success: function () {
                setTimeout(function () {
                    Patient_name_input.prop("disabled", false);
                    file_number.prop("disabled", false);

                    Patient_name_input.val("")
                    file_number.val("")
                    add_btn.html("ADD")

                }, 1000)
            }
        });
    }

})
/**
 * Event listener for key press events.
 * Allows only certain key inputs (backspace, delete, tab, escape, enter, and period).
 * Prevents non-numeric inputs.
 */

function checkKey(e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if ([46, 8, 9, 27, 13, 110, 190].indexOf(e.keyCode) !== -1 ||
        // Allow: Ctrl+A, Ctrl+C, Ctrl+V, Command+A
        ((e.keyCode == 65 || e.keyCode == 86 || e.keyCode == 67) && (e.ctrlKey === true || e.metaKey === true)) ||
        // Allow: home, end, left, right, down, up
        (e.keyCode >= 35 && e.keyCode <= 40)) {
        // let it happen, don't do anything
        return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
}
/**
 * Event listener for keyup event on the search bar.
 * Retrieves the search term and sends an AJAX request to search.php.
 * Displays the results in the suggestion box.
 */
search_bar.keyup(search_name);
function search_name() {
    // Get the search term from the input field
    var search_term = search_bar.val();
    let names = search_term.split(" ");
    let f_name, s_name, l_name;
    if (names.length === 3) {
        [f_name, s_name, l_name] = names;
    } else if (names.length === 2) {
        [f_name, l_name] = names;
    }
    console.log(f_name);
    console.log(s_name);
    console.log(l_name);
    // Send an AJAX request to the PHP file
    $.ajax({
        type: "GET",
        url: "search.php",
        data: { first_name: f_name, second_name: s_name, last_name: l_name },
        success: function (data) {
            // Parse the JSON data
            var json_data = JSON.parse(data);
            // Display the results in the suggestion box
            var viewBox = $("#viewBox").html("")
            // suggestionBox.html("");
            for (var i = 0; i < 5; i++) {
                viewBox.append("<li class='table-row'>" + "<div class='col col-2' data-label='Customer Name'>" + json_data[i].file_number + "</div>" + "<div class='col col-3' data-label='Amount'>" + json_data[i].first_name + "     " + json_data[i].second_name + "    " + json_data[i].last_name + "</div>" + "</li>");
            }
        }
    });
}
