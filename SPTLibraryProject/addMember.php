<?php
	session_start(); // Start the session
	require_once('openDB.php'); // Open the connection to the database
	require_once('logout.php'); // Logout script for the logout button
	
	if (isset($_SESSION['position'])) {
		if($_SESSION['position'] == 'manager') {
		?>
		<h3>Welcome <?php echo $_SESSION['name'] ?></h3>
		<a href="?action=logout">Logout</a>
		<a href = "home.php">Search Books</a>
		<?php if($_SESSION['position'] == 'assistant' || $_SESSION['position'] == 'manager') {?>
		<a href = "checkout.php">Checkout Books</a>
		<?php } 
			if($_SESSION['position'] == 'manager') {
		?>
		<a href = "editMember.php">Library Members</a>
		<a href = "editBook.php">Library Books</a>
		<?php
			}
			
		} else {
			header('Location: home.php');
		}
	} else { //redirect to book search page
		header('Location: home.php');
	}
?>