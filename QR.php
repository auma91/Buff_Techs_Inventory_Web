<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Buff Techs | Equipment Checkout</title>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style-new.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <header>
      <nav class="navbar">
        <br>
        <img style="" width="30%" src="BT_Swiper_OIT_White.png" alt="">
        <br>
        <h3 style =""><a style="color:inherit;" id="link">Buff Techs Inventory</a></h3>
      </nav>
    </header>
    <div class="body-fit">
      <div style="padding-top:25px;" class="row">
        <div class="column-QR">
          <div class="card">
            <form id="itemsub" method="get">
              <input id="item" type="text" name="item" value="item"/>
              <input type="submit" class="button button-gold" name="button" value="Generate"/>
              <input style="visibility: hidden;" type="text" name="token" value="193a12c753f3d281138137ec55439bbffc64b09648decc6d60461799a067ae51">
            </form>
            <?php
              include('./php/qrlib.php');
              //set it to writable location, a place for temp generated PNG files
              if(isset($_REQUEST['item'])) {
                $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
                //html PNG location prefix
                $PNG_WEB_DIR = 'temp/';
                $ITEMNAME = $_REQUEST['item'];
                //ofcourse we need rights to create temp dir
                if (!file_exists($PNG_TEMP_DIR))
                    mkdir($PNG_TEMP_DIR);
                $filename = $PNG_TEMP_DIR.$ITEMNAME.'.png';
                $matrixPointSize = 4;
                $errorCorrectionLevel = 'L';
                //$filename = $PNG_TEMP_DIR.'test'.md5('Hello'.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
                QRcode::png('http://bt-server.colorado.edu/?token=193a12c753f3d281138137ec55439bbffc64b09648decc6d60461799a067ae51&deviceID='.$ITEMNAME, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
                //echo 'You can provide data in GET parameter: <a href="?data=like_that">like that</a>';

                echo '<a href="'.$PNG_WEB_DIR.basename($filename).'" download="'.$ITEMNAME.'.png'.'"> <img src="'.$PNG_WEB_DIR.basename($filename).'" /></a>';
                //echo '<script type="text/javascript">remove();</script>';
              }
             ?>
          </div>
        </div>
      </div>
      <br>
    </div>
    <footer>
      <div class="navbar-bottom">
        <h3 style="padding-left:10px;padding-top:10px;" style ="">Buff Techs Walk-In Tech Support</h3>
        <img width="30%" src="BT_Swiper_CUBoulder_White.png" style="display: hidden; padding-left:50px;">
      </div>
    </footer>
  </body>
  <script type="text/javascript">
    $("#link").attr("href", ""+"http://bt-server.colorado.edu/?token=193a12c753f3d281138137ec55439bbffc64b09648decc6d60461799a067ae51" )
  </script>
</html>
