<?php
require('constants/header.php');

if (isset($_POST['project_form'])) {
    $valid = 1;
    $path = $_FILES['new_image']['name'];
    $path_tmp = $_FILES['new_image']['tmp_name'];

    if ($path != '') {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $file_name = basename($path, '.' . $ext);
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') {
            $valid = 0;
            $error_message = 'You must to upload jpg, jpeg, gif or png file';
        }
    }

    if ($valid == 1) {
        // removing the existing photo
        if ($path == '') {
            $statement = $PDO->prepare("UPDATE projects SET name=?, description=? WHERE id=?");
            $statement->execute(array($_POST['project_name'], $_POST['project_desc'], $_REQUEST['id']));
        } else {
            unlink('../assets/images/' . $_POST['current_photo']);
            $final_name = 'project-' . $_REQUEST['id'] . '.' . $ext;
            move_uploaded_file($path_tmp, '../assets/images/' . $final_name);

            $statement = $PDO->prepare("UPDATE projects SET name=?, description=?, image=? WHERE id=?");
            $statement->execute(array($_POST['project_name'], $_POST['project_desc'], $final_name, $_REQUEST['id']));
        }

        $success_message = 'Image updated successfully';
    }
}

if (!isset($_REQUEST['id'])) {
    header('location: index.php');
    exit;
} else {
    // Check the id is valid or not
    $statement = $PDO->prepare("SELECT * FROM projects WHERE id=?");
    $statement->execute(array($_REQUEST['id']));
    $total = $statement->rowCount();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    if ($total == 0) {
        header('location: index.php');
        exit;
    }
}
?>


<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Project</h1>
        <a href="index.php" class="float-left btn btn-primary">View All</a>
    </div>
    <?php
    $statement = $PDO->prepare("SELECT * FROM projects WHERE id=?");
    $statement->execute(array($_REQUEST["id"]));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $project_name = $row['name'];
        $project_desc = $row['description'];
        $project_image = $row['image'];
    }
    ?>
    <div class="col-md-12">


        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="current_photo" value="<?= $project_image ?>">
            <div class="box box-info">
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Project Name</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="project_name" value="<?= $project_name ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Porject Description</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="project_desc" value="<?= $project_desc ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Existing Image</label>
                        <div class="col-sm-4">
                            <img src="../assets/images/<?= $project_image ?>" width="100">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">New Image</label>
                        <div class="col-sm-4">
                            <input type="file" name="new_image">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class='col-sm-6'>
                            <button type="submit" class="btn btn-primary pull-left" name="project_form">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>