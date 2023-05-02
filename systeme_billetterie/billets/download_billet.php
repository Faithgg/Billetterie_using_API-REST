<?php
namespace chillerlan\QRCodeExamples;
header(" multipart/form-data; boundary=something");
use chillerlan\QRCode\{QRCode, QROptions};

$data = filter_input(INPUT_GET,"url");
$nom =  filter_input(INPUT_GET,"nom");
$date =  filter_input(INPUT_GET,"date");
$event =  filter_input(INPUT_GET,"event");
$lieu =  filter_input(INPUT_GET,"lieu");
$code =  filter_input(INPUT_GET,"code");
$id =  filter_input(INPUT_GET,"id");
$generation =  filter_input(INPUT_GET,"generation");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
    <style>
    .ticket {
      width: 600px;
      height: 150px;
      background-color: #ffffff;
      border: 1px solid #000;
      padding: 10px;
      position: relative;
    }
    .qr-code {
      width: 145px;
      height: 145px;
      background-color: #fff;
      border: 1px solid #000;
      position: absolute;
      top: 10px;
      right: 10px;
    }
    .qr-code img {
      width: 100%;
      height: 100%;
    }

    .ticket-info {
      background-color: #FFDD33;
      width: 350px;
      height: 30px;
      margin-left:-3%;
      margin-top:1%;
      border: 0.10px solid black;
      display:flex;
      align-items: center;
    }

    .ticket-details {
      font-size: 13px;
    }

    .code-public {
      font-size: 15px;
    }
  </style>
</head>
<body>
<?php
function billet ($data,$nom,$date,$event,$lieu ,$code,$id,$generation ) {
?>
     <div class="ticket">
        <div class="qr-code">
        <!-- Code QR -->
        <img src="./display_QR_code.php?url=<?= $data ?>" alt="QR-code">
        </div>
        <div class="ticket-info">
        <p class="ticket-details" style="width: 225px;margin-left: 3%;">BILLETS N"<?= $id?> généré le <?= $generation ?></p>
        </div>
        <div>
            <p class="ticket-details" >Propriégé du visiteur: <strong><?= $nom ?></strong></p>
            <p class="ticket-details" style="margin-top: -1%;">Valide pour l'evénement: <strong><?= $event ?></strong></p>
        <p class="ticket-details" style="margin-top: -1%;">Date: <strong><?= $date ?></strong></p>
        <p class="ticket-details" style="margin-top: -1%;">Lieu: <strong><?= $lieu ?></strong></p>
        <p class="code-public" style="margin-top: -1%;"> Code public du billet: <strong><?= $code ?></strong></p>
        </div>
    </div>
</body>
</html>
  <?php
}


billet ($data,$nom,$date,$event,$lieu ,$code,$id,$generation );