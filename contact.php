<?php
// Hostinger PHP contact handler for NUHRA
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: index.html'); exit; }
if (!empty($_POST['website'])) { http_response_code(400); exit('Invalid request'); }
function clean($v){ return trim(strip_tags($v ?? '')); }
$name=clean($_POST['name']); $email=filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL); $company=clean($_POST['company']); $service=clean($_POST['service']); $message=clean($_POST['message']);
if(!$name || !$email || !$message){ http_response_code(400); exit('Please complete the required fields.'); }
$to='connect@nuhra.in'; $subject='New NUHRA website enquiry — '.preg_replace('/[\r\n]+/',' ',$name);
$body="Name: $name\nEmail: $email\nCompany: $company\nService: $service\n\nMessage:\n$message\n";
$headers="From: NUHRA Website <connect@nuhra.in>\r\nReply-To: $email\r\nContent-Type: text/plain; charset=UTF-8\r\n";
$sent=mail($to,$subject,$body,$headers);
if($sent){ header('Location: thank-you.html'); exit; }
http_response_code(500); echo 'Sorry, your message could not be sent. Please email connect@nuhra.in directly.';
?>
