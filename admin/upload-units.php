<html>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" id="file" name="file" size="50" onchange="fileChosen()">
        <input type="submit" name="submit" id="submit-button" style="display: none" />

        <?php wp_nonce_field( 'upload-file-nonce','upload-file-nonce' ); ?>
    </form>

</html>

<script>
    function fileChosen() {
        document.getElementById("submit-button").style.display = 'block';

        var files = document.getElementById("file").files;
        console.log('files', files);
    }

</script>


<?php 
    if( isset($_POST['upload-file-nonce']) && wp_verify_nonce( $_POST['upload-file-nonce'], 'upload-file-nonce' ) ) {
        if(current_user_can( 'manage_options' ) ) {


          if( isset($_POST["submit"])) {
            echo 'File uploaded: ';
            echo ' '.str_replace(".html", " ", $_FILES["file"]["name"] );
            echo ' '.$_FILES["file"]["type"];
            echo ' '.$_FILES["file"]["size"];

            $my_post = array(
              'post_type'     => 'Unit',
              'post_title'    => str_replace(".html", " ", $_FILES["file"]["name"] ),
              'post_content'  => file_get_contents($_FILES["file"]["tmp_name"]),
              'post_status'   => 'publish',
              'post_author'   => 1,
              'post_category' => array( 8,39 )
            );

            wp_insert_post( $my_post );
          }


        }
    } 
?>
