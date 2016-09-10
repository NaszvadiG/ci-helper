<?php

//tambahan
function get_day($month) {
  switch ($month) {
    case 'Sun':
      $d = 'Minggu';
      break;
    case 'Mon':
      $d = 'Senin';
      break;
    case 'Tue':
      $d = 'Selasa';
      break;
    case 'Wed':
      $d = 'Rabu';
      break;
    case 'Thu':
      $d = 'Kamis';
      break;
    case 'Fri':
      $d = 'Jumat';
      break;
    case 'Sat':
      $d = 'Sabtu';
      break;

    default:
      $d = '';
      break;
  }
  return $d;
}


  function ubah($date){
    list($tgl, $bln, $thn) = explode('-', $date);
    return $thn."-".$bln."-".$tgl;
  }


  function addDate($date, $step){
    list($tahun, $bulan, $tanggal) = explode('-', $date);

    $tanggal=$tanggal+$step;
  	if(($tahun%4==0) && ($tahun%100!=0) || ($tahun%400==0 && $bulan==2))
  	{
  		$tglakh=$tanggal%29;
  		if($tanggal>=29)
  		{
  			$bulan+=1;
  		}
  	}


  	else
  	{
  		if($bulan==2)
  		{
  			$tglakh=$tanggal%28;
  			if($tanggal>=28)
  			{
  				$bulan+=1;
  			}
  		}
  		else if(($bulan==4) || ($bulan==6) || ($bulan==9) || ($bulan==11))
  		{
  			$tglakh=$tanggal%30;
        if($tglakh == 0) $tglakh = 30;
  			if($tanggal>30)
  			{
  				$bulan+=1;
  			}
  		}
  		else
  		{
  			$tglakh=$tanggal%31;
        if($tglakh == 0) $tglakh = 31;
  			if($tanggal>31)
  			{
  				$bulan+=1;
  			}
  		}
  	}
    return $tglakh."-".$bulan."-".$tahun;

  }
  function nmonth($month){
      $thn_kabisat = date("Y") % 4;
      ($thn_kabisat==0)?$feb=29:$feb=28;
      $init_month = array(1=>31,    // Januari
                          2=>$feb,  // Feb
                          3=>31,    // Mar
                          4=>30,    // Apr
                          5=>31,    // Mei
                          6=>30,    // Juni
                          7=>31,    // Juli
                          8=>31,    // Aug
                          9=>30,    // Sep
                          10=>31,   // Oct
                          11=>30,   // Nov
                          12=>31);  // Des
      $nmonth = $init_month[$month];
      return $nmonth;
  }

  function frmDate($date,$code){
   $explode = explode("-",$date);
   $year  = $explode[0];
   $month = (substr($explode[1],0,1)=="0")?str_replace("0","",$explode[1]):$explode[1];
   $dated = $explode[2];
   $explode_time = explode(" ",$dated);
   $dates = $explode_time[0];
   switch($code){
       // Per Object
       case 4: $format = $dates; break;
       case 5: $format = $month; break;
       case 6: $format = $year; break;
   }
   return $format;
 }

  function getRange($start,$end){
    $xdate = frmDate($start,4);
    $ydate = frmDate($end,4);
    $xmonth = frmDate($start,5);
    $ymonth = frmDate($end,5);
    $xyear = frmDate($start,6);
    $yyear = frmDate($end,6);
    if($xyear==$yyear){
        if($xmonth==$ymonth){
            $nday=$ydate+1-$xdate;
        } else {
            $r2=NULL;
            $nmonth = $ymonth-$xmonth;
            $r1 = nmonth($xmonth)-$xdate+1;
            for($i=$xmonth+1;$i<$ymonth;$i++){
                $r2 = $r2+nmonth($i);
            }
            $r3 = $ydate;
            $nday = $r1+$r2+$r3;
        }
    } else {
        $r2=NULL; $r3=NULL;
        $r1=nmonth($xmonth)-$xdate+1;

        for($i=$xmonth+1;$i<13;$i++){
            $r2 = $r2+nmonth($i);
        }
        for($i=1;$i<$ymonth;$i++){
            $r3 = $r3+nmonth($i);
        }
        $r4 = $ydate;
        $nday = $r1+$r2+$r3+$r4;
    }
    return $nday;
  }

  //tambahan end

  function daterange_to_id($date1, $date2) {
    $a = explode('-', $date1);
    $b = explode('-', $date2);

    if (($a[1] == $b[1]) && ($a[0] == $b[0])) {
      $m = get_month($b[1]);
      return "{$a[2]} s.d {$b[2]} $m {$a[0]}";
    } else if (($a[1] != $b[1]) && ($a[0] == $b[0])) {
      $m = get_month($a[1]);
      $m2 = get_month($b[1]);
      return "{$a[2]} $m s.d {$b[2]} $m2 {$a[0]}";
    } else {
      $m = get_month($a[1]);
      $m2 = get_month($b[1]);
      return "{$a[2]} $m {$a[0]} s.d {$b[2]} $m2 {$b[0]}";
    }
  }

  function daterange_to_bahasa($date1, $date2) {
    $a = explode('-', $date1);
    $b = explode('-', $date2);

    if (($a[1] == $b[1]) && ($a[0] == $b[0])) {
      $m = get_month($b[1]);
      return "{$a[2]} s.d {$b[2]} bulan $m tahun {$a[0]}";
    } else if (($a[1] != $b[1]) && ($a[0] == $b[0])) {
      $m = get_month($a[1]);
      $m2 = get_month($b[1]);
      return "{$a[2]} bulan $m s.d {$b[2]} bulan $m2 tahun {$a[0]}";
    } else {
      $m = get_month($a[1]);
      $m2 = get_month($b[1]);
      return "{$a[2]} bulan $m tahun {$a[0]} s.d {$b[2]} bulan $m2 tahun {$b[0]}";
    }
  }


  function datetime_to_id($datetime = NULL) {
    if ($datetime == NULL) {
      return '';
    } else {
      $a = explode(' ', $datetime);
      $b = explode('-', $a[0]);

      $m = get_month($b[1]);
    }

    return "{$b[2]} $m {$b[0]} Pukul ".substr($a[1], 0, 5);
  }

  function date_to_id($date = NULL) {
    if ($date == NULL) {
      return '';
    } else {
      $a = explode('-', $date);

      $m = get_month($a[1]);
    }

    return "{$a[2]} $m {$a[0]}";
  }

  function get_month($month) {
    switch ($month) {
      case '01':
        $m = 'Januari';
        break;
      case '02':
        $m = 'Februari';
        break;
      case '03':
        $m = 'Maret';
        break;
      case '04':
        $m = 'April';
        break;
      case '05':
        $m = 'Mei';
        break;
      case '06':
        $m = 'Juni';
        break;
      case '07':
        $m = 'Juli';
        break;
      case '08':
        $m = 'Agustus';
        break;
      case '09':
        $m = 'September';
        break;
      case '10':
        $m = 'Oktober';
        break;
      case '11':
        $m = 'November';
        break;

      default:
        $m = 'Desember';
        break;
    }
    return $m;
  } ?>
