// function confirmDelete() {
// 	var x;
// 	var r=confirm("Press a button!");
// 	if (r==true)
// 	  {
// 	  x="You pressed OK!";
// 	  }
// 	else
// 	  {
// 	  x="You pressed Cancel!";
// 	  }
// 	document.getElementById("demo").innerHTML=x;
// }
// function isset(varname)
// {
// 	return typeof varname != 'undifined'
// }

// function validateName(field) {
// 	if (field == "") return "No Name was entered.\n"
// 	return ""
// }
// function validatePrice(field) {
// 	if (field == "") return "No Price was entered.\n"
// 	else if (field.length > 5) 
// 		return "Price can not be greater than 100000$"
// 	else if (![0-9].test(field))
// 		return "Invalid Price"
// 	return "" 
// }
// function validateDescription(field) {
// 	if (field == "") return "No description was entered.\n"
// 	else if (field.length > 200)
// 		return "description is too long!!.\n"
// 	return ""
// }

var pageLoaded, fetchInsert;

fetchInsert = function () {
	//variable declare that will be used.
	var xhr, target, changeListener;

	//find the element that should be updated.
	target = document.getElementById("mainpage");

	//create a request object
	xhr = new XMLHttpRequest();

	changeListener = function () {
		if (xhr.readyState === 4 && xhr.status === 200) {
			// add the retrived content to it using
			// the innerHTML property
			target.innerHTML = xhr.responseText;
		} else {
			target.innerHTML = "<p>Something went wrong.</p>";
		}
	};

// initialise a request, specifying the HTTP method
// to be used and the URL to be connected to.
xhr.open("GET", "php/insert.php", true);
xhr.onreadystatechange = changeListener;
xhr.send();
};

pageLoaded = function () {
	var fetchButton = document.getElementById("productButton");
	if (fetchButton) {
		fetchButton.addEventListener("click", fetchInsert, true);
	}
};

window.onload = pageLoaded;

