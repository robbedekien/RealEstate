<?php
$user = null;
$role = null;
if (!isset($_SESSION))
  session_start();
if (!empty($_SESSION['loggedInUser'])) {
  $sjUsers = file_get_contents(__DIR__ . '/../data/users.json');
  $jUsers = json_decode($sjUsers);
  $key = $_SESSION['loggedInUser'];
  $user = $jUsers->$key;
  $role = $user->role;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="reset.css">
  <link rel="stylesheet" href="mdbootstrap\css\bootstrap.min.css">
  <link rel="stylesheet" href="site.css">
  <title>HomeZ</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark indigo">
    <a class="navbar-brand" href="index">HomeZ</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav mr-auto mt-lg-0">
        <?php
        if ($role == 'agent')
          echo
            '<li class="nav-item">
            <a class="nav-link" href="add-property.php">Add properties</a>
            </li>'
          ?>
      </ul>
      <form class="form-inline my-3 ml-auto" id="searchForm">
        <input class="form-control mr-3" type="search" placeholder="Search" aria-label="Search" id="searchNavbar" style="height: 35px;">
        <!-- <button class="btn btn-info btn-md my-2 my-sm-0 mr-4" type="submit" style="color: white;" id="btnSearchNavbar">Search</button> -->
      </form>
      <div class="nav-item">
        <?php
        if ($user == null) {
          echo "<a href='login' class='nav-link' style='color: white;'>Login</a>";
        } else {
          ?>
          <div class='btn-group'>
            <button type='button' id='btnProfileMenu' class='btn btn-info'><?=$user->firstName?></button>
            <button type='button' class='btn btn-info dropdown-toggle px-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
              <span class='sr-only'>Toggle Dropdown</span>
            </button>
            <div class='dropdown-menu'>
              <a class='dropdown-item' id='btnLogout'>Log out</a>
              <a class='dropdown-item' id='btnDeleteProfile'>Delete profile</a>
            </div>
          </div>
        <?php
        };
        ?>


      </div>
    </div>
  </nav>