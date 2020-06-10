<?php
if (isset($_POST["image"])) {
	$tempdir = "assets/img/profile/";
	if (!file_exists($tempdir))
		mkdir($tempdir);

	$data = $_POST["image"];
	$nama = $_POST['user'];
	$image_array_1 = explode(";", $data);
	$image_array_2 = explode(",", $image_array_1[1]);
	$data = base64_decode($image_array_2[1]);

	$imageName = $tempdir . $nama . '.png';
	file_put_contents($imageName, $data);
}
