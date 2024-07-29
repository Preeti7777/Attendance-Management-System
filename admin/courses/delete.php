<?php require('../config/config.php');

     if(isset($_GET['id'])){
        $id=$_GET['id'];
        $delete ="DELETE FROM courses WHERE id=$id";
        $result=mysqli_query($conn,$delete);

    }
    if($result){
    echo "<meta http-equiv=\"refresh\" content=\"1;URL=index.php?sms=deleted\">";
    //header(Location:index.php?sms=deleted);
    }
    else{
        echo "<meta http-equiv=\"refresh\" content=\"1;URL=index.php?sms=error\">";
    }
?>