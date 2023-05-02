<?php require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/config/database.php';
?>

<div class="container">
    <?php
    $sql = $dbh->prepare("SELECT Name FROM users WHERE id = {$_GET['id']}");
    $sql->execute();
    $singleName = $sql->fetch(PDO::FETCH_ASSOC);
    if ($singleName) :?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                <h2 class="float-start"><?php echo htmlspecialchars($singleName["Name"])?> Records</h2>
                <a href="index.php" class="float-end btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <?php endif?>
    
    <div class="row">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>City</th>
                    <th>Phone</th>
                    <th>Salary</th>
                    <th>Gender</th>
                </tr>
            </thead>

            <tbody>
            <?php
            $stmt=$dbh->prepare("SELECT * FROM users WHERE id = {$_GET['id']}");
            $stmt->execute();
            $records = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($records) :?>
                <tr> 
                <td><?php echo htmlspecialchars($records['Name']) ?></td>
                <td><?php echo htmlspecialchars($records['Email']) ?></td>
                <td><?php echo htmlspecialchars($records['City']) ?></td>
                <td><?php echo htmlspecialchars($records['Phone']) ?></td>
                <td>Ksh <?php echo htmlspecialchars($records['Salary'] )?></td>
                <td><?php echo htmlspecialchars($records['Gender']) ?></td>
            </tr>
            <?php endif?>
            </tbody>
      </table>
    </div>
</div>
<?php


?>

<?php require_once __DIR__ . '/includes/footer.php'?>