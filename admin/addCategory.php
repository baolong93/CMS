<?php
/// Need to complete the validation.
/// Need to link to insert page, allow admin to add more cat even in insert page.
/// Need to allow admin to delete the cat as well
/// May need to implement sub cat system.
include_once('../include/connect.php');
include_once('header.php');
?>
<div class="maincontent">
		<div class="content">
			<div>
			<ul class="little-nav">
				<li>
					<a href="index.php">Home</a>
					<span class="divider">/</span>
				</li>
				<li>
					<a href="addCategory.php">Insert Category</a>
				</li>
			</ul>
			</div>
			<div class="topcontent" id="item">
<?php
if (isset($_POST['submitted'])) {
	
		$catname 			= $_POST['catName'];
		$sql					="INSERT INTO Category (ID, Name) 
								VALUES ('', '$catname')";
		$results = $mysqli->query($sql);
		if (!$results) {
			die('error inserting new product!');
		} //end of nested statement.
		else {
			echo "Succesfully insert new category:".$catname;
		}
} //end of if statement.


?>
	<form method="post" action="addCategory.php" onSubmit="return validate(this)"><pre>    <!--pre tag for keep the form in fix width-->
			<input type="hidden" name="submitted" value="yes"/>
			Name:             <input type="text" name="catName"/>
			<input type="submit" value="Add Category"/>
	</pre></form>
<?php

	include_once('footer.php');
?>
	<script>
	function validate(form) {
	 fail = validateName(form.catName.value)
	 if (fail == "") return true
	 	else {alert(fail); return false}
	}
 	</script>
 	<script>
		function validateName(field) {
		if (field == "") {
			return "No Name was entered.\n";
		}
		else if (field.length < 5) {
			return "The category Name must be asleast 5 character.\n";
		}
		return "";
		};
 </script>