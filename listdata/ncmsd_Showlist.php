<?php
/*
  library By : NCM Studio develop(Nuttakarn charchin | ณัฐกานต์ ชาชิน)
  - Mail:nattakarnswe@gmail.com
  -Codeนี้สามารถงานได้ฟรี(ห้ามจำหน่ายและคิดค่าใช้จ่าย)และต้องติด Caredit ไว้ด้วย
  -Code นี้ทำขึ้นมาเพื่อการศึกษาแนวทางการเขียนอาจมีการใช้ Method หรือคำสั่งที่ไม่ถูกหลักหรือเกินความเสี่ยงต่อความปลอดภัยของระบบสามารถเมล์มาบอกถึงปัญหา
  -หรือแนวทางในการแก้ไขเพื่อใช้ในการปรับปรุง Code ต่อไป
*/
class ncmsd_Showlist{

  public function getlistdata($sqlcon="",$nametable="",$startdata=0,$limitdata=30,$namefide="",$namedata="",$fidepriority="",$priority=""){
    $Delword = array("<script>","</script>","<?php","?>","<?","?>",'<script type="text/javascript">');
    if(gettype($sqlcon)!="object" or $sqlcon==""){
      $getoutdataFN = "Not fond object connect database!";
    }else{
      $sql_chk_1 = "select * from ".$nametable.";";
      $pre_chk_1 = $sqlcon->prepare($sql_chk_1);
      $checkTable = $pre_chk_1->execute();
      if($checkTable==true){
        if(is_numeric($startdata)==false or is_numeric($limitdata)==false){
          //Start data or limit data that input not are number
          //check step 2
          if(is_numeric($startdata)==false){
            //Start data no number
            $getoutdataFN = "Start data not number!";
          }elseif(is_numeric($limitdata)==false){
            //Limit data no number
            $getoutdataFN = "Limit data not number!";
          }
        }else{
          //Start data and number that use end data are numbre
          if(gettype($namefide)=="array" or gettype($namedata)=="array"){
            //Data are array
            if(count($namefide)<0 or count($namedata)<0){
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
                if(count($namefide)!=count($namedata) or count($namedata)!=count($namefide)){
                  //this Data array 2 values no match
                  $getoutdataFN = "Number data array 2 data not match!";
                }else{
                  //this Data array 2 values match
                  //list data name fide out from array ========================
                  $coutarray1=0;//Count valute array 1
                  foreach($namefide as $datafideoutarray){
                    $coutarray1++;
                    if($coutarray1 == count($namefide)){
                      $newdataFide = $newdataFide.$datafideoutarray.'=:datawhere'.str_replace($Delword,'',$coutarray1);
                    }else{
                      $newdataFide = $newdataFide.$datafideoutarray.'=:datawhere'.str_replace($Delword,'',$coutarray1).' and ';
                    }
                  }
                  //list data data out from array ========================
                  $coutarray2=0;//Count valute array 2
                  foreach($namedata as $dataoutarray){
                    $coutarray2++;
                    if($coutarray2 == count($namedata)){
                      $newdatadata[':datawhere'.$coutarray2] = str_replace($Delword,'',$dataoutarray);
                    }else{
                      $newdatadata[':datawhere'.$coutarray2] = str_replace($Delword,'',$dataoutarray);
                    }
                  }
                  if($fidepriority==""){
                    //Name fide priority  no have input
                    //list data by no have priority
                    $sql_selec = 'select * from '.$nametable.' where '.$newdataFide.' limit '.$startdata.','.$limitdata;
                    $pre_selec = $sqlcon->prepare($sql_selec);
                    $pre_selec->execute($newdatadata);
                    $getoutdataFN = $pre_selec;
                  }else{
                    //Name fide priority have input
                    //check fide name priority have or no have
                    $fetch_chk_1 = $pre_chk_1->FETCH(PDO::FETCH_OBJ);
                    $fetch_chk_1_enjson = json_encode($fetch_chk_1);
                    $findnamefidepriority = strpos($fetch_chk_1_enjson,$fidepriority);
                    if($findnamefidepriority==false){
                      //No have fide name priority
                      $getoutdataFN = "No fide name priority!";
                    }else{
                      //Have fide name priority
                      if($priority=="DESC"){
                        //select priority list data are DESC
                        $sql_selec = 'select * from '.$nametable.' where '.$newdataFide.' order by '.$fidepriority.' DESC'.' limit '.$startdata.','.$limitdata;
                        $pre_selec = $sqlcon->prepare($sql_selec);
                        $pre_selec->execute($newdatadata);
                        $getoutdataFN = $pre_selec;
                      }elseif($priority=="ASC"){
                        //select priority list data are ASC
                        $sql_selec = 'select * from '.$nametable.' where '.$newdataFide.' order by '.$fidepriority.' ASC'.' limit '.$startdata.','.$limitdata;
                        $pre_selec = $sqlcon->prepare($sql_selec);
                        $pre_selec->execute($newdatadata);
                        $getoutdataFN = $pre_selec;
                      }else{
                        //None select waill select priority list data are DESC
                        $sql_selec = 'select * from '.$nametable.' where '.$newdataFide.' order by '.$fidepriority.' DESC'.' limit '.$startdata.','.$limitdata;
                        $pre_selec = $sqlcon->prepare($sql_selec);
                        $pre_selec->execute($newdatadata);
                        $getoutdataFN = $pre_selec;
                      }
                    }
                  }
                }
              }
            }
          }else{
            //Data no are array
            $sql_selec = 'select * from '.$nametable.' limit '.$startdata.','.$limitdata;
            $pre_selec = $sqlcon->prepare($sql_selec);
            $pre_selec->execute($newdatadata);
            $getoutdataFN = $pre_selec;
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
