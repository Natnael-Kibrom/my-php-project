<?php
$conn = new mysqli("localhost", "northtech", "ntech@ro.ot", "xept");
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}