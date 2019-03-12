<?php
	session_start(); // Start the session
	require_once('openDB.php'); // Open the connection to the database
	require_once('logout.php'); // Logout script for the logout button
	require_once('header.php'); // Head, complete with stylesheet links
	
	if (isset($_SESSION['position'])) {
		if($_SESSION['position'] == 'manager' || $_SESSION['position'] == 'assistant') {
		?>
		<h1 class = "title">Public Library</h1>
		<h3 class = "heading">Welcome <?php echo $_SESSION['name'] ?></h3>
		<div class = "nav">
			<a class = "logout" href="?action=logout">Logout</a>
			<a class = "nav-link" href = "home.php">Search Books</a>
			<?php
				// Show link to checkout page if user is logged in
				if($_SESSION['position'] == 'assistant' || $_SESSION['position'] == 'manager') {
			?>
			<a class = "nav-link" href = "checkout.php">Checkout Books</a>
			<?php } 
				// Show links to manager restricted pages if the logged in user is a manager
				if($_SESSION['position'] == 'manager') {
			?>
			<a class = "nav-link" href = "editMember.php">Library Members</a>
			<a class = "nav-link" href = "editBook.php">Library Books</a>
			<?php
				}
			?>
		</div>
		<h2 class = "page-title checkout-title">Checkout/In</h2>
		<div class = "checkout check-form">
			<h3 class = "form-title">Library Member Checkout</h3>
			<form id = "checkout-form" action = "checkoutBook.php" method = "post">
				<label for = "ucard">U-Card Number</label>
				<input type = "text" name = "ucard"></input>
				<label for = "isbn">ISBN</label>
				<input type = "text" name = "isbn"></input>
				<button type = "submit">Checkout Book</button>
			</form>
		</div>
		<div class = "checkin check-form">
			<h3 class = "form-title">Library Member Checkin</h3>
			<form id = "checkin-form" action = "checkinBook.php" method = "post">
				<label for = "ucard">U-Card Number</label>
				<input type = "text" name = "ucard"></input>
				<label for = "isbn">ISBN</label>
				<input type = "text" name = "isbn"></input>
				<button type = "submit">Checkin Book</button>
			</form>
		</div>
		<div class = "checkout-staff check-form">
			<h3 class = "form-title">Library Staff Checkin</h3>
			<form id = "checkout-form" action = "checkoutBookStaff.php" method = "post">
				<label for = "username">Staff Username</label>
				<input type = "text" name = "username"></input>
				<label for = "isbn">ISBN</label>
				<input type = "text" name = "isbn"></input>
				<button type = "submit">Checkout Book</button>
			</form>
		</div>
		<div class = "checkin-staff check-form">
			<h3 class = "form-title">Library Staff Checkin</h3>
			<form id = "checkin-form" action = "checkinBookStaff.php" method = "post">
				<label for = "username">Staff Username</label>
				<input type = "text" name = "username"></input>
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