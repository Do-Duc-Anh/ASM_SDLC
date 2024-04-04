<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <style>
        body {
            background-image: url('image/chill3.gif');
            background-size: cover;
            background-color: #FF9933;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            border: 1px solid #FFFF00;
            padding: 20px;
            background-color: #FFFFFF;
        }
        table, th, td {
            border: 2px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #FFFF00;
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
        input[type="text"], input[type="submit"], input[type="reset"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"], input[type="reset"] {
            background-color: #0056b3;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: #0056b3;
        }
        input[type="submit"]:focus, input[type="reset"]:focus {
            outline: none;
        }
        .required {
            color: red;
        }
    </style>
</head>
<body>
    <?php
    include "db_conn.php";
    $sql = "select * from students";
    //Executing query
    $result = mysqli_query($conn,$sql);
    ?>

    <table align="center" border="1px" cellpadding="0" cellspacing="0">
    <caption align="center">Student List</caption>
    <tr>
        <th>Rollno</th>
        <th>Student Fullname</th>
        <th>Address</th>
        <th>Email</th>
        <th>Action</th> <!-- New Column for Action Buttons -->
    </tr>

    <?php
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {        
    ?>
    <tr>
        <td><?php echo $row['Rollno']; ?></td>
        <td><?php echo $row['Sname']; ?></td>
        <td><?php echo $row['Address']; ?></td>
        <td><?php echo $row['Email']; ?></td>
        <td class="action-buttons">
            <a href="editStudent.php?id=<?php echo $row['Rollno']; ?>">Edit</a>
            <a href="deleteStudent.php?id=<?php echo $row['Rollno']; ?>" onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
        </td> <!-- Edit and Delete Buttons -->
    </tr>
    <?php
        }
    ?>
    </table>
    
    <!-- Add student -->
    <?php
    include "db_conn.php";
    if(isset($_POST['btnAdd']))
    {
        //Get data from student form
        $Rollno = $_POST['Rollno'];
        $Sname = $_POST['Sname'];
        $Address = $_POST['Address'];
        $Email = $_POST['Email'];
        if($Rollno=="" || $Sname=="" || $Address=="" || $Email=="")
        {
            echo "(*) is not empty";
        }
        else
        {
            //Retrieving data from table
            $sql = "select Rollno from students where Rollno='$Rollno'";
            //Executing query
            $result = mysqli_query($conn,$sql);
            //Testing exist data and then insert into table
            if(mysqli_num_rows($result)==0)
            {
                $sql = "INSERT INTO students VALUES ('$Rollno', '$Sname', '$Address', '$Email')";
                mysqli_query($conn,$sql);
                echo '<meta http-equiv="refresh" content="0; URL=StudentList.php"';
            }
            else
            {
                echo "Existed student in list";
            }

        }
    }
    ?>

    <!-- Search form -->
    <div style="text-align: center; margin-bottom: 20px;">
        <form method="post" style="margin-bottom: 10px;">
            <select name="search_criteria">
                <option value="Sname">Name</option>
                <option value="Address">Address</option>
                <option value="Email">Email</option>
            </select>
            <input type="text" name="search" placeholder="Enter search keyword">
            <button type="submit" name="btnSearch">Search</button>
        </form>
    </div>

    <div class="add-student-form">
        <form method="post">
           <caption><b>Adding Student</b></caption> 
           <div>
                <label for="Rollno">Rollno:</label>
                <input type="text" name="Rollno" id="Rollno" required/>
           </div>

           <div>
                <label for="Sname">Student Name:</label>
                <input type="text" name="Sname" id="Sname" required/>
           </div>

           <div>
                <label for="Address">Student Address:</label>
                <input type="text" name="Address" id="Address" required/>
           </div>

           <div>
                <label for="Email">Student Email:</label>
                <input type="text" name="Email" id="Email" required/>
           </div>

           <div>
                <input type="submit" value="Add" name="btnAdd"/>
                <input type="reset" value="Delete All" name="btnbtnDeleteAll"/>
           </div>
        </form>
    </div>
    <form method="post" action="logout.php">
        <button type="submit" name="logout">Logout</button>
    </form>
</body>
</html>
