<?php
// - testing
// header('Content-Type: application/json');
// echo json_encode($_POST);
// exit();

/*
  More flexible handler for Mailchimp API v3 requests,
  Including the ability to add users to interest groups.

  to add interest group to a signup form, add a hidden field like so:
  <input type="hidden" class="form-interests" value="newsletter" name="interests[]">
  where the 'value' matches one of the following conditionals.
*/

// first, prepare an empty array
$interestGroup = array();

if(isset($_POST['interests'])){

  // grab the form 'interests' values
  // $interestsRaw = $_POST['interests'];

  // grab the form 'interests' values
  $interests = $_POST['interests'];

  // for each interest, add ID to array
  foreach($interests as $interest){
    $interestGroup[$interest] = true;
  }


  // check for specific interest values and add interest ID to array
  // (https://us5.api.mailchimp.com/playground/ -> list ->  interest group -> id)
  // if(in_array('newsletter', $interests)){
  //   // Interest Group ID - Newsletter > Organic
  //   $interestGroup['940fadb050'] = true;
  // }
  // if(in_array('shape-of-b2b', $interests)){
  //   // Interest Group ID - Nurture Campaign > Post 4/22/16
  //   $interestGroup['6f9878a054'] = true;
  // }
  // if(in_array('self-service-white-paper', $interests)){
  //   // Interest Group ID - Nurture Campaign > Post 4/22/16
  //   $interestGroup['59763c6433'] = true;
  // }
}

// Fill the rest of the values from POST vars
$fname = $_POST['FNAME'];
$lname = $_POST['LNAME'];
$email = $_POST['EMAIL'];
$company = '';
if(isset($_POST['COMPANY'])){
  $company = $_POST['COMPANY'];
}

// Make an array from values
$data = array(
  'firstname' => $fname,
  'lastname' => $lname,
  'email' => $email,
  'company' => $company,
  'status' => 'subscribed',
  'interest' => $interestGroup
);

header('Content-Type: application/json');
echo syncMailchimp($data);



// mailchimp subscription code via http://stackoverflow.com/questions/30481979/adding-subscribers-to-a-list-using-mailchimps-api-v3
function syncMailchimp($data) {
    $apiKey = 'c67760689f7697a995ac53159e7b522d-us5';
    // $listId = 'ec547254e7'; // old list ID
    $listId = '1c7703765a'; // new list ID

    $memberId = md5(strtolower($data['email']));
    $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);

    $urlNewMember = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listId . '/members/';
    $urlExistingMember = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listId . '/members/' . $memberId;

    $paramNewMember = array(
      'email_address' => $data['email'],
      'status'        => $data['status'], // "subscribed","unsubscribed","cleaned","pending"
      'merge_fields'  => array(
          'FNAME'     => $data['firstname'],
          'LNAME'     => $data['lastname'],
          'MMERGE3'   => $data['company'],
          'EMAIL'   => $data['email']
      )
    );
    // If interest group is available, push it into the $param array
    if($data[interest]){
      $paramNewMember['interests'] = $data['interest'];
    }

    $paramExistingMember = array(
      'interests' => $data['interest'],
      'email_address' => $data['email'],
      'merge_fields'  => array(
          'FNAME'     => $data['firstname'],
          'LNAME'     => $data['lastname'],
          'MMERGE3'   => $data['company'],
          'EMAIL'   => $data['email']
      )
    );

    $jsonNewMember = json_encode($paramNewMember);
    $jsonExistingMember = json_encode($paramExistingMember);

    $firstresult = '';

    // First, try to update user info
    $ch = curl_init($urlExistingMember);
    curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonExistingMember);

    $result = curl_exec($ch);
    $firstresult = $result;
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if($httpCode != '200'){
      // If user does not exist, create new user
      $ch = curl_init($urlNewMember);
      curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_TIMEOUT, 10);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonNewMember);

      $result = curl_exec($ch);
      $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      curl_close($ch);
    }

    return json_encode(array('httpcode' => $httpCode, 'result' => $result, 'firstresult' => $firstresult));
    // return json_encode($result);
}
?>
