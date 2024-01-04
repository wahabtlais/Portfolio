<?php require_once('constants/header.php'); ?>

<?php
if (isset($_POST['skills_form'])) {
    $valid = 1;

    if (empty($_POST['title'])) {
        $valid = 0;
        $error_message .= "Title can't be empty.<br>";
    }

    if (empty($_POST['class_name'])) {
        $valid = 0;
        $error_message .= "Class Name can't be empty.<br>";
    }
    if (empty($_POST['percentage'])) {
        $valid = 0;
        $error_message .= "Percentage can't be empty.<br>";
    }

    if ($valid == 1) {
        $statement = $PDO->prepare("UPDATE skills SET title=?, class=?, percentage=? WHERE id=?");
        $statement->execute([$_POST['title'], $_POST['class_name'], $_POST['percentage'], $_REQUEST['id']]);

        $success_message = 'Skill updated successfully!';
    }
}
?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Skills</h1>
        <a href="skills.php" class="float-left btn btn-success">View All</a>
    </div>

    <?php
    $statement = $PDO->prepare("SELECT * FROM skills WHERE id=?");
    $statement->execute([$_REQUEST['id']]);
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $title = $row['title'];
        $class_name = $row['class'];
        $percentage = $row['percentage'];
    }

    ?>

    <div class="row">
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
                    <p>
                        <?= $success_message; ?>
                    </p>
                </div>
            <?php endif; ?>

            <form class="form-horizontal" action="" method="POST">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="edit-title" class="col-sm-2 control-label">Title<span>*</span></label>
                            <div class="col-sm-6">
                                <input id="edit-title" type="text" autocomplete="off" class="form-control" name="title" value="<?= $title ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit-class-name" class="col-sm-2 control-label">Class Name<span>*</span></label>
                            <div class="col-sm-6">
                                <input id="edit-class-name" type="text" autocomplete="off" class="form-control" name="class_name" value="<?= $class_name ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit-percentage" class="col-sm-2 control-label">Percentage<span>*</span></label>
                            <div class="col-sm-6">
                                <input id="edit-percentage" type="text" autocomplete="off" class="form-control" name="percentage" value="<?= $percentage ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left" name="skills_form">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>