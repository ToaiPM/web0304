<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    
    // if(file_exists('./leo_ConverNumberToWord.php')){
	// 	require_once('./leo_ConverNumberToWord.php');
	// }
	// else{
	// 	require_once('../leo_ConverNumberToWord.php');
	// }
	function SetID($kytu = '')
    {
        $arr_ngay_gio = explode(" ",date('Y-m-d H:i:s'));
        $arr_ngay = explode("-",$arr_ngay_gio['0']);
        $arr_gio = explode(":",$arr_ngay_gio['1']);
            
        $result = $kytu . $arr_ngay['2'] . $arr_ngay['1'] . substr($arr_ngay['0'],2) . substr(number_format(time() * rand(),0,'',''),0,6);
        
        return $result;
    }
    /**
     * 
     * @param type $sonha
     * @param type $thonpho
     * @param type $phuongxa
     * @param type $quanhuyen
     * @param type $tinhthanh
     * @param type $coquan
     * @return type
     */
    function SetDiaChi($sonha, $thonpho, $phuongxa, $quanhuyen, $tinhthanh, $coquan)
    {
        $diachi = '';
        if(trim($sonha) != '')
            $diachi .= $sonha . " - ";
        if(trim($thonpho) != '')
            $diachi .= $thonpho;
        if(trim($phuongxa) != '' || trim($phuongxa) != 'Không Xác Định')
            $diachi .= ' ' . $phuongxa;
        if(trim($quanhuyen) != '' || trim($quanhuyen) != 'Không Xác Định')
            $diachi .= ' - ' . $quanhuyen;
        if(trim($tinhthanh) != '' || trim($tinhthanh) != 'Không Xác Định')
            $diachi .= ' - ' . $tinhthanh;
        
        if((trim($phuongxa) == '' || trim($phuongxa) == 'Không Xác Định' ) && (trim($quanhuyen) == '' || trim($quanhuyen) == 'Không Xác Định') && (trim($tinhthanh) == '' || trim($tinhthanh) == 'Không Xác Định'))
            $diachi = trim($coquan);
        
        return trim($diachi);
    }
    
    function KiemTraNgayThu($ngaybd,$ngaykt)
    {
        $day = 60*60*24;

        $date1 = strtotime($ngaybd);
        $date2 = strtotime($ngaykt);

        $days_diff  = ($date2 - $date1)/$day; 
        $age_day    = round($days_diff);
        
       return $age_day;
    }
    /**
    *   YYYY-mm-dd hh:ii:ss --> hh:ii:ss dd/mm/YYYY 
    */
	function FormatDatetime($ngay = "")
	{	
		if($ngay != ""){
			// 2012-06-27 18:59:58
			$arr = explode(" ", $ngay);
			$strNgay = $arr['0'];
			$strGio = $arr['1'];			
			$arrNgay = explode("-", $strNgay);
			$arrGio = explode(":", $strGio);
			
			if(count($arrGio) <= 1)
				return $arrNgay['2'] . "/" . $arrNgay['1'] . "/" . $arrNgay['0'];
			else
				return '<strong>' . $arrNgay['2'] . "/" . $arrNgay['1'] . "/" . $arrNgay['0'] . "</strong> " . $arrGio['0'] . ":" . $arrGio['1'];
		}else return "Error";
	}
    
    /**
       dd/mm/YYYY hh:ii:ss --> YYYY-mm-dd hh:ii:ss 
    */
    function FormatDatetime_DB($ngay = "")
    {
        // 2012-06-27 18:59:58
        $arr = explode(" ", $ngay);
        $strNgay = $arr['0'];
        $strGio = $arr['1'];
        
        $arrNgay = explode("/", $strNgay);
        if (checkdate($arrNgay['1'],$arrNgay['0'],$arrNgay['2']))
            return $arrNgay['2'] . "-" . $arrNgay['1'] . "-" . $arrNgay['0'] . " " . $strGio;
        else 
            return "loingaygio";
    }
    
	/**
       YYYY-mm-dd hh:ii:ss --> dd/mm/YYYY 
    */
    function FormatDate($ngay = "")
    {
        //Tách chuỗi Datetime trong DB
	$arr = explode(" ", $ngay); 
        //Tách chuỗi ngày
	$strNgay = $arr['0'];
        $arr_ngay = explode("-", $strNgay);
        //Tách chuỗi thời gian
        if(count($arr) > 1)
        {
            $strGio = $arr['1'];
            $arr_Gio = explode(":", $strGio);
        }
	//Ngày tháng NULL thì chỉ hiện thị năm
        if($arr_ngay['2'] != '00' && $arr_ngay['1'] != '00')
            $result = $arr_ngay['2'] . "/" . $arr_ngay['1'] . "/" . $arr_ngay['0'];
        else    
            $result = $arr_ngay['0'];
		
	return $result;// kết quả trả về
    }
    
    /**
       YYYY-mm-dd hh:ii:ss --> Thứ XX, dd/mm/YYYY 
    */
    function FormatDate_TaiKham($ngay = "")
    {
        //Tách chuỗi Datetime trong DB
	$arr = explode(" ", $ngay); 
        //Tách chuỗi ngày
	$strNgay = $arr['0'];
        $arr_ngay = explode("-", $strNgay);
        //Tách chuỗi thời gian
        if(count($arr) > 1)
        {
            $strGio = $arr['1'];
            $arr_Gio = explode(":", $strGio);
        }
        //Tìm thứ
        $jd=cal_to_jd(CAL_GREGORIAN,$arr_ngay['1'],$arr_ngay['2'],$arr_ngay['0']);
        $day=jddayofweek($jd,0);
        switch($day)
        {
            case 0:
            $thu="Chủ Nhật";
            break;
            case 1:
            $thu="Thứ Hai";
            break;
            case 2:
            $thu="Thứ Ba";
            break;
            case 3:
            $thu="Thứ Tư";
            break;
            case 4:
            $thu="Thứ Năm";
            break;
            case 5:
            $thu="Thứ Sáu";
            break;
            case 6:
            $thu="Thứ 7";
            break;
            //Vì mod bằng 0
        }
        
	//Ngày tháng NULL thì chỉ hiện thị năm
        if($arr_ngay['2'] != '00' && $arr_ngay['1'] != '00')
            $result = $thu . ', ' . $arr_ngay['2'] . "/" . $arr_ngay['1'] . "/" . $arr_ngay['0'];
        else    
            $result = $arr_ngay['0'];
		
	return $result;// kết quả trả về
    }
    
    /**
       YYYY-mm-dd --> dd/mm/YYYY 
       (YYYY-00-00 --> YYYY)
    */
    function FormatDateGet($ngay = "")
    {
        $arr_ngay = explode("-", $ngay);
        
        if($arr_ngay['2'] != '00' && $arr_ngay['1'] != '00')
            $result = $arr_ngay['2'] . "/" . $arr_ngay['1'] . "/" . $arr_ngay['0'];
        else
            $result = $arr_ngay['0'];
        
        return $result;
    }
    
    /**
       dd/mm/YYYY -->YYYY-mm-dd 
    */
    function FormatDateSet($ngay = "")
    {//echo $ngay;
        $arr_ngay = explode("/", $ngay);
        
        $result = $arr_ngay['2'] . "-" .$arr_ngay['1'] . "-" .$arr_ngay['0'];
        
        return $result;
    }
    
    
    function TinhCanChiTheoNamSinh($namsinh = "")
    {
        $can = array(
                '0' => 'Canh',
                '1' => 'Tân',
                '2' => 'Nhâm',
                '3' => 'Quý',
                '4' => 'Giáp',
                '5' => 'Ất',
                '6' => 'Bính',
                '7' => 'Đinh',
                '8' => 'Mậu',
                '9' => 'Kỷ'
            );

        $chi = array(
            '0' => 'Tý',
            '1' => 'Sửu',
            '2' => 'Dần',
            '3' => 'Mão',
            '4' => 'Thìn',
            '5' => 'Tỵ',
            '6' => 'Ngọ',
            '7' => 'Mùi',
            '8' => 'Thân',
            '9' => 'Dậu',
            '10' => 'Tuất',
            '11' => 'Hợi'
        );
        
        // lấy ra can
        $can_namsinh = $can[$namsinh % 10];
        // lấy ra chi
        $chi_namsinh = $chi[($namsinh+8) % 12];
        // hiển thị chi can chi theo năm sinh
        return $can_namsinh .' '. $chi_namsinh;    
    }
    /**
       hh:ii:ss dd/mm/YYYY --> YYYY-mm-dd 
    */
    function FormatDateTimePicKer($ngay = "")
    {
        //  18:59:58  01/12/2014
        $arr = explode(" ", $ngay);
        $strNgay = $arr['1'];
        $strGio = $arr['0'];
        
        $arrNgay = explode("/", $strNgay);
        if (checkdate($arrNgay['1'],$arrNgay['0'],$arrNgay['2']))
            return $arrNgay['2'] . "-" . $arrNgay['1'] . "-" . $arrNgay['0'];
        else 
            return "loingaygio";
    }
	/**
       YYYY-mm-dd --> YYYY
    */
	function LayNamSinh($ngay = "")
	{
		$arr_ngay = explode("-", $ngay);
		return $arr_ngay['0'];
	}
	
	function TinhTuoi($ngay = "",$canchi = false)
	{
		$day = 60*60*24;
        $namsinh = explode("-", $ngay);
        //$test_namsinh = ($namsinh['0'] > 2000) ? $namsinh['0'] : ($namsinh['0'] + 1900);
		//$ngaysinh = $test_namsinh . '-' . date('m') . '-' . date('d');
		$date1 = strtotime($ngay);
		$date2 = strtotime("now");

		$days_diff = ($date2 - $date1)/$day; //Số ngày tính từ ngày sn đến nay
		
		if($days_diff >= 365*6)
		{
			//$age = round($days_diff/(365)); // năm tuổi
			$age = (int)Date("Y") - (int)($namsinh[0]);
            if($canchi)
			    echo "<strong>".$age."</strong> tuổi (" . TinhCanChiTheoNamSinh(LayNamSinh($ngay)) . ")";
            else
                echo "<strong>".$age."</strong> tuổi";
		}	
		if($days_diff >= 30 && $days_diff < 365*6)
		{
			$age_month = round($days_diff/30); // tháng tuổi
            if($canchi)
                echo "<strong>".$age_month."</strong> tháng tuổi (" . TinhCanChiTheoNamSinh(LayNamSinh($ngay)) . ")";
            else
			    echo "<strong>".$age_month."</strong> tháng tuổi";
		}
		
		if($days_diff > 0 && $days_diff < 30)
		{
			$age_day = round($days_diff); // ngày tuổi
			if($canchi)
                echo "<strong>".$age_day."</strong> ngày tuổi (" . TinhCanChiTheoNamSinh(LayNamSinh($ngay)) . ")";
            else
                echo "<strong>".$age_day."</strong> ngày tuổi";
		}
		
		if($days_diff == 0)
		{
            if($canchi)
			    echo "<strong>1</strong> ngày tuổi (" . TinhCanChiTheoNamSinh(LayNamSinh($ngay)) . ")";
            else
                echo "<strong>1</strong> ngày tuổi"; 
		}
		
		if($days_diff < 0) // tuổi âm cho chọn ngày sau ngày hiện tại
		{   
			echo "<strong class='loingaysinh'>lỗi ngày sinh</strong>";
		}
	}
        
        function TinhTuoiGoiTen($ngay)
	{
            $kq = '0 tuổi';
            $day = 60*60*24; 
            
            $date1 = strtotime($ngay);
            $date2 = strtotime("now");

            $days_diff = ($date2 - $date1)/$day; //Số ngày tính từ ngày sn đến nay
            
            
            if($days_diff >= 365*3)
            {
                    //$age = round($days_diff/(365)); // năm tuổi
					$age = (int)(date('Y')) - (int)(substr($ngay,0,4));
                    $kq =  $age." tuổi";
            }	
            if($days_diff >= 30 && $days_diff < 365*3)
            {
                    $age_month = round($days_diff/30); // tháng tuổi
                    $kq =  $age_month." tháng tuổi";
            }

            if($days_diff > 0 && $days_diff < 30)
            {
                    $age_day = round($days_diff); // ngày tuổi
                    $kq =  $age_day." ngày tuổi ";
            }

            if($days_diff == 0)
            {
                $kq = " 1 ngày tuổi ";
            }
            
            return $kq;
	}
    
    function TinhTuoiReport($ngaysinh,$ngaytiepnhan)
    {
        $day = 60*60*24;
        $now = $ngaytiepnhan == "" ? date('Y-m-d') : $ngaytiepnhan;
        $date1 = strtotime($ngaysinh);
        $date2 = strtotime($now);

        $days_diff = ($date2 - $date1)/$day; //Số ngày tính từ ngày sn đến nay
        
        if($days_diff >= 365*3)
        {
            //$age = round($days_diff/(365)); // năm tuổi
            //echo $age;
			$age_1 = (int)(substr($ngaytiepnhan,0,4)) - (int)(substr($ngaysinh,0,4));
            echo $age_1;
        }    
        if($days_diff >= 30 && $days_diff < 365*3)
        {
            $age_month = round($days_diff/30); // tháng tuổi
                echo "(".$age_month . ") tháng tuổi";
        }
        
        if($days_diff > 0 && $days_diff < 30)
        {
            $age_day = round($days_diff); // ngày tuổi
                echo "(".$age_day . " ngày tuổi) ";
        }
        
        if($days_diff == 0)
        {
                echo "(1 ngày tuổi)"; 
        }
        
        if($days_diff < 0) // tuổi âm cho chọn ngày sau ngày hiện tại
        {   
            echo "<strong class='loingaysinh'>Error</strong>";
        }
    }
  

    function return_TinhTuoiReport($ngaysinh,$ngaytiepnhan)
    {
        $day = 60*60*24;
        $now = $ngaytiepnhan == "" ? date('Y-m-d') : $ngaytiepnhan;
        $date1 = strtotime($ngaysinh);
        $date2 = strtotime($now);

        $days_diff = ($date2 - $date1)/$day; //Số ngày tính từ ngày sn đến nay
        
        if($days_diff >= 365*3)
        {
            //$age = round($days_diff/(365)); // năm tuổi
            //echo $age;
			$age_1 = (int)(substr($ngaytiepnhan,0,4)) - (int)(substr($ngaysinh,0,4));
            return $age_1. " tuổi";;
        }    
        if($days_diff >= 30 && $days_diff < 365*3)
        {
            $age_month = round($days_diff/30); // tháng tuổi
                return $age_month . " tháng tuổi";
        }
        
        if($days_diff > 0 && $days_diff < 30)
        {
            $age_day = round($days_diff); // ngày tuổi
                return $age_day . " ngày tuổi ";
        }
        
        if($days_diff == 0)
        {
                return "1 ngày tuổi"; 
        }
        
        if($days_diff < 0) // tuổi âm cho chọn ngày sau ngày hiện tại
        {   
            return "<strong class='loingaysinh'>Error</strong>";
        }
    }

  
function TinhTuoiReport_2($ngaysinh,$ngaytiepnhan)
    {
        $day = 60*60*24;
        $now = $ngaytiepnhan == "" ? date('Y-m-d') : $ngaytiepnhan;
        $date1 = strtotime($ngaysinh);
        $date2 = strtotime($now);

        $days_diff = ($date2 - $date1)/$day; //Số ngày tính từ ngày sn đến nay
        //$age = round($days_diff/(365)); // năm tuổi
        $age = (int)(substr($ngaytiepnhan,0,4)) - (int)(substr($ngaysinh,0,4));
        if($age == 0)
        {
           return 1; 
        }
        else if($age >= 10)
        {
           return $age; 
        }
        else
        {
            return '0' . $age;
        }       
    }


    
    function TinhNgayDieuTri($ngaybd,$ngaykt)
    {
        $day = 60*60*24;

        $date1 = strtotime($ngaybd);
        $date2 = strtotime($ngaykt);

        $days_diff  = ($date2 - $date1)/$day; //Số ngày tính từ ngày ra vien đến ngay nhap
        $age_day    = round($days_diff); // ngày dieu tri
        
        if($age_day == 0)
            echo '1';
        else
            echo $age_day;
    }
    
    //khắc phục lỗi SQL injection
    function cleanup_text($data)
    {
        //Khai báo biến cục bộ.
        global $connect;
        if(ini_get('magic_quotes_gpc'))
        {
            $data= stripslashes($data);
        }
        return mysql_real_escape_string($data,$connect);
    }
	
	function PhanTrang($TrangHienTai, $SoBaiViet, $BaiVietMoiTrang, $SoTrangKe)
	{
		echo '<div class="PhanTrang">';
			$SoTrang = (int)$SoBaiViet / $BaiVietMoiTrang;
			$SoTrang += ($SoBaiViet % $BaiVietMoiTrang > 0) ? 1 : 0;
			$SoTrang = (int)$SoTrang;
            
            if($TrangHienTai < 1)
                echo "<a href='#' class='ClickPage' val='1'><div class='First'>&laquo; Đầu</div></a>";
                
            if($TrangHienTai > $SoTrang)
                echo "<a href='#' class='ClickPage' val='". $SoTrang ."'><div class='First'>Cuối &raquo;</div></a>";
                
			for($i = 1; $i <= $SoTrang; $i++)
			{
				if($TrangHienTai - $SoTrangKe - 1 == $i || $i == $TrangHienTai + $SoTrangKe + 1)
				{
					if($TrangHienTai - $SoTrangKe - 1 == $i)
					{
						echo "<a href='#' class='ClickPage' val='1'><div class='First'>&laquo; Đầu</div></a>";
						echo "<a href='#' class='ClickPage' val='". ($TrangHienTai - $SoTrangKe - 1) . "'><div>...</div></a>";
					}
					else
					{
						echo "<a href='#' class='ClickPage' val='". ($TrangHienTai + $SoTrangKe + 1) . "'><div>...</div></a>";
						echo "<a href='#' class='ClickPage' val='". $SoTrang ."'><div class='First'>Cuối &raquo;</div></a>";
					}
				}
				else
				{
					if($TrangHienTai - $SoTrangKe - 1 < $i && $i < $TrangHienTai + $SoTrangKe + 1)
					{
						if($i == $TrangHienTai)
							echo "<a href='#' class='ClickPage' val='". $i . "'><div class='CurrentPage'>" . $i . "</div></a>";
						else
							echo "<a href='#' class='ClickPage' val='". $i . "'><div>" . $i . "</div></a>";
					}
					else
						continue;
				}
			}
			echo '<div class="SoTrang">';
				echo "Trang " . $TrangHienTai . "/" . $SoTrang;
			echo '</div>';
		echo '</div>';
	}


    function PhanTrangTheoClass($class,$TrangHienTai, $SoBaiViet, $BaiVietMoiTrang, $SoTrangKe)
    {
        echo '<div class="PhanTrang">';
            $SoTrang = (int)$SoBaiViet / $BaiVietMoiTrang;
            $SoTrang += ($SoBaiViet % $BaiVietMoiTrang > 0) ? 1 : 0;
            $SoTrang = (int)$SoTrang;
            
            if($TrangHienTai < 1)
                echo "<a href='#' class='".$class."' val='1'><div class='First'>&laquo; Đầu</div></a>";
                
            if($TrangHienTai > $SoTrang)
                echo "<a href='#' class='".$class."' val='". $SoTrang ."'><div class='First'>Cuối &raquo;</div></a>";
                
            for($i = 1; $i <= $SoTrang; $i++)
            {
                if($TrangHienTai - $SoTrangKe - 1 == $i || $i == $TrangHienTai + $SoTrangKe + 1)
                {
                    if($TrangHienTai - $SoTrangKe - 1 == $i)
                    {
                        echo "<a href='#' class='".$class."' val='1'><div class='First'>&laquo; Đầu</div></a>";
                        echo "<a href='#' class='".$class."' val='". ($TrangHienTai - $SoTrangKe - 1) . "'><div>...</div></a>";
                    }
                    else
                    {
                        echo "<a href='#' class='".$class."' val='". ($TrangHienTai + $SoTrangKe + 1) . "'><div>...</div></a>";
                        echo "<a href='#' class='".$class."' val='". $SoTrang ."'><div class='First'>Cuối &raquo;</div></a>";
                    }
                }
                else
                {
                    if($TrangHienTai - $SoTrangKe - 1 < $i && $i < $TrangHienTai + $SoTrangKe + 1)
                    {
                        if($i == $TrangHienTai)
                            echo "<a href='#' class='".$class."' val='". $i . "'><div class='CurrentPage'>" . $i . "</div></a>";
                        else
                            echo "<a href='#' class='".$class."' val='". $i . "'><div>" . $i . "</div></a>";
                    }
                    else
                        continue;
                }
            }
            echo '<div class="SoTrang">';
                echo "Trang " . $TrangHienTai . "/" . $SoTrang;
            echo '</div>';
        echo '</div>';
    }	
	//Lấy ngày tháng năm từ dữ liệu kiểu ngày giờ
	function LayNgay($Ngay)
	{
		$arr = explode(" ", $Ngay);
		return "20" . $arr[0];
	}
	
	//Xén bớt chuỗi dài thành chuỗi ngắn, dạng "Tin tức thế giới trong ngày..."
	function XenChuoi($Chuoi = "", $SoKyTu = 0)
	{
		$result = "";
		$arr = explode(" ", $Chuoi);
		for($i = 0; $i < count($arr); $i++)
		{
			if(isset($result{$SoKyTu}) >= $SoKyTu)
			{
				$result .= "...";
				break;
			}
			else
			{
				if($i == 0)
					$result .= $arr[$i];
				else
					$result .= " " . $arr[$i];
			}
		}
		return $result;
	}
	function CurrentURL()
	{
		$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$arr = explode("/", $url);
		$url = $arr[count($arr) - 1];
		$arr = explode("&page=", $url);
		$url = $arr[0];
		return $url;
	}
	function CurrentURLFull()
	{
		$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		return $url;
	}
	
	function QuayVeTrangTruoc()
	{
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
    
    function QuayVeTrangTruocNhapLai()
    {
        echo "<script>window.history.go(-1);</script>";
    }
    
    function show_query_error($text)
    {
        echo "<div class='show_query_error'>" . $text . "</div>";
    }
    
    function show_query_success($text)
    {
        echo "<div class='show_query_success'>" . $text . "</div>";
    }
	
	//Xóa tất cả file và thư mục con
	function remove_dir($dir = null) {
		if (is_dir($dir)) 
		{
			$objects = scandir($dir);
			foreach ($objects as $object) 
			{
				if ($object != "." && $object != "..") 
				{
					if (filetype($dir."/".$object) == "dir") remove_dir($dir."/".$object);
					else unlink($dir."/".$object);
				}
			}
			reset($objects);
			rmdir($dir);
		}
	}
	
	function rmdir_recurse($path) {
		$path = rtrim($path, '/').'/';
		$handle = opendir($path);
		while(false !== ($file = readdir($handle))) {
			if($file != '.' and $file != '..' ) {
				$fullpath = $path.$file;
				if(is_dir($fullpath)) rmdir_recurse($fullpath); else unlink($fullpath);
			}
		}
		closedir($handle);
		rmdir($path);
	}
    
    function time_stamp($time_ago)
    {
        $cur_time = $_SERVER['REQUEST_TIME'];
        $time_elapsed = $cur_time - $time_ago;
        $seconds = $time_elapsed ;
        $minutes = round($time_elapsed / 60 );
        $hours = round($time_elapsed / 3600);
        $days = round($time_elapsed / 86400 );
        $weeks = round($time_elapsed / 604800);
        $months = round($time_elapsed / 2600640 );
        $years = round($time_elapsed / 31207680 );
        // Seconds
        if($seconds <= 60)
        {
            echo " Cách đây $seconds giây ";
        }
        //Minutes
        else if($minutes <=60)
        {
            if($minutes==1)
            {
                echo " Cách đây 1 phút ";
            }
            else
            {
                echo " Cách đây $minutes phút";
            }
        }
        //Hours
        else if($hours <=24)
        {
            if($hours==1)
            {
                echo "Cách đây 1 tiếng ";
            }
            else
            {
                echo " Cách đây  $hours tiếng ";
            }
        }
        //Days
        else if($days <= 7)
        {
            if($days==1)
            {
                echo " Ngày hôm qua ";
            }
            else
            {
                echo " Cách đây  $days ngày ";
            }
        }
        //Weeks
        else if($weeks <= 4.3)
        {
            if($weeks==1)
            {
                echo " Cách đây 1 tuần ";
            }
            else
            {
                echo " Cách đây  $weeks tuần";
            }
        }
        //Months
        else if($months <=12)
        {
            if($months==1)
            {
                echo " Cách đây 1 tháng ";
            }
            else
            {
                echo " Cách đây $months tháng";
            }
        }
        //Years
        else
        {
            if($years==1)
            {
                echo " Cách đây 1 năm ";
            }
            else
            {
                echo " Cách đây $years năm ";
            }
        }
    } 

    /*This worked correctly for me*/
    function mb_ucfirst($string, $encoding='UTF-8')
    {
        $firstChar = mb_substr($string, 0, 1, $encoding);
        $then = mb_substr($string, 1, mb_strlen($string, $encoding)-1, $encoding);
        return mb_strtoupper($firstChar, $encoding) . $then;
    }
	
    //Định dạng tên [lÊ    văn a ==> Lê Văn A]
    function DinhDangTen($str){ 
        $arr = explode(' ', $str);
        $result='';
        $max_arr = count($arr);
        for($i = 0; $i < $max_arr; $i++)
        {    
            if($arr[$i]!=""){    
                $arr[$i] = mb_strtolower($arr[$i],'UTF-8');
                $result .= ' ' . mb_ucfirst($arr[$i],'UTF-8');
            }
        }  
        return str_replace('[[:space:]]+', ' ', trim($result));
    }
    //So sánh chuỗi
    function SoSanhChuoi($str1,$str2){ 
        $str_1 = DinhDangTen($str1);
        $str_2 = DinhDangTen($str2);
    }
    
    function TinhHanDung($ngay)
    {
        $day = 60*60*24;
        $now = date('Y-m-d');
        $date1 = strtotime($ngay);
        $date2 = strtotime($now);

        $days_diff = ($date1 - $date2)/$day; //Số ngày tính từ nay đến ngày hết hạn
        
        if($days_diff >= 365)
        {
            $age = round($days_diff/365); // năm 
            echo "còn <strong>".$age."</strong> năm";
        }    
        if($days_diff >= 30 && $days_diff < 365)
        {
            $age_month = round($days_diff/30); // tháng 
            echo "còn <strong>".$age_month."</strong> tháng";
        }
        
        if($days_diff > 0 && $days_diff < 30)
        {
            $age_day = round($days_diff); // ngày 
            echo "còn <strong>".$age_day."</strong> ngày";
        }
        
        if($days_diff == 0)
        {
            echo "còn <strong>1</strong> ngày";
        }
        
        if($days_diff < 0) // ngày âm cho chọn ngày sau ngày hiện tại
        {
            echo "<strong class='loingaysinh'>hết hạn</strong>";
        }
    }
    
	//Function lọc bỏ dấu
	function khongdau($str) {
		$search = array (
			'#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
			'#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
			'#(ì|í|ị|ỉ|ĩ)#',
			'#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
			'#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
			'#(ỳ|ý|ỵ|ỷ|ỹ)#',
			'#(đ)#',
			'#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
			'#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
			'#(Ì|Í|Ị|Ỉ|Ĩ)#',
			'#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
			'#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
			'#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
			'#(Đ)#',
			'#(A-Z)#',
			"/[^a-zA-Z0-9.\-\_]/",
		);
		$replace = array ('a','e','i','o','u','y','d','A','E','I','O','U','Y','D','a-z','-',);
		$str = str_replace($search, $replace, $str);
		$str = str_replace('/(-)+/', '-', $str);
		return $str;
	}

	function khongdau2($str) {
		$search = array (
			'#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
			'#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
			'#(ì|í|ị|ỉ|ĩ)#',
			'#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
			'#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
			'#(ỳ|ý|ỵ|ỷ|ỹ)#',
			'#(đ)#',
			'#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
			'#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
			'#(Ì|Í|Ị|Ỉ|Ĩ)#',
			'#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
			'#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
			'#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
			'#(Đ)#',
			'#(A-Z)#',
			"/[^a-zA-Z0-9.\-\_]/",
		);
		$replace = array ('a','e','i','o','u','y','d','A','E','I','O','U','Y','D','a-z','',);
		$str = str_replace($search, $replace, $str);
		$str = str_replace('/(-)+/', '', $str);
		return $str;
	}
	
	//Chuyển đổi chữ số ra chữ viết
    function dochangchuc($so,$daydu)
    {
        $mangso = array("không","một","hai","ba","bốn","năm","sáu","bảy","tám","chín");
        $chuoi = "";
        $chuc = floor($so/10);
        $donvi = $so%10;
        if ($chuc>1) {
            $chuoi = " " . $mangso[$chuc] . " mươi";
            if ($donvi==1) {
                $chuoi .= " mốt";
            }
        } else if ($chuc==1) {
            $chuoi = " mười";
            if ($donvi==1) {
                $chuoi .= " một";
            }
        } else if ($daydu && $donvi>0) {
            $chuoi = " lẻ";
        }
        if ($donvi==5 && $chuc>=1) {
            $chuoi .= " lăm";
        } else if ($donvi>1||($donvi==1&&$chuc==0)) {
            $chuoi .= " " . $mangso[$donvi];
        }
        return $chuoi;
    }
    function docblock($so,$daydu)
    {
        $mangso = array("không","một","hai","ba","bốn","năm","sáu","bảy","tám","chín");
        $chuoi = "";
        $tram = floor($so/100);
        $so = $so%100;
        if ($daydu || $tram>0) {
            $chuoi = " " . $mangso[$tram] . " trăm";
            $chuoi .= dochangchuc($so,true);
        } else {
            $chuoi = dochangchuc($so,false);
        }
        return $chuoi;
    }
    function dochangtrieu($so,$daydu)
    {
        $mangso = array("không","một","hai","ba","bốn","năm","sáu","bảy","tám","chín");
        $chuoi = "";
        $trieu = floor($so/1000000);
        $so = $so%1000000;
        if ($trieu>0) {
            $chuoi = docblock($trieu,$daydu) . " triệu";
            $daydu = true;
        }
        $nghin = floor($so/1000);
        $so = $so%1000;
        if ($nghin>0) {
            $chuoi .= docblock($nghin,$daydu) . " nghìn";
            $daydu = true;
        }
        if ($so>0) {
            $chuoi .= docblock($so,$daydu);
        }
        return $chuoi;
    }
    function convert_number_to_words($so)
    {
        return leo_ConverNumberToWord($so);
		/*
		$mangso = array("không","một","hai","ba","bốn","năm","sáu","bảy","tám","chín");
        if ($so==0) return ucwords($mangso[0]);
        $chuoi = ""; $hauto = "";
        do {
            $ty = $so%1000000000;
            $so = floor($so/1000000000);
            if ($so>0) {
                $chuoi = dochangtrieu($ty,true) . $hauto . $chuoi;
            } else {
                $chuoi = dochangtrieu($ty,false) . $hauto . $chuoi;
            }
            $hauto = " tỷ";
        } while ($so>0);
        
        //$chuoi = mb_ucfirst(mb_strtolower($chuoi,'UTF-8'),'UTF-8');
        $chuoi = mb_strtolower($chuoi,'UTF-8');
        $chucaidau = substr($chuoi,1,1);
        $chuconlai = substr($chuoi,2);
        $chuoi = mb_strtoupper($chucaidau,'UTF-8') . $chuconlai;
        return $chuoi;*/
    }
	function convert_number_Double_to_words($number) 
	{ 
		return leo_ConverNumberToWord($number);
		/*
		$hyphen      = ' ';
		$conjunction = '  ';
		$separator   = ' ';
		$negative    = 'âm ';
		$decimal     = ' phẩy ';	
		$dictionary  = array(
		0                   => 'Không',
		1                   => 'Một',
		2                   => 'Hai',
		3                   => 'Ba',
		4                   => 'Bốn',
		5                   => 'Năm',
		6                   => 'Sáu',
		7                   => 'Bảy',
		8                   => 'Tám',
		9                   => 'Chín',
		10                  => 'Mười',
		11                  => 'Mười một',
		12                  => 'Mười hai',
		13                  => 'Mười ba',
		14                  => 'Mười bốn',
		15                  => 'Mười lăm',
		16                  => 'Mười sáu',
		17                  => 'Mười bảy',
		18                  => 'Mười tám',
		19                  => 'Mười chín',
		20                  => 'Hai mươi',
		30                  => 'Ba mươi',
		40                  => 'Bốn mươi',
		50                  => 'Năm mươi',
		60                  => 'Sáu mươi',
		70                  => 'Bảy mươi',
		80                  => 'Tám mươi',
		90                  => 'Chín mươi',
		100                 => 'trăm',
		1000                => 'ngàn',
		1000000             => 'triệu',
		1000000000          => 'tỷ',
		1000000000000       => 'nghìn tỷ',
		1000000000000000    => 'ngàn triệu triệu',
		1000000000000000000 => 'tỷ tỷ'
		);
		 
		if (!is_numeric($number)) {
			return false;
		}
		$number = (double)$number;
		*/
		/*if (($number >= 0 && (int)$number < 0) ||(int)$number < 0 - PHP_INT_MAX) 
		{
			// overflow
			trigger_error('đổi số thành chữ chỉ áp dụng từ -' . PHP_INT_MAX . ' đến ' . PHP_INT_MAX, E_USER_WARNING);
			return false;
		}*/
		/* 
		if ($number < 0) {
			return $negative . convert_number_to_words(abs($number));
		}
		 
		$string = $fraction = null;
		 
		if (strpos($number, '.') !== false) {
			list($number, $fraction) = explode('.', $number);
		}
		 
		switch (true) {
			case $number < 21:
				$string = $dictionary[$number];
				break;
			case $number < 100:
				$tens   = ((int) ($number / 10)) * 10;
				$units  = $number % 10;
				$string = $dictionary[$tens];
				if ($units) {
					$string .= $hyphen . $dictionary[$units];
				}
				break;
			case $number < 1000:
				$hundreds  = $number / 100;
				$remainder = $number % 100;
				$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
				if ($remainder) {
				$string .= $conjunction . convert_number_to_words($remainder);
				}
				break;
			default:
				$baseUnit = pow(1000, floor(log($number, 1000)));
				//d($baseUnit);
				$numBaseUnits = ($number / $baseUnit);
				//d($numBaseUnits);
				$phannguyen= (int)$numBaseUnits;
				//d($phannguyen);
				if ($baseUnit <=100000000)				
				{
					//d('vaoday');
					$remainder = $number % $baseUnit;					
					//d($remainder);
				}
				else
				{
					$phandu = $numBaseUnits - (float)$phannguyen;		
					//d($phandu);
					$remainder = $phandu * $baseUnit;
					//d($remainder);
				}
				
				//$string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
				$string = convert_number_to_words($phannguyen) . ' ' . $dictionary[$baseUnit];
				if ($remainder) {
				$string .= $remainder < 100 ? $conjunction : $separator;
				$string .= convert_number_to_words($remainder);
				}
				break;
		}
		 
		if (null !== $fraction && is_numeric($fraction)) {
		$string .= $decimal;
		$words = array();
		foreach (str_split((string) $fraction) as $number) {
		$words[] = $dictionary[$number];
		}
		$string .= implode(' ', $words);
		}	
        return mb_ucfirst(mb_strtolower($string,'UTF-8'),'UTF-8');	
		*/
	}
	
	//Tạo ngẫu nhiên password với độ phức tạp cao
	function passGen($length,$nums)
	{
		$lowLet = "abcdefghijklmnopqrstuvwxyz";
		$highLet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$numbers = "123456789";
		$pass = "";
		$i = 1;
		While ($i <= $length)
		{
			$type = rand(0,1);
				if ($type == 0)
				{
					if (($length-$i+1) > $nums)
					{
						$type2 = rand(0,1);
						if ($type2 == 0)
						{
							$ran = rand(0,25);
							$pass .= $lowLet[$ran];
						}
						else
						{
							$ran = rand(0,25);
							$pass .= $highLet[$ran];
						}
				}
				else
				{
					$ran = rand(0,8);
					$pass .= $numbers[$ran];
					$nums--;
				}
			}
			else
			{
				if ($nums > 0)
				{
					$ran = rand(0,8);
					$pass .= $numbers[$ran];
					$nums--;
				}
				else
				{
					$type2 = rand(0,1);
					if ($type2 == 0)
					{
						$ran = rand(0,25);
						$pass .= $lowLet[$ran];
					}
					else
					{
						$ran = rand(0,25);
						$pass .= $highLet[$ran];
					}
				}
			}
			$i++;
		}
		return $pass;
	}
	
	//làm tag cloud cho trang web
	function getCloud( $data = array(), $minFontSize = 12, $maxFontSize = 30 )
	{
		$minimumCount = min($data);
		$maximumCount = max($data);
		$spread       = $maximumCount - $minimumCount;
		$cloudHTML    = '';
		$cloudTags    = array();
		$spread == 0 && $spread = 1;
		foreach( $data as $tag => $count )
		{
		$size = $minFontSize + ( $count - $minimumCount )
		* ( $maxFontSize - $minFontSize ) / $spread;
		$cloudTags[] = '<a style="font-size: ' . floor( $size ) . 'px'
		. '" href="#" title="\'' . $tag  .
		'\' returned a count of ' . $count . '">'
		. htmlspecialchars( stripslashes( $tag ) ) . '</a>';
		}
		return join( "\n", $cloudTags ) . "\n";
	}
	
	function drawCSSGraph($data, $total, $settings='height=20 width=300 color=#c0c0c0')
	{
		//Emulate the symfony style of using settings
		if(is_array($settings)){
		$width = (isset($settings['width']))?$settings['width']:300;
		$height = (isset($settings['height']))?$settings['height']:20;
		$color = (isset($settings['color']))?$settings['color']:'#c0c0c0';
		} else {
		$settings = explode(' ', $settings);
		foreach($settings as $setting){
		$tmp = explode('=', $setting);
		$$tmp[0] = $tmp[1];
		if(!isset($width)) $width = 300;
		if(!isset($height)) $height = 20;
		if(!isset($color)) $color = '#c0c0c0';
		}
		}
		if(count($data) > 1){
		$HTMLoutput = '';
		foreach($data as $label=>$var){
		$labelv = preg_replace('/\[var\]/', $var, $label);
		$HTMLoutput .= drawCSSGraph(array($labelv=>$var), $total, $settings);
		}
		return $HTMLoutput;
		} else {
		$variable = $data[key($data)];
		$label = preg_replace('/\[var\]/', $variable, key($data));
		return
		'<div><span>'.$label.'</span>
		<div style="width:'.$width.'px;height:'.$height.'px;border:1px solid black;padding:1px;">
		<div class=\'bargraph\' style=\''.
		(($width > $height)?'width':'height').':'.
		(($variable/$total)*($width > $height?$width:$height)).'px;background-color:'.$color.';\'></div>
		</div>
		</div>'."\n";
		}
         
	}
    
    function FormatDateTimePicKerFull($ngay = "")
    {
        //  18:59:58  01/12/2014
        $arr = explode(" ", $ngay);
        $strNgay = $arr[1];
        $strGio = $arr[0];
        
        $arrNgay = explode("/", $strNgay);
        $arrGio = explode(":", $strGio);
        if (checkdate($arrNgay[1],$arrNgay[0],$arrNgay[2]))
            return $arrNgay[2] . "-" . $arrNgay[1] . "-" . $arrNgay[0] . ' ' . $arrGio[0] . ':' . $arrGio[1] . ':' .$arrGio[2];
        else 
            return "loingaygio";
    }
    function FormatTime($ngay = "") //ngay gio ---> ngay
    {
        $arr = explode(" ", $ngay);
        $strNgay = $arr['0'];
        $strGio = $arr['1'];
        $arr_ngay = explode("-", $strNgay);
        $arr_Gio = explode(":", $strGio);
        
        $result = $arr_Gio['0'] . ":" .$arr_Gio['1'] . ":" .$arr_Gio['2'];
        
        return $result;
    }
    
?>