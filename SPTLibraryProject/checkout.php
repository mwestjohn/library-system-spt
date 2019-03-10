<?php
	session_start(); // Start the session
	require_once('openDB.php'); // Open the connection to the database
	require_once('logout.php'); // Logout script for the logout button
	
	if (isset($_SESSION['position'])) {
		if($_SESSION['position'] == 'manager' || $_SESSION['position'] == 'assistant') {
		?>
		<h3>Welcome <?php echo $_SESSION['name'] ?></h3>
		<a href="?action=logout">Logout</a>
		<a href = "home.php">Search Books</a>
		<?php
			// Show link to checkout page if user is logged in
			if($_SESSION['position'] == 'assistant' || $_SESSION['position'] == 'manager') {
		?>
		<a href = "checkout.php">Checkout Books</a>
		<?php } 
			// Show links to manager restricted pages if the logged in user is a manager
			if($_SESSION['position'] == 'manager') {
		?>
		<a href = "editMember.php">Library Members</a>
		<a href = "editBook.php">Library Books</a>
		<?php
			}
		?>
		<div class = "checkout">
			<form id = "checkout-form" action = "checkoutBook.php" method = "post">
				<label for = "ucard">U-Card Number</label>
				<input type = "text" name = "ucard"></input>
				<label for = "isbn">ISBN</label>
				<input type = "text" name = "isbn"></input>
				<button type = "submit">Checkout Book</button>
			</form>
		</div>
		<div class = "checkin">
			<form id = "checkin-form" action = "checkinBook.php" method = "post">
				<label for = "ucard">U-Card Number</label>
				<input type = "text" name = "ucard"></input>
				<label for = "isbn">ISBN</label>
				<input type = "text" name = "isbn"></input>
				<button type = "submit">Checkin Book</button>
			</form>
		</div>
		<?php
		} else {
			header('Location: home.php');
		}
	} else { //redirect to book search page
		header('Location: home.php');
	}
?>