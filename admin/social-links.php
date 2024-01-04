<?php
require("constants/header.php");
?>



<div class="container-fluid">

    <div class="mb-4">
        <a href="social-link-add.php" class="btn btn-primary btn-sm">Add New</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Social Links</h6>
        </div>
        <div class="card-body ">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Social Name</th>
                            <th>Social URL</th>
                            <th>Social Icon</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Social Name</th>
                            <th>Social URL</th>
                            <th>Social Icon</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $i = 0;
                        $statement = $PDO->prepare("SELECT * FROM social_links");
                        $statement->execute();
                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $row) {
                            $i++;
                        ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $row['social_name']; ?></td>
                                <td style="max-width: 300px"><?= $row['social_url']; ?></td>
                                <td><?= $row['social_icon']; ?></td>
                                <td>
                                    <a href="social-link-edit.php?id=<?= $row['id']; ?>" class="btn btn-primary btn-xs">Edit</a>
                                    <a href="social-link-delete.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-xs">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>