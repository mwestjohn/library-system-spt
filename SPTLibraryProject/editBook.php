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
		?>
		<form id = "add-book" action = "addBook.php" method = "post">
			<label for = "member-name">Name</label>
			<input name = "member-name"></input>
			<label for = "member-ucard">U-Card</label>
			<input name = "member-ucard"></input>
			<label for = "member-address">Address</label>
			<input name = "member-address"></input>
			<label for = "member-phone">Phone</label>
			<input name = "member-phone"></input>
			<button type = "submit">Add Member</button>
		</form>	
		<form id = "update-book" action = "updateBook.php" method = "post">
			<label for = "current-ucard">Current U-Card</label>
			<input type = "text" name = "current-ucard"></input>
			<label for = "member-name">New Name</label>
			<input type = "text" name = "member-name"></input>
			<label for = "member-ucard">New U-Card</label>
			<input type = "text" name = "member-ucard"></input>
			<label for = "member-address">New Address</label>
			<input type = "text" name = "member-address"></input>
			<label for = "member-phone">New Phone</label>
			<input type = "text" name = "member-phone"></input>
			<button type = "submit">Add Member</button>
		</form>
		<form id = "remove-book" action = "removeBook.php" method = "post">
			<label for = "ucard">U-Card Number</label>
			<input type = "text" name = "ucard"></input>
			<button type = "submit">Remove Member</button>
		</form>
		<?php
			}
		} else {
			header('Location: home.php');
		}
	} else { //redirect to login page
		header('Location: login.php');
	}
?>