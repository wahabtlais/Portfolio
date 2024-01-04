<?php require("constants/header.php");


if (isset($_POST['about_form'])) {
    $valid = 1;
    $path = $_FILES['new_image']['name'];
    $path_tmp = $_FILES['new_image']['tmp_name'];

    if ($path != '') {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $image_name = basename($path, '.' . $ext);
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') {
            $valid = 0;
            $error_message = 'You must to upload jpg, jpeg, gif or png file';
        }
    }


    if ($valid == 1) {
        // removing the existing photo
        if ($path == '') {
            $statement = $PDO->prepare("UPDATE about_me SET description=? WHERE id=1");
            $statement->execute(array($_POST['about_desc']));
        } else {
            $statement = $PDO->prepare("SELECT * FROM about_me WHERE id=1");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $image = $row['image'];
                unlink('../assets/images/' . $image);
            }
            $final_name = 'image' . '.' . $ext;
            move_uploaded_file($path_tmp, '../assets/images/' . $final_name);

            $statement = $PDO->prepare("UPDATE about_me SET image=?, description=? WHERE id=1");
            $statement->execute(array($final_name, $_POST['about_desc']));
        }

        $success_message = 'About section updated successfully';
    }
}

?>


<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit About Section</h1>

    </div>
    <?php
    $statement = $PDO->prepare("SELECT * FROM about_me WHERE id=1");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $image = $row['image'];
        $about_desc = $row['description'];
    }
    ?>
    <?php if ($error_message) : ?>
        <div class="callout text-danger">
            <p>
                <?= $error_message; ?>
            </p>
        </div>
    <?php endif; ?>
    <?php if ($success_message) : ?>
        <div class="callout text-success">
            <p>
                <?= $success_message; ?>
            </p>
        </div>
    <?php endif; ?>



    <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
        <div class="box box-info">
            <div class="box-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Existing Image</label>
                    <div class="col-sm-4">
                        <img src="../assets/images/<?= $image ?>" width="100">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">New Image</label>
                    <div class="col-sm-4">
                        <input type="file" name="new_image">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-4">
                        <textarea type="text" class="form-control" rows="5" name="about_desc"><?= $about_desc ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class='col-sm-6'>
                        <button type="submit" class="btn btn-primary pull-left" name="about_form">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>