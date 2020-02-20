<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <?php
            session_start();
            include 'getDataAdmin.php';
            $list = getList();
        ?>
                <main>
                    <div class="container-fluid">
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>DataTable Example</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                            <th>Project Name</th>
                                                <th>Person In Charge</th>
                                                <th>Status</th>
                                                <th>DateOfInitiation</th>
                                                <th>EstimatedDateEnd</th>
                                                <th>Last Update</th>
                                                <th>(i)</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Project Name</th>
                                                <th>Person In Charge</th>
                                                <th>Status</th>
                                                <th>DateOfInitiation</th>
                                                <th>EstimatedDateEnd</th>
                                                <th>Last Update</th>
                                                <th>(i)</th>
                                                <th>Delete</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                                while($row = mysqli_fetch_assoc($list)) {
                                                    //display data
                                                      echo '<tr>';
                                                      //echo '<td>'.$count."</td>";
                                                      echo '<td>' . $row['projectName'] . "</td>"; //display regNumber
                                                      echo '<td>' . $row['personInCharge'] . "</td>";
                                                      echo '<td>' . $row['projectStatus'] . "</td>";
                                                      echo '<td>' . $row['dateOfInitiation'] . "</td>";
                                                      echo '<td>' . $row['estimatedDateEnd'] . "</td>";
                                                      echo '<td> Later </td>';
                                                      echo '<td>';
                                                        echo '<form action="differentDestinationPageAdmin.php" method="post">';
                                                        echo "<input type='hidden' value=" . $row['projectId'] . " name='projectToView'>";
                                                        echo $row['projectId'];
                                                        echo '<input type="submit" name="viewProjectButton" value="Details">';
                                                        echo '</form>';
                                                      echo '</td>';
                                                      echo '<td>';
                                                        echo '<form action="adminButtonProcesses.php" method="post" onsubmit="return warn(event)">';
                                                        echo "<input type='hidden' value=" . $row['projectId'] . " name='projectToDelete'>";
                                                        echo '<input type="submit" name="deleteProjectButton" value="X">';
                                                        echo '</form>';
                                                      echo '</td>';
                                                      $count++;
                                                    }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
