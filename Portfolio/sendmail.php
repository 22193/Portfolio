<?php
if(isset($_POST['email'])) {
    $email_to = "22193@ma-web.nl";
    $email_subject = "Contact";

    function died($error) {
        echo "Het spijt ons maar uw bericht was niet verstuurd" . "<br />";
        echo $error. "<br />";
        die();
    }

    if (!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['comment'])) {
        died('Sorry maar er is iets fout gegaan');
    }

    $naam = $_POST['name'];
    $email_from = $_POST['email'];
    $comment = $_POST['comment'];

    $error_message = "";

    if(!empty($email_from) && filter_var($email_from, FILTER_VALIDATE_EMAIL) === false) {
        $error_message .= 'De emailadress die u heeft ingevoerd is niet geldig.<br />';
        die();
    }

    $string_exp = "/^[A-Za-z .'-]+$/";


    if(!preg_match($string_exp,$naam)) {
        $error_message .= 'De naam die uw heeft ingevoerd klopt niet.<br />';
        die();
    }

    if(strlen($comment) < 2) {
        $error_message .= 'Het bericht die u heeft ingevoerd klopt niet.<br />';
        die();
    }

    if(strlen($error_message) > 0) {
        died($error_message);
    }

    $email_message = "Form details below.\n\n";


    function clean_string($string) {
        $bad = array("content-type","bcc:","to:","cc:","href");
        return str_replace($bad,"",$string);
    }



    $email_message .= "Naam: ".clean_string($naam)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Comments: ".clean_string($comment)."\n";

// create email headers
    $headers = 'From: '.$email_from."\r\n".
        'Reply-To: '.$email_from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
        if ($sent == '0') {
          @mail($email_to, $email_subject, $email_message, $headers);
          $sent = 1;
        }


}

if (@mail($email_to, $email_subject, $email_message, $headers) == TRUE) {
    echo "<script> alert('Uw bericht is verstuurd!'); window.location.href='http://22193.hosts1.ma-cloud.nl/portfolio/'; </script>";
} else {
    echo "<script> alert('Uw bericht was niet verstuurd!'); window.location.href='http://22193.hosts1.ma-cloud.nl/portfolio/'; </script>";
}
