<?php
require("admin/server/config.php")
?>
<?php
// Fetch references
$statement = $PDO->prepare("SELECT * FROM details WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $resume = $row['resume'];
    $email = $row['email'];
    $phone_number = $row['phone_number'];
}

// Fetch About Section
$statement1 = $PDO->prepare("SELECT * FROM about_me WHERE id=1");
$statement1->execute();
$result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
foreach ($result1 as $row) {
    $aboutMe_image = $row['image'];
    $aboutMe_desc = $row['description'];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="skills.css" />

    <title>Wahab Tlais</title>


</head>

<body>
    <div class="container">
        <!-- --------------- HEADER --------------- -->
        <nav id="header">
            <div class="nav-logo">
                <a href="#" class="nav-name">Wahab</a>
            </div>
            <div class="nav-menu" id="myNavMenu">
                <ul class="nav_menu_list">
                    <li class="nav_list">
                        <a href="#home" class="nav-link active-link">Home</a>
                        <div class="circle"></div>
                    </li>
                    <li class="nav_list">
                        <a href="#about" class="nav-link">About</a>
                        <div class="circle"></div>
                    </li>
                    <li class="nav_list">
                        <a href="#skills" class="nav-link">Skills</a>
                        <div class="circle"></div>
                    </li>
                    <li class="nav_list">
                        <a href="#projects" class="nav-link">Projects</a>
                        <div class="circle"></div>
                    </li>
                    <li class="nav_list">
                        <a href="#contact" class="nav-link">Contact</a>
                        <div class="circle"></div>
                    </li>
                </ul>
            </div>
            <div class="nav-button">
                <button class="btn">
                    <a href="assets/pdf/<?= $resume ?>">
                        Download CV <i class="uil uil-file-alt"></i>
                    </a>
                </button>
            </div>
            <div class="nav-menu-btn">
                <i class="uil uil-bars" onclick="myMenuFunction()"></i>
            </div>
        </nav>

        <!-- -------------- MAIN ---------------- -->
        <main class="wrapper">
            <!-- -------------- FEATURED BOX ---------------- -->
            <section class="featured-box" id="home">
                <div class="featured-text">
                    <div class="featured-name">
                        <h1>WAHAB TLAIS</h1>
                    </div>
                    <div class="featured-job-name">
                        <p>I'm <span class="typedText"></span></p>
                    </div>
                    <div class="featured-text-info">
                        <p>
                            Passionate about Building Innovative Solutions. Empowering the
                            Next Generation of Coders.
                        </p>
                    </div>

                    <div class="social_icons">
                        <?php
                        $statement = $PDO->prepare("SELECT * FROM social_links");
                        $statement->execute();
                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $link) :
                        ?>
                            <a href="<?= $link['social_url'] ?>" class="icon"><i class="<?= $link['social_icon'] ?>"></i></a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="scroll-icon-box">
                    <a href="#about" class="scroll-btn">
                        <i class="uil uil-mouse-alt"></i>
                        <p>Scroll Down</p>
                    </a>
                </div>
            </section>
            <!-- -------------- ABOUT BOX ---------------- -->
            <section class="section" id="about">
                <div class="top-header">
                    <h1>About Me</h1>
                </div>
                <div class="row">
                    <div class="about-info">
                        <div class="col">
                            <div class="featured-image">
                                <div class="image">
                                    <img src="assets/images/<?= $aboutMe_image ?>" alt="avatar" />
                                </div>
                            </div>
                        </div>
                        <div class="col about-text">
                            <h3>My introduction</h3>
                            <p>
                                <?= $aboutMe_desc ?>
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- -------------- SKILLS BOX ---------------- -->
            <section class="section" id="skills">
                <div class="top-header">
                    <h1>Skills</h1>
                </div>
                <div class="skill-bars">
                    <?php
                    $statement = $PDO->prepare("SELECT * FROM skills");
                    $statement->execute();
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $skill) :
                    ?>
                        <div class="bar">
                            <div class="info">
                                <span><?= $skill['title'] ?></span>
                            </div>
                            <div class="progress-line <?= $skill['class'] ?>">
                                <span style="content:<?= $skill['percentage'] ?>; width: <?= $skill['percentage'] ?> ;
                                ">
                                </span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <!-- -------------- PROJECT BOX ---------------- -->

            <section class="section" id="projects">
                <div class="top-header">
                    <h1>Projects</h1>
                </div>
                <div class="project-container">
                    <?php
                    $statement = $PDO->prepare("SELECT * FROM projects");
                    $statement->execute();
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $project) :
                    ?>
                        <div class="project-box">
                            <img src="assets/images/<?= $project['image'] ?>" alt="<?= $project['name'] ?>" />
                            <h3><?= $project['name'] ?></h3>
                            <label><?= $project['description'] ?></label>
                        </div>
                    <?php endforeach ?>

                </div>
            </section>

            <!-- -------------- CONTACT BOX ---------------- -->

            <section class="section" id="contact">
                <div class="top-header">
                    <h1>Get in touch</h1>
                    <span>Do you have a project in your mind, contact me here</span>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="contact-info">
                            <h2>Find Me <i class="uil uil-corner-right-down"></i></h2>
                            <p>
                                <i class="uil uil-envelope"></i> Email: <?= $email ?>
                            </p>
                            <p><i class="uil uil-phone"></i> Tel: <?= $phone_number ?></p>
                        </div>
                    </div>
                    <div class="col">
                        <form id="contactForm" onsubmit="sendEmail(); return false;">
                            <div class="form-control">
                                <div class="form-inputs">
                                    <input type="text" id="name" class="input-field" placeholder="Name" required />
                                    <input type="email" id="email" class="input-field" placeholder="Email" required />
                                </div>
                                <div class="text-area">
                                    <textarea id="message" placeholder="Message" required></textarea>
                                </div>
                                <div class="form-button">
                                    <button type="submit" class="btn">
                                        Send <i class="uil uil-message"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </main>

        <!-- --------------- FOOTER --------------- -->
        <footer>
            <div class="top-footer">
                <p>Wahab Tlais .</p>
            </div>
            <div class="middle-footer">
                <ul class="footer-menu">
                    <li class="footer_menu_list">
                        <a href="#home">Home</a>
                    </li>
                    <li class="footer_menu_list">
                        <a href="#about">About</a>
                    </li>
                    <li class="footer_menu_list">
                        <a href="#skills">Skills</a>
                    </li>
                    <li class="footer_menu_list">
                        <a href="#projects">Projects</a>
                    </li>
                    <li class="footer_menu_list">
                        <a href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <div class="footer-social-icons">
                <?php
                $statement = $PDO->prepare("SELECT * FROM social_links");
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $link) :
                ?>
                    <a href="<?= $link['social_url'] ?>" class="icon"><i class="<?= $link['social_icon'] ?>"></i></a>
                <?php endforeach; ?>
            </div>
            <div class="bottom-footer">
                <p>
                    Copyright &copy;
                    <a href="#home">Wahab Tlais</a> - All rights reserved
                </p>
            </div>
        </footer>
    </div>

    <script src="https://cdn.emailjs.com/dist/email.min.js"></script>
    <script>
        emailjs.init("your_public_key");
    </script>

    <script>
        function sendEmail() {
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;
            var message = document.getElementById('message').value;

            var templateParams = {
                name: name,
                email: email,
                message: message
            };

            emailjs.send("your_service_id", "your_template_id", templateParams)
                .then(function(response) {
                    console.log("Email sent successfully:", response);
                    // Clear the form inputs
                    document.getElementById('name').value = '';
                    document.getElementById('email').value = '';
                    document.getElementById('message').value = '';
                }, function(error) {
                    console.log("Email failed to send:", error);

                });
        }
    </script>
    <!-- ----- TYPING JS Link ----- -->
    <script src="https://unpkg.com/typed.js@2.0.16/dist/typed.umd.js"></script>

    <!-- ----- SCROLL REVEAL JS Link----- -->
    <script src="https://unpkg.com/scrollreveal"></script>

    <!-- ----- MAIN JS ----- -->
    <script src="assets/js/main.js"></script>
</body>

</html>