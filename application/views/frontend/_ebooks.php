<div id="main">
  <h3 id="_control"></h3>
        <div class="tab-control padding20" data-role="tab-control">
    <div class="cleaner_h10"></div>
<?php
if(count($ebook->result_array())>0){
foreach($ebook->result_array() as $kt)
{
echo "<div class='download'><img src='".base_url()."assets/images/download.png' alt='Yudi Purwanto' border='0' class='image2'>
<table>
<tr><td width='135'>File</td><td width='10'> : </td><td>".$kt['title']."</td></tr>
<tr><td>Date</td><td> : </td><td>".generate_tanggal($kt['date'])."</td></tr>
<tr><td>Download</td><td> : </td><td>".$kt['counter']." Kali</td></tr>
<tr><td>Posting by</td><td> : </td><td>Yudi Purwanto</td></tr>
<tr><td></td><td></td><td><a href='".base_url()."ebooks/get/".$kt['idebook']."'><span class='submitButton2'>Download File</span></a></td></tr>
</table>
</div>";
}
}
else{
echo "Sorry, File Not Found.";
}
?>
<div class="pagination"><ul><?=$paginator;?></ul></div>
<div class="cleaner_h20"></div>
</div></div>
 
