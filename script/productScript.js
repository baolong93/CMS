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
	var status = document.getElementById('status'+proid).value;
	request("active_deactive.php?id="+proid+"&status="+status, target);
};

edit = function(link) 
	{
		var target;
		target = document.getElementById("item");
		request("edit.php?id="+link, target);
	}