<?php
require"dbconnect.php";

$insert = false;
$update = false;
$err = false;
$delete = false;

if (isset($_GET['Waj23U52kol'])) {
  $del = $_GET['Waj23U52kol'];
  // echo $del;
  $delete = "DELETE FROM `information` WHERE `sr` = '$del'";
  $ansd = mysqli_query($connection, $delete);

  if(!$ansd)
    echo "<b><i>deletion is failed !!! : </i></b>". mysqli_error($connection); 
  else
    $delete = true;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

  /*data update*/
  if (isset($_REQUEST["hide"])){
    $srn = $_REQUEST["hide"];
    $Uname = $_REQUEST["Uname"];
    $Uemail = $_REQUEST["Uemail"];
    $Ubranch = $_REQUEST["Ubranch"];
    $Usem = $_REQUEST["Usem"];
    $Uid = $_REQUEST["Uid"];
    $Urno = $_REQUEST["Urno"];
    $update = "UPDATE `information` SET 
                      `name` = '$Uname', 
                      `email` = '$Uemail',
                      `branch` = '$Ubranch', 
                      `sem` = '$Usem', 
                      `id` = '$Uid', 
                      `rno` = '$Urno' WHERE `information`.`sr` = '$srn'";
    $ansu = mysqli_query($connection,$update);
    if(!$ansu)
      echo "<b><i>updatetion is failed !!! : </i></b>". mysqli_error($connection);
    else
      $update = true;
  }
  else
  {
    /*data insert*/
    $name = $_REQUEST["name"];
    $email = $_REQUEST["email"];
    $branch = $_REQUEST["branch"];
    $sem = $_REQUEST["sem"];
    $id = $_REQUEST["id"];
    $rno = $_REQUEST["rno"];
    $sql = "INSERT INTO `information` (`name`,`email`,`branch`,`sem`,`id`,`rno`) VALUES ('$name','$email','$branch','$sem','$id','$rno')";
    $ansi = mysqli_query($connection,$sql);
    if(!$ansi)
      $err = true;
    else
      $insert = true;
  }
}

?>

<!doctype html>
<html lang="en">

<head>
  <!-- autocomplete="off" required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- per icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- datatabels CSS -->
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

  <!-- CSS -->
  <link rel="stylesheet" href="notes.css">
  <!-- <link rel="stylesheet" href="style.css"> -->
  <title>Data Storage</title>
</head>

<body>
  <div class="container my-5 py-3" id="mainDiv">
    <?php
      if ($err) 
      { 
        $err =  mysqli_error($connection);
        echo "<div class='alert alert-danger alert-dismissible'>
                  <button type='button' class='btn-c btn-close' data-bs-dismiss='alert'>✘</button>
                  <strong>Error!</strong> $err
                </div>";
      }
      
      if ($insert) {
        echo '<div class="alert alert-s alert-dismissible my-2" style="text-align: center;">
        <button type="button" class="btn-c btn-close" data-bs-dismiss="alert">✘</button>
        <strong>☑</strong> Your information has been <strong>Inserted</strong> successfully !
      </div>';
      }

      if ($update) {
        echo '<div class="alert alert-s alert-dismissible my-2" style="text-align: center;">
          <button type="button" class="btn-c btn-close" data-bs-dismiss="alert">✘</button>
          <strong>☑</strong> Your information has been <strong>Updated</strong> successfully !
      </div>';
      }

      if ($delete) {
        echo '<div class="alert alert-s alert-dismissible my-2" style="text-align: center;">
        <button type="button" class="btn-c btn-close" data-bs-dismiss="alert"> ✘ </button>
        <strong>☑</strong> Your information has been <strong>Deleted</strong> successfully !
      </div>';
      }
    ?>
    <div id="header" class="container d-flex bd-highlight my-2 py-2">
      <h5 id="heading" class="me-auto p-2 bd-highlight my-0">
        Data Storage<span style="font-weight: 500;"> > </span><span style="font-weight: bolder;">Dashboard</span>
      </h5>
    </div>

    <div id="formDiv" class="px-3 py-4 my-3">
      <form class="row g-3" action="./main.php" method="POST">
        <div class="col-md-6">
          <!-- <label for="name" class="form-label">Name</label> -->
          <input type="text" class="form-control insertIP my-3" name="name" id="name" placeholder="Enter Student's Name"
            autocomplete="off" required>
        </div>
        <div class="col-md-6">
          <!-- <label for="email" class="form-label">DDU Email</label> -->
          <input type="email" class="form-control insertIP my-3" name="email" id="email"
            placeholder="Enter Student's E-mail" autocomplete="off" required>
        </div>
        <div class="col-md-3">
          <!-- <label for="branch" class="form-label">Branch</label> -->
          <input type="text" class="form-control insertIP my-3" name="branch" id="branch"
            placeholder="Enter Student's Branch" autocomplete="off" required>
        </div>
        <div class="col-md-3">
          <!-- <label for="id" class="form-label">DDU-ID</label> -->
          <input type="text" class="form-control insertIP my-3" name="id" id="id" placeholder="Enter Student's DDU-ID"
            autocomplete="off" required>
        </div>
        <div class="col-md-3">
          <!-- <label for="sem" class="form-label">Semester</label> -->
          <input type="text" class="form-control insertIP my-3" name="sem" id="sem"
            placeholder="Enter Student's Semester" autocomplete="off" required>
        </div>
        <div class="col-md-3">
          <!-- <label for="rno" class="form-label">Roll No</label> -->
          <input type="text" class="form-control insertIP my-3" name="rno" id="rno"
            placeholder="Enter Student's Roll no." autocomplete="off" required>
        </div>
        <div class="col-12">
          <button id="save" type="submit" class="btn px-5 my-2">Save ✔</button>
        </div>
      </form>
    </div>
    <!-- <hr>
    <h4 style="text-align: center;">Contents</h4>
    <hr> -->
    <div id="" class="my-4 tableDiv">
      <table class="table table-dark" id="myTable">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">E-mail</th>
            <th scope="col">Branch</th>
            <th scope="col">Semester</th>
            <th scope="col">DDU_ID</th>
            <th scope="col">ROLL NO</th>
            <th scope="col">ACTION</th>
          </tr>
        </thead>
        <tbody>
          <?php
          /*data read*/
          $read = "SELECT * FROM `information`";
          $ansr = mysqli_query($connection,$read);
            if(!$ansr)
            {
              echo '<div class="alert alert-warning alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Error!</strong> We apologize for the inconvenience.Try a few moments later.
                    </div>';
            }
            else
            {
              $row = mysqli_fetch_assoc($ansr);
              $sr=0;
              while($row!= NULL){
                 $sr++;
                 echo 
                 "<tr>
                 <td scope='row'>". $sr . "</td>
                 <td>". $row['name'] . "</td>
                 <td>". $row['email'] . "</td>
                 <td>". $row['branch'] . "</td>
                 <td>". $row['sem'] . "</td>
                 <td>". $row['id'] . "</td>
                 <td>". $row['rno'] . "</td>
                 <td>
                 <div class='d-flex justify-content-between'>
                    <button type='button' class='btn btn-success update' data-bs-toggle='modal' data-bs-target='#staticBackdrop' id=".$row['sr'].">🖉</button>
                    <button type='button'class='btn btn-danger delete' id=".$row['sr'].">✘</button>
                 </div>
                 </td>
                 </tr>";
                 $row = mysqli_fetch_assoc($ansr);
              }
            }
          ?>
        </tbody>
      </table>
    </div>
    <!-- Modal update -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Update Information</h5>
            <button type="button" class="btn-c" data-bs-dismiss="modal">✘</button>
            <!--  aria-label="Close" -->
          </div>
          <div class="modal-body">
            <form class="row g-3" action="./main.php" method="POST">
              <!-- to set id (updatetion) -->
              <input type="hidden" id="hide" name="hide">

              <div class="col-md-6">
                <label for="Uname" class="form-label">Name</label>
                <input type="text" class="form-control insertEdit" name="Uname" id="Uname" autocomplete="off" required>
              </div>
              <div class="col-md-6">
                <label for="Uemail" class="form-label">DDU Email</label>
                <input type="email" class="form-control insertEdit" name="Uemail" id="Uemail" autocomplete="off"
                  required>
              </div>
              <div class="col-md-3">
                <label for="Ubranch" class="form-label">Branch</label>
                <input type="text" class="form-control insertEdit" name="Ubranch" id="Ubranch" autocomplete="off"
                  required>
              </div>
              <div class="col-md-3">
                <label for="Uid" class="form-label">DDU-ID</label>
                <input type="text" class="form-control insertEdit" name="Uid" id="Uid" autocomplete="off" required>
              </div>
              <div class="col-md-3">
                <label for="Usem" class="form-label">Semester</label>
                <input type="text" class="form-control insertEdit" name="Usem" id="Usem" autocomplete="off" required>
              </div>
              <div class="col-md-3">
                <label for="Urno" class="form-label">Roll No</label>
                <input type="text" class="form-control insertEdit" name="Urno" id="Urno" autocomplete="off" required>
              </div>
              <!--  -->
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button id="Usave" type="submit" class="btn">Changes Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>



  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

  <!-- datatables.net -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>
  <script>
    // add class to the searchbar
    // var searchInput = document.getElementById("myTable_filter").getElementsByTagName("label")[0].getElementsByTagName("input")[0];
    // searchInput.classList.add("searchbar");

    // console.log(typeof x);

    const updates = document.getElementsByClassName("update");
    Array.from(updates).forEach((element) => {
      element.addEventListener('click', (e) => {
        tr = e.target.parentNode.parentNode.parentNode;
        document.getElementById('Uname').value = tr.getElementsByTagName('td')[1].innerText;
        document.getElementById('Uemail').value = tr.getElementsByTagName('td')[2].innerText;
        document.getElementById('Ubranch').value = tr.getElementsByTagName('td')[3].innerText;
        document.getElementById('Usem').value = tr.getElementsByTagName('td')[4].innerText;
        document.getElementById('Uid').value = tr.getElementsByTagName('td')[5].innerText;
        document.getElementById('Urno').value = tr.getElementsByTagName('td')[6].innerText;
        document.getElementById('hide').value = e.target.id;
        // console.log(e.target.id);
        console.log(document.getElementById('hide').value);
        /*document.getElementById('hide').value = tr.getElementsByTagName('td')[6].innerText;
        document.getElementById('hide').value = e.target.id;*/
      })
    });

    const deletes = document.getElementsByClassName("delete");
    Array.from(deletes).forEach((element) => {
      element.addEventListener('click', (e) => {
        tr = e.target.parentNode.parentNode.parentNode;
        str = e.target.id;
        var link = "http://localhost/PHP/Project/DataStorage/main.php?Waj23U52kol=" + str;
        window.location = link;
      })
    })

    /*stop re-submission*/
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
</body>

</html>