<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>QR Gen PHP</title>
  </head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript">
    function remove() {
      console.log("Remove form");
      $("form").remove();
    }
    function add() {
      //$('#code').remove();
      var form = '<form id="itemsub" action="test.php" method="get"><input id="item" type="text" name="item" value="item"><button type="submit" name="button">Gennerate</button></form>';
      $('button').remove();
      $('img').remove();
      $("body").append(form);
    }
  </script>
  <body>
    <form id="itemsub" action="test.php" method="get">
      <input id="item" type="text" name="item" value="item">
      <button type="submit" name="button">Gennerate</button>
    </form>
    <?php
      include('./php/qrlib.php');
      //set it to writable location, a place for temp generated PNG files
      if(isset($_REQUEST['item'])) {
        $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
        //html PNG location prefix
        $PNG_WEB_DIR = 'temp/';
        //ofcourse we need rights to create temp dir
        if (!file_exists($PNG_TEMP_DIR))
            mkdir($PNG_TEMP_DIR);
        $filename = $PNG_TEMP_DIR.$_REQUEST['item'].'.png';
        $matrixPointSize = 4;
        $errorCorrectionLevel = 'L';
        //$filename = $PNG_TEMP_DIR.'test'.md5('Hello'.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);
        //echo 'You can provide data in GET parameter: <a href="?data=like_that">like that</a>';
        echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" />';
        echo '<script type="text/javascript">remove();</script>';
        echo '<button onclick="add()" name="button">Add New Item</button>';
      }
     ?>
  </body>
</html>
