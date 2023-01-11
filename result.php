<?php

include("navbar.html");
$connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego");

 

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}



$SetID = $_GET['set'];

$setname  = mysqli_query($connection, "SELECT sets.Setname FROM sets WHERE sets.SetID= '$SetID'");
$nameArray = mysqli_fetch_array($setname);
$setnamedisplay = $nameArray['Setname'];


$info = mysqli_query($connection, "SELECT inventory.Quantity, inventory.SetID , inventory.ItemID, parts.Partname, images.ItemID, images.ItemtypeID,images.ColorID,
images.has_gif, images.has_jpg, images.has_largegif, images.has_largejpg, colors.Colorname 
FROM inventory, colors, images, parts
WHERE
inventory.SetID =  '$SetID'AND colors.ColorID=inventory.ColorID AND images.ItemID=inventory.ItemID AND images.ColorID=inventory.ColorID
AND images.ItemtypeID=inventory.ItemtypeID AND parts.PartID=inventory.ItemID ORDER BY inventory.Quantity DESC");






  echo("
  <h3 class='mycss'> Parts included in set $SetID ($setnamedisplay):</h3>
<table>
   <tr class = 'displaybricks'>
     <td>Image </td>
     <td> part name </td>
     <td> Color </td>
     <td> Quantity </td>
   </tr>
</table>"

);


  


while   ($row =  mysqli_fetch_array($info)){



$invpart = $row['Partname'];

$invqual = $row['Quantity'];

$colorsname = $row['Colorname'];

$itemid = $row['ItemID'];

$itemtype = $row['ItemtypeID'];

$colorid = $row['ColorID'];

$gif = $row['has_gif'];

$jpg = $row['has_jpg'];

$imagesrc = "";





if ($jpg){

    $imagesrc = "http://www.itn.liu.se/~stegu76/img.bricklink.com/$itemtype/$colorid/$itemid.jpg";

    


}

else if ($gif){

    $imagesrc = "http://www.itn.liu.se/~stegu76/img.bricklink.com/$itemtype/$colorid/$itemid.gif";


}





print (

 "<table >
     <tr class = 'displaybricks'>
        <td> <img src= $imagesrc> </td>
        <td> $invpart </td>
        <td> $colorsname </td>
        <td> $invqual </td>
       
     </tr>
    <table>"

) ;

}


