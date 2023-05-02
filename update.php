<?php
session_start();
require_once __DIR__ . '/config/database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name']); 
    $email = trim($_POST['email']);
    $city = $_POST['city'];
    $phone = trim($_POST['phone']);
    $salary = trim($_POST['salary']);
    $gender = $_POST['gender'];

    // Updating user query
    $statement = $dbh->prepare("UPDATE users SET Name = '$name',
    Email = '$email', City = '$city', Phone = '$phone', Salary = '$salary',
    Gender = '$gender'
    WHERE id = {$_GET['id']}");
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if ($user === true){
        $_SESSION['message'] = "Profile successfully updated";
       }
       else {
        $_SESSION['message'] = "Profile not successfully updated";
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
        
        <!-- BS alert when user is updated -->
        <?php if(isset($_SESSION['message'])):?>

        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['message']?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <?php
        unset($_SESSION['message']);
        endif;
        ?>
        <!-- Show full existing user details from the DB before updating -->
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
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo htmlspecialchars($result['Name']) ?>">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="<?php echo htmlspecialchars($result['Email']) ?>">
                </div>

                <div class="mb-3">
                <label for="city" class="form-label">Choose your city</label>
                <select name="city" id="city">
                    <option value="<?php echo htmlspecialchars($result['City']) ?>">Nairobi</option>
                    <option value="<?php echo htmlspecialchars($result['City']) ?>">Kisumu</option>
                    <option value="<?php echo htmlspecialchars($result['City']) ?>">Mombasa</option>
                </select>
            </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="phone" class="form-control" name="phone" id="phone" value="<?php echo htmlspecialchars($result['Phone'])?>">
                </div>

                <div class="mb-3">
                    <label for="salary" class="form-label">Salary</label>
                    <input type="text" class="form-control" name="salary" id="salary" value="<?php echo htmlspecialchars($result['Salary'])?>">
                </div>

                <div class="mb-3">Choose your gender
                <input type="radio" name="gender" id="male" value="<?php echo htmlspecialchars($result['Gender'])?>"/>
                <label for="male">Male</label>
                <input type="radio" name="gender" id="female" value="<?php echo htmlspecialchars($result['Gender'])?>"/>
                <label for="female">Female</label>
            </div>


                <button type="submit" class="btn btn-primary">Update</button>
            </form>
            
            <?php else : 
                echo "No such record found"; ?>

    <?php endif?>

    <?php }
    ?>
</div>
</div>
<?php require_once __DIR__ . '/includes/footer.php';?>