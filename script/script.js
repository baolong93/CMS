request = function(link, target, result)
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
    xhr.send(result);
};

// picPreview = function()
// {
// 	var target;
// 	target = document.getElementById('picPreview');
// 	request("picPreview.php", target);
// }

changeCart = function()
	{
		var target;
		target = document.getElementById("cart");
		request("php/shoppingCart/cart_display.php", target);
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
		changeCart();
	};

window.onload = pageLoaded;