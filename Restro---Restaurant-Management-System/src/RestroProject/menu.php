<?php  include('connect.php'); ?>

<!DOCTYPE html>
<html>
<head>
         <title>Restaurant Management System</title>
    <link rel="stylesheet" href="style2.css">

</head>
<body>


<pre>                                  <img src="m1.jpeg"  width="250" height="250"><img src="m2.jpeg"  width="250" height="250"><img src="m3.jpeg"  width="250" height="250"><img src="m4.jpeg"  width="250" height="250"><img src="m5.jpeg"  width="250" height="250"><img src="m6.jpeg"  width="250" height="250"><img src="m7.jpeg"  width="250" height="250"> </pre>

<?php $results = mysqli_query($db, "SELECT * FROM menucard"); ?>
 
 <div style="text-align: center; color: grey; font-style: italic;">
       <h2>MENU<h2>
 </div>

 <center>

<table>
            <t3>Name</th>
            <t3>Price</th> 
    <thead>
        <tr>
        </tr>
    </thead>
    
    <?php while ($row = mysqli_fetch_array($results)) { ?>
        <tr>
                        <td><?php echo $row['mname']; ?></td>
                        <td><?php echo $row['mprice']; ?></td>
        </tr>
    <?php } ?>
</table>
</div>
<center>
 <input type="submit" class="fadeIn first" onclick="document.location='index.php'" value="HOME">

 <pre>           <img src="m1.jpeg"  width="250" height="250"><img src="m2.jpeg"  width="250" height="250"><img src="m3.jpeg"  width="250" height="250"><img src="m4.jpeg"  width="250" height="250"><img src="m5.jpeg"  width="250" height="250"><img src="m6.jpeg"  width="250" height="250"><img src="m7.jpeg"  width="250" height="250"> </pre>

 </center>
</body>
</html>   