xmlRequest = function(url, target, vars)
{
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
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
    xhr.open("POST", url, true);
    xhr.send(vars);
}

changeHomepage = function()
	{
		var target;
		target = document.getElementById("cart");
		xmlRequest("php/shoppingCart/cart_display.php", target);
	}

pageLoaded = function() 
	{
		var homepage = document.getElementById("add_to_cart");
		if(homepage)
			{
				homepage.addEventListener("click", changeHomepage);
			}
		changeHomepage();
	}

window.onload = pageLoaded;