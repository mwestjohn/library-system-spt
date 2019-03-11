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
	
	$ucard = $_POST['ucard'];
	
	// Get the number of books checked out by a member. They cannot leave the system if they are still in possession of any library property
	$query = 'SELECT books_checked_out FROM members WHERE ucard = '.$ucard;
	$result = $conn->query($query);
	$row = $result->fetch_assoc();
	if($row['books_checked_out'] != 0) {
		echo "<p>Cannot remove member who still has books checked out
		<a href = 'editMember.php'>Remove someone else?</a></p>";
	} else {
		$query = "DELETE FROM members WHERE ucard = ".$ucard;
		if($conn->query($query)) {
			echo '<p>Successfully removed member
			<a href = "editMember.php">Remove another?</a></p>';
		} else {
			echo '<p>Could not remove member. Verify the U-Card number.
			<a href = "editMember.php">Try again?</a></p>';
		}
	}
?>