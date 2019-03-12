<?php
	session_start();
	require_once('openDB.php');
	require_once('logout.php');
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
		<?php
		}
	}
	?>
	<div class = "results page">
	<?php
	$isbn = $_POST['isbn'];
	$username = $_POST['username'];
			
	$query = 'DELETE FROM checkedoutbyStaff WHERE isbn = '.$isbn.' AND username = "'.$username.'"';
	if($conn->query($query)) {
		echo "<p>Successfully removed record
		<a href = 'checkout.php'>Remove another?</a></p>";
		// Get how many books are checked out
		$query = 'SELECT books_checked_out FROM staff WHERE username = "'.$username.'"';
		$result = $conn->query($query);
		$row = $result->fetch_assoc();
		
		// Subtract 1 from the number of books checked out to allow for the member to check out more books later
		$newChecked = $row['books_checked_out']-1;
		$query = 'UPDATE staff SET books_checked_out='.$newChecked.' WHERE userename = '.$username.'';
		$conn->query($query);
		
		// Get how many books are checked out
		$query = 'SELECT copies_available FROM books WHERE isbn13 = '.$isbn.'';
		$result = $conn->query($query);
		$row = $result->fetch_assoc();
		
		// Subtract 1 from the number of books checked out to allow for the member to check out more books later
		$newChecked = $row['copies_available']+1;
		$query = 'UPDATE books SET copies_available='.$newChecked.' WHERE isbn13 = '.$isbn.'';
		$conn->query($query);
	} else {
		echo "<p>Error removing record. Please double check the member id and the ISBN.
		<a href = 'checkout.php'>Try again?</a></p>";
		echo $conn->error;
	}
	?>
	</div>
	<?php
?>