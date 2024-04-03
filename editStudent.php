<?php
include "db_conn.php";

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM students WHERE Rollno='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}

if(isset($_POST['btnUpdate'])) {
    $Rollno = $_POST['Rollno'];
    $Sname = $_POST['Sname'];
    $Address = $_POST['Address'];
    $Email = $_POST['Email'];

    $sql = "UPDATE students SET Sname='$Sname', Address='$Address', Email='$Email' WHERE Rollno='$Rollno'";
    if(mysqli_query($conn, $sql)) {
        header("Location: studentList.php");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <style>
        body {
            background-image: url('image/chill.gif');
            background-size: auto;
            font-family: Arial, sans-serif;
            margin: 40px;
            padding: 40px;
            background-color: #CCCCFF;
        }
        h2{
            text-align: center;
            margin-top: 40px;
        }
        caption {
            font-size: 20px;
            margin-bottom: 20px;
        }
        form {
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            background-color: #FF9933;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="submit"], input[type="reset"] {
            background-color: #0066FF;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: #4169E1;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h2>Edit Student</h2>
    <form method="post">
        <input type="hidden" name="Rollno" value="<?php echo $row['Rollno']; ?>">
        Student Name: <input type="text" name="Sname" value="<?php echo $row['Sname']; ?>"><br><br>
        Address: <input type="text" name="Address" value="<?php echo $row['Address']; ?>"><br><br>
        Email: <input type="text" name="Email" value="<?php echo $row['Email']; ?>"><br><br>
        <input type="submit" name="btnUpdate" value="Update">
    </form>
</body>
</html>
