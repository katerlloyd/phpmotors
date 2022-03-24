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
		console.log(data);
		buildReviewList(data);
	})
	.catch(function (error) {
		console.log('There was a problem: ', error.message)
	})


function getVehicleInfo(invId) {
	document.getElementById('invId').value = `${invId}`;
	let invIdURL = "/phpmotors/reviews/index.php?action=getVehicles&invId=" + invId;
	fetch(invIdURL)
    	.then(function (response) {
    		if (response.ok) {
    		return response.json();
    	}
    		throw Error("Network response was not OK");
    	})
    	.then(function (data) {
    		console.log(data);
    		return data;
    	})
    	.catch(function (error) {
    		console.log('There was a problem: ', error.message)
    	})
}

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
//			let vehicle = getVehicleInfo(element.InvId);
//			console.log(vehicle);
	       let options = { year: 'numeric', month: 'long', day: 'numeric' };
	       let date = new Date(element.reviewDate);
	       dataTable += `<tr><td>${date.toLocaleDateString("en-US", options)}</td>`;
//	       dataTable += `<td>${vehicle.invMake} ${vehicle.invModel}</td>`;
		   dataTable += `<td>${element.reviewText}</td>`;
		   dataTable += `<td><a href='/phpmotors/reviews?action=edit-review&reviewId=${element.reviewId}' title='Click to modify'>Modify</a></td>`;
		   dataTable += `<td><a href='/phpmotors/reviews?action=delete-review&reviewId=${element.reviewId}' title='Click to delete'>Delete</a></td></tr>`;
	  })
	  dataTable += '</tbody>';
	  // Display the contents in the Admin view
	  reviewListDisplay.innerHTML = dataTable;
 }