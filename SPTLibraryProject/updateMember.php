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
	$oldUcard = $_POST['current_ucard'];
	$newName = $_POST['new_name'];
	$newUcard = $_POST['new_ucard'];
	$newAddress = $_POST['new_address'];
	$newPhone = $_POST['new_phone'];
	
	if($oldUcard == ''){
		echo "<p>Please provide a valid U-Card number
		<a href = 'editMember.php'>Try again</a></p>";
	} else {
		echo '<p>';
		if($newName != '') {
			$query = 'UPDATE members SET name = "'.$newName.'" WHERE ucard = '.$oldUcard;
			if($conn->query($query)){
				echo 'Successfully updated name.<br>';
			} else {
				echo 'Error updating name.<br>';
				echo $conn->error;
			}
		}
		if($newAddress != '') {
			$query = 'UPDATE members SET address = "'.$newAddress.'" WHERE ucard = '.$oldUcard;
			if($conn->query($query)){
				echo 'Successfully updated address.<br>';
			} else {
				echo 'Error updating address.<br>';
				echo $conn->error;
			}
		}
		if($newPhone != '') {
			$query = 'UPDATE members SET phone = '.$newPhone.' WHERE ucard = '.$oldUcard;
			if($conn->query($query)){
				echo 'Successfully updated phone number.<br>';
			} else {
				echo 'Error updating phone number.<br>';
				echo $conn->error;
			}
		}
		if($newUcard != '') {
			
			$query = 'UPDATE members SET ucard = '.$newUcard.' WHERE ucard = '.$oldUcard;
			if($conn->query($query)){
				echo 'Successfully updated U-Card number.<br>';
			} else {
				echo 'Error updating U-Card number.<br>';
				echo $conn->error;
			}
		}
		echo '<a href = "editMember.php">Update another?</a></p>';
	}
	?>
	</div>
	<?php
?>