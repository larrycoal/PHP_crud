<?php
    require('db_conn.php');

    $query = 'SELECT * FROM users;'; // replace with paramertized query using mysqli_stmt_bind_param for asynchronous work task
    $results = @mysqli_query($dbc,$query); // print_r($results);
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>
            User Details
        </title>
    </head>
    <body>
        <table width="80%">
            <thead>
                <tr align="left">
                    <th>ID</th>
                    <th>Sr. No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Province</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sr_no = 0;
                    while($row = mysqli_fetch_array($results, MYSQLI_ASSOC)){
                        $sr_no++;
                        $str_to_print = "";
                        $str_to_print = "<tr> <td>{$row['user_id']}</td>";
                        $str_to_print .= "<td>$sr_no</td>";
                        $str_to_print .= "<td> {$row['name']}</td>";
                        $str_to_print .= "<td> {$row['email']}</td>";
                        $str_to_print .= "<td> {$row['phone']}</td>";
                        $str_to_print .= "<td> {$row['province']}</td>";
                        $str_to_print .= "<td> <a href='edit_user.php?user_id={$row['user_id']}'>Edit</a> | <a href='delete_user.php?user_id={$row['user_id']}'>Delete</a> </td> </tr>";

                        echo $str_to_print;
                    }
                ?>
            </tbody>
        </table>
    </body>
</html>











