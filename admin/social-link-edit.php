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
        $statement = $PDO->prepare("UPDATE social_links SET social_name=?, social_url=?, social_icon=? WHERE id=?");
        $statement->execute([$_POST['social-name'], $_POST['social-url'], $_POST['social-icon'], $_REQUEST['id']]);

        $success_message = 'Link updated successfully!';
    }
}
?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Link</h1>
        <a href="social-links.php" class="float-left btn btn-success">View All</a>
    </div>

    <?php
    $statement = $PDO->prepare("SELECT * FROM social_links WHERE id=?");
    $statement->execute([$_REQUEST['id']]);
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $social_name = $row['social_name'];
        $social_url = $row['social_url'];
        $social_icon = $row['social_icon'];
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
                            <label for="add-social-name" class="col-sm-2 control-label">Social
                                Name<span>*</span></label>
                            <div class="col-sm-6">
                                <input id="add-social-name" type="text" autocomplete="off" class="form-control"
                                    name="social-name" value="<?= $social_name ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="add-social-url" class="col-sm-2 control-label">Social
                                URL<span>*</span></label>
                            <div class="col-sm-6">
                                <input id="add-social-url" type="text" autocomplete="off" class="form-control"
                                    name="social-url" value="<?= $social_url ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="add-social-icon" class="col-sm-2 control-label">Social
                                Icon<span>*</span></label>
                            <div class="col-sm-6">
                                <input id="add-social-icon" type="text" autocomplete="off" class="form-control"
                                    name="social-icon" value="<?= $social_icon ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left"
                                    name="socials_form">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>