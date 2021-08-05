<?php

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $first_name = strip_tags(trim($_POST["first_name"]));
        $last_name = strip_tags(trim($_POST["last_name"]));
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $company = trim($_POST["company"]);
        $phone = trim($_POST["phone"]);
        $address = trim($_POST["address"]);
        $post_code = trim($_POST["post_code"]);
        $message = trim($_POST["message"]);

        // Check that data was sent to the mailer.
        if ( empty($first_name) OR empty($last_name) OR empty($company)OR empty($post_code) OR empty($phone) OR empty($address) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Please complete the form and try again.";
            exit;
        }

        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = "hello@gridtemplate.com";

        // Set the email subject.
        $subject = "Conference & Multi Event HTML5 Bootstrap Template";

        // Build the email content.
        $email_content = "First Name: $first_name\n";
        $email_content = "Last Name: $last_name\n";
        $email_content = "Company Name: $company\n";
        $email_content = "Post Code: $post_code\n";
        $email_content = "Phone Number: $phone\n";
        $email_content = "Address: $address\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Message:\n$message\n";

        // Build the email headers.
        $email_headers = "From: $first_name <$email>";

        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo "Thank You! Your message has been sent.";
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Something went wrong and we couldn't send your message.";
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }

?>

