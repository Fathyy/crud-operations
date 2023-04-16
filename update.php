<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $salary = $_POST['salary'];

    require_once __DIR__ . '/config/database.php';
    $statement = $dbh->prepare("UPDATE users SET Name = '$name',
    Address = '$address', Phone = '$phone', Salary = '$salary'
    WHERE id = {$_GET['id']}");
    $statement->execute();
    $result = $statement->fetch();
    if ($result) {
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

        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" name="address" id="address">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="phone" class="form-control" name="phone" id="phone">
            </div>

            <div class="mb-3">
                <label for="salary" class="form-label">Salary</label>
                <input type="text" class="form-control" name="salary" id="salary">
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
</div>
</div>
<?php require_once __DIR__ . '/includes/footer.php';?>