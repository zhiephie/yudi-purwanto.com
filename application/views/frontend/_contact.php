<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>vasPLUS Programming Blog - Ajax and Jquery Registration or Sign-up Form Submission</title>
<!-- Required header files -->
<link href="<?php echo base_url(); ?>assets/contact/css/style.css" rel="stylesheet" type="text/css">
<!--<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>assets/contact/js/script.js"></script>-->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/contact/js/jquery.min.js"></script>

<script type="text/javascript">
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
                        url: "<?php echo base_url();?>contact/send",
			type: "POST",
			data: dataString,
			cache: false,
			beforeSend: function() 
			{
				$("#status").html('<br clear="all"><div style="padding-left:115px;"><font style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:black;">Please wait</font> <img src="<?php echo base_url();?>assets/contact/images/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div><br clear="all">');
			},
			success: function(response)
			{
				$("#status").hide().fadeIn('slow').html(response);
			}
		});
	}
}

</script>
</head>
<body>
<br clear="all">
<center>
<div style="font-family:Verdana, Geneva, sans-serif; font-size:24px;width:800px;">Ajax and Jquery Registration or Sign-up Form Submission</div><br clear="all" /><br clear="all">
<!-- Code Begins -->
<center>
<div class="vpb_main_wrapper"><br clear="all">

<div style="width:115px; padding-top:10px;float:left;" align="left">Name:</div>
<div style="width:300px;float:left;" align="left"><input type="text" id="names" name="names" value="" class="vpb_textAreaBoxInputs"></div><br clear="all"><br clear="all">


<div style="width:115px; padding-top:10px;float:left;" align="left">Email Address:</div>
<div style="width:300px;float:left;" align="left"><input type="text" id="email" name="email" value="" class="vpb_textAreaBoxInputs"></div><br clear="all"><br clear="all">


<div style="width:115px; padding-top:10px;float:left;" align="left">Subject:</div>
<div style="width:300px;float:left;" align="left"><input type="text" id="subject" name="subject" value="" class="vpb_textAreaBoxInputs"></div><br clear="all"><br clear="all">


<div style="width:115px; padding-top:10px;float:left;" align="left">Message:</div>
<div style="width:300px;float:left;" align="left"><textarea type="text" id="messages" name="messages" value="" class="textArea"></textarea></div><br clear="all"><br clear="all">


<div style="width:115px; padding-top:10px;float:left;" align="left">&nbsp;</div>
<div style="width:300px;float:left;" align="left">
<a href="javascript:void(0);" class="vpb_general_button" onClick="Contact();">Send</a></div>

<br clear="all"><br clear="all">

<div align="left" id="status"></div>

</div>
</center>
<!-- Code Ends -->
</center>
</body>
</html>