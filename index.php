<?php
//set default values
$name = '';
$email = '';
$phone = '';
$message = 'Enter some data and click on the Submit button.';

//process
$action = filter_input(INPUT_POST, 'action');

switch ($action) {
    case 'process_data':
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');

        /*************************************************
         * validate and process the name
         ************************************************/
        // 1. make sure the user enters a name
        if(empty($name)){
            $message = "Please enter a full name.";
            break;
        }
        // 2. display the name with only the first letter capitalized
        $message = "Hello " . ucfirst(explode(" ", $name)[0]) . ",\n\n";
        /*************************************************
         * validate and process the email address
         ************************************************/
        // 1. make sure the user enters an email
        if(empty($email)){
            $message = "Please enter an email.";
            break;
        }
        // 2. make sure the email address has at least one @ sign and one dot character
        if(!strpos($email, '@') || !strpos($email, '.')){
            $message = "Please enter a valid email address.";
        }
        /*************************************************
         * validate and process the phone number
         ************************************************/
        // 1. make sure the user enters at least seven digits, not including formatting characters
        $phone = str_replace(array('+','-',' ','(',')'), '', filter_var($phone, FILTER_SANITIZE_NUMBER_INT));
        if(strlen($phone) < 7){
            $message = "Please enter a valid phone number.";
            break;
        }
        // 2. format the phone number like this 123-4567 or this 123-456-7890
        if(strlen($phone) == 7){
            $phone = substr($phone, 0, 3)."-".substr($phone, 3);
        }else{
            $phone = substr($phone, 0, 3)."-".substr($phone, 3, 3)."-".substr($phone,6);
        }

        /*************************************************
         * Display the validation message
         ************************************************/
         $message .= "Thank you for entering this data:\n\n";
         $message .= "Name: ". ucwords($name) ."\n";
         $message .= "Email: $email\n";
         $message .= "Phone: $phone";

        break;
}
include 'string_tester.php';
?>