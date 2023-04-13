<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = sanitize_data($_POST['name']);
    $address = sanitize_data($_POST['address']);
    $phone = sanitize_data($_POST['phone']);
    $salary = sanitize_data($_POST['salary']);

    require_once __DIR__ . '/config/database.php';

   $stmt = $dbh->prepare("INSERT INTO users(Name, Address, Phone, Salary)
   VALUES(?, ?, ?, ?)"); 
   $stmt->bindParam(1, $name, PDO::PARAM_STR); 
   $stmt->bindParam(2, $address, PDO::PARAM_STR); 
   $stmt->bindParam(3, $phone, PDO::PARAM_STR); 
   $stmt->bindParam(4, $salary, PDO::PARAM_STR); 
   $stmt->execute();
   $result = $stmt->fetch(PDO::FETCH_ASSOC);
   print_r($result);
//    if ($result) {
//     header('Location: index.php');
//     exit;
//    }

}

function sanitize_data($data)
{
    $data = trim($data);
    $data = strip_tags($data);
    $data = addslashes($data);
    return $data;
}

?>
<?php require_once __DIR__ . '/includes/header.php';?>
<form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
    <div>
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
    </div>

    <div>
        <label for="phone">Phone</label>
        <input type="phone" name="phone" id="phone">
    </div>

    <div>
        <label for="address">Address</label>
        <input type="text" name="address" id="address">
    </div>

    <div>
        <label for="salary">Salary</label>
        <input type="text" name="salary" id="salary">
    </div>

    <button type="submit">Create</button>
</form>
<?php require_once __DIR__ . '/includes/footer.php'?>