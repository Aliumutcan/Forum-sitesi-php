
<?php
function Sayfalama($sayfa,$suanki){
	$url=substr($_SERVER['REQUEST_URI'], 1,strlen($_SERVER['REQUEST_URI'])-6);
	$url_dizisi;

	if (strlen(strstr($url, '/'))>0) 
		$url_dizisi=explode('/',$url);
	else
		$url_dizisi[]=$url;
	$urlon="";
	$urlarka="";
	for ($i=0; $i <count($url_dizisi); $i++) {
		if($i==$sayfa) continue;
		else if($i>$sayfa) $urlarka=$urlarka."/".$url_dizisi[$i];
		else $urlon=$urlon."/".$url_dizisi[$i];

	}
	for ($i=1; $i <intval($_GET["adet"])+1; $i++) { 
?>
	<a class="btn btn-danger" href="<?php echo Kok_Dizine_Yonlendir().$urlon.$i.$urlarka.'.html'; ?>"><?php echo $i ;?></a>

<?php
	}
}


?>