<?php require("constants/header.php");


if (isset($_POST['ref_form'])) {
    $valid = 1;
    $path = $_FILES['new_resume']['name'];
    $path_tmp = $_FILES['new_resume']['tmp_name'];

    if ($path != '') {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $image_name = basename($path, '.' . $ext);
        if ($ext != 'pdf') {
            $valid = 0;
            $error_message = 'You must to upload pdf file';
        }
    }


    if ($valid == 1) {
        // removing the existing photo
        if ($path == '') {
            $statement = $PDO->prepare("UPDATE details SET email=?, phone_number=? WHERE id=1");
            $statement->execute(array($_POST['email'], $_POST['phone_number']));
        } else {
            $statement = $PDO->prepare("SELECT * FROM details WHERE id=1");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $resume = $row['resume'];
                unlink('../assets/pdf/' . $resume);
            }
            $final_name = 'resume' . '.' . $ext;
            move_uploaded_file($path_tmp, '../assets/pdf/' . $final_name);

            $statement = $PDO->prepare("UPDATE details SET resume=?, email=?, phone_number=? WHERE id=1");
            $statement->execute(array($final_name, $_POST['email'], $_POST['phone_number']));
        }

        $success_message = 'References updated successfully';
    }
}

?>


<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit References</h1>

    </div>
    <?php
    $statement = $PDO->prepare("SELECT * FROM details WHERE id=1");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $email = $row['email'];
        $phone_number = $row['phone_number'];
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
                    <label class="col-sm-2 control-label">New Resume</label>
                    <div class="col-sm-4">
                        <input type="file" name="new_resume">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-4">
                        <input type="email" class="form-control" name="email" value="<?= $email ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Phone Number</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="phone_number" value="<?= $phone_number ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class='col-sm-6'>
                        <button type="submit" class="btn btn-primary pull-left" name="ref_form">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>