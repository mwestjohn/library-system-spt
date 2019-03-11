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
	
	$oldUcard = $_POST['current-ucard'];
	$newName = $_POST['new-name'];
	$newUcard = $_POST['new-ucard'];
	$newAddress = $_POST['new-address'];
	$newPhone = $_POST['new-phone'];
	
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