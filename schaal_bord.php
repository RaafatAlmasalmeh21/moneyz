<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>schaalbord</title>
</head>
<body>
    <table align="center" width="800" height="800" border="1">
        <?php for($row=1; $row<=8; $row++){
            echo"<tr>";
         for($col=1; $col<=8; $col++){
             $total=$row+$col;
             if($total%2 == 0){
                echo  '<td style="width:30px; height:30px; background: #000"></td>';
             }else{
                 echo'<td style="width:30px; height:30px; background: #fff"></td>';
             }
          }
          echo"</tr>";
        }
        ?>
    
    </table>
</body>
</html>