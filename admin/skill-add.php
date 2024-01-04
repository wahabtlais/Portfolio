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

        // getting auto increment id
        $statement = $PDO->prepare("SHOW TABLE STATUS LIKE 'skills'");
        $statement->execute();
        $result = $statement->fetchAll();
        foreach ($result as $row) {
            $ai_id = $row[10];
        }



        $statement = $PDO->prepare("INSERT INTO skills (title,class,percentage) VALUES (?,?,?)");
        $statement->execute(array($_POST['title'], $_POST['class_name'], $_POST['percentage']));

        $success_message = 'Skill added successfully!';

        unset($_POST['title']);
        unset($_POST['class_name']);
        unset($_POST['percentage']);
    }
}
?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Skill</h1>
        <a href="skills.php" class="float-left btn btn-primary">View All</a>
    </div>


    <section class="content">

        <div class="row">
            <div class="col-md-12">

                <?php if ($error_message) : ?>
                    <div class="callout text-danger">
                        <p>
                            <?php echo $error_message; ?>
                        </p>
                    </div>
                <?php endif; ?>

                <?php if ($success_message) : ?>
                    <div class="callout text-success">
                        <p><?php echo $success_message; ?></p>
                    </div>
                <?php endif; ?>

                <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                    <div class="box box-info">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="add-title" class="col-sm-2 control-label">Title<span>*</span></label>
                                <div class="col-sm-6">
                                    <input id="add-title" type="text" autocomplete="off" class="form-control" name="title">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="add-class-name" class="col-sm-2 control-label">Class
                                    Name<span>*</span></label>
                                <div class="col-sm-6">
                                    <input id="add-class-name" type="text" autocomplete="off" class="form-control" name="class_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="add-percentage" class="col-sm-2 control-label">Percentage<span>*</span></label>
                                <div class="col-sm-6">
                                    <input id="add-percentage" type="text" autocomplete="off" class="form-control" name="percentage">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label"></label>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary pull-left" name="skills_form">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </section>
</div>