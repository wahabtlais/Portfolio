<?php
require('constants/header.php');

if (isset($_POST['project_form'])) {
    $valid = 1;
    $path = $_FILES['project_image']['name'];
    $path_tmp = $_FILES['project_image']['tmp_name'];

    if ($path != '') {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $file_name = basename($path, '.' . $ext);
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') {
            $valid = 0;
            $error_message .= 'You must to upload jpg, jpeg, gif or png file';
        }
    } else {
        $valid = 0;
        $error_message .= 'You must have to select a photo.<br>';
    }

    if ($valid == 1) {
        $statement = $PDO->prepare("SELECT * FROM projects");
        $statement->execute();
        $result = $statement->fetchAll();
        foreach ($result as $row) {
            $ai_id = $row['id'];
        }

        $final_name = 'project-' . $ai_id . '.' . $ext;
        move_uploaded_file($path_tmp, '../assets/images/' . $final_name);

        $statement = $PDO->prepare("INSERT INTO projects (name, description, image) VALUES (?,?,?)");
        $statement->execute(array($_POST['project_name'], $_POST['project_desc'], $final_name));

        $success_message .= 'Product added successfully';

        unset($_POST['project_name']);
        unset($_POST['project_desc']);
    }
}

?>


<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Project</h1>
        <a href="index.php" class="float-left btn btn-primary">View All</a>
    </div>
    <div class="col-md-12">
        <?php if ($error_message) : ?>
            <div class="callout text-danger">
                <p>
                    <?= $error_message; ?>
                </p>
            </div>
        <?php endif; ?>

        <?php if ($success_message) : ?>
            <div class="callout text-success">
                <p><?= $success_message; ?></p>
            </div>
        <?php endif; ?>

        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
            <div class="box box-info">
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Project Name</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="project_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Porject Description</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="project_desc">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Project Image</label>
                        <div class="col-sm-4">
                            <input type="file" name="project_image">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class='col-sm-6'>
                            <button type="submit" class="btn btn-primary pull-left" name="project_form">Add
                                Project</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>