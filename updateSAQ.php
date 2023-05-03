<!DOCTYPE HTML>
<html>

	<head>
		<meta charset="UTF-8" />
	</head>
	<body>
<?php
	require("dataconf.php");
	require("config.php");
	$page = 1;
	$nombreProduit = 12; //48 ou 96

	$saq = new SAQ();
	$listeProduit= [];
	for($i=0; $i<$nombreProduit;$i++)	//permet d'importer séquentiellement plusieurs pages.
	{
		$nombre = $saq->getProduits($nombreProduit,$page+$i);
		$listeProduit[] = $nombre;
	}
	var_dump($listeProduit);

?>
</body>
</html>