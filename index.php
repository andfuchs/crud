<?php 
    require_once 'formprocess.php';
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Andis Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
   <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light"> -->
   <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Tutorial</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

  
    <div class="container">
    <?php
        if(isset($_SESSION['msg']) && isset($_SESSION['msg-class'])){
       ?>
        <div class="alert alert-<?= $_SESSION['msg-class']; ?>" role="alert">
          <?= $_SESSION['msg']; ?>
        </div>
      <?php
        unset($_SESSION['msg']);
        unset($_SESSION['msg-class']);
      }
       ?>
        <div class="row mt-5">
            <h3>Daten eintragen</h3>
        
            <form method="post" action="formprocess.php" class="col-12">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Firstname" name="firstname">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Lastname" name="lastname">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="E-Mail" name="email">
                </div>
                <input type="submit" class="btn btn-primary" name="submit">
            </form>
         </div>

        <div class="row mt-5">
            <h3>Gespeicherte Daten</h3>
            <?php
            $results = $crud->getMembers();
            ?>
        <table class="table table-hover" class="col-12">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Firstname</th>
              <th scope="col">Lastname</th>
              <th scope="col">E-Mail</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach($results as $result){
              ?>
              <tr>
                <th scope="row"><?= $result['id']; ?></th>
                <td><?= $result['firstname']; ?></td>
                <td><?= $result['lastname']; ?></td>
                <td><?= $result['email']; ?></td>
                <td><a class="btn btn-primary" href="index.php?edit=<?= $result['id']; ?>">EDIT</a><a class="btn btn-danger ml-3" href="index.php?delete=<?= $result['id']; ?>">DELETE</a></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        </div>
        
        <?php
          if(isset($_GET['edit'])){
          $result = $crud->getMember($_GET['edit']);
        ?>  
        <div class="row mt-5">          
            <h3>UPDATE</h3>        
            <form method="post" action="formprocess.php" class="col-12">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Firstname" name="firstname" value="<?= $result['firstname']; ?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Lastname" name="lastname" value="<?= $result['lastname']; ?>">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="E-Mail" name="email" value="<?= $result['email']; ?>">
                </div>
                <input type="hidden" name="id" value="<?= $result['id']; ?>">
                <input type="submit" class="btn btn-primary" name="update">
            </form>
         </div>
  
      <?php
      }
      ?>  
  
      </div>
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>