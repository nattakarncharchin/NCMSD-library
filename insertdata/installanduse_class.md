#คลาสแสดงรายการข้อมูล
#การติดตั้ง
	โหลดไฟล์คลาส .php ไปวางที่โฟลเดอร์ตัวงานของท่านและเปิดไฟล์งานที่ต้องการใช้งาน
		1.นำเข้าไฟล์คลาสที่ต้องการใช้งาน <?php require(‘ที่อยู่ไฟล์คลาส/ncmsd_insert.php’); ?>
		2.สร้างตัวแปรเพื่อเรียกใช้คลาส $variable = new  ncmsd_insert ();
#การใช้งาน

	คลาสนี้สามารถเพิ่มข้อมูลได้ 2 แบบ 
		1).แบบค่าเดียว 
		2).แบบหลายค่า
#คืนค่า
	True = เพิ่มสำเร็จ
	False = เพิ่มไม่สำเร็จ
	
#รูปแบบคลาส
  insertdata (เชื่อมต่อฐานข้อมูล,ชื่อตาราง,ชื่อฟิวฐานข้อมูล,ข้อมูลที่จะเพิ่ม)