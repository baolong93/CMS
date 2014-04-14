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

changeCart = function()
	{
		var target;
		target = document.getElementById("cart");
		request("php/shoppingCart/cart_display.php", target);
	};

pageLoaded = function() 
	{
		var cart = document.getElementById("add_to_cart");
		if(cart)
			{
				cart.addEventListener("click", changeHomepage);
			}
		changeCart();
	};

window.onload = pageLoaded;