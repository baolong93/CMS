<script>
function isset(varname)
{
	return typeof varname != 'undifined'
}

function validateName(field) {
	if (field == "") return "No Name was entered.\n"
	return ""
}
function validatePrice(field) {
	if (field == "") return "No Price was entered.\n"
	else if (field.length > 5) 
		return "Price can not be greater than 100000$"
	else if (![0-9].test(field))
		return "Invalid Price"
	return "" 
}
function validateDescription(field) {
	if (field == "") return "No description was entered.\n"
	else if (field.length > 200)
		return "description is too long!!.\n"
	return ""
}

</script>
