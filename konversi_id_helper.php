<?php

function releaseGlue($string)
{
  $a=explode("|",$string);
  $data=array();
  foreach ($a as $key) {
    if($key!="")
    {
      $data[]=$key;
    }
  }
  return $data;
}

function arrayGlue($array)
{
	$result="";
	if(is_array($array))
	{
		foreach($array as $data)
		{
			$result.="|".$data."|";
		}
	}
	else {
		$result="";
	}
	return $result;
}

// any_in_array() is not in the Array Helper, so it defines a new function
function any_in_array($needle, $haystack)
{
    $needle = (is_array($needle)) ? $needle : array($needle);

    foreach ($needle as $item)
    {
        if (in_array($item, $haystack))
        {
            return TRUE;
        }
        }

    return FALSE;
}

// random_element() is included in Array Helper, so it overrides the native function
function random_element($array)
{
    shuffle($array);
    return array_pop($array);
}

function ubah_huruf_awal($pemisah, $paragrap) {
//pisahkan $paragraf berdasarkan $pemisah dengan fungsi explode
	$pisahkalimat=explode($pemisah, $paragrap);
	$kalimatbaru = array();

	//looping dalam array
	foreach ($pisahkalimat as $kalimat) {
	//jadikan awal huruf masing2 array menjadi huruf besar dengan fungsi ucfirst
		$kalimatawalhurufbesar=ucfirst(strtolower($kalimat));
		$kalimatbaru[] = $kalimatawalhurufbesar;
	}

	//kalo udah gabungin lagi dengan fungsi implode
	$textgood = implode($pemisah, $kalimatbaru);
	return $textgood;
}


//angka ke teks
function rubah_angka($x){
    $arr = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    if ($x < 12)
    return " " . $arr[$x];
    elseif ($x < 20)
    return terbilang($x - 10) . " belas";
    elseif ($x < 100)
    return terbilang($x / 10) . " puluh" . terbilang($x % 10);
    elseif ($x < 200)
    return " seratus" . terbilang($x - 100);
    elseif ($x < 1000)
    return terbilang($x / 100) . " ratus" . terbilang($x % 100);
    elseif ($x < 2000)
    return " seribu" . terbilang($x - 1000);
    elseif ($x < 1000000)
    return terbilang($x / 1000) . " ribu" . terbilang($x % 1000);
    elseif ($x < 1000000000)
    return terbilang($x / 1000000) . " juta" . terbilang($x % 1000000);
}

?>
