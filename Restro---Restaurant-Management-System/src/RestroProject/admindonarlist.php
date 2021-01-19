<?php  include('configure.php'); 
 
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $update = true;
        $record = mysqli_query($db, "SELECT * FROM donorlist WHERE id=$id");

        if (mysqli_num_rows($record) == 1 ) {
            $n = mysqli_fetch_array($record);
            $name = $n['name'];
            $address = $n['address'];
            $phonenumber =  $n['phonenumber'];
            $dob =  $n['dob'];
            $gender = $n['gender'];
            $bloodgroup =  $n['bloodgroup'];
        }
    }

     if (isset($_POST['save'])) {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phonenumber = $_POST['phonenumber'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $bloodgroup = $_POST['bloodgroup'];

        $q1="INSERT INTO donorlist VALUES('' ,'$name', '$address', '$phonenumber', '$dob', '$gender', '$bloodgroup')";
        mysqli_query($db,$q1);
            $_SESSION['message'] = "Data saved";       
    }

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phonenumber = $_POST['phonenumber'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $bloodgroup = $_POST['bloodgroup'];


    mysqli_query($db, "UPDATE donorlist SET name='$name', address='$address',phonenumber='$phonenumber', dob='$dob', gender='$gender', bloodgroup='$bloodgroup'  WHERE id=$id");
    $_SESSION['message'] = "Data updated!"; 
    }


    if (isset($_GET['deldl'])) {
    $id = $_GET['deldl'];
    mysqli_query($db, "DELETE FROM donorlist WHERE id=$id");
    $_SESSION['message'] = "Data deleted!"; 
    }
?>


<!DOCTYPE html>
<html>
<head>
    <title>Blood Bank And Donor System</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
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
    <?php $results = mysqli_query($db, "SELECT * FROM donorlist"); ?>
<button  onclick="document.location='admincontrol.php'" >BACK</button>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Dob</th>
            <th>Contact</th>
            <th>Gender</th>
            <th>Blood Group</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    
    <?php while ($row = mysqli_fetch_array($results)) { ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['dob']; ?></td>
             <td><?php echo $row['phonenumber']; ?></td>
             <td><?php echo $row['gender']; ?></td>
            <td><?php echo $row['bloodgroup']; ?></td>

            <td>
                <a href="admindonarlist.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
            </td>
            <td>
                <a href="admindonarlist.php?deldl=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>


    <form method="post" action="admindonarlist.php" >
        
        <div class="input-group">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label>Name</label>
            <input type="text" name="name" value="<?php echo $name; ?>">
        </div>
        <div class="input-group">
            <label>Address</label>
            <input type="text" name="address" value="<?php echo $address; ?>">
        </div>
        <div class="input-group">
            <label>DOB</label>
            <input type="date" name="dob" value="<?php echo $dob; ?>">
        </div>
        <div class="input-group">
            <label>Contact</label>
            <input type="text" name="phonenumber" value="<?php echo $phonenumber; ?>">
        </div>
         <div class="input-group">
            <label>Gender</label>
            <input type="text" name="gender" value="<?php echo $gender; ?>">
        </div>
        <div class="input-group">
            <label>Bloodgroup</label>
            <input type="text" name="bloodgroup" value="<?php echo $bloodgroup; ?>">
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