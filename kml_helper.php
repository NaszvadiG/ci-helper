<?php
  function generate_kml()
  {
    $CI =& get_instance();
    $CI->load->model(array('lampu_model','sarpras_model','jalan_model','rambu_model','delinator_model'));
    /*
    	lineString => jalan
    	marker => lampu,sarpras,rambu,delinator
    */
		// Creates the Document.
		$dom = new DOMDocument('1.0', 'UTF-8');
		// Creates the root KML element and appends it to the root document.
		$node = $dom->createElementNS('http://earth.google.com/kml/2.1', 'kml');
		$parNode = $dom->appendChild($node);
		// Creates a KML Document element and append it to the KML element.
		$dnode = $dom->createElement('Document');
		$docNode = $parNode->appendChild($dnode);

		$restStyleNode = $dom->createElement('Style');
		$restStyleNode->setAttribute('id', "jalan");

		$lineStyle= $dom->createElement('LineStyle');
		$color=$dom->createElement("color","#00e37bcc");
		$width=$dom->createElement("width","3");
		$lineStyle->appendChild($color);
		$lineStyle->appendChild($width);
		$restStyleNode->appendChild($lineStyle);
		$docNode->appendChild($restStyleNode);
		

		// Iterates through the MySQL results, creating one Placemark for each row.
		$jalan=$CI->jalan_model->get()->result_array();
		foreach ($jalan as $row )
		{
		  // Creates a Placemark and append it to the Document.
		  $node = $dom->createElement('Placemark');
		  $placeNode = $docNode->appendChild($node);
		  // Creates an id attribute and assign it the value of id column.
		  $placeNode->setAttribute('id', 'jalan-'.$row['id']);
		  // Create name, and description elements and assigns them the values of the name and address columns from the results.
		  $nameNode = $dom->createElement('name',htmlentities($row['ruas-jalan']));
		  $placeNode->appendChild($nameNode);
		  $descNode = $dom->createElement('description', $row['id-kecamatan']."<br/>".$row['nama-awal']." - ".$row['nama-akhir']."<br/> <a target='_blank' href='".base_url('perangkat/detail/jalan/'.$row['id'])."'>Detail</a>");
		  $placeNode->appendChild($descNode);
		  // $styleUrl = $dom->createElement('styleUrl', '#'.$row['id-konstruksi']);
		  $styleUrl = $dom->createElement('styleUrl', '#jalan');
		  $placeNode->appendChild($styleUrl);
		  // Creates a Point element.
		  $lineNode = $dom->createElement('LineString');
		  $placeNode->appendChild($lineNode);
      $tessellateNode=$dom->createElement('tessellate');
      $placeNode->appendChild($tessellateNode);
		  // Creates a coordinates element and gives it the value of the lng and lat columns from the results.
		  $coorNode = $dom->createElement('coordinates', $row['path']);
		  $lineNode->appendChild($coorNode);
		}

    $lampu=$CI->lampu_model->get()->result_array();
		foreach ($lampu as $row )
		{
		  // Creates a Placemark and append it to the Document.
		  $node = $dom->createElement('Placemark');
		  $placeNode = $docNode->appendChild($node);
		  // Creates an id attribute and assign it the value of id column.
		  $placeNode->setAttribute('id', 'lampu-'.$row['id']);
		  // Create name, and description elements and assigns them the values of the name and address columns from the results.
		  $nameNode = $dom->createElement('name',$row['jenis'].'-'.$row['id-jalan']);
		  $placeNode->appendChild($nameNode);
		  $descNode = $dom->createElement('description', $row['jenis'].'-'.$row['id-jalan']."<br/> Kondisi :".$row['id-kondisi']."<br/>".$row['keterangan']);
		  // $descNode = $dom->createElement('description', $row['jenis'].'-'.$row['id-jalan']."<br/> Kondisi :".$row['id-kondisi']."<br/>".$row['keterangan']."<br/> <a href='".base_url('perangkat/detail/lampu/'.$row['id'])."'");
		  $placeNode->appendChild($descNode);
		  $styleUrl = $dom->createElement('styleUrl', '#lampu-'.$row['id']);
		  $placeNode->appendChild($styleUrl);
		  // Creates a Point element.
      $pointNode = $dom->createElement('Point');
      $placeNode->appendChild($pointNode);
		  // Creates a coordinates element and gives it the value of the lng and lat columns from the results.
      $coorStr="";
      if(@$row['lat']&&@$row['lng'])
			{
				$coorStr = $row['lng'] . ','  . $row['lat'];
			}
		  $coorNode = $dom->createElement('coordinates', $coorStr);
		  $pointNode->appendChild($coorNode);
		}

    $delinator=$CI->delinator_model->get()->result_array();
		foreach ($delinator as $row )
		{
		  // Creates a Placemark and append it to the Document.
		  $node = $dom->createElement('Placemark');
		  $placeNode = $docNode->appendChild($node);
		  // Creates an id attribute and assign it the value of id column.
		  $placeNode->setAttribute('id', 'delinator-'.$row['id']);
		  // Create name, and description elements and assigns them the values of the name and address columns from the results.
		  $nameNode = $dom->createElement('name','Delinator -'.$row['id-jalan']);
		  $placeNode->appendChild($nameNode);
		  $descNode = $dom->createElement('description', "Kondisi :".$row['id-kondisi']."<br/>".$row['keterangan']);
		  // $descNode = $dom->createElement('description', "Kondisi :".$row['id-kondisi']."<br/>".$row['keterangan']."<br/> <a href='".base_url('perangkat/detail/delinator/'.$row['id'])."'");
		  $placeNode->appendChild($descNode);
		  $styleUrl = $dom->createElement('styleUrl', '#delinator-'.$row['id']);
		  $placeNode->appendChild($styleUrl);
		  // Creates a Point element.
      $pointNode = $dom->createElement('Point');
      $placeNode->appendChild($pointNode);
		  // Creates a coordinates element and gives it the value of the lng and lat columns from the results.
      $coorStr="";
      if(@$row['lat']&&@$row['lng'])
			{
				$coorStr = $row['lng'] . ','  . $row['lat'];
			}
		  $coorNode = $dom->createElement('coordinates', $coorStr);
		  $pointNode->appendChild($coorNode);
		}

    $sarpras=$CI->sarpras_model->get()->result_array();
		foreach ($sarpras as $row )
		{
		  // Creates a Placemark and append it to the Document.
		  $node = $dom->createElement('Placemark');
		  $placeNode = $docNode->appendChild($node);
		  // Creates an id attribute and assign it the value of id column.
		  $placeNode->setAttribute('id', 'sarpras-'.$row['id']);
		  // Create name, and description elements and assigns them the values of the name and address columns from the results.
		  $nameNode = $dom->createElement('name','sarpras -'.$row['id-jalan']);
		  $placeNode->appendChild($nameNode);
		  $descNode = $dom->createElement('description', "Kondisi :".$row['id-kondisi']."<br/>Jumlah: ".$row['jumlah']."<br/>".$row['keterangan']);
		  $placeNode->appendChild($descNode);
		  $styleUrl = $dom->createElement('styleUrl', '#sarpras-'.$row['id']);
		  $placeNode->appendChild($styleUrl);
		  // Creates a Point element.
      $pointNode = $dom->createElement('Point');
      $placeNode->appendChild($pointNode);
		  // Creates a coordinates element and gives it the value of the lng and lat columns from the results.
      $coorStr="";
      if(@$row['lat']&&@$row['lng'])
			{
				$coorStr = $row['lng'] . ','  . $row['lat'];
			}
		  $coorNode = $dom->createElement('coordinates', $coorStr);
		  $pointNode->appendChild($coorNode);
		}

    $rambu=$CI->rambu_model->get()->result_array();
		foreach ($rambu as $row )
		{
		  // Creates a Placemark and append it to the Document.
		  $node = $dom->createElement('Placemark');
		  $placeNode = $docNode->appendChild($node);
		  // Creates an id attribute and assign it the value of id column.
		  $placeNode->setAttribute('id', 'rambu-'.$row['id']);
		  // Create name, and description elements and assigns them the values of the name and address columns from the results.
		  $nameNode = $dom->createElement('name','rambu -'.$row['id-jalan']);
		  $placeNode->appendChild($nameNode);
		  $descNode = $dom->createElement('description', "Kondisi :".$row['id-kondisi']."<br/>Posisi: ".$row['letak']."<br/>".$row['keterangan']);
		  $placeNode->appendChild($descNode);
		  $styleUrl = $dom->createElement('styleUrl', '#rambu-'.$row['id']);
		  $placeNode->appendChild($styleUrl);
		  // Creates a Point element.
      $pointNode = $dom->createElement('Point');
      $placeNode->appendChild($pointNode);
		  // Creates a coordinates element and gives it the value of the lng and lat columns from the results.
      $coorStr="";
      if(@$row['lat']&&@$row['lng'])
			{
				$coorStr = $row['lng'] . ','  . $row['lat'];
			}
		  $coorNode = $dom->createElement('coordinates', $coorStr);
		  $pointNode->appendChild($coorNode);
		}
		$dom->save("upload/getKML.kml");
  }

?>
