
<?php

function getProduits($nombre = 24, $page = 1) {
	$s = curl_init();
	$url = "https://www.saq.com/fr/produits/vin/vin-rouge?p=".$page."&product_list_limit=".$nombre."&product_list_order=name_asc";
	curl_setopt_array($s,array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_USERAGENT=>'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0',
		CURLOPT_ENCODING=>'gzip, deflate',
		CURLOPT_HTTPHEADER=>array(
				'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
				'Accept-Language: en-US,en;q=0.5',
				'Accept-Encoding: gzip, deflate',
				'Connection: keep-alive',
				'Upgrade-Insecure-Requests: 1',
		),
	));
	$webpage = curl_exec($s);
	curl_close($s);

	$doc = new DOMDocument();
	@$doc->loadHTML($webpage);
	$elements = $doc->getElementsByTagName("li");
	$produits = array();
	foreach ($elements as $key => $noeud) {
		if (strpos($noeud->getAttribute('class'), "product-item") !== false) {
			$info = recupereInfo($noeud);
			$produits[] = $info;
		}
	}

	return json_encode($produits);
}

function recupereInfo($noeud) {
   var_dump($noeud);
	$info = new stdClass();
	$info->img = $noeud->getElementsByTagName("img")->item(0)->getAttribute('src');
	$info->nom = $noeud->getElementsByTagName("h3")->item(0)->nodeValue;
	$info->pays = $noeud->getElementsByTagName("p")->item(0)->nodeValue;
	$info->description = $noeud->getElementsByTagName("div")->item(0)->nodeValue;
	$info->prix = $noeud->getElementsByTagName("span")->item(0)->nodeValue;
	$info->code_saq = str_replace('Code SAQ : ', '', $noeud->getElementsByTagName("div")->item(2)->nodeValue);
	$info->url_saq = "https://www.saq.com" . $noeud->getElementsByTagName("a")->item(0)->getAttribute('href');
	return $info;
}

echo getProduits();

?>