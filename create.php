<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name']); //trim them
    $email = trim($_POST['email']);
    $city = $_POST['city'];
    $phone = trim($_POST['phone']);
    $salary = trim($_POST['salary']);

    // sanitize and validate the email
    $sanitizeEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (filter_var($sanitizeEmail, FILTER_VALIDATE_EMAIL) !== true) {
        $_SESSION['message'] = "Invalid email format";
    }

    // the city field is not empty
    if (filter_has_var(INPUT_POST, 'city') === false) {
        $_SESSION['message'] = "Please select a city";
    }

    // check if gender radio button is checked
    if (filter_has_var(INPUT_POST, 'gender') === false) {
        $_SESSION['message'] = "Please select a gender";
    }

    // terms of service
    if (filter_has_var(INPUT_POST, 'agree') === false) {
        $_SESSION['message'] = "You must agree to the terms of service";
    }

    require_once __DIR__ . '/config/database.php';

    if (empty($_SESSION['message'])) {
        // insering new user to DB query
        $stmt = $dbh->prepare("INSERT INTO users(Name, Address, Phone, Salary)
        VALUES(?, ?, ?, ?)"); 
        $stmt->bindParam(1, $name, PDO::PARAM_STR); 
        $stmt->bindParam(2, $address, PDO::PARAM_STR); 
        $stmt->bindParam(3, $phone, PDO::PARAM_STR); 
        $stmt->bindParam(4, $salary, PDO::PARAM_STR); 
        $stmt->execute();
        $lastInsertId=$dbh->lastInsertId();
            if ($lastInsertId){
                $_SESSION['message'] = "Profile successfully created";
                header('Location: create.php');
                exit;
            }
            else {
                $_SESSION['message'] = "Profile not successfully created";
                header('Location: create.php');
                exit;
        }
    }

   }

?>
<?php require_once __DIR__ . '/includes/header.php';
?>

<div class="container">
    <div class="row">
        <div class="col-md-12 mt-4">
            <h4 class="float-start">Profile create page</h4>
            <a href="index.php" class="float-end btn btn-primary">Back</a>
        </div>

        <!-- BS alert if a new user is created -->
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
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" id="email">
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">Choose your city</label>
                <select name="city" id="city">
                    <option value="Nairobi">Nairobi</option>
                    <option value="Kisumu">Kisumu</option>
                    <option value="Kisumu">Mombasa</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="phone" class="form-control" name="phone" id="phone">
            </div>

            <div class="mb-3">
                <label for="salary" class="form-label">Salary</label>
                <input type="text" class="form-control" name="salary" id="salary">
            </div>

            <div class="mb-3">Choose your gender
                <input type="radio" name="gender" id="male" value="email"/>
                <label for="male">Male</label>
                <input type="radio" name="gender" id="female" value="email" />
                <label for="female">Female</label>
            </div>

            <div class="mb-3">
                <label for="agree">
                    <input type="checkbox" name="agree" id="agree">
                    I agree to the terms of services
                </label>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
</div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'?>