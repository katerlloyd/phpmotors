'use strict'

// Build review items into HTML table components and inject into DOM
 function buildReviewsList(data) {
    console.log("IN buildReviewsList");
	  let reviewListDisplay = document.getElementById("reviewListDisplay");
	  // Set up the table labels
	  let dataTable = '<thead>';
	  dataTable += '<tr><th>Review</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
	  dataTable += '</thead>';
	  // Set up the table body
	  dataTable += '<tbody>';
	  // Iterate over all reviews in the array and put each in a row
	  data.forEach(function (element) {
		   dataTable += `<tr><td>${element.reviewText} ${element.reviewDate}</td>`;
		   dataTable += `<td><a href='/phpmotors/reviews?action=edit-review&reviewId=${element.reviewId}' title='Click to modify'>Modify</a></td>`;
		   dataTable += `<td><a href='/phpmotors/reviews?action=delete-review&reviewId=${element.reviewId}' title='Click to delete'>Delete</a></td></tr>`;
	  })
	  dataTable += '</tbody>';
	  // Display the contents in the Admin view
	  reviewListDisplay.innerHTML = dataTable;
 }