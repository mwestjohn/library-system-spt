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
		<?php
		} else {
			header('Location: home.php');
		}
	} else { //redirect to book search page
		header('Location: home.php');
	}
	?>
	<div class = "results page">
	<?php
	$ucard = $_POST['ucard'];
	
	// Get the number of books checked out by a member. They cannot leave the system if they are still in possession of any library property
	$query = 'SELECT books_checked_out FROM members WHERE ucard = '.$ucard;
	$result = $conn->query($query);
	$row = $result->fetch_assoc();
	if($row['books_checked_out'] != 0) {
		echo "<p>Cannot remove member who still has books checked out
		<a href = 'editMember.php'>Remove someone else?</a></p>";
		require_once('header.php'); // Head, complete with stylesheet links
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
	</div>
	<?php
?>