<?php


if(isset($_POST['submit'])){
$email = $_POST['email'];
$subject="Thank you for subscribe";
$body = "Thank you for subscribe our channel. Get in touch with us. We send our articles for you.";
$id = getId($email);
addToList($id);
sendEmail($email,$body,$subject);
header("Location: index.php");

}

if(isset($_GET['send'])){
	$body=$_GET['msg'];
	$subject=$_GET['subject'];
	sendBulkEmail($body,$subject);
	header("Location: index.php");

}
if(isset($_GET['delete'])){
	$email = $_GET['delete'];
	$id = getId($email);
	deleteContact($id);
	
}


function getId($email){
    $url = 'https://api.sendgrid.com/v3/';
$request =  $url.'contactdb/recipients';
$params = array(array(
'email' => $email
));
$json_post_fields = json_encode($params);
// Generate curl request
$ch = curl_init();
$headers = 
array("Content-Type: application/json",
"Authorization: Bearer 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");
curl_setopt($ch, CURLOPT_POST, true);   
curl_setopt($ch, CURLOPT_URL, $request);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// Apply the JSON to our curl call
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_post_fields);
$data = curl_exec($ch);
if (curl_errno($ch)) {
print "Error: " . curl_error($ch);
} else {
// Show me the result
curl_close($ch);
}
$obj = json_decode($data);
$id = $obj->{'persisted_recipients'};
    return $id[0];
}



function addToList($id){
    $url = 'https://api.sendgrid.com/v3/';
$request =  $url.'contactdb/lists/5110018/recipients/'.$id;  //5110018 is list_id

// Generate curl request
$ch = curl_init();
$headers = 
array("Content-Type: application/json",
"Authorization: Bearer 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");
curl_setopt($ch, CURLOPT_POST, true);   
curl_setopt($ch, CURLOPT_URL, $request);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// Apply the JSON to our curl call
$data = curl_exec($ch);
if (curl_errno($ch)) {
print "Error: " . curl_error($ch);
} else {
// Show me the result
curl_close($ch);
}

}

function sendBulkEmail($body,$subject){
    $request =  'https://api.sendgrid.com/v3/contactdb/lists/5110018/recipients?page_size=100&page=1';


$ch = curl_init();
$headers = 
array("Content-Type: application/json",
"Authorization: Bearer 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");

curl_setopt($ch, CURLOPT_URL, $request);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// Apply the JSON to our curl call

$data = curl_exec($ch);
if (curl_errno($ch)) {
print "Error: " . curl_error($ch);
} else {
// Show me the result
curl_close($ch);
}
$obj = json_decode($data);

$count = $obj->{'recipient_count'};
$id = $obj->{'recipients'};


for ($x = 0; $x < $count; $x++) {
    $email = $id[$x]->{'email'};
    sendEmail($email,$body,$subject);
    sleep(0.5);
}

}









function sendEmail($email,$body,$subject){

	$body = $body."If you want to unsubscribe our chanel follow below link.http://localhost/mail/action.php?delete=".$email;

$request = 'https://api.sendgrid.com/v3/mail/send';
$vari = array (
  'personalizations' => 
  array (
    0 => 
    array (
      'to' => 
      array (
        0 => 
        array (
          'email' => $email,
        ),
      ),
      'subject' => $subject,
    ),
  ),
  'from' => 
  array (
    'email' => 'akilakavindu05@gmail.com',
  ),
  'content' => 
  array (
    0 => 
    array (
      'type' => 'text/plain',
      'value' => $body,
    ),
  ),
);
$json_post_fields = json_encode($vari);

$ch = curl_init();
$headers = 
array("Content-Type: application/json",
"Authorization: Bearer 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");
curl_setopt($ch, CURLOPT_POST, true);   
curl_setopt($ch, CURLOPT_URL, $request);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// Apply the JSON to our curl call
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_post_fields);
$data = curl_exec($ch);
if (curl_errno($ch)) {
print "Error: " . curl_error($ch);
} else {
// Show me the result
curl_close($ch);
}

}

function deleteContact($id){
$request = 'https://api.sendgrid.com/v3/contactdb/lists/5110018/recipients/'.$id;  //5110018 is list_id


$ch = curl_init();
$headers = 
array("Content-Type: application/json",
"Authorization: Bearer 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");

curl_setopt($ch, CURLOPT_URL, $request);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_TIMEOUT, 60);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$data = curl_exec($ch);
if (curl_errno($ch)) {
print "Error: " . curl_error($ch);
} else {

curl_close($ch);
}
echo "done!!!!";

}


