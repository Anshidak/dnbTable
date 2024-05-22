<?php
require_once('database.php');
$db = new DBConnection();
$conn = $db->conn;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DNB DUTY LIST</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <style>
        .editable{
            display:none;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">KIMS ALSHIFA HOSPITAL</a>
  </div>
</nav>
<div class="container py-3">
    <div class="row">
        <div class="col-12">
            <h3 class="text-center">DNB DUTY SCHEDULE LIST</h3>
        </div>
        <hr>
        <div class="col-12">
            <!-- Table Form start -->
            <form action="" id="form-data">
                <input type="hidden" name="id" value="">
                <table class='table table-hovered table-stripped table-bordered' id="form-tbl">
                    <colgroup>
                        <col width="15%">
                        <col width="20%">
                        <col width="10%">
                        <col width="%15">
                        <col width="%15%">
                        <col width="15%">
                        <col width="15%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="text-center p-1">Duty Area</th>
                            <th class="text-center p-1">Name</th>
                            <th class="text-center p-1">Contact</th>
                            <th class="text-center p-1">Shift/Remarks</th>
                            <th class="text-center p-1">User</th>
                            <th class="text-center p-1">Last Update</th>
                            <th class="text-center p-1">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $query = $conn->query("SELECT * FROM `members` ORDER BY id ASC");
                    while($row = $query->fetch_assoc()):
                    ?>
                    <tr data-id='<?php echo $row['id'] ?>'>
                        <td name="duty"><?php echo $row['duty'] ?></td>
                        <td name="name"><?php echo $row['name'] ?></td>
                        <td name="contact"><?php echo $row['contact'] ?></td>
                        <td name="shift"><?php echo $row['shift'] ?></td>
                        <td name="user"><?php echo $row['user'] ?></td>
                        <td name="last_update"><?php echo $row['last_update'] ?></td>
                        <td class="text-center">
                            <button class="btn btn-primary btn-sm rounded-0 py-0 edit_data noneditable" type="button">Edit</button>
                            <button class="btn btn-danger btn-sm rounded-0 py-0 delete_data noneditable" type="button">Delete</button>
                            <button class="btn btn-sm btn-primary btn-flat rounded-0 px-2 py-0 editable">Save</button>
                            <button class="btn btn-sm btn-dark btn-flat rounded-0 px-2 py-0 editable" onclick="cancel_button($(this))" type="button">Cancel</button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </form>
            <!-- Table Form end -->
        </div>
        <div class="w-100 d-flex pposition-relative justify-content-center">
            <button class="btn btn-flat btn-primary" id="add_member" type="button">Add New Doctor</button>
        </div>
    </div>
</div>
<script type="text/javascript" src="./assets/js/jquery-3.6.0.js"></script>
<script type="text/javascript" src="./assets/js/bootstrap.js"></script>
<script type="text/javascript" src="./assets/js/script.js"></script>
</body>
</html>

