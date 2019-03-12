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
	$ucard = $_POST['ucard'];
	
	// Get the number of books checked out by the member
	$query = 'SELECT books_checked_out FROM members WHERE ucard = '.$ucard.'';
	$result = $conn->query($query);
	$row = $result->fetch_assoc();
	$numChecked = $row['books_checked_out'];
	
	// Get the number of available copies of the book in question
	$query = 'SELECT copies_available FROM books WHERE isbn13 = '.$isbn.'';
	$result = $conn->query($query);
	$row = $result->fetch_assoc();
	$numAvailable = $row['copies_available'];
	
	if($numChecked <= 6 && $numAvailable >= 0){
		$query = 'INSERT INTO checkedoutby (isbn,ucardNo) values('.$isbn.','.$ucard.')';
		
		if($conn->query($query)) {
			echo "<p>Successfully inserted record
			<a href = 'checkout.php'>Checkout another?</a></p>";
			
			$newChecked = $numChecked + 1;
			$query = 'UPDATE members SET books_checked_out='.$newChecked.' WHERE ucard = '.$ucard.'';
			$conn->query($query);
			
			$newAvailable = $numAvailable - 1;
			$query = 'UPDATE books SET copies_available='.$newAvailable.' WHERE isbn13 = '.$isbn.'';
			$conn->query($query);
		} else {
			echo "<p>Error checking out book. Please double check the member id and the ISBN.
			<a href = 'checkout.php'>Try again?</a></p>";
		}
	} else {
		echo '<p>Error checking out book. Either there are no available copies,
		or the member already has six books checked out.
		<a href = "checkout.php">Try again?</a></p>';
	}
	?>
	</div>
	<?php
?>