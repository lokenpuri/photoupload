<?php 
include 'upload.php';
 ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
<form method="post" action="" enctype="multipart/form-data">
    <input type="file" name="file"><br><br>
    <input type="submit" name="submit">
</form>

<?php

  if (isset($_POST['submit'])) {
      //var_dump($_FILES);
    $temp_name = $_FILES['file']['tmp_name'];
    $image_name=$_FILES['file']['name'];
    $location='upload/'.$image_name;
    move_uploaded_file($temp_name, $location);
   //var_dump($image_name);
    $query = mysqli_query($mysqli, "INSERT into uploads(name) values('".$image_name."')");   
}
?>
    
        <?php 
         $result = mysqli_query($mysqli, "SELECT * FROM uploads");
         ?>
        
         <table width="40%" border="1px">
            <thead>
                <th>Name</th>
                <th>Action</th>
            </thead>
        <?php 
	if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){ ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
               
                <td>
                    <a href="index.php?display=<?php echo $row['id']; ?>" class="display_btn">Display</a>
                </td>
        </tr>
	<?php } 
        } else {
            echo 'zero records';    
        }
        
	?>     
    </table> 
        
        <?php if(isset($_GET['display'])){
            $id = $_GET['display'];
            $result = mysqli_query($mysqli, "SELECT * from uploads WHERE id=$id");
            $row = mysqli_fetch_assoc($result);
          
            $image = $row['name'];
            $image_src = "upload/".$image;      
        }
      
            ?>
        <img src='<?php echo $image_src;  ?>' height="400" width="400">
      
    </body>
</html>
