<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['uname'];
    $address = $_POST['uaddress'];
    $phone = $_POST['uphone'];
    $salary = $_POST['usalary'];

    require_once __DIR__ . '/config/database.php';
    $statement = $dbh->prepare("UPDATE users SET Name = '$name',
    Address = '$address', Phone = '$phone', Salary = '$salary'
    WHERE id = {$_GET['id']}");
    $statement->execute();
    $result = $statement->fetchAll();
    
}

?>

<?php require_once __DIR__ . '/includes/header.php';

if (isset($message)) {
    echo "Profile updated successfully";
}?>

<form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
    <div>
        <label for="name">Name</label>
        <input type="text" name="uname" id="name">
    </div>

    <div>
        <label for="address">Address</label>
        <input type="text" name="uaddress" id="address">
    </div>

    <div>
        <label for="phone">Phone</label>
        <input type="phone" name="uphone" id="phone">
    </div>

    <div>
        <label for="salary">Salary</label>
        <input type="text" name="usalary" id="salary">
    </div>

    <button type="submit">Update</button>
</form>
<?php require_once __DIR__ . '/includes/footer.php';?>