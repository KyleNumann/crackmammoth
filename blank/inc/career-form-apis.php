<?php

$firstname = $_POST['careerFirstName'];
$lastname = $_POST['careerLastName'];
$email = $_POST['careerEmail'];
$phone = isset($_POST['careerPhone']) && $_POST['careerPhone'] != null ? $_POST['careerPhone'] : '';
$portfolio = isset($_POST['careerPortfolio']) && $_POST['careerPortfolio'] != null ? $_POST['careerPortfolio'] : '';
$comments = isset($_POST['careerComment']) && $_POST['careerComment'] != null ? nl2br($_POST['careerComment']) : '';
$listing = $_POST['careerListing'];
$category = $_POST['careerCategory'];
// $coverletter = $_FILES["careerCoverLetter"];
$resume = $_FILES["careerResume"];

$emailmessage = <<<EOF

Position:<br>
    $listing
<br><br>
Name:<br>
	$firstname $lastname
<br><br>
Email:<br>
	$email
<br><br>
Phone:<br>
	$phone
<br><br>
Portfolio URL:<br>
    $portfolio
<br><br>
Cover Letter/Comments:<br>
    $comments
<br><br>

EOF;

$return_message = '';
$return = array();

// if($coverletter) {
//     $coverletterfile = fopen($_FILES["careerCoverLetter"]["tmp_name"],'rb');
//     // Read the file content into a variable
//     $coverletterflsz=filesize($_FILES["careerCoverLetter"]["tmp_name"]);
//     $coverletterdata = fread($coverletterfile, $coverletterflsz);
//     // close the file
//     fclose($coverletterfile);

//     $coverlettername = $_FILES["careerCoverLetter"]["name"];
// }

if($resume) {
    // if (is_readable($resume)) {
        $resumefile = fopen($_FILES["careerResume"]["tmp_name"],'rb');
        // Read the file content into a variable
        $resumeflsz=filesize($_FILES["careerResume"]["tmp_name"]);
        $resumedata = fread($resumefile, $resumeflsz);
        // close the file
        fclose($resumefile);

        $resumename = $_FILES["careerResume"]["name"];
    // } else {
    //     $resume = null;
    // }
}

// if ( $listing == 'Graphic Designer' ) {
if ( $category == 'designer' ) {
    $to = 'bennett@goldenspiralmarketing.com,andy@goldenspiralmarketing.com';
// } elseif ( $listing == 'Web Developer' ) {
} elseif ( $category == 'developer' ) {
    $to = 'andy@goldenspiralmarketing.com,peter@goldenspiralmarketing.com';
} else {
    $to = 'peter@goldenspiralmarketing.com,john@goldenspiralmarketing.com';
}
// $to = 'bennett@goldenspiralmarketing.com,andy@goldenspiralmarketing.com';
$subject = 'Career Inquiry';

$bound_text = "test123";
$bound = "--".$bound_text."\r\n";
$bound_last = "--".$bound_text."--\r\n";

$headers = "From: \"Golden Spiral Website [Careers]\" <careers@goldenspiralmarketing.com>\r\n";
$headers.= "MIME-Version: 1.0\r\n"
    ."Content-Type: multipart/mixed; boundary=\"$bound_text\"";

$message.= "If you can see this MIME then your client doesn't accept MIME types!\r\n"
    	.$bound;
$message.= "Content-Type: text/html; charset=\"iso-8859-1\"\r\n"
		."Content-Transfer-Encoding: 7bit\r\n\r\n"
	    ."$emailmessage\r\n"
	    .$bound;

// if($coverletter) {
//     $message.= "Content-Type: ".$_FILES["careerCoverLetter"]["type"]."; name=\"".$coverlettername."\"\r\n"
//         	."Content-Transfer-Encoding: base64\r\n"
//         	."Content-disposition: attachment; file=\"".$coverlettername."\"\r\n"
//         	."\r\n"
//         	.chunk_split(base64_encode($coverletterdata))
//             .$bound_last;
// }

if($resume) {
    $message.= "Content-Type: ".$_FILES["careerResume"]["type"]."; name=\"".$resumename."\"\r\n"
            ."Content-Transfer-Encoding: base64\r\n"
            ."Content-disposition: attachment; file=\"".$resumename."\"\r\n"
            ."\r\n"
            .chunk_split(base64_encode($resumedata))
            .$bound_last;
} else {
    $message.= $bound_last;
}

// if(!$coverletter && !$resume) {
//     $message.= $bound_last;
// }

if(mail($to, $subject, $message, $headers)) {
     $return['status'] = 'sent';
} else {
     $return['status'] = 'unsent';
}

header('Content-Type: application/json');
echo json_encode($return);

?>
