<?php
/**
 * Created by Gayan Hewa
 * User: Gayan
 * Date: 6/7/13
 * Time: 2:35 AM
 */
?>
<html>
<head>
    <title>XML CRUD APP</title>
</head>
<body>
    <ul>
        <li><a href="process.php?list">List All Users</a></li>
        <li>
            <form method="POST" action="process.php?filter">
                <input type="text" value='' name="pers"/>
                <input type="submit" value="Filter"/>
            </form>
        </li>
        <li><a href="process.php?add">Add User</a></li>
    </ul>
</body>
</html>







