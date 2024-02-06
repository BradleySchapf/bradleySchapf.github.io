// Bradley Schapfs personal website


function validate(e) {
    //  Hides all error elements on the page
    hideAllErrors();

    //  Determine if the form has errors
    if (formHasErrors()) {
        //  Prevents the form from submitting
        e.preventDefault();
        return false;
    }

    return true;
}

function formHasErrors() {
    let errorFlag = false;

    let requiredFields = ["name", "phone", "email", "comments"];

    for(let i = 0; i < requiredFields.length; i++) {
        let textField = document.getElementById(requiredFields[i]);
        console.log(textField);
        if(!formFieldHasInput(textField)) {
            document.getElementById(requiredFields[i] + "_error").style.display = "block";

            if(!errorFlag) {
                textField.focus();
                textField.select();
            }

            //Raise the error flag
            errorFlag = true;
        }
    }

    let regex = new RegExp(/^\d{10}$/);
    let phoneNumValue = document.getElementById("phone").value;

    if(!regex.test(phoneNumValue)) {
        document.getElementById("phone_error").style.display = "block";

        if(!errorFlag){
            document.getElementById("phone").focus();
            document.getElementById("student").select();

        }

        errorFlag = true;
    } 

    return errorFlag;
}

function formFieldHasInput(fieldElement) {
    // Check if the text field has a value
    if (fieldElement.value == null || fieldElement.value.trim() == "") {
        // Invalid entry
        return false;
    }

    // Valid entry
    return true;
}

function hideAllErrors() {
    //Get an array of the error fields
    let errorFields = document.getElementsByClassName("error");
    for(let i=0;i < errorFields.length; i++) {
        errorFields[i].style.display = "none";
    }
}

function resetForm(e) {
    // Confirm that the user wants to reset the form.
    if (confirm('Clear survey?')) {
        // Ensure all error fields are hidden
        hideAllErrors();

        // Set focus to the first text field on the page
        document.getElementById("name").focus();

        // When using onReset="resetForm()" in markup, returning true will allow
        // the form to reset
        return true;
    }

    // Prevents the form from resetting
    e.preventDefault();

    // When using onReset="resetForm()" in markup, returning false would prevent
    // the form from resetting
    return false;
}

function load() {
    document.getElementById("contactForm").reset();

    document.getElementById("contactForm").addEventListener("submit", validate) 
    document.getElementById("contactForm").addEventListener("reset", resetForm)
}


// Add the event listener for the document load
document.addEventListener("DOMContentLoaded", load);