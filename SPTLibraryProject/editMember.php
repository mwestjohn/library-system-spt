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
		<form id = "add-member" action = "addMember.php" method = "post">
			<label for = "member-name">Name</label>
			<input name = "member-name" placeholder = "John Smith"></input>
			<label for = "member-ucard">U-Card</label>
			<input name = "member-ucard" placeholder = "1234"></input>
			<label for = "member-address">Address</label>
			<input name = "member-address" placeholder = "1 Maple Dr."></input>
			<label for = "member-phone">Phone</label>
			<input name = "member-phone" placeholder = "1234567890"></input>
			<button type = "submit">Add Member</button>
		</form>	
		<form id = "update-member" action = "updateMember.php" method = "post">
			<label for = "current-ucard">Current U-Card</label>
			<input type = "text" name = "current-ucard" placeholder = "1234"></input>
			<label for = "new-name">New Name</label>
			<input type = "text" name = "new-name" placeholder = "John Smith"></input>
			<label for = "new-ucard">New U-Card</label>
			<input type = "text" name = "new-ucard" placeholder = "1234"></input>
			<label for = "new-address">New Address</label>
			<input type = "text" name = "new-address" placeholder = "1 Maple Dr."></input>
			<label for = "new-phone">New Phone</label>
			<input type = "text" name = "new-phone" placeholder = "1234567890"></input>
			<button type = "submit">Update Member</button>
		</form>
		<form id = "remove-member" action = "removeMember.php" method = "post">
			<label for = "ucard">U-Card Number</label>
			<input type = "text" name = "ucard" placeholder = "1234"></input>
			<button type = "submit">Remove Member</button>
		</form>
		<?php
		} else {
			header('Location: home.php');
		}
	} else { //redirect to book search page
		header('Location: home.php');
	}
?>