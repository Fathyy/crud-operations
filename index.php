<?php 
session_start();
require_once __DIR__ . '/includes/header.php'; 

require_once __DIR__ . '/config/database.php';
$statement = $dbh->prepare("SELECT * FROM users ORDER BY id DESC");
$statement->execute();
$result = $statement->fetchAll();
?>

<div class="container">
    <div class="row"> 
        <div class="my-4">
            <h2 class="float-start">All Employee Records</h2>
            <a href="create.php" class="btn btn-primary float-end"><i class="fa-solid fa-circle-plus" 
            style="margin-right:3px;"></i>Create</a>
        </div>

<!-- BS alert if a user is updated-->
<?php if(isset($_SESSION['message'])):?>

<div class="alert alert-warning alert-dismissible fade show" role="alert">
<?php echo $_SESSION['message']?>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php
unset($_SESSION['message']);
endif;
?>

<table class="table table-bordered table-hover">
<thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>City</th>
        <th>Phone</th>
        <th>Salary</th>
        <th>Gender</th>
        <th>Actions</th>
      </tr>
    </thead>

    <tbody>
        <?php
        // retrieve all records from the DB
        if (!empty($result)) {
            foreach ($result as $row) {?>
               <tr>
               <td><?php echo htmlspecialchars($row['id'])?></td> 
                <td><?php echo htmlspecialchars($row['Name']) ?></td>
                <td><?php echo htmlspecialchars($row['Email']) ?></td>
                <td><?php echo htmlspecialchars($row['City']) ?></td>
                <td><?php echo htmlspecialchars($row['Phone']) ?></td>
                <td>Ksh <?php echo htmlspecialchars($row['Salary'] )?></td>
                <td><?php echo htmlspecialchars($row['Gender']) ?></td>
                <td>
                    <!-- Edit -->
                    <a href="update.php?id=<?php echo htmlspecialchars($row['id'])?>" 
                    data-bs-toggle="tooltip" data-bs-title="Edit Record"><i class="fa-regular fa-pen-to-square"></i></a>

                    <!-- Delete Record -->
                    <a href="delete.php?id=<?php echo htmlspecialchars($row['id'])?>"
                    data-bs-toggle="tooltip" data-bs-title="Delete Record"><i class="fa-solid fa-trash"></i></a>

                    <!-- View Record -->
                    <a href="view.php?id=<?php echo htmlspecialchars($row['id'])?>"
                    data-bs-toggle="tooltip" data-bs-title="View Record"><i class="fa-regular fa-eye"></i></a>
                </td>
               </tr> 
        <?php }
        }?>
    </tbody>
</table>

    </div>
</div>


<?php require_once __DIR__ . '/includes/footer.php'; ?>