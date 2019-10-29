// Variables used for grabbing form information and elements.
const form = document.getElementById('form');
const name = document.getElementById('name_input');
const email = document.getElementById('email_input');
const password = document.getElementById('password_input');
const confirm = document.getElementById('confirm_password');
const notify = document.getElementById('allow_notifications');
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
        if (errors.length > 0){
            e.preventDefault();
            errorOut.innerText = errors.join(', ');
            errors = [];
        }
    });
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
        errors.push('Passwords must math');
    }
}