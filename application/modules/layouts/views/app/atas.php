<?php
	if($this->auth->is_login()) {
		if($this->auth->user()->role == "ADMIN") {
			redirect('administrator', 'refresh');
		}
	}
		
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		<?= $title ? "{$title} - " : '' ?>Hotelin | Layanan Booking Online Hotel Terbaik
	</title>

	<!-- Bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

	<!-- FA 6 -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" integrity="sha256-zgORubRsz5iTQajy0X9EdrJBq1vNm70B2ZW4YKdRy3s=" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/all.min.css" integrity="sha256-Z1K5uhUaJXA7Ll0XrZ/0JhX4lAtZFpT6jkKrEDT0drU=" crossorigin="anonymous">

	<!-- Flatpickr -->
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css">

	<!-- DataTables -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.13.1/datatables.min.css"/>
</head>
<body>

<?php $this->load->view('navbar'); ?>