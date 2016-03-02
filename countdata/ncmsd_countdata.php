<?php
/*
  library By : NCM Studio develop(Nuttakarn charchin | ณัฐกานต์ ชาชิน)
  - Mail:nattakarnswe@gmail.com
  -Codeนี้สามารถงานได้ฟรี(ห้ามจำหน่ายและคิดค่าใช้จ่าย)และต้องติด Caredit ไว้ด้วย
  -Code นี้ทำขึ้นมาเพื่อการศึกษาแนวทางการเขียนอาจมีการใช้ Method หรือคำสั่งที่ไม่ถูกหลักหรือเกินความเสี่ยงต่อความปลอดภัยของระบบสามารถเมล์มาบอกถึงปัญหา
  -หรือแนวทางในการแก้ไขเพื่อใช้ในการปรับปรุง Code ต่อไป
*/
class ncmsd_countdata{

	public function GetcountNoconditions($OBJconnect,$nametable,$numberformate=true,$decimal=false){
		//เรียกดูจำนวนแบบไม่มีเงื่อนไข
		$sql = "select * from ".$nametable;
		$pre = $OBJconnect->prepare($sql);
		$pre->execute();
		$row = $pre->rowCount();
		if(gettype($OBJconnect)!="object" or $OBJconnect==""){
      $getoutcout = "Not fond object connect database!";
    }else{
			$sql_chk_1 = "select * from ".$nametable.";";
      $pre_chk_1 = $OBJconnect->prepare($sql_chk_1);
      $checkTable = $pre_chk_1->execute();
			if($checkTable==true){
				if($numberformate == "true"){
					if($decimal == "true"){
						$getoutcout = number_format($row,2,".",",");
					}else{
						$getoutcout = number_format($row);
					}
				}else{
					$getoutcout = $row;
				}
			}else{
        $getoutcout = "Not fond this table name '".$nametable."'!";
      }
		}
		return $getoutcout;
	}

}
?>
