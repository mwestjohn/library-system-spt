<?php
	session_start(); // Start the session
	require_once('openDB.php'); // Open the connection to the database
	require_once('logout.php'); // Logout script for the logout button
	require_once('header.php'); // Head, complete with stylesheet links
	
	if (isset($_SESSION['position'])) {
		if($_SESSION['position'] == 'manager') {
		?>
		<h1 class = "title">Public Library</h1>
		<h3 class = "heading">Welcome <?php echo $_SESSION['name'] ?></h3>
		<div class = "nav">
			<a class = "logout" href="?action=logout">Logout</a>
			<a class = "nav-link" href = "home.php">Search Books</a>
			<?php if($_SESSION['position'] == 'assistant' || $_SESSION['position'] == 'manager') {?>
			<a class = "nav-link" href = "checkout.php">Checkout Books</a>
			<?php } 
				if($_SESSION['position'] == 'manager') {
			?>
			<a class = "nav-link" href = "editMember.php">Library Members</a>
			<a class = "nav-link" href = "editBook.php">Library Books</a>
			<?php
				}
			?>
		</div>
		<h2 class = "page-title member-title">Control Member Information</h2>
		<div class = "add-form member-form">
			<h3 class = "form-title">Add a New Member</h3>
			<form id = "add-member" action = "addMember.php" method = "post" onsubmit = "return valAddMember(this);">
				<label for = "member_name">Name</label>
				<input name = "member_name"></input>
				<label for = "member_ucard">U-Card</label>
				<input name = "member_ucard"></input>
				<label for = "member_address">Address</label>
				<input name = "member_address"></input>
				<label for = "member_phone">Phone</label>
				<input name = "member_phone"></input>
				<button type = "submit">Add Member</button>
			</form>
		</div>
		<div class = "update-form member-form">
			<h3 class = "form-title">Update a Member's Information</h3>
			<form id = "update-member" action = "updateMember.php" method = "post" onsubmit = "return valUpdateMember(this);">
				<label for = "current_ucard">Current U-Card</label>
				<input type = "text" name = "current_ucard"></input>
				<label for = "new_name">New Name</label>
				<input type = "text" name = "new_name"></input>
				<label for = "new_ucard">New U-Card</label>
				<input type = "text" name = "new_ucard"></input>
				<label for = "new_address">New Address</label>
				<input type = "text" name = "new_address"></input>
				<label for = "new_phone">New Phone</label>
				<input type = "text" name = "new_phone"></input>
				<button type = "submit">Update Member</button>
			</form>
		</div>
		<div class = "remove-form member-form">
			<h3 class = "form-title">Remove a Member</h3>
			<form id = "remove-member" action = "removeMember.php" method = "post" onsubmit = "return valDeleteMember(this);">
				<label for = "ucard">U-Card Number</label>
				<input type = "text" name = "ucard"></input>
				<button type = "submit">Remove Member</button>
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