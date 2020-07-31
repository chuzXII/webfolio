<?php
require_once "header.php";
if (isset($_SESSION['username']))
{
	header_user();
}
else 
{	
header_belum_login();
modal();
}
session_start();
if (isset($_GET['username']))
{
	if(strlen(trim($_GET['username'])) != 0)
	{
		$id = $_GET['username'];
		$kueri=mysql_query("SELECT * FROM user WHERE username='$_GET[username]'");
		$data=mysql_fetch_array($kueri);
		if(mysql_num_rows($kueri) > 0)
		{
			?>
<br/>	
<div class="container">
<div class="col-md-3">
<div class="panel panel-default">
<div class="panel-heading" style="background: url('../novoselic/img/photography/new_year_background.png');">
<div class="text-center"><?php echo "<small>$data[username]</small>"; ?></div>

<?php
if ($_GET["username"] == $_SESSION['username']){
?>
<?php
}
else
{
	echo "";
}
?>
</div>
<div class="panel-body" style="background: url('../novoselic/img/photography/dimension.png');">
<?php
echo "<img src='foto_profil/$data[foto_profil]' width='500px' height='500px' class='img-responsive gambarpost' style='cursor:pointer;'/>
</div>
<div class='text-center'>";
?>
</div>
<div class="panel-footer" style="background: url('../novoselic/img/photography/new_year_background.png');">
<?php
		echo"
		<hr>
		<h3 class='text-center'>$data[nama_profil]</h3>
		<hr>
		<span class='glyphicon glyphicon-user'></span> - $data[username] <br> 
		<span class='glyphicon glyphicon-envelope'></span> - $data[email]<br>
		<span class='glyphicon glyphicon-star'></span> - $data[keterangan]<br>
		<span class='glyphicon glyphicon-map-marker'></span> - $data[location]<br>
		<hr>";
			if (isset($_SESSION['username'])=="$data[id_user]" && $_SESSION['username']=="$data[username]")
			{
			echo "<a href='upload_karya.php?id=$data[id_user]'><button class='btn btn-success btn-lg' style='margin-left:8px;'><span class='glyphicon glyphicon-upload'></span> Upload Karya</button></a><hr>";
			}
		}
?>
</div>
</div>
</div>
<div class="col-lg-9">
 
			<?php
			

 			$sql = mysql_query("SELECT * FROM image JOIN user USING(id_user) WHERE username='$_GET[username]' && image.status='sudah_vertifikasi' order by id_image DESC");
			if (mysql_num_rows($sql)==0)
			{
				echo "<b>Belum ada gambar silahkan upload!</b>";
			}
			else
			{
			while($data = mysql_fetch_array($sql)){
				
				if (isset($_SESSION['username'])=="$data[id_user]" && $_SESSION['username']=="$data[username]"){
						echo'<div class="custom-column-5" id='. $data['kategori_file'] .'>
							<div class="be-post">
							
								<a href="gambarz.php?id='. $data["id_image"] .'" class="be-img-block">
								<img src="'. $data[file] .'" alt="">
								</a>
								<a href="gambar.php?id='. $data["id_image"] .'" class="be-post-title">' . $data[nama_file] . '</a>
								<span>
									<a class="be-post-tag">'. $data[kategori_file] .'</a>
								</span>
								<div class="author-post">
									<hr><span class="text-center">'. $data[tgl_upload] .'</span>
								</div>
								
								</div>
								
							</div>
							
							';}
				else{
					echo'<div class="custom-column-5" id='. $data['kategori_file'] .'>
							<div class="be-post">
							
								<a href="gambar.php?id='. $data["id_image"] .'" class="be-img-block">
								<img src="'. $data[file] .'" alt="">
								</a>
								<a href="gambar.php?id='. $data["id_image"] .'" class="be-post-title">' . $data[nama_file] . '</a>
								<span>
									<a class="be-post-tag">'. $data[jurusan] .'</a>
								</span>
								<div class="author-post">
									<hr><span class="text-center">'. $data[tgl_upload] .'</span>
								</div>
								
								</div>
								
							</div>
							
							';}
				}

				}				
			
			
			?>

</div>

<div id="myModal" class="modal fade" role="dialog">

  <div class="modal-dialog" >
  <div class="modal-content" style="background-color:transparent; box-shadow: none !important; border: 0px !important; cursor: pointer;">

  <div class="col-md-12">
	<div class="modal-body">
		
	</div>
	</div>
	
	</div>
   </div>
  </div>
 
</div>

<script>
$('.gambarpost').click(function(){
  	$('.modal-body').empty();
  	var title = $(this).parent('a').attr("title");
  	$('.modal-title').html(title);
  	$($(this).parents('div').html()).appendTo('.modal-body');
  	$('#myModal').modal({show:true});
});
</script>
</div>
<?php
	}
	else 
		{
			echo "User Tidak ada";
		}
	}
	else
	{
		echo "<script>window.location='index.php'</script>";
	}
footer();
?>
