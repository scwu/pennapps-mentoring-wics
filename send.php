<?php
if(isset($_POST['email'])) {
     
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "s.clara.wu@gmail.com";
    $email_subject = "PennApps Mentoring Submission";
     
     
    function died($error) {
      // your error code can go here
        echo json_encode(array("Response" => "Error", 'Error' => $error));
    }
     
    // validation expected data exists
    if(!isset($_POST['name']) ||
      !isset($_POST['email']) ||
      !isset($_POST['major']) ||
      !isset($_POST['year'])) {
         echo json_encode(array("Response"=>"Error"));
    }     
    $name = $_POST['name']; // required
    $email_from = $_POST['email']; // required
    $comments = $_POST['comments']; // required
    $major = $_POST['major'];
    $year = $_POST['year'];
     
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
    return died($error_message);
  }
    $string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$name)) {
    $error_message .= 'The name you entered does not appear to be valid.<br />';
    return died($error_message);
  }

  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "Form details below.\n\n";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Major: ".clean_string($major)."\n";
    $email_message .= "Year: ".clean_string($year)."\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";
     
     
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers); 
echo json_encode(array('Response' => 'Success'));
}

?>

