<?php
/*
  library By : NCM Studio develop(Nuttakarn charchin | ณัฐกานต์ ชาชิน)
  - Mail:nattakarnswe@gmail.com
  -Codeนี้สามารถงานได้ฟรี(ห้ามจำหน่ายและคิดค่าใช้จ่าย)และต้องติด Caredit ไว้ด้วย
  -Code นี้ทำขึ้นมาเพื่อการศึกษาแนวทางการเขียนอาจมีการใช้ Method หรือคำสั่งที่ไม่ถูกหลักหรือเกินความเสี่ยงต่อความปลอดภัยของระบบสามารถเมล์มาบอกถึงปัญหา
  -หรือแนวทางในการแก้ไขเพื่อใช้ในการปรับปรุง Code ต่อไป
*/
class ncmsd_delete{

  public function daletedata($sqlcon="",$nametable="",$namefide="",$valuesdata=""){
    $Delword = array("<script>","</script>","<?php","?>","<?","?>",'<script type="text/javascript">');
    if(gettype($sqlcon)!="object" or $sqlcon==""){
      $getoutdataFN = "Not fond object connect database!";
    }else{
      $sql_chk_1 = "select * from ".$nametable.";";
      $pre_chk_1 = $sqlcon->prepare($sql_chk_1);
      $checkTable = $pre_chk_1->execute();
      if($checkTable==true){
        if(gettype($namefide)=="array" or gettype($valuesdata)=="array"){
          //Data are array
          if(count($namefide)<0 or count($valuesdata)<0){
            //not input fidename and values that delete
            $getoutdataFN = "No input fidename or data that delete!";
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
              if(count($namefide)!=count($valuesdata) or count($valuesdata)!=count($namefide)){
                //this Data array 2 values no match
                $getoutdataFN = "Number data array 2 data not match!";
              }else{
                //this Data array 2 values match
                $countnamefidedelete=0;
                foreach($namefide as $getoutfidedelete){
                  $countnamefidedelete++;
                  if($countnamefidedelete==count($namefide)){
                    $fullfidenamedelete = $fullfidenamedelete.$getoutfidedelete."=:datadeleteval".$countnamefidedelete;
                  }else{
                    $fullfidenamedelete = $fullfidenamedelete.$getoutfidedelete."=:datadeleteval".$countnamefidedelete.' and ';
                  }
                }

                $countdatadelete=0;
                foreach($valuesdata as $getdatadelete){
                  $countdatadelete++;
                  $arraydatadelete[":datadeleteval".$countdatadelete]=str_replace($Delword,"",$getdatadelete);
                }

                $sql_deletedata = "delete from ".$nametable." where ".$fullfidenamedelete;
                $pre_deletedata = $sqlcon->prepare($sql_deletedata);
                $chkdelete = $pre_deletedata->execute($arraydatadelete);
                if($chkdelete==true){
                  //delete success
                  $getoutdataFN = true;
                }else{
                  //delete false
                  $getoutdataFN = false;
                }
              }
            }
          }
        }else{
          //Data no are array
          if($namefide=="" and $valuesdata==""){
            //not input fidename and values that delete
            $sql_deletedata = "delete from ".$nametable;
            $pre_deletedata = $sqlcon->prepare($sql_deletedata);
            $chkdelete = $pre_deletedata->execute();
            if($chkdelete==true){
              //delete success
              $getoutdataFN = true;
            }else{
              //delete false
              $getoutdataFN = false;
            }
          }else{
            //input fidename and values that delete
            $sql_deletedata = "delete from ".$nametable." where ".$namefide."=:datadelete";
            $pre_deletedata = $sqlcon->prepare($sql_deletedata);
            $chkdelete = $pre_deletedata->execute(array(':datadelete'=>str_replace($Delword,"",$valuesdata)));
            if($chkdelete==true){
              //delete success
              $getoutdataFN = true;
            }else{
              //delete false
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
