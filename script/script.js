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
};

changeActive = function(proid)
{
	var target;
	target = document.getElementById('active'+proid);
	var status = document.getElementById('status');
	request("active_deactive.php?id="+proid+"&status="+status, target);
};

changeCart = function()
	{
		var target;
		var proQty = document.getElementById('proQty').value;
		var productID = document.getElementById('product_ID').value;
		target = document.getElementById("cart");
		request("php/shoppingcart/cart_display.php?product_ID="+productID+"&product_qty="+proQty+"&type=add", target);
	};

edit = function(link) 
	{
		var target;
		target = document.getElementById("item");
		request("edit.php?id="+link, target);
	}
changeProductView = function(link)
	{
		var target;
		target = document.getElementById("item");
		request("php/shoppingCart/product_display.php?id="+link, target);
	}

pageLoaded = function() 
	{
		// 
		var cart = document.getElementById("addCart");
		// if(button){
		// 	button.addEventListener("click", changeActive, true);
		// }
		if(cart){
			cart.addEventListener("click", changeCart, true);
		}
		changeCart();
		// changeActive();
	};

window.onload = pageLoaded;