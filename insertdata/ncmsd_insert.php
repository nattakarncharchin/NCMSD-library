<?php
/*
  library By : NCM Studio develop(Nuttakarn charchin | ณัฐกานต์ ชาชิน)
  - Mail:nattakarnswe@gmail.com
  -Codeนี้สามารถงานได้ฟรี(ห้ามจำหน่ายและคิดค่าใช้จ่าย)และต้องติด Caredit ไว้ด้วย
  -Code นี้ทำขึ้นมาเพื่อการศึกษาแนวทางการเขียนอาจมีการใช้ Method หรือคำสั่งที่ไม่ถูกหลักหรือเกินความเสี่ยงต่อความปลอดภัยของระบบสามารถเมล์มาบอกถึงปัญหา
  -หรือแนวทางในการแก้ไขเพื่อใช้ในการปรับปรุง Code ต่อไป
*/
class ncmsd_insert{

  public function insertdata($sqlcon="",$nametable="",$namefide="",$valuesdatainsert=""){
    $Delword = array("<script>","</script>","<?php","?>","<?","?>",'<script type="text/javascript">');
    if(gettype($sqlcon)!="object" or $sqlcon==""){
      $getoutdataFN = "Not fond object connect database!";
    }else{
      $sql_chk_1 = "select * from ".$nametable.";";
      $pre_chk_1 = $sqlcon->prepare($sql_chk_1);
      $checkTable = $pre_chk_1->execute();
      if($checkTable==true){
        if(gettype($namefide)=="array" or gettype($valuesdatainsert)=="array"){
          //Data are array
          if(count($namefide)<0 or count($valuesdatainsert)<0){
            //not input fidename and values that insert
            $getoutdataFN = "No input fidename or data that insert!";
          }else{
            //input fidename and values that insert
            //that step will check values in array is empty or not
            foreach($namefide as $listdataarray){
              if($listdataarray==""){
                $checkoutemptynamefide = false;
                break;
              }else{
                $checkoutemptynamefide = true;
              }
            }
            if($checkoutemptynamefide == false){
              //array values of namefide have is empty
              $getoutdataFN = "Data input fidename have values empty!";
            }else{
              //array values of namefide have is not empty
              if(count($namefide)!=count($valuesdatainsert) or count($valuesdatainsert)!=count($namefide)){
                //this Data array 2 values no match
                $getoutdataFN = "Number data array 2 data not match!";
              }else{
                //this Data array 2 values match
                $countnamefideinsert=0;
                foreach($namefide as $getoutfideinsert){
                  $countnamefideinsert++;
                  if($countnamefideinsert==count($namefide)){
                    $fullfidenameinsert = $fullfidenameinsert.$getoutfideinsert;
                  }else{
                    $fullfidenameinsert = $fullfidenameinsert.$getoutfideinsert.',';
                  }
                }

                for($Cdeinser=1;$Cdeinser<=count($valuesdatainsert);$Cdeinser++){
                  if($Cdeinser==count($valuesdatainsert)){
                    $defindeinsert = $defindeinsert.":datainsertval".$Cdeinser;
                  }else{
                    $defindeinsert = $defindeinsert.":datainsertval".$Cdeinser.',';
                  }
                }

                $countdatainsert=0;
                foreach($valuesdatainsert as $getdatainsert){
                  $countdatainsert++;
                  $arraydatainsert[":datainsertval".$countdatainsert] =$getdatainsert;
                }

                $sql_inertdata = "insert into ".$nametable."(".$fullfidenameinsert.") values(".$defindeinsert.")";
                $pre_inertdata = $sqlcon->prepare($sql_inertdata);
                $chkinsert = $pre_inertdata->execute($arraydatainsert);
                if($chkinsert==true){
                  //insert success
                  $getoutdataFN = true;
                }else{
                  //insert false
                  $getoutdataFN = false;
                }
              }
            }
          }
        }else{
          //Data no are array
          if($namefide=="" or $valuesdatainsert==""){
            //not input fidename and values that insert
            $getoutdataFN = "No input fidename or data that insert!";
          }else{
            //input fidename and values that insert
            $sql_inertdata = "insert into ".$nametable."(".$namefide.") values(:datainsertdataNA)";
            $pre_inertdata = $sqlcon->prepare($sql_inertdata);
            $chkinsert = $pre_inertdata->execute(array(':datainsertdataNA'=>str_replace($Delword,'',$valuesdatainsert)));
            if($chkinsert==true){
              //insert success
              $getoutdataFN = true;
            }else{
              //insert false
              $getoutdataFN = false;
            }
          }
        }
      }else{
        $getoutdataFN = "Not fond this table name '".$nametable."'!";
      }
    }
    return $getoutdataFN;
  }

}
?>
