//This does the users registration
function Contact()
{
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var names = $("#names").val();
	var email = $("#email").val();
	var subject = $("#subject").val();
	var messages = $("#messages").val();
	
	if(names == "")
	{
		$("#status").html('<div class="info">Please enter your name in the required field to proceed.</div>');
		$("#name").focus();
	}
	else if(email == "")
	{
		$("#status").html('<div class="info">Please enter your email address to proceed.</div>');
		$("#email").focus();
	}
	else if(reg.test(email) == false)
	{
		$("#status").html('<div class="info">Please enter a valid email address to proceed.</div>');
		$("#email").focus();
	}
	else if(subject == "")
	{
		$("#status").html('<div class="info">Please enter your subject to proceed.</div>');
		$("#subject").focus();
	}
	else if(messages == "")
	{
		$("#status").html('<div class="info">Please enter your message.</div>');
		$("#messages").focus();
	}
	else
	{
		var dataString = 'names='+ names + '&email=' + email + '&subject=' + subject + '&messages=' + messages + '&page=signup';
		$.ajax({
			type: "POST",
			url: "http://localhost/purwanto/contact/send",
			data: dataString,
			cache: false,
			beforeSend: function() 
			{
				$("#status").html('<br clear="all"><div style="padding-left:115px;"><font style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:black;">Please wait</font> <img src="http://localhost/purwanto/assets/contact/images/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div><br clear="all">');
			},
			success: function(response)
			{
				$("#status").hide().fadeIn('slow').html(response);
			}
		});
	}
}
