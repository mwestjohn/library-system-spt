/*
	validation.js
	Author: Matt Westjohn
	Purpose: Form data validation for the library system found with this file
*/

function valAddMember(form) {
	// Define regex values for comparing to the field values
	var reAN = /^[\w ]+$/;
	var reA = /^[a-zA-Z ]+$/;
	var reUcard = /^\d{1,10}$/;
	var rePhone = /^\d{10}$/;
	
	// Make sure that all fields are filled, you can't add a member with only partial information
	if(form.member_name.value == "" || form.member_ucard.value == "" || form.member_address.value == "" || form.member_phone.value == "") {
		alert("All member information must be filled in to proceed");
		return false;
	}
	
	// Check that name only has alphabetic characters in it
	if(!reA.test(form.member_name.value)) {
		alert("Names must only contain alphabetic characters and spaces");
		return false;
	}
	
	// Check that U-Card number only contains numbers
	if(!reUcard.test(form.member_ucard.value)) {
		alert("U-Card numbers may only contain numbers");
		return false;
	}
	
	// Check that the address only contains alphanumeric characters and spaces
	if(!reAN.test(form.member_address.value)) {
		alert("Address may only contain alphanumeric characters and spaces");
		return false;
	}
	
	// Check that phone number only contains numbers
	if(!rePhone.test(form.member_phone.value)) {
		alert("Phone numbers should only contain 10 numbers, ie 1234567890");
		return false;
	}
	
	// If all those tests pass, then validation was successful, so return true
	return true;
}

function valUpdateMember(form) {
	// Define regex values for comparing to the field values
	var reAN = /^[\w ]+$/;
	var reA = /^[a-zA-Z ]+$/;
	var reUcard = /^\d{1,10}$/;
	var rePhone = /^\d{10}$/;
	
	// Make sure that the current/old U-Card number is filled in
	if(form.current_ucard.value == "") {
		alert("Current U-Card number is required in order to update a member's information");
		return false;
	}
	
	// Make sure that U-Card value is between 1 and 10 numerals
	if(!reUcard.test(form.current_ucard.value)) {
		alert("Current U-Card number must only contain numbers");
		return false;
	}
	
	// Make sure that not all update fields are empty. There's no point in updating with nothing
	if(form.new_name.value == "" && form.new_ucard.value == "" && form.new_address.value == "" && form.new_phone.value == "") {
		alert("At least one information field must be filled in to proceed");
		return false;
	}
	
	// If the form field is not blank, then check the U-Card number for properness
	if(form.new_ucard.value != "") {
		if(!reUcard.test(form.new_ucard.value)) {
			alert("New U-Card number must only contain numbers");
			return false;
		}
	}
	
	// If the form field is not blank, then check the name for properness
	if(form.new_name.value != "") {
		if(!reA.test(form.new_name.value)) {
			alert("New name must only contain letters and spaces");
			return false;
		}
	}
	
	// If the form field is not blank, then check the address for properness
	if(form.new_address.value != "") {
		if(!reAN.test(form.new_address.value)) {
			alert("New address number must only contain letters, numbers and spaces");
			return false;
		}
	}
	
	// If the form field is not blank, then check the phone number for properness
	if(form.new_phone.value != "") {
		if(!rePhone.test(form.new_phone.value)) {
			alert("New phone number must contain exactly 10 numbers");
			return false;
		}
	}
	
	// If all those tests pass, then validation was successful, so return true
	return true;
}

function valDeleteMember(form) {
	// Define regex values for comparing to the field values
	var reUcard = /^\d{1,10}$/;
	
	// Make sure that the U-Card number is filled in
	if(form.ucard.value == "") {
		alert("You cannot delete nothing! Please fill in the member's U-Card number that you wish to delete");
		return false;
	}
	
	// Check that U-Card number only contains numbers
	if(!reUcard.test(form.ucard.value)) {
		alert("U-Card numbers may only contain numbers");
		return false;
	}
	
	// If all those tests pass, then validation was successful, so return true
	return true;
}

function valAddBook(form) {
	// Define regex values for comparing to the field values
	var reAN = /^[\w ]+$/;
	var reA = /^[a-zA-Z]+$/;
	var reCopies = /^\d{10}$/;
	var reIsbn = /^\d{13}$/;
	var reLoan = /^\d{1}$/;
	
	// Make sure that all fields are filled, you can't add a book with only partial information
	if(form.book_title.value == "" || form.book_author.value == "" || form.book_isbn.value == "" || form.book_loan.value == "" || form.book_copies.value == "") {
		alert("All book information must be filled in to proceed");
		return false;
	}
	
	// Check that author name only contains letters
	if(!reA.test(form.book_author.value)) {
		alert("Author names may only contain letters and spaces");
		return false;
	}
	
	// Check that the address only contains alphanumeric characters and spaces
	if(!reIsbn.test(form.book_isbn.value)) {
		alert("ISBN must be exactly 13 numbers");
		return false;
	}
	
	// Check that phone number only contains numbers
	if(!reLoan.test(form.book_loan.value)) {
		alert("Loan duration should be the numeric duration, and should only be a single digit, ie 4");
		return false;
	}
	
	// Check that phone number only contains numbers
	if(!reCopies.test(form.book_copies.value)) {
		alert("The number of copies must be a number");
		return false;
	}
	
	// If all those tests pass, then validation was successful, so return true
	return true;
}

function valUpdateBook(form) {
	// Define regex values for comparing to the field values
	var reAN = /^[\w ]+$/;
	var reA = /^[a-zA-Z]+$/;
	var reCopies = /^\d{10}$/;
	var reIsbn = /^\d{13}$/;
	var reLoan = /^\d{1}$/;
	
	// Make sure that the current/old ISBN is filled in
	if(form.current_isbn.value == "") {
		alert("Current ISBN is required in order to update a book's information");
		return false;
	}
	
	// Make sure that ISBN value is exactly 13 numbers
	if(!reIsbn.test(form.current_isbn.value)) {
		alert("Current ISBN must contain exactly 13 numbers");
		return false;
	}
	
	// Make sure that not all update fields are empty. There's no point in updating with nothing
	if(form.new_title.value == "" && form.new_author.value == "" && form.new_isbn.value == "" && form.new_loan.value == "" && form.new_copies.value == "") {
		alert("At least one information field must be filled in to proceed");
		return false;
	}
	
	// If the form field is not blank, then check the ISBN for properness
	if(form.new_isbn.value != "") {
		if(!reIsbn.test(form.new_isbn.value)) {
			alert("New ISBN must only contain numbers");
			return false;
		}
	}
	
	// If the form field is not blank, then check the name for properness
	if(form.new_author.value != "") {
		if(!reA.test(form.new_author.value)) {
			alert("New author name must only contain letters and spaces");
			return false;
		}
	}
	
	// If the form field is not blank, then check the address for properness
	if(form.new_loan.value != "") {
		if(!reLoan.test(form.new_loan.value)) {
			alert("New loan duration must only contain a single digit number, ie 4");
			return false;
		}
	}
	
	// If the form field is not blank, then check the phone number for properness
	if(form.new_copies.value != "") {
		if(!reCopies.test(form.new_copies.value)) {
			alert("New number of copies must contain numbers only");
			return false;
		}
	}
	
	// If all those tests pass, then validation was successful, so return true
	return true;
}

function valDeleteBook(form) {
	// Define regex values for comparing to the field values
	var reCopies = /^\d{10}$/;
	var reIsbn = /^\d{13}$/;
	
	// Make sure that both fields are filled in
	if(form.isbn.value == "" || form.num_copies.value == "") {
		alert("Both fields are required in order to delete");
		return false;
	}
	
	// Make sure that ISBN value is exactly 13 numbers
	if(!reIsbn.test(form.isbn.value)) {
		alert("ISBN must contain exactly 13 numbers");
		return false;
	}
	
	// Make sure that copies value is proper
	if(!reCopies.test(form.num_copies.value)) {
		alert("ISBN must contain exactly 13 numbers");
		return false;
	}
	
	// If all those tests pass, then validation was successful, so return true
	return true;
}

function valMemCheckout(form) {
	// Define regex values for comparing to the field values
	var reIsbn = /^\d{13}$/;
	var reUcard = /^\d{1,10}$/;
	
	// Make sure that both fields are filled in
	if(form.isbn.value == "" || form.ucard.value == "") {
		alert("Both fields are required in order to delete");
		return false;
	}
	
	// Make sure that ISBN value is exactly 13 numbers
	if(!reIsbn.test(form.isbn.value)) {
		alert("ISBN must contain exactly 13 numbers");
		return false;
	}
	
	// Check that U-Card number only contains numbers
	if(!reUcard.test(form.ucard.value)) {
		alert("U-Card numbers may only contain numbers");
		return false;
	}
	
	// If all those tests pass, then validation was successful, so return true
	return true;
}

function valMemCheckin(form) {
	// Define regex values for comparing to the field values
	var reIsbn = /^\d{13}$/;
	var reUcard = /^\d{1,10}$/;

	// Make sure that both fields are filled in
	if(form.isbn.value == "" || form.ucard.value == "") {
		alert("Both fields are required in order to delete");
		return false;
	}
	
	// Make sure that ISBN value is exactly 13 numbers
	if(!reIsbn.test(form.isbn.value)) {
		alert("ISBN must contain exactly 13 numbers");
		return false;
	}
	
	// Check that U-Card number only contains numbers
	if(!reUcard.test(form.ucard.value)) {
		alert("U-Card numbers may only contain numbers");
		return false;
	}
	
	// If all those tests pass, then validation was successful, so return true
	return true;
}

function valStaffCheckout(form) {
	// Define regex values for comparing to the field values
	var reAN = /^[\w ]+$/;
	var reIsbn = /^\d{13}$/;
	
	// Make sure that both fields are filled in
	if(form.isbn.value == "" || form.username.value == "") {
		alert("Both fields are required in order to delete");
		return false;
	}
	
	// Make sure that ISBN value is exactly 13 numbers
	if(!reIsbn.test(form.isbn.value)) {
		alert("ISBN must contain exactly 13 numbers");
		return false;
	}
	
	// Check that U-Card number only contains numbers
	if(!reAN.test(form.username.value)) {
		alert("Username may only contain letters and numbers");
		return false;
	}
	
	// If all those tests pass, then validation was successful, so return true
	return true;
}

function valStaffCheckin(form) {
	// Define regex values for comparing to the field values
	var reAN = /^[\w ]+$/;
	var reIsbn = /^\d{13}$/;
	
	// Make sure that both fields are filled in
	if(form.isbn.value == "" || form.username.value == "") {
		alert("Both fields are required in order to delete");
		return false;
	}
	
	// Make sure that ISBN value is exactly 13 numbers
	if(!reIsbn.test(form.isbn.value)) {
		alert("ISBN must contain exactly 13 numbers");
		return false;
	}
	
	// Check that U-Card number only contains numbers
	if(!reAN.test(form.username.value)) {
		alert("Username may only contain letters and numbers");
		return false;
	}
	
	// If all those tests pass, then validation was successful, so return true
	return true;
}

