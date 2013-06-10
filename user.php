<?php if (!isset($id) || $id == "") :?>
<h3>Add New Record</h3>
<form method="POST" action="process.php?add">
    <table>
        <tr>
            <td>ID</td>
            <td><input type='text' name='id'/></td>
        </tr>
        <tr>
            <td>Name</td>
            <td><input type='text' name='name'/></td>
        </tr>
        <tr>
            <td>Job</td>
            <td><input type='text' name='job'/></td>
        </tr>
        <tr>
            <td>Personality</td>
            <td><input type='text' name='personality'/></td>
        </tr>
        <tr>
            <td>Salary</td>
            <td><input type='text' name='salary'/></td>
        </tr>
        <tr>
            <td>Email
            </td>
            <td><input type='text' name='email'/></td>
        </tr>
        <tr>
            <td>User Notes</td>

            <td><input type='text' name='user_notes'/></td>
        </tr>
    </table>
    <input type="submit" value="Save"/>
</form>
<?php else:?>

    <h3>Update the existing user :</h3>
    <form method="POST" action="process.php?update">
        <table>
            <tr>

                <td><input type='hidden' name='id' value='<?php echo $user->attributes()->id;?>'/></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><input type='text' name='name' value='<?php echo $user->name;?>'/></td>
            </tr>
            <tr>
                <td>Job</td>
                <td><input type='text' name='job' value='<?php echo $user->job;?>'/></td>
            </tr>
            <tr>
                <td>Personality</td>
                <td><input type='text' name='personality' value='<?php echo $user->personality;?>'/></td>
            </tr>
            <tr>
                <td>Salary</td>
                <td><input type='text' name='salary' value='<?php echo $user->salary;?>'/></td>
            </tr>
            <tr>
                <td>Email
                </td>
                <td><input type='text' name='email' value='<?php echo $user->email;?>'/></td>
            </tr>
            <tr>
                <td>User Notes</td>

                <td><input type='text' name='user_notes' value='<?php echo $user->user_notes;?>'/></td>
            </tr>
        </table>
        <input type="submit" value="Save"/>
    </form>
<?php endif;?>