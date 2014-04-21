
	function validate(form) {
	 fail = validateName(form.proName.value)
	 fail += validatePrice(form.price.value)
	 fail += validateDescription(form.desc.value)
	 fail += validateStock(form.NoP.value)
	 if (fail == "") return true
	 	else {alert(fail); return false}
	};
		function validateName(field) {
		if (field == "") {
			return "No Name was entered.\n";
		}
		else if (field.length < 8) {
			return "The product Name must be asleast 8 character.\n";
		}
		return "";
		};
		function validateStock(field) {
			if (field == "") {
				return "Stock at least one. \n";
			}
			else if (!/\d/.test(field)) {
				return "Stock can only be a number."
			}
			return "";
		};
		function validatePrice(field) {
			if (field == "") return "No Price was entered.\n"
			else if (!/\d{1,6}/.test(field))
				return "Price can only be a number and less than million";
			return "" 
		};
		function validateDescription(field) {
			if (field == "") return "No description was entered.\n";
			else if (field.length > 200){
				return "description is too long!!.\n";
			}
			return ""
		};

