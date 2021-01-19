<?php  include('connect.php');  

    if (isset($_GET['edit'])) {
        $mid = $_GET['edit'];
        $update == true;
        $record = mysqli_query($db, "SELECT * FROM menucard WHERE mid=$mid");

        if (mysqli_num_rows($record) == 1 ) {
            $n = mysqli_fetch_array($record);
            $mname =  $n['mname'];
            $mprice = $n['mprice'];
        }
    }

     if (isset($_POST['save'])) {
       
        $mname = $_POST['mname'];
        $mprice = $_POST['mprice'];

        $q1="INSERT INTO menucard VALUES('' ,'$mname' , '$mprice')";
        mysqli_query($db,$q1);
            $_SESSION['message'] = "Data saved";       
    }

    if (isset($_POST['update'])) {
         $mid = $_POST['mid'];
        $mname = $_POST['mname'];
        $mprice = $_POST['mprice'];

        mysqli_query($db, "UPDATE menucard SET  mname='$mname' , mprice='$mprice'  WHERE mid=$mid");
        $_SESSION['message'] = "Data updated!"; 
        }

    if (isset($_GET['del'])) {
    $mid = $_GET['del'];
    mysqli_query($db, "DELETE FROM menucard WHERE mid=$mid");
    $_SESSION['message'] = "Data deleted!"; 
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Restaurant Management System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="msg">
            <?php 
                echo $_SESSION['message']; 
                unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?>
    <?php $results = mysqli_query($db, "SELECT * FROM menucard"); ?>
<button  onclick="document.location='admin.php'" >BACK</button>
<table>
    <thead>
        <tr>
            
            <th>Name</th>
            <th >Price</th>
            <th colspan="2">Action</th>
        </tr>
    </thead> 

<center> <img src="m21.jpg"  width="300" height="250"> </center>

 <?php while ($row = mysqli_fetch_array($results)) { ?>
        <tr>
            <td><?php echo $row['mname']; ?></td>
            <td><?php echo $row['mprice']; ?></td>

            <td>
                <a href="item.php?edit=<?php echo $row['mid']; ?>" class="edit_btn"  >Edit</a>
            </td>

            <td>
                <a href="item.php?del=<?php echo $row['mid']; ?>" class="del_btn" >Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>

    <form method="post" action="item.php" >
        <div class="input-group">
            <input type="hidden" name="mid" value="<?php echo $mid; ?>">
            <label>Name</label>
            <input type="text" name="mname" value="<?php echo $mname; ?>">
        </div>
        <div class="input-group">
            <label>Price</label>
            <input type="text" name="mprice" value="<?php echo $mprice; ?>">
        </div>
        <div class="input-group">
            <?php if ($update == true): ?>
    <input  class="btn" type="submit" name="update" value= "UPDATE" style="background: white;" >
    <?php else: ?>
    <input  class="btn" type="submit" name="save" value= "SAVE" >
<?php endif ?>
        </div>
    </form>
</body>
</html>   