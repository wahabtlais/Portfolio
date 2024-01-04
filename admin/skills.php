<?php
require("constants/header.php");
?>



<div class="container-fluid">

    <div class="mb-4">
        <a href="skill-add.php" class="btn btn-primary btn-sm">Add New</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Skills</h6>
        </div>
        <div class="card-body ">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Class Name</th>
                            <th>Percentage</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Class Name</th>
                            <th>Percentage</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $i = 0;
                        $statement = $PDO->prepare("SELECT * FROM skills");
                        $statement->execute();
                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $row) {
                            $i++;
                        ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $row['title']; ?></td>
                                <td><?= $row['class']; ?></td>
                                <td><?= $row['percentage']; ?></td>
                                <td>
                                    <a href="skill-edit.php?id=<?= $row['id']; ?>" class="btn btn-primary btn-xs">Edit</a>
                                    <a href="skill-delete.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-xs">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>