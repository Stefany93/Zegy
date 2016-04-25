//alert('Your JS file has been sucessfully included! Please go to js/general.js and remove the alert box!');

/*
    Returns true if the element is filled, false otherwise
*/
function validate_empty_field(the_element)
{
    return (the_element.value.length == '') ? false : true;
}
 /*
    Returns true if the element is more than num_chars value, false otherwise
*/
function min_chars(the_element, num_chars)
{
    return (the_element.value.length < num_chars) ? false : true;
}

 /*
    Returns true if the strings match. Often used for comparing passwords and email addresses when they
    need to be confirmed in forms.
*/
function validate_two_strings_match(string1, string2)
{
    return (string1 == string2) ? true : false;
}
/*
    Defined regular expressions. Return true or false IF found.
    Exp: with "letters_only", the string 'Stefany' // true but '2Stefany' // false
*/
function validate_regex(the_string, type_of_check)
{
    if(type_of_check == 'letters_only')
    {
        var re = /^[a-zA-Z]+[a-zA-Z]$/;
        return (re.test(the_string));
    }
    if(type_of_check == 'numbers_only')
    {
        var re = /^[0-9]+[0-9]$/;
        return (re.test(the_string));
    }
    if(type_of_check == 'email')
    {
        var re = /^[a-zA-Z]+[a-zA-Z0-9.]*@+[a-zA-Z0-9]+[a-zA-Z0-9]+[.]+[a-zA-Z09.]{1,5}$/;
        return (re.test(the_string));
    }
     if(type_of_check == 'numbers_letters_only')
    {
        var re = /^[a-zA-Z0-9]+[a-zA-Z0-9]$/;
        return (re.test(the_string));
    }
    if(type_of_check == 'must_start_with_a_letter')
    {
        var re = /^[a-zA-Z]/;
        return (re.test(the_string));
    }
}
/*
    Display all the errors found. 
    validated_form_field_id => the ID of the form element like 'email'
    error_message => 'Invalid email address!'
    alert_or_text => accepts two values, either 'alert' or 'text'. 

    1. Text value of alert_or_text would make the elements inside the form with the id of the id of the currently validated form element + '_error' suffix to be populated with error_message. So if we validated an 'email' ID form, the element holding the error will be with the ID email_error. If not named like that, it WON'T WORK!!

    2. Alert value of the alert_or_text would make an alert box to jump out if there is an error. 
    If there are more than 1 error, multiple alert boxes will jump out, depending on their number.
    You may change alert() to more modern and good looking alert box like swal(), however, beware that swal()
    has a bug when more than one error is present at the same time.
*/
function display_errors(validated_form_field_id, error_message, alert_or_text)
{
    if(alert_or_text == 'text')
    {
        document.getElementById(validated_form_field_id+'_error').innerHTML = error_message;
    }
    if(alert_or_text == 'alert' && error_message.length > 0)
    {
        alert(error_message);
    }
}
 /*
    Returns true if email has the typical email chars and the string length is longer or equal to 10
*/
 function validate_email(the_element)
{
     if(validate_regex(the_element.value, 'email') && min_chars(the_element, 10))
    {
        return false;
    }else{
        return true;
    }
}

/*
    Combining above functions for login forms. Typically they would have only two fields that needs validating. 
*/
function validate_login_form(username, password)
{
    var username = document.getElementById(username);
    var password = document.getElementById(password);
    if(validate_empty_field(username) === false)
    {
        display_errors('username', 'please populate the username', 'text');
    }else{
        display_errors('username', '', 'text'); // Remove error text if field is OK.
    }
    if( validate_empty_field(password) === false)
    {
        display_errors('password', 'please populate the password', 'text');
    }else{
        display_errors('password', '', 'text'); // Remove error text if field is OK.
    }
}

function validate_contact_form(name, email, message)
{
    var name = document.getElementById(name);
    var email = document.getElementById(email);
    var message = document.getElementById(message);
    if(validate_empty_field(name) === false)
    {
        display_errors('name', 'Please populate the name', 'text'); 
        errors = true;

    }else{
        display_errors('name', '', 'text');
        errors = false;

    }
    if(validate_empty_field(email) === false)
    {
        display_errors('email', 'Please populate the email', 'text');
         errors = true;

    }else{
        display_errors('email', '', 'text');
        errors = false;
    }
    if(validate_empty_field(message) === false)
    {
        display_errors('text_area', 'Please populate the message', 'text');
          errors = true;
    
    }else{
        display_errors('text_area', '', 'text');
        errors = false;
    }
   /* if(validate_empty_field(username) === false)
    {
        display_errors('name', 'Please populate the name', 'text');
    }*/
}

/*
    Example usage of the functions above.
*/
window.onload = function()
{
    var contact_button = document.getElementById('contact_button');
    var contact_form = document.getElementById('contact_form');

    contact_button.onclick = function(event)
    {
        event.preventDefault();
        validate_contact_form('name_field', 'email_field', 'text_area');
        if(errors === false)
        {
            console.log(errors);
            contact_form.submit();
        }

    }
}