<?php
if (isset($_SESSION['message'])) {
	$message = $_SESSION['message'];
}
?><!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Image Management | PHP Motors</title>
        <link rel="stylesheet" href="/phpmotors/css/styles.css" type="text/css" media="screen">
    </head>
    <body>
        <header>
           <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>
        </header>
        <nav>
            <?php echo $navList; ?>
        </nav>
        <main>
			<h1>Image Management</h1>
			<p>Welcome to Image Management! Please select one of the option below.</p>

			<h2>Add New Vehicle Image</h2>
			<?php if (isset($message)) { echo $message; } ?>
			<form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
				<label for="invItem">Vehicle</label>
					<?php echo $prodSelect; ?>
					<fieldset>
						<label>Is this the main image for the vehicle?</label>
						<label for="priYes" class="pImage">Yes</label>
						<input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
						<label for="priNo" class="pImage">No</label>
						<input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
					</fieldset>
				<label>Upload Image:</label>
				<input type="file" name="file1">
				<button type="submit">Upload</button>
				<input type="hidden" name="action" value="upload">
			</form>

			<h2>Existing Images</h2>
            <p class="notice">If deleting an image, always delete the thumbnail too and vice versa.</p>
			<?php if (isset($imageDisplay)) { echo $imageDisplay; } ?>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </body>
</html>
<?php unset($_SESSION['message']); ?>