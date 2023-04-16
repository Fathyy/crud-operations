<?php
session_start();
require_once __DIR__ . '/config/database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $salary = $_POST['salary'];

    $statement = $dbh->prepare("UPDATE users SET Name = '$name',
    Address = '$address', Phone = '$phone', Salary = '$salary'
    WHERE id = {$_GET['id']}");
    $statement->execute();
    $lastInsertId=$dbh->lastInsertId();
    if ($lastInsertId){
        $_SESSION['message'] = "Profile successfully updated";
        header('Location: index.php');
        exit;
       }
       else {
        $_SESSION['message'] = "Profile not successfully updated";
        header('Location: update.php');
        exit;
       }
}
?>

<?php require_once __DIR__ . '/includes/header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-12 mt-4">
            <h4 class="float-start">Profile Update page</h4>
            <a href="index.php" class="float-end btn btn-primary">Back</a>
        </div>

        <?php if(isset($_SESSION['message'])):?>

        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['message']?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <?php
        unset($_SESSION['message']);
        endif;
        ?>

        <?php
        if (isset($_GET['id'])) {
            $profile_id = $_GET['id'];
            $statement = $dbh->prepare("SELECT * FROM 
            users WHERE id = '$profile_id'");
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result) :?>
                
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo $result['Name'] ?>">
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" id="address" value="<?php echo $result['Address']?>">
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="phone" class="form-control" name="phone" id="phone" value="<?php echo $result['Phone']?>">
                </div>

                <div class="mb-3">
                    <label for="salary" class="form-label">Salary</label>
                    <input type="text" class="form-control" name="salary" id="salary" value="<?php echo $result['Salary'] ?>">
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
            </form>
            
            <?php else : 
                echo "No such record found"; ?>

    <?php endif?>

    <?php }
    ?>
</div>
</div>
<?php require_once __DIR__ . '/includes/footer.php';?>