request = function(link, target	)
{
	var changeListener;
    var xhr = new XMLHttpRequest();
    changeListener = function()
    	{
        	if(xhr.readyState === 4)
					{
						if(xhr.status == 200) 
		   					{
		    					target.innerHTML = xhr.responseText;
		    				} 
						else 
		    				{
		    					target.innerHTML = "<p>Something didn't work right.</p>";
		    				}
		    		}
		    	else
		    		{
		    			target.innerHTML = "<p>Hold Up...</p>";
		    		}
		}; 
    xhr.open("GET", link, true);
    xhr.onreadystatechange = changeListener;
    xhr.send();
}
changeCart = function()
	{
		var target;
		var proQty = document.getElementById('proQty').value;
		var productID = document.getElementById('product_ID').value;
		target = document.getElementById("cart");
		request("customer/shoppingcart/cart_display.php?product_ID="+productID+"&product_qty="+proQty+"&type=add", target);
	};

searchProduct = function()
{
	var target;
	var search = document.getElementById('search').value;
	target = document.getElementById('item');
	request("customer/search.php?search="+search, target);
}

searchProductAdmin = function()
{
	var target; 
	var search = document.getElementById('search').value;
	target = document.getElementById('item');
	request("search.php?search="+search, target);
}
changeProductView = function(link)
	{
		var target;
		target = document.getElementById("item");
		request("customer/shoppingCart/product_display.php?id="+link, target);
	}
changeReport = function()
{
	var target;
	target = document.getElementById("item");
	request("report/orderreport.php", target);
}

pageLoaded = function() {
		var searchButton = document.getElementById("searchButton");
		var reportButton = document.getElementById("Report");
		if(searchButton)
		{
			searchButton.addEventListener("click", searchProduct, true);
		}
		if(reportButton)
		{
			reportButton.addEventListener("click", changeReport, true);
		}
	};

window.onload = pageLoaded;