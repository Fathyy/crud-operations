<?php require_once __DIR__ . '/includes/header.php';
    
    require_once __DIR__ . '/config/database.php';
    $statement = $dbh->prepare("SELECT * FROM users ORDER BY id DESC");
    $statement->execute();
    $result = $statement->fetchAll();
    ?>

<div class="container">
  <div class="row">

  <div>
<a href="create.php"><i class="fa-solid fa-circle-plus"></i>Create</a>
</div>

  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Salary</th>
        <th>Actions</th>
      </tr>
    </thead>
    
    <tbody>
    <?php 
        if (($result)) {
          foreach ($result as $row) { ?>
          <tr>
          <!-- escape the output before displaying them -->
            <td><?php echo $row['id'] ?></td> 
            <td><?php echo $row['Name'] ?></td>
            <td><?php echo $row['Address'] ?></td>
            <td><?php echo $row['Phone'] ?></td>
            <td><?php echo $row['Salary'] ?></td>
            <td><a href="update.php?id=<?php echo $row['id'] ?>"><i class="fa-regular fa-pen-to-square"></i></a>
                    <a href="delete.php?id=<?php echo $row['id']?>"><i class="fa-solid fa-trash"></i></a></td>
            </tr>
        <?php } }?>
    </tbody>
  </table>

  </div>
</div>

  



  
<?php require_once __DIR__ . '/includes/footer.php'?>
    