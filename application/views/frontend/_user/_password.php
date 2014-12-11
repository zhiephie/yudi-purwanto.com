<style>
body{
	background-image:url(assets/img/body-bg.png);
	background-repeat:repeat-x;
	background-attachment:fixed;
	background-position:bottom;
	font-family:Arial, Helvetica, sans-serif;
	font-size:11px;
}
h2{
	font-size:15px;
	padding:0px;
	margin:0px;
	font-weight:bold;
	color:#666666;
}
h3{
	font-size:12px;
	padding:0px;
	margin:0px;
	font-weight:normal;
	color:#666666;
}
.tombol{
background-color:#d6d6d6;
border:1px solid #DDDDDD;
font-size:11px;
color:#666666;
font-weight:bold;
padding:5px;
}
.tombol:hover{
background-color:#b5bec6;
color:#666666;
box-shadow: 0 1px 1px rgba(0, 0, 255, 0.3), 0 1px 1px rgba(255, 255, 0, 0.2);
}
</style>
 <?php echo form_open("user/updatepassword"); ?>
<table cellspacing="5">
<tr><td width="150"><h3>username</h3></td><td width="10">:</td><td><input type="text" disabled="disabled" value="<?php echo $this->session->userdata('username'); ?>" class="form-control" size="30"></td></tr>
<tr><td width="150"><h3>old password</h3></td><td width="10">:</td><td><input type="password" name="pwd_lama" class="form-control" size="30"></td></tr>
<tr><td width="150"><h3>new password</h3></td><td width="10">:</td><td><input type="password" name="pwd" class="form-control" size="30"></td></tr>
<tr><td></td><td></td><td><input type="submit" value="Update" class="tombol"></td></tr>
</table>
<?php echo form_close();?>