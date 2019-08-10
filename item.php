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
        <h3 style ="">Buff Techs Inventory</h3>
      </nav>
    </header>
    <?php
    $token = $_REQUEST['token'];
    //Get address variable ex: www.nonsense.com/site?token=193a12c753f3d281138137ec55439bbffc64b09648decc6d60461799a067ae51&deviceID=ssd1
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
      if(!empty($name)){
        checkInventory($name, $deviceID);
        document.write('');
        die();
      }
      else{
        echo "ERROR: Enter Identikey!";
      }
    }
    ?>
    <div class="body-fit">
      <div style="padding-top:25px;" class="row">
        <div class="column-QR">
          <div id="card-append" class="card">
            <h1>Qr generator by link</h1>
            <form id="itemsub" method="get">
              <input id="item" type="text" name="" value="item">
              <button type="submit" name="button">Gennerate</button>
            </form>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="application/javascript" src="./js/QR/qrcodegen.js"></script>
  <script type="application/javascript" src="./js/saveSvgAsPng/saveSvgAsPng.js"></script>
  <script type="text/javascript">
    // Name abbreviated for the sake of these examples here
    $("form").submit(function(){
      var QRC = qrcodegen.QrCode;
      var link_abbrev = 'http://localhost/concept/?token=193a12c753f3d281138137ec55439bbffc64b09648decc6d60461799a067ae51&deviceID=';
      var item = $('input:first').val();
      console.log(item);
      // Simple operation
      var qr0 = QRC.encodeText(link_abbrev+item, QRC.Ecc.MEDIUM);
      var svg = qr0.toSvgString(4);
      $('form').remove();
      $('#card-append').append('<a href = "bt-server.colorado.edu"></a>');
      $('#card-append').append(''+svg);
      $('svg').attr('id',item);
      saveSvgAsPng(document.getElementById(item), item+".png");
      console.log(svg);
    });
  </script>
</html>
