<?php
include("search.html");
switch($_POST['selectedValue']){
    case 'Set-id':
     
        $connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego");
 
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
    
        $SetID = $_POST['text'];
    
        $query = "SELECT * FROM sets WHERE SetID = '$SetID'";
    
    
    $searchid = mysqli_query($connection, "SELECT sets.SetID, images.has_largejpg, images.has_largegif, images.has_jpg, images.has_gif FROM sets, images
    WHERE sets.SetID LIKE '$SetID' AND images.ItemtypeID = 'S' AND images.ItemID = sets.SetID");
    
        while($row = mysqli_fetch_array($searchid)){
             
          
            $set_name = $row['Setname'];
            $setid1 = $row['SetID'];
            $itemid = $row['ItemID'];
            $gif = $row['has_gif'];
            $jpg = $row['has_jpg'];
            $gifL = $row['has_largegif'];
            $jpgL = $row['has_largejpg'];
    
          
        
             
            
    $gifL = $row['has_largegif'];
            if ($jpgL){
                $imagesrc = "http://www.itn.liu.se/~stegu76/img.bricklink.com/SL/$setid1.jpg";
            }
    
            else if  ($jpg){
                $imagesrc = "http://www.itn.liu.se/~stegu76/img.bricklink.com/SL/$setid1.gif";   
            }
            else {
                $imagesrc = "https://weber.itn.liu.se/~stegu76/img.bricklink.com/SL/375-2.jpg"; 
    
            }
            
            print("<p>$itemid </p>"); 
            print("<p>$set_name</p>");
            print("<p>$setid1</p>");
            print("<img src= $imagesrc  id='$setid1' onclick='inspectSet(this.id)'>");  // Hans fixar det
    
    
    
            //Checks format of image
    
}
    break;
    case 'Set-name':

         
    $connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego");
 
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $setname = $_POST['text'];

   

$searchname = mysqli_query($connection, "SELECT sets.SetID, sets.Setname, images.has_largejpg, images.has_largegif, images.has_jpg, images.has_gif FROM sets, images
WHERE sets.Setname LIKE '%$setname%' AND images.ItemtypeID = 'S' AND images.ItemID = sets.SetID ORDER BY CASE
WHEN sets.Setname LIKE '$setname%' THEN 1
WHEN sets.Setname LIKE '%$setname' THEN 2
ELSE 3
END");



    while($row = mysqli_fetch_array($searchname)){
         
        $set_name = $row['Setname'];
        $setid1 = $row['SetID'];
        $itemid = $row['ItemID'];
        $gif = $row['has_gif'];
        $jpg = $row['has_jpg'];
        $gifL = $row['has_largegif'];
        $jpgL = $row['has_largejpg'];

      
    
         
        
$gifL = $row['has_largegif'];
        if ($jpgL){
            $imagesrc = "http://www.itn.liu.se/~stegu76/img.bricklink.com/SL/$setid1.jpg";
        }

        else if  ($jpg){
            $imagesrc = "http://www.itn.liu.se/~stegu76/img.bricklink.com/SL/$setid1.gif";   
        }
        else {
            $imagesrc = "kossa.jpg"; 

        }
        
        print("<p>$itemid </p>"); 
        print("<p>$set_name</p>");
        print("<p>$setid1</p>");
        print("<img src= $imagesrc  id='$setid1' onclick='inspectSet(this.id)'>");  // Hans fixar det

        //Checks format of image
}
        // do Something for Alphabetical

    break;
    default:
        // Something went wrong or form has been tampered.
    }


?>