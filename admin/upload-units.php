<html>
    <div id="content">
        <h1> Upload New Unit</h1>
        <section>
            <p>The file must be <b>HTML</b> format. To convert your Word Doc to HTML, we recommend using Google Docs: </p>
            <ol class="instructions">
                <li> Upload your Word Doc to Google Drive</li>
                <li> Open the Doc </li>
                <li> At the top of the screen select "Open with" dropdown, and then "Google Docs" from the menu </li>
                <li> From the Google Doc, go to File menu, select Download As, then select Web Page (.html, zipped) </li>
                <li> It will create a new zipped file on your computer. Unzip it by double clicking, and locate the .html file </li>
                <li> Upload the .html file below! </li>
            </ol>
        </section>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="file" id="file" name="file" size="50" onchange="fileChosen()">
            <input type="submit" name="submit" id="submit-button" style="display: none" />

            <?php wp_nonce_field( 'upload-file-nonce','upload-file-nonce' ); ?>
        </form>
    </div>
</html>

<style>
    #content {
        background: #fff;
        padding: 30px;
        margin: 20px 0px;
        display: inline-block;
    }
    h1 {
        text-align: center;
    }
    section {
        border: 1px solid #ccc;
        display: inline-block;
        margin: 15px 0px 30px;
        padding: 20px;
    }
    input#file {
        font-size: 16px;
    }
    #submit-button {
        font-size: 16px;
    }
    .msg {
        font-size: 16px;
        margin: 15px 0px 30px;
        padding: 20px;
        background: #fff;
        max-width: 50%;
    }
    .msg.fail {
        border: 1px solid #e46c6c;
    }
    .msg.success {
        border: 1px solid #23c323;
    }
</style>

<script>
    function fileChosen() {
        document.getElementById("submit-button").style.display = 'block';
    }
</script>

<?php
    if( isset($_POST['upload-file-nonce']) && wp_verify_nonce( $_POST['upload-file-nonce'], 'upload-file-nonce' ) ) {
        if(current_user_can( 'manage_options' ) ) {

          if( isset($_POST["submit"])) {
            if ($_FILES["file"]["type"] === 'text/html') {
                $my_post = array(
                  'post_type'     => 'Unit',
                  'post_title'    => str_replace(".html", " ", $_FILES["file"]["name"] ),
                  'post_content'  => file_get_contents($_FILES["file"]["tmp_name"]),
                  'post_status'   => 'publish',
                  'post_author'   => 1,
                  'has_archive'   => true,
                  'post_category' => array( 8,39 )
                );

                wp_insert_post( $my_post );

                $postId = wp_insert_post($my_post);
                $url = get_permalink($postId);

                echo '<div class="msg success">File '.str_replace(".html", " ", $_FILES["file"]["name"]).' successfully uploaded. 
                      <a href="'.admin_url().'edit.php?post_type=unit">View All Units</a> or <a href="'.$url.'">View Post</a>
                      </div>';

                /*
                echo ' '.$_FILES["file"]["size"];
                */

            } else {
                echo '<div class="msg fail">Upload failed. Please ensure file is HTML format and try again. </div>';
            }
          }
        }
    }
?>
