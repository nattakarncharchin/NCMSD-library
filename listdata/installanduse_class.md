#คลาสแสดงรายการข้อมูล
#การติดตั้ง
	โหลดไฟล์คลาส .php ไปวางที่โฟลเดอร์ตัวงานของท่านและเปิดไฟล์งานที่ต้องการใช้งาน
		1.นำเข้าไฟล์คลาสที่ต้องการใช้งาน <?php require(‘ที่อยู่ไฟล์คลาส/ncmsd_Showlist.php’); ?>
		2.สร้างตัวแปรเพื่อเรียกใช้คลาส $variable = new  ncmsd_Showlist ();
#การใช้งาน
	คลาสนี้สามารถเรียกดูรายการข้อมูลได้ 3 แบบ 
		1).แบบค่าเดียว 
		2).แบบหลายค่า
		3).แบบทั้งหมด
#รูปแบบคลาส
  getlistdata(เชื่อมต่อฐานข้อมูล,ชื่อตาราง,จำนวนข้อมูลเริ่ม,จำนวนข้อมูลแสดงผล,ชื่อฟิวฐานข้อมูล,ข้อมูลที่ตรวจสอบ,ชื่อฟิวใช้ลำดับข้อมูล,รูปแบบลำดับข้อมูล)