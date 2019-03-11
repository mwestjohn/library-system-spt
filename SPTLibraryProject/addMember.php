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
	
	$name = $_POST['member-name'];
	$address = $_POST['member-address'];
	$phone = $_POST['member-phone'];
	$ucard = $_POST['member-ucard'];
	
	$query = "INSERT INTO members(U-card,name,address,phone) VALUES(".$ucard.",".$name.",".$address.",".$phone."";
	
	if($conn->query($query)) {
		echo '<p>Successfully added a new member.
		<a href = "editMember.php">Add Anther?</a></p>';
	} else {
		echo '<p>Failed to add member.
		<a href = "editMember.php">Try Again?</a></p>';
	}
?>