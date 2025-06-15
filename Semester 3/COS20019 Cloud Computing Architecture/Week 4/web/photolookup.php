<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Photo Album</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			background-color: #f7f7f7;
		}

		.container {
			max-width: 600px;
			margin: 0 auto;
			padding: 20px;
			background-color: #ffffff;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
		}

		h2 {
			margin-bottom: 20px;
		}

		form {
			width: 100%;
		}

		label {
			display: block;
			margin-bottom: 5px;
		}

		input[type="text"],
		input[type="date"] {
			width: 96%;
			padding: 10px;
			margin-bottom: 15px;
			border: 1px solid #ccc;
			border-radius: 4px;
			font-size: 16px;
		}

		input[type="submit"] {
			background-color: #007bff;
			color: #ffffff;
			border: none;
			padding: 10px 20px;
			border-radius: 4px;
			cursor: pointer;
		}

		input[type="submit"]:hover {
			background-color: #0056b3;
		}

		a {
			color: #007bff;
		}
	</style>
</head>
<body>
	<div class="container">
		<h2>Photo lookup</h2>
		<form name="upload" id="upload">
			<fieldset>
				<label for="phototitle">Photo title:</label>
				<input type="text" name="phototitle" id="phototitle" />

				<label for="keyword">Keyword:</label>
				<input type="text" name="keyword" id="keyword" />

				<label for="fromdate">From Date:</label>
				<input type="date" name="fromdate" id="fromdate" />

				<label for="todate">To Date:</label>
				<input type="date" name="todate" id="todate" />

				<input type="submit" value="Search" />
			</fieldset>
		</form>
		<p><a href="photouploader.php" title="Photo Uploader">Photo Uploader</a></p>
	</div>
</body>
</html>
