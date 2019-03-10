<?php
	session_start();
	require_once('openDB.php');
	require_once('logout.php');
	
	if (isset($_SESSION['position'])) {
		if($_SESSION['position'] == 'manager' || $_SESSION['position'] == 'assistant') {
		?>
		<h3>Welcome <?php echo $_SESSION['name'] ?></h3>
		<a href="?action=logout">Logout</a>
		<a href = "home.php">Search Books</a>
		<?php
			// Show link to checkout page if user is logged in
			if($_SESSION['position'] == 'assistant' || $_SESSION['position'] == 'manager') {
		?>
		<a href = "checkout.php">Checkout Books</a>
		<?php } 
			// Show links to manager restricted pages if the logged in user is a manager
			if($_SESSION['position'] == 'manager') {
		?>
		<a href = "editMember.php">Library Members</a>
		<a href = "editBook.php">Library Books</a>
		<?php
			}
		}
	}
	
	$isbn = $_POST['isbn'];
	$ucard = $_POST['ucard'];
			
	$query = 'DELETE FROM checkedoutby WHERE isbn = '.$isbn.' AND ucardNo = '.$ucard.'';
	if($conn->query($query)) {
		echo "<p>Successfully removed record 
		<a href = 'checkout.php'>Remove another?</a></p>";
	} else {
		echo "<p>Error removing record. Please double check the member id and the ISBN.
		<a href = 'checkout.php'>Try again?</a></p>";
	}
?>