<?php  include('connect.php'); 
 
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $update = true;
        $record = mysqli_query($db, "SELECT * FROM menu WHERE id=$id");

        if (mysqli_num_rows($record) == 1 ) {
            $n = mysqli_fetch_array($record);
            $mid = $n['mid'];
            $mname = $n['mname'];
            $mprice =  $n['mprice'];
        }
    }

     if (isset($_POST['save'])) {
        $mid = $_POST['mid'];
        $mname = $_POST['mname'];
        $mprice = $_POST['mprice'];

        $q1="INSERT INTO menu VALUES('' , '$mname', '$mprice')";
        mysqli_query($db,$q1);
            $_SESSION['message'] = "DISH ADDED";       
    }

    if (isset($_POST['update'])) {
        $mid = $_POST['mid'];
        $mname = $_POST['mname'];
        $mprice = $_POST['mprice'];


    mysqli_query($db, "UPDATE menu SET  mname='$mname', mprice='$mprice',WHERE id=$id");
    $_SESSION['message'] = "DISH UPDATED!"; 
    }

if (isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($db, "DELETE FROM menu WHERE id=$id");
    $_SESSION['message'] = "DATA DELETED!"; 
    }
?>


<!DOCTYPE html>
<html>
<head>
    <title>Restaurant Manangement System</title>
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
    <?php $results = mysqli_query($db, "SELECT * FROM menu"); ?>
<button  onclick="document.location='admin.php'" >BACK</button>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    
    <?php while ($row = mysqli_fetch_array($results)) { ?>
        <tr>
            <td><?php echo $row['mid']; ?></td>
            <td><?php echo $row['mname']; ?></td>
            <td><?php echo $row['mprice']; ?></td>

            <td>
                <a href="adminmenu.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
            </td>
            <td>
                <a href="adminmenu.php?deldl=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>


    <form method="post" action="adminmenu.php" >
        
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
            <input class="btn" type="submit" name="update" value="UPDATE" style="background: #556B2F;" >
            <?php else: ?>
            <input class="btn" type="submit" name="save" value="SAVE" >
            <?php endif ?>
        </div>
    </form>
</body>
</html>   