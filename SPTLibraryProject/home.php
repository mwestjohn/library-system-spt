<?php
	session_start(); // Start the session
	require_once('openDB.php'); // Open the connection to the database
	require_once('logout.php'); // Logout script for the logout button
	require_once('header.php'); // Head, complete with stylesheet links
	
	$output = '';
	
	if($_POST['search']){
		$searchField = "isbn13";
		if(isset($_POST['search-field'])){
			$searchField = $_POST['search-field'];
		}
		$target = '';
		if(isset($_POST['target'])){
			$target = $_POST['target'];
		}
		$query = "SELECT * FROM books WHERE $searchField LIKE '%$target%' ORDER BY isbn13 ASC";
		
		
		// Query the database
		if($result = $conn->query($query)) {
			while($row=$result->fetch_assoc()){
				$s = '<span class = "book-title">'.$row['title'].'</span>
				<span class = "book-author">'.$row['author'].'</span>
				<span class = "book-isbn">'.$row['isbn13'].'</span>
				<span class = "book-loan">Loan Duration: '.$row['loan_duration'].' weeks</span>
				<span class = "book-available">Number Available: '.$row['copies_available'].'</span>';
				$output .= '<div class = "search-row">'.$s.'</div>';
			}
		} else {
			$output = 'Error searching database';
		}
	}
	?>
	
	<?php
	if (isset($_SESSION['position'])) {
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
		} else { // stay here and show login button
			?>
			<h1 class = "title">Public Library</h1>
			<h3 class = "heading">Welcome</h3>
			<div class = "nav">
			<a class = "login" href = "login.php">Login Here</a>
			<?php
		}
		?>
	</div>
	<h2 class = "page-title">Search Books</h2>
	<div class = "search-form">
		<form id = "search" action="" method = "post">
			<label for="search-field">Search By: </label>
			<select id="search-field" name="search-field">
				<option value="isbn13">ISBN</option>
				<option value="title">Title</option>
				<option value="author">Author</option>
			</select>
			<input type = "text" name = "target"></input>
			<input type = "submit" name = "search" value = "Search Books" title = "Click here to search books"></input>
		</form>
	</div>
	<?php
	echo $output;
	?>
	</body>
	<?php
?>