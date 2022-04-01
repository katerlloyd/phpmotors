'use strict'

// Get a list of reviews based on the clientId
let clientId = document.getElementById('clientId').value;
let clientIdURL = "/phpmotors/reviews/index.php?action=getReviews&clientId=" + clientId;
fetch(clientIdURL)
	.then(function (response) {
		if (response.ok) {
		return response.json();
	}
		throw Error("Network response was not OK");
	})
	.then(function (data) {
		buildReviewList(data);
	})
	.catch(function (error) {
		console.log('There was a problem: ', error.message)
	})

// Build review items into HTML table components and inject into DOM
 function buildReviewList(data) {
	  let reviewListDisplay = document.getElementById("reviewListDisplay");
	  // Set up the table labels
	  let dataTable = '<thead>';
	  dataTable += '<tr><th>Date</th><th>Vehicle</th><th>Review</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
	  dataTable += '</thead>';
	  // Set up the table body
	  dataTable += '<tbody>';
	  // Iterate over all reviews in the array and put each in a row
	  data.forEach(function (element) {
			dataTable += `<td>${element.reviewDate}</td>`
			dataTable += `<td>${element.invMake} ${element.invModel}</td>`;
			dataTable += `<td>${element.reviewText}</td>`;
			dataTable += `<td class="review-buttons"><a class="mod" href='/phpmotors/reviews?action=edit-review-page&reviewId=${element.reviewId}' title='Click to modify'>Modify</a>`;
			dataTable += `<a class="del" href='/phpmotors/reviews?action=delete-review-page&reviewId=${element.reviewId}' title='Click to delete'>Delete</a></td></tr>`;
	  })
	  dataTable += '</tbody>';
	  // Display the contents in the Admin view
	  reviewListDisplay.innerHTML = dataTable;
 }