<?php
/*
* Template Name: Add Your Projects Template
* @package WordPress
* @subpackage Code_for_Freedom
* @since Code for Freedom 1.0
*/

get_header();

// Include the featured content template.
get_template_part('front-banner');
?>
    <div id="main" class="container"><!-- #main container -->
        <div class="main-content col-xs-12 col-sm-8">
            <div class="add-new-project frontPost row">
                <div class="title">Add Your Projects</div>
                <div class="content">
                    <?php
                    if (!('POST' == $_SERVER['REQUEST_METHOD'] && !empty($_POST['action']) && $_POST['action'] == "new_project")) {
                        if (have_posts()) : while (have_posts()) : the_post();
                            the_content();
                        endwhile; endif;
                    }
                    ?>
                </div>
                <div id="postbox" class="row">
                    <?php
                    if ('POST' == $_SERVER['REQUEST_METHOD'] && !empty($_POST['action']) && $_POST['action'] == "new_project") {
                        $validate = true;

                        if (isset ($_POST['leader_name']) && $_POST['leader_name'] != '') {
                            $name = $_POST['leader_name'];
                        } else {
                            echo '<div class="alert alert-danger" role="alert">Please enter "Your name"</div>';
                            $validate = false;
                        }
                        if (isset ($_POST['leader_surname']) && $_POST['leader_surname'] != '') {
                            $surname = $_POST['leader_surname'];
                        } else {
                            echo '<div class="alert alert-danger" role="alert">Please enter "Your surname"</div>';
                            $validate = false;
                        }
                        if (isset ($_POST['email']) && $_POST['email'] != '') {
                            $email = $_POST['email'];
                        } else {
                            echo '<div class="alert alert-danger" role="alert">Please enter "Your e-mail"</div>';
                            $validate = false;
                        }
                        if (isset ($_POST['title']) && $_POST['title'] != '') {
                            $title = $_POST['title'];
                        } else {
                            echo '<div class="alert alert-danger" role="alert">Please enter "Title of the project"</div>';
                            $validate = false;
                        }
                        if (isset ($_POST['description']) && $_POST['description'] != '') {
                            $description = $_POST['description'];
                        } else {
                            echo '<div class="alert alert-danger" role="alert">Please enter "Description of the project"</div>';
                            $validate = false;
                        }
                        if (!isset ($_POST['rules'])) {
                            echo '<div class="alert alert-danger" role="alert">Please accept rules</div>';
                            $validate = false;
                        }
                    }

                    if (isset($validate) && $validate == true) {
                        ?>
                        <?php // Add the content of the form to $post as an array
                        $new_project = array(
                            'post_title' => $title,
                            'post_content' => $description,
                            'post_category' => array(get_cat_ID('Projects')), // Usable for custom taxonomies too
                            'post_status' => 'pending', // Choose: publish, preview, future, draft, etc.
                            'post_type' => 'post' //'post',page' or use a custom post type if you want to
                        );
                        //save the new post
                        $pid = wp_insert_post($new_project);
                        add_post_meta($pid, 'autor', $name . ' ' . $surname);
                        add_post_meta($pid, 'email', $email);

                        if (isset($_FILES['logo']) && !empty($_FILES['logo']['name'])) {
                            $uploadDir = wp_upload_dir();
                            $file = $_POST['logo'];
                            $uploadFile = $uploadDir['path'] . '/' . basename($file);

                            $upload = wp_upload_bits($_FILES['logo']['name'], null, file_get_contents($_FILES['logo']['tmp_name']));

                            if (isset($upload['error']) && $upload['error'] != 0) {
                                ?>
                                <div id="new_project" class="error">
                                    <?php echo 'There was an error uploading your file. The error is: ' . $upload['error'] ?>
                                </div>
                            <?php
                            } else {
                                $filename = $upload['file'];
                                $wp_fileType = wp_check_filetype(basename($filename), null);

                                $attachment = array(
                                    'guid' => $uploadDir['url'] . '/' . basename($filename),
                                    'post_mime_type' => $wp_fileType['type'],
                                    'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
                                    'post_content' => 'Project ' . $title,
                                    'post_status' => 'inherit'
                                );
                                // Insert the attachment.
                                $attach_id = wp_insert_attachment($attachment, $filename, $pid);

                                // Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
                                require_once(ABSPATH . 'wp-admin/includes/image.php');

                                // Generate the metadata for the attachment, and update the database record.
                                $attach_data = wp_generate_attachment_metadata($attach_id, $filename);
                                wp_update_attachment_metadata($attach_id, $attach_data);

                                // Add thumbnail to post
                                set_post_thumbnail($pid, $attach_id);
                            }
                        }
                        ?>
                        <div id="new_project" class="congrats">
                            Thank you for sending your project to us!
                        </div>
                    <?php } else { ?>
                        <form id="new_project" name="new_project" method="POST" action=""
                              enctype="multipart/form-data">
                                <span class="col-xs-12 col-sm-6">
                                    <label for="leader_name">Your name<span class="require">*</span></label><br/>
                                    <input type="text" id="leader_name" class="goodlook" value="" tabindex="1"
                                           size="255"
                                           required="required" name="leader_name"/>
                                </span>

                                <span class="col-xs-12 col-sm-6">
                                    <label for="leader_surname">Your surname<span class="require">*</span></label><br/>
                                    <input type="text" id="leader_surname" class="goodlook" value="" tabindex="1"
                                           size="255"
                                           required="required" name="leader_surname"/>
                                </span>

                                <span class="col-xs-12 col-sm-6 separate">
                                    <label for="email">Your e-mail<span class="require">*</span></label><br/>
                                    <input type="email" id="email" class="goodlook" value="" tabindex="1" size="255"
                                           required="required" name="email"/>
                                </span>

                                <span class="col-xs-12 col-sm-6">
                                    <label for="title">Title of your project<span class="require">*</span></label><br/>
                                    <input type="text" id="title" class="goodlook" value="" tabindex="1" size="255"
                                           required="required" name="title"/>
                                </span>

                                <span class="col-xs-12 col-sm-6">
                                    <label for="description">Description of your project<span
                                            class="require">*</span></label><br/>
                                    <textarea id="description" tabindex="3" name="description" cols="50"
                                              required="required" rows="6"></textarea>
                                </span>

                                <span class="col-xs-12 col-sm-6 logo">
                                    <label for="logo">Logo of the project (Optionally)</label><br/>
                                    <input type="file" name="logo" id="logo">
                                </span>

                                <span class="col-xs-12 col-sm-12 rulesBlock">
                                    <label>Consent for processing of personal data<span class="require">*</span></label><br/>
                                    <input type="checkbox" name="rules" id="rules" required="required">
                                    <label for="rules" class="smallOne">I agree for publishing this information on
                                        <a href="www.codeforfreedom.org" target="_self">www.codeforfreedom.org</a> and I
                                        agree that the event organizers will use my email
                                        to contact me regarding this event and not for any marketing purpose. I'm aware
                                        that I can withdraw my permission anytime by contacting the organizers at
                                        <a href="mailto:info@epf.org.pl" target="_blank">info@epf.org.pl</a></label>
                                </span>

                                <span class="col-xs-12 col-sm-12">
                                    <button type="submit" id="submit" name="submit">
                                        <span>submit</span>

                                        <div class="arrow">&#8594;</div>
                                    </button>
                                </span>

                            <input type="hidden" name="action" value="new_project"/>
                            <?php wp_nonce_field('new_project'); ?>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="main-sidebar col-xs-12 col-sm-3 col-sm-offset-1">
            <?php get_sidebar('front'); ?>
        </div>
    </div>
<?php

get_footer();