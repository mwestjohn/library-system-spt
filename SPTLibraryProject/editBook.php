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
		?>
		<form id = "add-book" action = "addBook.php" method = "post">
			<label for = "book-title">Title</label>
			<input name = "book-title"></input>
			<label for = "book-author">Author</label>
			<input name = "book-author"></input>
			<label for = "book-isbn">ISBN</label>
			<input name = "book-isbn"></input>
			<label for = "book-loan">Loan Duration</label>
			<input name = "book-loan"></input>
			<label for = "book-copies">Number of Copies to be Added</label>
			<input name = "book-copies"></input>
			<button type = "submit">Add Member</button>
		</form>	
		<form id = "update-book" action = "updateBook.php" method = "post">
			<label for = "current-isbn">Current ISBN</label>
			<input type = "text" name = "current-ucard"></input>
			<label for = "book-title">Title</label>
			<input name = "book-title"></input>
			<label for = "book-author">Author</label>
			<input name = "book-author"></input>
			<label for = "book-isbn">ISBN</label>
			<input name = "book-isbn"></input>
			<label for = "book-loan">Loan Duration</label>
			<input name = "book-loan"></input>
			<label for = "book-copies">Number of Copies to be Added</label>
			<input name = "book-copies"></input>
			<button type = "submit">Update Book</button>
		</form>
		<form id = "remove-book" action = "removeBook.php" method = "post">
			<label for = "isbn">ISBN</label>
			<input type = "text" name = "isbn"></input>
			<label for = "num-copies">Number of Copies to Remove</label>
			<input type = "text" name = "num-copies"></input>
			<button type = "submit">Remove Books</button>
		</form>
		<?php
			}
		} else {
			header('Location: home.php');
		}
	} else { //redirect to login page
		header('Location: login.php');
	}
?>