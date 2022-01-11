<?php

require '../components/header.php';

    ?>

<main>



    <form id="form" enctype="multipart/form-data"  action="./upload.php" method="post">

        <div>

            <label for="file">Select a file:</label>

            <input type="file" id="file" name="image_file"/>

            <label for="description">Write a description:</label>

            <textarea row="5" cols="50" name="description"> </textarea>

           

        </div>

        <div>

            <button type="submit">Upload</button>

        </div>

    </form>

</main>

</body>

</html>
