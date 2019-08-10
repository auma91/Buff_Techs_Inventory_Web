
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Buff Techs | Equipment Checkout</title>
    <link rel="icon" href="http://bt-server.colorado.edu/favicon.ico" type="image/x-icon" />
    <?php
      $token = $_REQUEST['token'];
      //Get address variable ex: http://bt-server.colorado.edu?token=193a12c753f3d281138137ec55439bbffc64b09648decc6d60461799a067ae51&deviceID=ssd1
      if ($token != "193a12c753f3d281138137ec55439bbffc64b09648decc6d60461799a067ae51"){
        //var_dump(http_response_code(403));
        echo "Insufficient Permissions";
        die();
      }
    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style-new.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <header>
      <nav class="navbar">
        <br>
        <img style="" src="BT_Swiper_OIT_White.png" alt="">
        <br>
        <h3 style ="">Buff Techs Inventory</h3>
      </nav>
    </header>
    <div class="body-fit">
      <div style="padding-top:25px;" class="row">
        <div class="column">
          <div class="card">
            <?php
            $token = $_REQUEST['token'];
            //Get address variable ex: www.nonsense.com/site?token=193a12c753f3d281138137ec55439bbffc64b09648decc6d60461799a067ae51&deviceID=ssd1
            if ($token != "193a12c753f3d281138137ec55439bbffc64b09648decc6d60461799a067ae51"){
            	var_dump(http_response_code(403));
            	die();
            }
            ?>
            </head>
            <br>
            <body>
            <?php
            //Get address variable ex: www.nonsense.com/site?deviceID=ssd1
            //Device IDS: ssd1, ssd2, AB1, AB2
            $deviceID = $_REQUEST['deviceID'];
            //Security token


            function checkInventory($name, $deviceID){
            	//Search checked out inventory for device
            	//Search for deviceID in checked out
            	$searchthis = $deviceID;
            	$matches = array();
            	$handle = @fopen("secrets/checkedout.txt", "r");
            	if ($handle)
            	{
            	    while (!feof($handle))
            	    {
            	        $buffer = fgets($handle);
            	        if(strpos($buffer, $searchthis) !== FALSE)
            	            $matches[] = $buffer;
            	    }
            	    fclose($handle);
            	}

            	//check if it is already checked out
            	if (empty($matches)){
            		checkout($deviceID, $name);
            	}
            	else{
            		//print_r($matches[0]);
            		checkin($deviceID, $name, $matches[0]);
            	}
            }

            //File operations
            function writeLog($text, $deviceID, $name) {
                $file = 'secrets/log.txt';
                $line = $text;
                file_put_contents($file, $line, FILE_APPEND | LOCK_EX);
                echo "<br>wrote log!\n";
            }
            function checkout($deviceID, $name) {
                $file = 'secrets/checkedout.txt';
                $line = $name.";".$deviceID.";".time()."\n";
                file_put_contents($file, $line, FILE_APPEND | LOCK_EX);
                echo "checked out item";
            	writeLog($name." checked out ".$deviceID." at ".time()."\n", $deviceID, $name);
            }
            function checkin($deviceID, $name, $lineDel) {
                $file = 'secrets/checkedout.txt';
                $line = $lineDel;
                $contents = file_get_contents($file);
            	$contents = str_replace($line, '', $contents);
            	file_put_contents($file, $contents);
            	echo "checked in item";
            	writeLog($name." checked in ".$deviceID." at ".time()."\n", $deviceID, $name);
            }

            //Form
            if(isset($_POST['submit']))
            {
            	$name=$_POST['name'];
            	if(!empty($name) && !empty($deviceID)){
            		checkInventory($name, $deviceID);
	            	document.write('');
	            	die();
            	}
            	else{
            		echo "ERROR: Enter Identikey!";
            	}

            }
            ?>

            <form method="post">
            Enter your identikey <input type="text" name="name"/><hr/>
            <input type="submit" class="button button-gold" name="submit" value="SUBMIT"/>
            </form>
            <!--Print Diagnostic info-->
            <br><br>
            Your device is <?php echo $deviceID ?>
          </div>
        </div>
        <div class="column">
          <div style="font-family: Helvetica Neue" class="card">
            <div class="flip-container">
              <div class="flipper">
                <div class="front">
                  <h1>Checkedout</h1>
                  <?php
                    $fn = @fopen("secrets/checkedout.txt","r");
                    while(!feof($fn))  {
                  	   $result = fgets($fn);
                       if(empty($result)) {break;}
                       $str_arr = explode (";", $result);
                       $dt = new DateTime("@$str_arr[2]");
                       $tm = new DateTimeZone( "MST" );
                       $dt->setTimeZone($tm);
                  	   echo "<h2> Identikey: " . $str_arr[0] . ", checkedout device " . $str_arr[1] . " at " . $dt->format('h:i:s a') . "</h2>";
                    }
                    fclose($fn);
                  ?>
                </div>
                <div class="back">
			<img width="30%" src="BT_Swiper_OIT_White.png" alt="Avatar">
			<h1>Log</h1>
                </div>
                            </div>
            </div>
            <br>
            <input type="submit" class="button button-gold" name="submit" value="Flip" onclick="switchCard()">
          </div>
        </div>
      </div>
      <br>
    </div>
    <footer>
      <div class="navbar-bottom">
        <h3 style="padding-left:10px;padding-top:10px;" style ="">Buff Techs Walk-In Tech Support</h3>
        <img src="BT_Swiper_CUBoulder_White.png">
      </div>

    </footer>
  </body>
</html>
