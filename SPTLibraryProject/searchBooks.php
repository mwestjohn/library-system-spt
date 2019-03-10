<?php
	require_once('openDB.php');
	$searchField = "isbn13";
	if(isset($_POST['search-field'])){
		$searchField = $_POST['search-field'];
	}
	$target = '';
	if(isset($_POST['target'])){
		$target = $_POST['target'];
	}
	$query = "SELECT * FROM books WHERE $searchField LIKE '%$target%' ORDER BY isbn13 ASC";
	$output = '';
	
	// Query the database
	if($result = $conn->query($query)) {
		while($row=$result->fetch_assoc()){
			$s = '<span class = "book-title">'.$row['title'].'</span>
			<span class = "book-author">'.$row['author'].'</span>
			<span class = "book-isbn">'.$row['isbn13'].'</span>
			<span class = "book-loan">Loan Duration: '.$row['loan duration'].' weeks</span>
			<span class = "book-available">Number Available: '.$row['copies available'].'</span>';
			$output .= '<div class = "search-row">'.$s.'</div>';
		}
	} else {
		$output = 'Error searching database';
	}
	echo $output;
	return;

?>