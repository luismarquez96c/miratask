<?php 

$hostname='{imap.gmail.com:993/imap/ssl}INBOX';
$username = 'cmdavid32@gmail.com';
$password = 'pasiontuning';

$mbox = imap_open($hostname,$username,$password) or die('Cannot connect to Tiriyo: ' . imap_last_error());
$status=imap_status($mbox,$hostname,SA_ALL);
if ($status) {
	echo "Messages: " . $status->messages . "
	\n";
	echo "Recent: " . $status->recent . "
	\n";
	echo "Unseen: " . $status->unseen . "
	\n";
	echo "UIDnext: " . $status->uidnext . "
	\n";
	echo "UIDvalidity:" . $status->uidvalidity . "
	\n";
} 
else {
	echo "imap_status failed: " . imap_last_error() . "\n";
}
?>