// Variables used for grabbing form information and elements.
const form = document.getElementById('form');
const name = document.getElementById('name_input');
const email = document.getElementById('email_input');
const password = document.getElementById('password_input');
const confirm = document.getElementById('confirm_password');
const picture = document.getElementById('image_input').value;
const notify = document.getElementById('allow_notifications');
//const dob = document.getElementById('dob_input');
const errorOut = document.getElementById('error_List');


// patterns used for passwords.
const UpperCaseChars = /[A-Z]/g;
const LowerCaseChars = /[a-z]/g;
const numbers = /[0-9]/g;
const pwLength = 8;

// List for holding error messages.
var errors = [];
if(form){
    form.addEventListener('submit', (e) => {
    //  Check if values are empty, if the email is correct and if the password meets requirements
        validateEmpty();
        validateEmail();
        validatePassword();
        validateConfirmPassword();
        validatePicture();
        //vaidlateDateOfBirth();
        if (errors.length > 0){
            e.preventDefault();
            errorOut.innerText = errors.join(', ');
            errors = [];
        }
    });
}

//replace &, <, and >
//this is to make the website more secure, but it is not perfect
function escapeBasic(str) {
    return(
        str.replace(/&/g, "&amp;")
           .replace(/</g, "&lt;")
           .replace(/>/g, "&gt;")
    );
}

//replace &, <, and >
//using the browser's built-in functionality
//much safer
function escapeHtml(str) {
    var div =
    document.appendChild(
        document.createTextNode(str)
    );
    return div.innerHTML;
}


// Checking if inputs are empty
function validateEmpty(){
    if (name.value === '' || name.value == null){
        errors.push('Name field is Empty');
    }
    if (email.value === '' || email.value == null){
        errors.push('Email field is Empty');
    }
    if (password.value === '' || password.value == null){
        errors.push('Password field is Empty');
    }
    if (confirm.value === '' || confirm.value == null){
        errors.push('Confirm Password field is Empty');
    }
}

// Regular Expression Pattern
// /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
// Character	Description
// / .. /	All regular expressions start and end with forward slashes.
// ^	Matches the beginning of the string or line.
// \w+	Matches one or more word characters including the underscore. Equivalent to [A-Za-z0-9_].
// [\.-]	\ Indicates that the next character is special and not to be interpreted literally.
// .- matches character . or -.
// ?	Matches the previous character 0 or 1 time. Here previous character is [.-].
// \w+	Matches 1 or more word characters including the underscore. Equivalent to [A-Za-z0-9_].
// *	Matches the previous character 0 or more times.
// ([.-]?\w+)*	Matches 0 or more occurrences of [.-]?\w+.
// \w+([.-]?\w+)*	The sub-expression \w+([.-]?\w+)* is used to match the username in the email. It begins with at least one or more word characters including the underscore, equivalent to [A-Za-z0-9_]. , followed by . or - and . or - must follow by a word character (A-Za-z0-9_).
// @	It matches only @ character.
// \w+([.-]?\w+)*	It matches the domain name with the same pattern of user name described above..
// \.\w{2,3}	It matches a . followed by two or three word characters, e.g., .edu, .org, .com, .uk, .us, .co etc.
// +	The + sign specifies that the above sub-expression shall occur one or more times, e.g., .com, .co.us, .edu.uk etc.
// $	Matches the end of the string or line.
// The above explaination for the regular expression used to validate the email address is found on:
// https://www.w3resource.com/javascript/form/email-validation.php
function validateEmail(){
    if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value))) {
        errors.push('Email invalid');
    }
}

/*function validateDateOfBirth(){
    if (!(/^(18|19|20)\d\d[-/](0[1-9]|1[012])[-/](0[1-9]|[12][0-9]|3[01])$/.test(email.value))) {
        errors.push('Date of birth invalid');
    }
}*/

// Validating Password requirements, this can be split up more.
function validatePassword(){
    if (!(password.value.match(UpperCaseChars))){
        errors.push('Password must have at least one upper-case letter');
    }
    if (!(password.value.match(LowerCaseChars)) ){
        errors.push('Password must have at least one lower-case letter');
    }
    if (!(password.value.match(numbers)) ){
        errors.push('Password must have at least one number');
    }
    if (password.value.length < pwLength){
        errors.push('Password must be at least 8 characters long');
    }
}

// Validating a confirm password
function validateConfirmPassword(){
    if (!(confirm.value === password.value)){
        errors.push('Passwords must match');
    }
}

//validate a picture
function validatePicture(){
    {
        var file_extension = picture.split('.').pop().toLowerCase(); 
        // split function splits the filename by dot(.)
        // pop the last element from the array to find the extension as well. 
        // returns the filename if there is no extension.

        if ((file_extension != "jpg") && (file_extension != "png")){
            errors.push('Picture must be .jpg or .png format');
        }


    }
}