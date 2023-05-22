<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <!-- Stylesheets
	============================================= -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('img/favicon/apple-touch-icon.png'); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('img/favicon/favicon-32x32.png'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('img/favicon/favicon-16x16.png'); ?>">
    <link rel="manifest" href="<?= base_url('img/favicon/site.webmanifest'); ?>">

    <link rel="stylesheet" href="<?= base_url('css/bootstrap.css'); ?>" type="text/css" />
    <link rel="stylesheet" href="<?= base_url('style.css'); ?>" type="text/css" />
    <link rel="stylesheet" href="<?= base_url('css/swiper.css'); ?>" type="text/css" />

    <link rel="stylesheet" href="<?= base_url('css/dark.css'); ?>" type="text/css" />
    <link rel="stylesheet" href="<?= base_url('css/font-icons.css'); ?>" type="text/css" />
    <link rel="stylesheet" href="<?= base_url('css/animate.css'); ?>" type="text/css" />
    <link rel="stylesheet" href="<?= base_url('css/magnific-popup.css'); ?>" type="text/css" />

    <!-- Date & Time Picker CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Kindergarten Demo Specific Stylesheet -->
    <link rel="stylesheet" href="<?= base_url('demos/kindergarten/kindergarten.css'); ?>" type="text/css" />
    <!-- Kindergarten Custom Css -->
    <link rel="stylesheet" href="<?= base_url('demos/kindergarten/css/fonts.css'); ?>" type="text/css" /> <!-- Kindergarten Custom Fonts -->
    <!-- / -->

    <link rel="stylesheet" href="<?= base_url('css/custom.css'); ?>" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="<?= base_url('css/colors.php'); ?>" type="text/css" />

    <!-- Document Title
	============================================= -->
    <title>Uitsig Kleuterskool</title>

</head>

<body class="stretched" id="home">


    <!-- Document Wrapper
	============================================= -->
    <div id="wrapper" class="clearfix">
        <!-- Content
		============================================= -->
        <section id="content">

            <div class="section" style="padding: 100px 0; background-color: #ECF4F1">
                <div class="shape-divider" data-shape="wave-5" data-height="50"></div>
                <div class="position-absolute top-0 start-0 w-100 h-100" style="background: url('<?= base_url('demos/kindergarten/images/hero-bg-icons.svg'); ?>') center center / cover; opacity: 0.04"></div>
                <div class="container z-3">
                    <h2 class="color text-center h1 fw-bold mb-5 pb-2"><?= $heading; ?>:</h2>

                    <div class="masonry-thumbs grid-container grid-4" data-big="4" data-lightbox="gallery">
                        <?php
                        foreach ($file_map as $file) {
                            echo "<a class='grid-item' href='" . base_url('img/gallery/' . $gallery . '/full/' . $file) . "' data-lightbox='gallery-item'><img src='" . base_url('img/gallery/' . $gallery . '/thumb/' . $file) . "' alt='Foto'></a>";
                        }
                        ?>
                    </div>
                </div>
                <div class="shape-divider" data-shape="wave-5" data-position="bottom" data-height="60"></div>
                <div class="container z-3" style="padding: 40px 0;">
                    <a class="btn text-white bg-color rounded-1 py-3 px-5 fw-medium float-end" href="<?= base_url('#fotos'); ?>"><i class="icon-line-arrow-left position-relative" style="top: 2px"></i> Terug</a>
                </div>
            </div>

        </section>

        <!-- Footer
		============================================= -->
        <footer id="footer" class="border-0" style="background-image: linear-gradient(to top, #FFF, #FFF);">

            <div class="col-auto text-center mt-4 text-smaller pb-3 font-primary">
                Kopiereg &copy; <?= date("Y"); ?> Alle regte voorbehou
            </div>
            <div class="footer-img">
                <img src="<?= base_url('img/footer.webp'); ?>" alt="Uitsig Header">
            </div>

        </footer><!-- #footer end -->

    </div><!-- #wrapper end -->


    <!-- Go To Top
	============================================= -->
    <div id="gotoTop" class="icon-hand-up rounded-circle"></div>

    <!-- JavaScripts
	============================================= -->
    <script src="js/jquery.js"></script>
    <script src="js/plugins.min.js"></script>

    <!-- Include Date Range Picker -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Footer Scripts
	============================================= -->
    <script src="js/functions.js"></script>

    <?php
    if (isset($scripts_to_load)) :
        foreach ($scripts_to_load as $row) :
            if (substr($row, 0, 4) == "http") {
                $js_link = $row;
            } else {
                $js_link = base_url('js/' . $row);
            }
            echo "<script src='$js_link'></script>
            ";
        endforeach;
    endif;
    ?>

</body>

</html>