<?php
if (isset($_GET['action']) && ('logout' == $_GET['action'])) {
	unset($_SESSION['position']);
	unset($_SESSION['name']);
}
?>