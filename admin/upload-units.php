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
            echo 'file to upload: ';
            echo ' '.$_FILES["file"]["name"];
            echo ' '.$_FILES["file"]["type"];
            echo ' '.$_FILES["file"]["size"];
          }


        }
    } 
?>
