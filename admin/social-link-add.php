<?php require_once('constants/header.php'); ?>

<?php
if (isset($_POST['socials_form'])) {
    $valid = 1;

    if (empty($_POST['social-name'])) {
        $valid = 0;
        $error_message .= "Name can't be empty.<br>";
    }

    if (empty($_POST['social-url'])) {
        $valid = 0;
        $error_message .= "URL can't be empty.<br>";
    }
    if (empty($_POST['social-icon'])) {
        $valid = 0;
        $error_message .= "Icon can't be empty.<br>";
    }



    if ($valid == 1) {

        // getting auto increment id
        $statement = $PDO->prepare("SHOW TABLE STATUS LIKE 'social_links'");
        $statement->execute();
        $result = $statement->fetchAll();
        foreach ($result as $row) {
            $ai_id = $row[10];
        }



        $statement = $PDO->prepare("INSERT INTO social_links (social_name,social_url,social_icon) VALUES (?,?,?)");
        $statement->execute(array($_POST['social-name'], $_POST['social-url'], $_POST['social-icon']));

        $success_message = 'Social Link added successfully!';

        unset($_POST['social-name']);
        unset($_POST['social-url']);
        unset($_POST['social-icon']);
    }
}
?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Link</h1>
        <a href="social-links.php" class="float-left btn btn-primary">View All</a>
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
                                <label for="add-social-name" class="col-sm-2 control-label">Social
                                    Name<span>*</span></label>
                                <div class="col-sm-6">
                                    <input id="add-social-name" type="text" autocomplete="off" class="form-control" name="social-name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="add-social-url" class="col-sm-2 control-label">Social
                                    URL<span>*</span></label>
                                <div class="col-sm-6">
                                    <input id="add-social-url" type="text" autocomplete="off" class="form-control" name="social-url">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="add-social-icon" class="col-sm-2 control-label">Social
                                    Icon<span>*</span></label>
                                <div class="col-sm-6">
                                    <input id="add-social-icon" type="text" autocomplete="off" class="form-control" name="social-icon">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label"></label>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary pull-left" name="socials_form">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </section>
</div>