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
	$title = $_POST['new_title'];
	$author = $_POST['new_author'];
	$CURISBN = $_POST['current_isbn'];
	$NEWISBN = $_POST['new_isbn'];
	$loanduration = $_POST['new_loan'];
	$copies = $_POST['new_copies'];
	
	$query = 'SELECT number_of_copies, copies_available FROM books WHERE isbn13 = '.$CURISBN;
	$result = $conn->query($query);
	$row = $result->fetch_assoc();
	if($copies != ''){
		$amountChanged = $copies - $row['number_of_copies'];
		$copies_avail = $row['copies_available'] + $amountChanged;
	}
	if($CURISBN == ''){
		echo "<p>Please provide a valid current ISBN
		<a href = 'editBook.php'>Try again</a></p>";
	} else {
		echo '<p>';
		if($title != '') {
			$query = 'UPDATE books SET title = "'.$title.'" WHERE isbn13 = '.$CURISBN;
			if($conn->query($query)){
				echo 'Successfully updated title.<br>';
			} else {
				echo 'Error updating title.<br>';
				echo $conn->error;
			}
		}
		if($author != '') {
			$query = 'UPDATE books SET author = "'.$author.'" WHERE isbn13 = '.$CURISBN;
			if($conn->query($query)){
				echo 'Successfully updated author.<br>';
			} else {
				echo 'Error updating author.<br>';
				echo $conn->error;
			}
		}
		if($loanduration != '') {
			$query = 'UPDATE books SET loan_duration = '.$loanduration.' WHERE isbn13 = '.$CURISBN;
			if($conn->query($query)){
				echo 'Successfully updated phone number.<br>';
			} else {
				echo 'Error updating phone number.<br>';
				echo $conn->error;
			}
		}
			if($copies != '') {
			$query = 'UPDATE books SET number_of_copies = '.$copies.' WHERE isbn13 = '.$CURISBN;
			if($conn->query($query)){
				echo 'Successfully updated copies.<br>';
			} else {
				echo 'Error updating copies.<br>';
				echo $conn->error;
			}
		}
			if($copies_avail != '') {
			$query = 'UPDATE books SET copies_available = '.$copies_avail.' WHERE isbn13 = '.$CURISBN;
			if($conn->query($query)){
				echo 'Successfully updated copies available.<br>';
			} else {
				echo 'Error updating copies available.<br>';
				echo $conn->error;
			}
		}
		if($NEWISBN != '') {
			
			$query = 'UPDATE books SET isbn13 = '.$NEWISBN.' WHERE isbn13 = '.$CURISBN;
			if($conn->query($query)){
				echo 'Successfully updated ISBN.<br>';
			} else {
				echo 'Error updating ISBN.<br>';
				echo $conn->error;
			}
		}
		echo '<a href = "editBook.php">Update another?</a></p>';
	}
	?>
	</div>
	<?php
?>