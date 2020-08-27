<?php
    require_once('login.php');
    //require_once('pdo-func.php');
    require_once('func/require-list.php');

//echo "<img src='img/icon-construction.jpg'/>";
#echo "<pre>";print_r($_REQUEST);
    if (isset($_POST['ssnum']) && safe($_POST['ssnum']) <> '') {  // saving service sheet ?
        //echo "</br>Count Post-->" . 1 + count($_POST);
        //echo "hello save service sheet!";
        
        if (isset($_POST['update'])) {
            #echo "<pre>";print_r($_REQUEST);
            echo "<div class='noticeGood'>Updating..</div>";

            $zero = 50 * safe($_GET['page']);
            // 2015-08-06 .. was set to 45
            //echo "Zero ".$zero;
            //die(); 

            for ($x = $zero; $x < ($zero + 51); $x++) {
                
                
                //echo "<div>row..$x</div>";
                //for ($x = $zero; $x<1+count($_POST); $x++){
                //echo " ..loop";
                $Unit_ID = safe($_POST['Unit_ID' . $x]);
                $Type = safe($_POST['Type' . $x]);
                $L1 = safe($_POST['L1' . $x]);
                $L2 = safe($_POST['L2' . $x]);
                $L4 = safe($_POST['L4' . $x]);
                $L5 = safe($_POST['L5' . $x]);
                //$lastpt = $_POST['lastpt'.$x];

                $Deleted = safe($_POST['Deleted' . $x]);

                //$nextpt = $_POST['nextpt'.$x];
                //if($lastpt<>''){$nextpt = date("Y-m-d", strtotime(date("Y-m-d", strtotime($lastpt)) . " + 1825 day"));}
                //$nextpt = $_POST['nextpt'.$x];
                $Rank = safe($_POST['Rank' . $x]);

                $Location = safe($_POST['Location' . $x]);
                $Comments = safe($_POST['Comments' . $x]);
                $servid = safe($_POST['servid' . $x]);

                $Level = safe($_POST['Level' . $x]);

                $Next_PT = safe($_POST['Next_PT' . $x]);
                $Static_Pressure = safe($_POST['Static_Pressure' . $x]);
                $Booster_Pressure = safe($_POST['Booster_Pressure' . $x]);
                $Flow_Rate = safe($_POST['Flow_Rate' . $x]);

                $Pass_Fail = safe($_POST['Pass_Fail' . $x]);
                $Battery_Power = safe($_POST['Battery_Power' . $x]);


                //Sprinkler System specific variables
                $Sprinkler_System = safe($_POST['Sprinkler_System' . $x]);
                $Fire_Pump = safe($_POST['Fire_Pump' . $x]);
                $EWOS = safe($_POST['EWOS' . $x]);
                $Gas_Suppression = safe($_POST['Gas_Suppression' . $x]);
                $DBA = safe($_POST['DBA' . $x]);
                $Qty_of_Zones = safe($_POST['Qty_of_Zones' . $x]);
                $Battery_Date = safe($_POST['Battery_Date' . $x]);






                /* $lid = safe($_POST['lid'.$x]);$Hose_Reel = safe($_POST['Hose_Reel'.$x]);
                  $Kit = safe($_POST['Kit'.$x]);
                  $Unit = safe($_POST['Unit'.$x]); */
                
                $op[$x] = array(
                    'Unit_ID' => $Unit_ID,
                    'Type' => $Type,
                    'L1' => $L1,
                    'L2' => $L2,
                    'L4' => $L4,
                    'L5' => $L5,
                    'Next_PT' => $Next_PT,
                    'Rank' => $Rank,
                    'Deleted' => $Deleted,
                    'Location' => $Location,
                    //'nextpt'=>$nextpt,
                    'lid' => $lid,
                    'Comments' => $Comments,
                    'servid' => $servid,
                    'Level' => $Level,
                    'Static_Pressure' => $Static_Pressure,
                    'Booster_Pressure' => $Booster_Pressure,
                    'Flow_Rate' => $Flow_Rate,
                    'Sprinkler_System' => $Sprinkler_System,
                    'Fire_Pump' => $Fire_Pump,
                    'EWOS' => $EWOS,
                    'Gas_Suppression' => $Gas_Suppression,
                    'DBA' => $DBA,
                    'Qty_of_Zones' => $Qty_of_Zones,
                    'Battery_Date' => $Battery_Date,
                    'Pass_Fail' => $Pass_Fail,
                    'Battery_Power' => $Battery_Power
                );
                 
                //'Hose_Reel'=>$Hose_Reel,
//									'Kit'=>$Kit,
//									'Unit'=>$Unit,
            }
        
            //echo "line 104 ";
            //print_r($op);
            // update the service sheet
            for ($x = $zero; $x < ($zero + 60); $x++) {
                //echo "<div> update service log ...</div>";
                $str = "UPDATE serviceLog SET
                        Unit_ID='" . $op[$x]['Unit_ID'] . "',
                        Type='" . $op[$x]['Type'] . "',
                        Rank='" . $op[$x]['Rank'] . "',
                        Location='" . $op[$x]['Location'] . "',
                        L1='" . $op[$x]['L1'] . "',
                        L2='" . $op[$x]['L2'] . "',
                        L4='" . $op[$x]['L4'] . "',
                        L5='" . $op[$x]['L5'] . "',

                        Next_PT='" . $op[$x]['Next_PT'] . "',
                        Comments='" . $op[$x]['Comments'] . "',
                        Deleted='" . $op[$x]['Deleted'] . "',

                        Level='" . $op[$x]['Level'] . "',

                        Static_Pressure='" . $op[$x]['Static_Pressure'] . "',
                        Booster_Pressure='" . $op[$x]['Booster_Pressure'] . "',
                        Flow_Rate='" . $op[$x]['Flow_Rate'] . "',


                        Sprinkler_System='" . $op[$x]['Sprinkler_System'] . "',
                        Fire_Pump='" . $op[$x]['Fire_Pump'] . "',
                        EWOS='" . $op[$x]['EWOS'] . "',
                        Gas_Suppression='" . $op[$x]['Gas_Suppression'] . "',
                        DBA='" . $op[$x]['DBA'] . "',
                        Qty_of_Zones='" . $op[$x]['Qty_of_Zones'] . "',
                        Battery_Date='" . $op[$x]['Battery_Date'] . "',

                        Pass_Fail='" . $op[$x]['Pass_Fail'] . "',
                        Battery_Power='" . $op[$x]['Battery_Power'] . "'

                        WHERE 
                        servID='" . $op[$x]['servid'] . "'";

                #echo "</br>UPDATE: ($x) ".$str;
                
                //lastPTdate = '".$op[$x]['lastpt']."',Hose_Reel='".$op[$x]['Hose_Reel']."',
                //			Kit='".$op[$x]['Kit']."',
                //			Unit='".$op[$x]['Unit']."',

                if ($op[$x]['servid'] <> '') {
                    if ($_SESSION['fire_ulev'] > 2) {//echo "</br>update str=".$str;}
                        $z = mysql_query($str) or die(mysql_error());
                    }// not <>''
                }
                #print_r($op[$x]['servid']);
                #die;
            }

            // update the service sheet
            //for ($x = 0; $x<count($op); $x++) {	
            
            if (safe($_POST['Location'] <> '')) {
                //
                $add = "INSERT INTO serviceLog SET
							Unit_ID='" . safe($_POST['Unit_ID']) . "',
							scheduleSheet='" . safe($_POST['ssnum']) . "',
							Type='" . safe($_POST['epyt']) . "',
							Location='" . safe($_POST['Location']) . "',
							Rank='" . safe($_POST['Rank']) . "',
							L1='" . safe($_POST['L1']) . "',
							L2='" . safe($_POST['L2']) . "',
							L4='" . safe($_POST['L4']) . "',
							L5='" . safe($_POST['L5']) . "',
							
							Next_PT='" . safe($_POST['Next_PT']) . "',
							Comments='" . safe($_POST['Comments']) . "',

							Level='" . safe($_POST['Level']) . "',


							Static_Pressure='" . safe($_POST['Static_Pressure']) . "',
							Booster_Pressure='" . safe($_POST['Booster_Pressure']) . "',
							Flow_Rate='" . safe($_POST['Flow_Rate']) . "',


							Sprinkler_System='" . safe($_POST['Sprinkler_System']) . "',
							Fire_Pump='" . safe($_POST['Fire_Pump']) . "',
							EWOS='" . safe($_POST['EWOS']) . "',
							Gas_Suppression='" . safe($_POST['Gas_Suppression']) . "',
							DBA='" . safe($_POST['DBA']) . "',
							Qty_of_Zones='" . safe($_POST['Qty_of_Zones']) . "',
							Battery_Date='" . safe($_POST['Battery_Date']) . "',


							Pass_Fail='" . safe($_POST['Pass_Fail']) . "',
							Battery_Power='" . safe($_POST['Battery_Power']) . "'";

                //echo "</br>add=".$add;//lastPTdate='".safe($_POST['lastpt'])."',
                
                $z = mysql_query($add) or die(mysql_error());
                echo "<div class='noticeGood'>New Service line entered.</div>";
            } //}
            //===== SAVE  Tech and Date ..continued
            if (safe($_POST['tech']) <> '...') {
                //$v = sprintf("UPDATE schedule SET actTech='%s', actDate='%s' WHERE bkID='%s'",safe($_POST['tech']), safe($_POST['actdate']), safe($_GET['sheet']));
                $v = sprintf("UPDATE schedule SET actTech='%s', actDate='%s', comDate='%s' WHERE bkID='%s'", safe($_POST['tech']), safe($_POST['actdate']), safe($_POST['completeddate']), safe($_GET['sheet']));
                //echo "v=".$v;
                $z = mysql_query($v) or die(mysql_error());
            }

            //===== SAVE  ...continued
            if (safe($_POST['stat3']) == 'true') {
                $v = "UPDATE schedule SET actStatus='3' WHERE bkID='" . safe($_GET['sheet']) . "'";
                //echo "v=".$v;
                $z = mysql_query($v) or die(mysql_error());

                echo "<div class='noticeGood'>Updated to Status 3.  Please close this window or go <a href='index.php'>[home]</a></div>";
                die();
            }
        }
        //}
    }

//============================================================================
//============================================================================
//============================================================================

    require_once('menu.php');
//require_once('mpdf/mpdf.php');

    echo "<title>#" . safe($_GET['sheet']) . "</title>";

// load table of extinguishers
    $aa = mysql_query("SELECT * FROM eModels") or die(mysql_error());
    
    while ($a = mysql_fetch_array($aa)) {
        $e++;
        #echo "<pre>";print_r($a);
        $bb = mysql_query("SELECT * FROM eSize WHERE eSID='" . $a['eSID'] . "'") or die(mysql_error());
        //while($b = mysql_fetch_array($bb)){ }
        $value = mysql_fetch_object($bb);
        $size = $value->eSize;
        
        $cc = mysql_query("SELECT * FROM eType WHERE eTID='" . $a['eTID'] . "'") or die(mysql_error());
        $value = mysql_fetch_object($cc);
        $type = $value->eType;

        $dd = mysql_query("SELECT * FROM eMake WHERE eMID='" . $a['eMID'] . "'") or die(mysql_error());
        $value = mysql_fetch_object($dd);
        $make = $value->eMake;
        
        $desc = $type . " - " . $size . " " . $make;
        $types[$e] = array(
            'eMOID' => $a['eMOID'],
            'desc' => $desc);
    }

    usort($types, function($a, $b) {
        return $a['desc'] > $b['desc'] ? 1 : ($a['Type'] > $b['Type'] ? 0 : -1);
    });

//echo array_to_table($types);



    if (!isset($_GET['sheet']) or $_GET['sheet'] == '') {
        echo "which sheet?";
        die();
    }

    $scheds = mysql_query("SELECT * FROM schedule WHERE bkID='" . $_GET['sheet'] . "'") or die(mysql_error());
    while ($sched = mysql_fetch_array($scheds)) {

//for($ii=0;$ii<count($sched);$ii++){

        $custid = $sched['bkCustID'];
        $bkid = $sched['bkID'];
        $tech = $sched['actTech'];
        $actdate = $sched['actDate'];
        $completeddate = $sched['comDate']; //added for completed date input
        $defecttype = $sched['Defect_Type']; //SM - added for defects
        $defectcomments = $sched['Defect_Comments']; //SM - added for defects

        //echo $bkid;


        $scusts = mysql_query("SELECT * FROM customers WHERE custID='" . $custid . "'") or die(mysql_error());
        while ($cust = mysql_fetch_array($scusts)) {
            
            $ss = 0;
            $customer = $cust['customer'];
            $custid = $cust['custID'];
            //echo $cust;

            echo "<h2>Edit --> #" . safe($_GET['sheet']) . " - <a href='customer.php?cust=" . $custid . "' target='new'>" . $customer . "</a></h2>";
            echo "<h2>Download --> #" . safe($_GET['sheet']) . " - <a href='service-log-download.php?sheet=" . $bkid . "' target='new'>" . $bkid . "</a></h2>";

//echo "<img src='img/icon-construction.jpg'/>";

            echo "<form name='fred' method='post'>";
            echo "<input type='hidden' name='custid' value='" . $custid . "'/>";

            echo "<input type='submit' class='control' name='update' value='Update & Refresh' title='Update = save any changes, ie, work-in-progress.. but (1) don`t close the screen, and (2) leave this sheet as not yet completed' />";

            echo "-------------->";
            echo "<input type='checkbox' class='click_yes' name='stat3' value='true' title='Save this sheet as COMPLETED, ie, --> level 3' /> <- check this box to save as Status #3, ie. data entry done.";
            echo "<input type='hidden' name='ssnum' value='" . safe($_GET['sheet']) . "'/>";
//echo "--------------> (if you want to add, delete or change the order of 'Locations', then do it ";
        }
    }




$teststring = fetch_servs(safe($_GET['sheet']));

//echo "</br>Get sheet = ".$_GET['sheet'];
//echo $teststring[0]['test_string'];
//echo 
    $myArray = explode(',', $teststring[0]['test_string']);
    
//print_r($teststring);
//echo "..and test string = ".print_r($teststring);//die();
//$selstr = "SELECT Rank, Location, Unit_ID, Type, L1, L2, L4, l5, lastPTdate, nextPTdate,Comments, deleted, servID FROM serviceLog WHERE (deleted='' OR deleted IS NULL ) AND scheduleSheet='".$bkid."' ORDER BY Rank";



//if($teststring[0]['testid'] == '8' || $teststring[0]['testid'] == '9'){
    if($teststring[0]['testid'] == '9'){
    $breakString =  explode('/', $teststring[0]['test_string']);
    $setString = trim($breakString[0]).'_'.trim($breakString[1]);
}else{
    $setString = $teststring[0]['test_string'];
}

    
#$selstr = "SELECT " . $teststring[0]['test_string'] . ", servID, testid, Deleted FROM serviceLog WHERE (Deleted='' OR Deleted IS NULL) AND scheduleSheet='" . $bkid . "' ORDER BY Rank";
$selstr = "SELECT " . $setString . ", servID,Rank,Location,Unit_ID,Comments,Type, testid, Deleted FROM serviceLog WHERE (Deleted='' OR Deleted IS NULL) AND scheduleSheet='" . $bkid . "' ORDER BY Rank";

//echo "</br>".$selstr;

    echo "<h2>" . $teststring[0]['title'] . "</h2>";

//echo $selstr;
    $sel = mysql_query($selstr) or die(mysql_error());
    
    for ($ss = 0; $servi[$ss] = mysql_fetch_assoc($sel); $ss++);
    
    array_pop($servi);
    
    $cc = 0;
    
    $ccc = count($servi);
    
    $qp = round(($ccc / 50), 0);
//unset($page);
//$page = safe($_GET['page']);
    if (isset($_GET['page']) && $_GET['page'] > 0) {
        $ccfirst = safe($_GET['page']) * 50;
    } else {
        $ccfirst = 0;
    }
    $cclast = $ccfirst + 50;
    if ($cclast > $ccc) {
        $cclast = $ccc;
    }

    if ($ccc > 50) {
        for ($pg = 0; $pg < ($qp + 1); $pg++) {
            $navlink = $navlink . " <a href='service-sheet-update.php?sheet=" . safe($_GET['sheet']) . "&page=" . $pg . "'>Page " . ($pg) . "</a> ";
        } // page link	
    }// make array for navigation
//echo "</br>There are ".$ccc." rows over ".$qp." page(s) </br>";
    if ($navlink <> '') {
        echo "Remember to [Update & Refresh] first! --> " . $navlink;
    }

    echo "<div class='Locations'>";
    echo "Service by & date ";
    echo "<select name='tech' class='input'>";
    echo "<option>...</option>";
    $str = mysql_query("SELECT name FROM technicians") or die(mysql_error());
    while ($a = mysql_fetch_array($str)) {
        if ($a['name'] == $tech) {
            echo "<option selected='selected' value='" . $a['name'] . "'>" . $a['name'] . "</option>";
        } else {
            echo "<option>" . $a['name'] . "</option>";
        }
    }// fetch technicians
    echo "</select>";

//echo "<input type='date' name='actdate' class='input' value='".$actdate."' / >";

    echo "                                                                                      ";
    echo "Completed date ";
    echo "<input type ='date' name='completeddate' class='input' value'" . $completeddate . "' / >";


    echo "</div>";
    //SM Start - Defects
    echo "<div class='Defects'>";

        echo "<select name='defect-type' class='input'>";
        echo "<option value='0'>0. None</option>";
        echo "<option value='1'>1. Critical</option>";
        echo "<option value='2'>2. Non Critical</option>";
        echo "<option value='3'>3. Non Conformance</option>";
        echo "<option value='4'>4. Recommendations</option>";
        echo "</select>";

        echo "<textarea name='defect-comment' cols='50' rows='5' maxlength='255' id='defect-comment'></textarea>";

        echo "</div>";


    //SM End - Defects

    ?>
    <table>

        <!-- <a href="#" id="test" onClick="javascript:fnExcelReport();">download XLS file</a> -->

        <table id="myTable" width="100%" border='1px' cellspacing='0px' cellpadding='2px' repeat_header="1">
            <thead>
                <tr bgcolor="#999999">
                    <td>#</td>
                    <td>del?</td>
                    <?php
					foreach ($myArray as $row) {
						if($teststring[0]['testid'] == '6' && trim($row) == 'Pass_Fail'){
							echo "<td>Main_Power</td>";
						}else if($teststring[0]['testid'] == '6' && trim($row) == 'Battery_Power'){
							echo "<td>Battery_Power</td>";
						}else{
							echo "<td>" . $row . "</td>";
						}
                    }
                    ?>
                </tr>
            </thead>
            
            <?php     
            #echo "<pre>";print_r($servi);die;
            for ($cc = $ccfirst; $cc < $cclast; $cc++) {
                echo '<tr>';
                echo "<td>$cc</td>";
                // DELETE checkbox 
                echo "<td>";
                echo "<input type='checkbox' title='Selecting this checkbox will delete this line entry when you Update & Refresh' name='Deleted" . $cc . "' value='true' />";
                echo "</td>";                
                echo "<td height='50px'><input type='text' size='5' name='Rank" . $cc . "' class='input' value='" . $servi[$cc]['Rank'] . "'/></td>";
                echo "<td><input type='text' size='45' name='Location" . $cc . "' value='" . $servi[$cc]['Location'] . "' class='input'/></td>";
                echo "<td><input type='text' size='5' class='input' name='Unit_ID" . $cc . "' value='" . $servi[$cc]['Unit_ID'] . "'/></td>";

                echo "<td><select name='Type" . $cc . "' class='input'>";
                echo "<option>...</option>";
                for ($f = 0; $f < count($types); $f++) {
                    if ($servi[$cc]['Type'] == $types[$f]['eMOID']) {
                        echo "<option value='" . $types[$f]['eMOID'] . "' selected='selected'>" . $types[$f]['desc'] . "</option>";
                    } else {
                        echo "<option value='" . $types[$f]['eMOID'] . "'>" . $types[$f]['desc'] . "</option>";
                    }
                }
                echo "</select>";
                echo "</td>";

                if (strpos($teststring[0]['test_string'], 'Level') !== false) {
                    echo "<td><input type='text' name='Level" . $cc . "' value='" . $servi[$cc]['Level'] . "'/></td>";
                }

                if (strpos($teststring[0]['test_string'], 'L1') !== false) {
                    if ($servi[$cc]['L1'] == 'TRUE') {
                        echo "<td><input type='checkbox' name='L1" . $cc . "' value='TRUE' checked='checked' /></td>";
                    } else {
                        echo "<td><input type='checkbox' name='L1" . $cc . "'  value='TRUE' /></td>";
                    }
                }

                if (strpos($teststring[0]['test_string'], 'L2') !== false) {
                    if ($servi[$cc]['L2'] == 'TRUE') {
                        echo "<td><input type='checkbox' name='L2" . $cc . "' value='TRUE' checked='checked' /></td>";
                    } else {
                        echo "<td><input type='checkbox' name='L2" . $cc . "'  value='TRUE' /></td>";
                    }
                }

                if (strpos($teststring[0]['test_string'], 'L4') !== false) {
                    if ($servi[$cc]['L4'] == 'TRUE') {
                        echo "<td><input type='checkbox' name='L4" . $cc . "' value='TRUE' checked='checked' /></td>";
                    } else {
                        echo "<td><input type='checkbox' name='L4" . $cc . "'  value='TRUE' /></td>";
                    }
                }

                if (strpos($teststring[0]['test_string'], 'L5') !== false) {
                    if ($servi[$cc]['L5'] == 'TRUE') {
                        echo "<td><input type='checkbox' name='L5" . $cc . "' value='TRUE' checked='checked' /></td>";
                    } else {
                        echo "<td><input type='checkbox' name='L5" . $cc . "'  value='TRUE' /></td>";
                    }
                }

                if (strpos($teststring[0]['test_string'], 'Pass_Fail') !== false) {
                    if ($servi[$cc]['Pass_Fail'] == 'TRUE') {
                        echo "<td><input type='checkbox' name='Pass_Fail" . $cc . "' value='TRUE' checked='checked' /></td>";
                    } else {
                        echo "<td><input type='checkbox' name='Pass_Fail" . $cc . "' value='TRUE' /></td>";
                    }
                }
				
				if (strpos($teststring[0]['test_string'], 'Battery_Power') !== false) {
                    if ($servi[$cc]['Battery_Power'] == 'TRUE') {
                        echo "<td><input type='checkbox' name='Battery_Power" . $cc . "' value='TRUE' checked='checked' /></td>";
                    } else {
                        echo "<td><input type='checkbox' name='Battery_Power" . $cc . "' value='TRUE' /></td>";
                    }
                }

                if (strpos($teststring[0]['test_string'], 'Flow_Rate') !== false) {
                    echo "<td><input type='text' size='5' class='input' name='Flow_Rate" . $cc . "' value='" . $servi[$cc]['Flow_Rate'] . "'/></td>";
                }

                if (strpos($teststring[0]['test_string'], 'Static_Pressure') !== false) {
                    echo "<td><input type='text' size='5' class='input' name='Static_Pressure" . $cc . "' value='" . $servi[$cc]['Static_Pressure'] . "'/></td>";
                }

                if (strpos($teststring[0]['test_string'], 'Booster_Pressure') !== false) {
                    echo "<td><input type='text' size='5' class='input' name='Booster_Pressure" . $cc . "' value='" . $servi[$cc]['Booster_Pressure'] . "'/></td>";
                }
                
                //Sprinkler System variables ===========================================
                if (strpos($teststring[0]['test_string'], 'Sprinkler_System') !== false) {
                    echo "<td><input type='text' size='5' class='input' name='Sprinkler_System" . $cc . "' value='" . $servi[$cc]['Sprinkler_System'] . "'/></td>";
                }
                if (strpos($teststring[0]['test_string'], 'Fire_Pump') !== false) {
                    echo "<td><input type='text' size='5' class='input' name='Fire_Pump" . $cc . "' value='" . $servi[$cc]['Fire_Pump'] . "'/></td>";
                }
                if (strpos($teststring[0]['test_string'], 'EWOS') !== false) {
                    echo "<td><input type='text' size='5' class='input' name='EWOS" . $cc . "' value='" . $servi[$cc]['EWOS'] . "'/></td>";
                }
                if (strpos($teststring[0]['test_string'], 'Gas_Suppression') !== false) {
                    echo "<td><input type='text' size='5' class='input' name='Gas_Suppression" . $cc . "' value='" . $servi[$cc]['Gas_Suppression'] . "'/></td>";
                }
                if (strpos($teststring[0]['test_string'], 'DBA') !== false) {
                    echo "<td><input type='text' size='5' class='input' name='DBA" . $cc . "' value='" . $servi[$cc]['DBA'] . "'/></td>";
                }
                if (strpos($teststring[0]['test_string'], 'Qty_of_Zones') !== false) {
                    echo "<td><input type='text' size='5' class='input' name='Qty_of_Zones" . $cc . "' value='" . $servi[$cc]['Qty_of_Zones'] . "'/></td>";
                }
                if (strpos($teststring[0]['test_string'], 'Battery_Date') !== false) {
                    echo "<td><input type='text' size='5' class='input' name='Battery_Date" . $cc . "' value='" . $servi[$cc]['Battery_Date'] . "'/></td>";
                }


                //echo "<td>".$servi['lastPTdate']."</td>";
                //echo "<td><input type='date' value='".$servi[$cc]['lastPTdate']."' name='lastpt".$cc."'/></td>";
                if (strpos($teststring[0]['test_string'], 'Next_PT') !== false) {
                    echo "<td><input type='date' value='" . $servi[$cc]['Next_PT'] . "' name='Next_PT" . $cc . "'/></td>";
                }

                echo "<td><input type='text'  class='input' name='Comments" . $cc . "' value='" . $servi[$cc]['Comments'] . "'/>
		<input type='hidden' name='servid" . $cc . "' value='" . $servi[$cc]['servID'] . "'/>
		</td>";
                echo "</tr>";
            } // Locations
            // ADD NEW line ================================================================================
            echo "<tr style='background-color:#AFA;'>";
            echo "<td></td>";
            echo "<td>New?</td>";

            echo "<td height='50px'><input type='text' size='5' name='Rank' class='input' placeholder='Sheet position'/></td>";
            echo "<td><input type='text' size='45' name='Location' placeholder='New Location' class='input'/></td>";

            echo "<td><input type='text' size='5' class='input' name='Unit_ID' placeholder='ID'/></td>";

            echo "<td><select name='epyt' class='input'>";
            echo "<option>...</option>";
            for ($f = 0; $f < count($types); $f++) {
                echo "<option value='" . $types[$f]['eMOID'] . "'>" . $types[$f]['desc'] . "</option>"; //}
            }

            echo "</select>";
            echo "</td>";

            if (strpos($teststring[0]['test_string'], 'Level') !== false) {
                echo "<td><input type='text' name='Level" . $cc . "' placeholder='Level?'/></td>";
            }

            if (strpos($teststring[0]['test_string'], 'L1') !== false) {
                echo "<td><input type='checkbox' name='L1'  value='TRUE' /></td>"; //}
            }

            if (strpos($teststring[0]['test_string'], 'L2') !== false) {
                echo "<td><input type='checkbox' name='L2'  value='TRUE' /></td>"; //}
            }

            if (strpos($teststring[0]['test_string'], 'L4') !== false) {
                echo "<td><input type='checkbox' name='L4'  value='TRUE' /></td>"; //}
            }

            if (strpos($teststring[0]['test_string'], 'L5') !== false) {
                echo "<td><input type='checkbox' name='L5'  value='TRUE' /></td>"; //}
            }

            if (strpos($teststring[0]['test_string'], 'Pass_Fail') !== false) {
                echo "<td><input type='checkbox' name='Pass_Fail' value='TRUE' /></td>"; //}
            }
			
			 if (strpos($teststring[0]['test_string'], 'Battery_Power') !== false) {
                echo "<td><input type='checkbox' name='Battery_Power' value='TRUE' /></td>"; //}
            }

            if (strpos($teststring[0]['test_string'], 'Flow_Rate') !== false) {
                echo "<td><input type='text' size='5' class='input' name='Flow_Rate' placeholder='Flow Rate?'/></td>";
            }

            if (strpos($teststring[0]['test_string'], 'Static_Pressure') !== false) {
                echo "<td><input type='text' size='5' class='input' name='Static_Pressure' placeholder='New Static?'/></td>";
            }

            if (strpos($teststring[0]['test_string'], 'Booster_Pressure') !== false) {
                echo "<td><input type='text' size='5' class='input' name='Booster_Pressure' placeholder='New Booster P?'/></td>";
            }

            if (strpos($teststring[0]['test_string'], 'Next_PT') !== false) {
                echo "<td><input type='date' name='Next_PT'/></td>";
                //echo "<td><input type='text' size='5' class='input' name='Next_PT' placeholder='New Booster P?'/></td>";
            }

            echo "<td><input type='text'  class='input' name='Comments' placeholder='New comment?'/>
                      <input type='hidden' name='servid' value='new'/>
                 </td></tr></table></form>";

            if ($navlink <> '') {
                echo "Remember to [Update & Refresh] first! --> " . $navlink;
            }
            ?>