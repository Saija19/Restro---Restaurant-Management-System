<?php include('connect.php');

if (isset($_GET['edit'])) 
{
        $customerId = $_GET['edit'];
        $update = true;
        $record = mysqli_query($db, "SELECT * FROM customer WHERE customerId=$customerId");

        if (mysqli_num_rows($record) == 1 ) 
        {
            $n = mysqli_fetch_array($record);
            $name = $n['name'];
            $tableNo = $n['tableNo'];
            $billAmount =  $n['billAmount'];
            
        }
    }

     if (isset($_POST['save'])) 
     {
        $name = $_POST['name'];
        $tableNo = $_POST['tableNo'];
        $billAmount = $_POST['billAmount'];
        
        $q1="INSERT INTO customer VALUES('' ,'$name', '$tableNo', '$billAmount')";
        mysqli_query($db,$q1);
            $_SESSION['message'] = "Record Added";       
    }

    if (isset($_POST['update'])) 
    {
        $customerId = $_POST['customerId'];
        $name = $_POST['name'];
        $tableNo = $_POST['tableNo'];
        $billAmount = $_POST['billAmount'];
       
        mysqli_query($db, "UPDATE customer SET name='$name', tableNo='$tableNo',billAmount='$billAmount'  WHERE customerId=$customerId");
    $_SESSION['message'] = "Record Updated"; 
    }

    if (isset($_GET['del'])) 
    {
    $customerId = $_GET['del'];
    mysqli_query($db, "DELETE FROM customer WHERE customerId=$customerId");
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
    <?php $results = mysqli_query($db, "SELECT * FROM customer"); ?>
<button  onclick="document.location='admin.php'" >BACK</button>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Table No.</th>
            <th>Bill Amount</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    
    <center> <img src="m20.jpg"  width="300" height="250"> </center>

    <?php while ($row = mysqli_fetch_array($results)) 
    { ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['tableNo']; ?></td>
            <td><?php echo $row['billAmount']; ?></td>
            
            <td>
                <a href="customer.php?edit=<?php echo $row['customerId']; ?>" class="edit_btn" >Edit</a>
            </td>
            <td>
                <a href="customer.php?del=<?php echo $row['customerId']; ?>" class="del_btn">Delete</a>
            </td>
            <td>
                <a href="bill.php" class="bill_btn" >Bill</a>
            </td>
        </tr>
    <?php } ?>
</table>


    <form method="post" action="customer.php" >
        
        <div class="input-group">
            <input type="hidden" name="customerId" value="<?php echo $customerId; ?>">
            <label>Name</label>
            <input type="text" name="name" value="<?php echo $name; ?>">
        </div>

        <div class="input-group">
            <label>Table No.</label>
            <input type="text" name="tableNo" value="<?php echo $tableNo; ?>">
        </div>

        <div class="input-group">
            <label>Bill Amount</label>
            <input type="text" name="billAmount" value="<?php echo $billAmount; ?>">
        
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