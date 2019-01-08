<html>
    <form>
        <input type="file" id="file" size="50" onchange="fileChosen()">
        <input id="submit-button" type="button" value="import" onclick="upload()" style="display: none" />
    </form>

</html>

<script>
    function fileChosen() {
        document.getElementById("submit-button").style.display = 'block';

        var files = document.getElementById("file").files;
        console.log('files', files);
    }

    function upload() {
        var files = document.getElementById("file").files;
    }

    // How to send my file data to the createNewUnit PHP function?
</script>


<?php 
    // Format file and insert new post
    function createNewUnit() {
        wp_insert_post( $post, $wp_error );
    }
?>
