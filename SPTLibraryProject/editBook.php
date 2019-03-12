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
			<?php if($_SESSION['position'] == 'assistant' || $_SESSION['position'] == 'manager') {?>
			<a class = "nav-link" href = "checkout.php">Checkout Books</a>
			<?php } 
				if($_SESSION['position'] == 'manager') {
			?>
			<a class = "nav-link" href = "editMember.php">Library Members</a>
			<a class = "nav-link" href = "editBook.php">Library Books</a>
			<?php
				}
			?>
		</div>
		<h2 class = "page-title books-title">Control Book Information</h2>
		<div class = "book-form add-form">
			<h3 class ="form-title">Add a Book</h3>
			<form id = "add-book" action = "addBook.php" method = "post" onsubmit = "return valAddBook(this);">
				<label for = "book_title">Title</label>
				<input type = "text" name = "book_title"></input>
				<label for = "book_author">Author</label>
				<input type = "text" name = "book_author"></input>
				<label for = "book_isbn">ISBN</label>
				<input type = "text" name = "book_isbn"></input>
				<label for = "book_loan">Loan Duration</label>
				<input type = "text" name = "book_loan"></input>
				<label for = "book_copies">Number of Copies to be Added</label>
				<input type = "text" name = "book_copies"></input>
				<button type = "submit">Add Member</button>
			</form>
		</div>
		<div class = "book-form update-form">
			<h3 class = "form-title">Update a Book's Information</h3>
			<form id = "update-book" action = "updateBook.php" method = "post" onsubmit = "return valUpdateBook(this);">
				<label for = "current_isbn">Current ISBN</label>
				<input type = "text" name = "current_isbn"></input>
				<label for = "new_title">Title</label>
				<input type = "text" name = "new_title"></input>
				<label for = "new_author">Author</label>
				<input type = "text" name = "new_author"></input>
				<label for = "new_isbn">ISBN</label>
				<input type = "text" name = "new_isbn"></input>
				<label for = "new_loan">Loan Duration</label>
				<input type = "text" name = "new_loan"></input>
				<label for = "new_copies">Number of Copies to be Added</label>
				<input type = "text" name = "new_copies"></input>
				<button type = "submit">Update Book</button>
			</form>
		</div>
		<div class = "book-form remove-form">
			<h3 class = "form-title">Remove a Book</h3>
			<form id = "remove-book" action = "removeBook.php" method = "post" onsubmit = "return valDeleteBook(this);">
				<label for = "isbn">ISBN</label>
				<input type = "text" name = "isbn"></input>
				<label for = "num_copies">Number of Copies to Remove</label>
				<input type = "text" name = "num_copies"></input>
				<button type = "submit">Remove Books</button>
			</form>
		</div>
		<?php		
		} else {
			header('Location: home.php');
		}
	} else { //redirect to login page
		header('Location: login.php');
	}
?>