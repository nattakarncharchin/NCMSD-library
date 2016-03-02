<?php
/*
  library By : NCM Studio develop(Nuttakarn charchin | ณัฐกานต์ ชาชิน)
  - Mail:nattakarnswe@gmail.com
  -Codeนี้สามารถงานได้ฟรี(ห้ามจำหน่ายและคิดค่าใช้จ่าย)และต้องติด Caredit ไว้ด้วย
  -Code นี้ทำขึ้นมาเพื่อการศึกษาแนวทางการเขียนอาจมีการใช้ Method หรือคำสั่งที่ไม่ถูกหลักหรือเกินความเสี่ยงต่อความปลอดภัยของระบบสามารถเมล์มาบอกถึงปัญหา
  -หรือแนวทางในการแก้ไขเพื่อใช้ในการปรับปรุง Code ต่อไป
*/
class ncmsd_connectDB{

	public function connectTODB($hostname,$username,$password,$dbname){
		try{
			$getOBJDB = new PDO("mysql:host=".$hostname.";dbname=".$dbname.";",$username,$password);
			$getOBJDB->exec("SET NAMES SET UTF8");
		}catch(PDOException $e){
			$getOBJDB = $e->getMessage();
		}
		return $getOBJDB;
	}

}
?>
