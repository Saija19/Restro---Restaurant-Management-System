<?php include('connect.php');

if (isset($_GET['edit'])) 
{
        $wid = $_GET['edit'];
        $update = true;
        $record = mysqli_query($db, "SELECT * FROM waiter WHERE wid=$wid");

        if (mysqli_num_rows($record) == 1 ) 
        {
            $n = mysqli_fetch_array($record);
            $wname = $n['wname'];
            $tableNo = $n['tableNo'];

            
        }
    }

     if (isset($_POST['save'])) 
     {
        $wname = $_POST['wname'];
        $tableNo = $_POST['tableNo'];
       
        
        $q1="INSERT INTO waiter VALUES('' ,'$wname', '$tableNo')";
        mysqli_query($db,$q1);
            $_SESSION['message'] = "Record Added";       
    }

    if (isset($_POST['update'])) 
    {
        $wid = $_POST['wid'];
        $wname = $_POST['wname'];
        $tableNo = $_POST['tableNo'];
        
       
        mysqli_query($db, "UPDATE waiter SET wname='$wname', tableNo='$tableNo'  WHERE wid=$wid");
    $_SESSION['message'] = "Record Updated"; 
    }

    if (isset($_GET['del'])) 
    {
    $wid = $_GET['del'];
    mysqli_query($db, "DELETE FROM waiter WHERE wid=$wid");
    $_SESSION['message'] = "Record Deleted"; 
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
    <?php $results = mysqli_query($db, "SELECT * FROM waiter"); ?>
<button  onclick="document.location='admin.php'" >BACK</button>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Table No.</th>
    

            <th colspan="2">Action</th>
        </tr>
    </thead>

    <center> <img src="m17.jpg"  width="300" height="250"> </center>

    <?php while ($row = mysqli_fetch_array($results)) 
    { ?>
        <tr>
            <td><?php echo $row['wname']; ?></td>
            <td><?php echo $row['tableNo']; ?></td>
           
            

            <td>
                <a href="waiter.php?edit=<?php echo $row['wid']; ?>" class="edit_btn" >Edit</a>
            </td>
            <td>
                <a href="waiter.php?del=<?php echo $row['wid']; ?>" class="del_btn">Delete</a>
            </td>
        
        </tr>
    <?php } ?>
</table>


    <form method="post" action="waiter.php" >
        
        <div class="input-group">
            <input type="hidden" name="wid" value="<?php echo $wid; ?>">
            <label>Name</label>
            <input type="text" name="wname" value="<?php echo $wname; ?>">
        </div>
        <div class="input-group">
            <label>Table No.</label>
            <input type="text" name="tableNo" value="<?php echo $tableNo; ?>">
        </div>
        
        <div class="input-group">
            <?php if ($update == true): ?>
            <input class="btn" type="submit" name="update" value="SAVE" style="background: #556B2F;" >
            <?php else: ?>
            <input class="btn" type="submit" name="save" value="SAVE" >
            <?php endif ?>
        </div>
    </form>
</body>
</html>   