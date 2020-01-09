<?php
$dbh = new PDO("mysql:host=localhost;dbname=mispms", "web2", "web2");
$attachmentId = isset($_GET['attachmentId'])? $_GET['attachmentId'] : "";
$stat = $dbh->prepare("select * from attachmentproject where attachmentId=?");
$stat->bindParam(1, $attachmentId);
$stat->execute();
$row = $stat->fetch();
header('Content-Type:'.$row['attachmentType']);
echo $row['attachmentData'];
?>