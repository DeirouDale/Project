<?php
include("../connection.php");

$school_id = $_GET['school_id'];

$query = mysqli_query($conn, "SELECT * FROM schools WHERE school_id = '$school_id' ");
if (!$query) {
    die("Query failed: " . mysqli_error($conn));
}

$school = mysqli_fetch_assoc($query);

if (!$school) {
    die("School not found or invalid school ID.");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<?php include '../Admin/constants/style.php'; ?>

	<title>SDO Batac LRMS</title>
</head>
<body>

	<!-- SIDEBAR -->
	<?php include '../Admin/constants/side_bar.php'; ?>
	<!-- SIDEBAR -->

	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<?php include("../Admin/constants/nav.php"); ?>	
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<!-- Dashboard -->
			<div class="container-Dashboard" id="Dashboard">
				<div class="head-title">
					<div class="left">
						<h1>School Information</h1><hr>
					</div>
				</div>
			</div>
			
			<!-- Display School Information -->
			<div class="title">
            <img src="../Img/school_logos/<?= $school['logo'] ?>.png" alt="School Logo" class="school-logo">
            <h2><?= $school['school_name'] ?></h2>
                <h4><?= $school['number'] ?>, <?= $school['street'] ?>, <?= $school['barangay'] ?>, <?= $school['municipality'] ?>, <?= $school['province'] ?>, <?= $school['zip_code'] ?></h4>
            <div class="columns">
            <!-- About Column -->
            <div class="column">
                <h3>About</h3>
        <div class="value-container">
            <p><strong>Previous Name:</strong> <?= $school['previous_name'] ?></p>
            <a href="edit.php?field=previous_name&school_id=<?= $school['school_id'] ?>" class="edit-icon"><i class='bx bx-edit'></i></a>
        </div>
        <div class="value-container">
            <p><strong>School ID:</strong> <?= $school['school_id'] ?></p>
            <a href="edit.php?field=school_id&school_id=<?= $school['school_id'] ?>" class="edit-icon"><i class='bx bx-edit'></i></a>
        </div>
        <div class="value-container">
            <p><strong>Type:</strong> <?= $school['type'] ?></p>
            <a href="edit.php?field=type&school_id=<?= $school['school_id'] ?>" class="edit-icon"><i class='bx bx-edit'></i></a>
        </div>
        <div class="value-container">
            <p><strong>Date Established:</strong> <?= $school['date_established'] ?></p>
            <a href="edit.php?field=date_established&school_id=<?= $school['school_id'] ?>" class="edit-icon"><i class='bx bx-edit'></i></a>
        </div>
        <div class="value-container">
            <p><strong>Region:</strong> <?= $school['region'] ?></p>
            <a href="edit.php?field=region&school_id=<?= $school['school_id'] ?>" class="edit-icon"><i class='bx bx-edit'></i></a>
        </div>
        <div class="value-container">
            <p><strong>Division:</strong> <?= $school['division'] ?></p>
            <a href="edit.php?field=division&school_id=<?= $school['school_id'] ?>" class="edit-icon"><i class='bx bx-edit'></i></a>
        </div>
        <div class="value-container">
            <p><strong>School District:</strong> <?= $school['school_district'] ?></p>
            <a href="edit.php?field=school_district&school_id=<?= $school['school_id'] ?>" class="edit-icon"><i class='bx bx-edit'></i></a>
        </div>
        <div class="value-container">
            <p><strong>Legislative District:</strong> <?= $school['legislative_district'] ?></p>
            <a href="edit.php?field=legislative_district&school_id=<?= $school['school_id'] ?>" class="edit-icon"><i class='bx bx-edit'></i></a>
        </div>
    </div>
    <!-- Contact Column -->
    <div class="column">
        <h3>Contact</h3>
        <div class="value-container">
            <p><strong>School Head:</strong> <?= $school['school_head'] ?></p>
            <a href="edit.php?field=school_head&school_id=<?= $school['school_id'] ?>" class="edit-icon"><i class='bx bx-edit'></i></a>
        </div>
        <div class="value-container">
            <p><strong>Address:</strong> <?= $school['number'] ?>, <?= $school['street'] ?>, <?= $school['barangay'] ?>, <?= $school['municipality'] ?>, <?= $school['province'] ?>, <?= $school['zip_code'] ?></p>
            <a href="edit.php?field=address&school_id=<?= $school['school_id'] ?>" class="edit-icon"><i class='bx bx-edit'></i></a>
        </div>
        <div class="value-container">
            <p><strong>Telephone Number:</strong> <?= $school['telephone_number'] ?></p>
            <a href="edit.php?field=telephone_number&school_id=<?= $school['school_id'] ?>" class="edit-icon"><i class='bx bx-edit'></i></a>
        </div>
        <div class="value-container">
            <p><strong>Mobile Number:</strong> <?= $school['mobile_number'] ?></p>
            <a href="edit.php?field=mobile_number&school_id=<?= $school['school_id'] ?>" class="edit-icon"><i class='bx bx-edit'></i></a>
        </div>
        <div class="value-container">
            <p><strong>Fax Number:</strong> <?= $school['fax_number'] ?></p>
            <a href="edit.php?field=fax_number&school_id=<?= $school['school_id'] ?>" class="edit-icon"><i class='bx bx-edit'></i></a>
        </div>
        <div class="value-container">
            <p><strong>Website:</strong> <a href="<?= $school['website'] ?>" target="_blank"><?= $school['website'] ?></a></p>
            <a href="edit.php?field=website&school_id=<?= $school['school_id'] ?>" class="edit-icon"><i class='bx bx-edit'></i></a>
        </div>
        <div class="value-container">
            <p><strong>E-mail:</strong> <?= $school['e-mail'] ?></p>
            <a href="edit.php?field=email&school_id=<?= $school['school_id'] ?>" class="edit-icon"><i class='bx bx-edit'></i></a>
        </div>
    </div>

    <!-- Programs Column -->
    <div class="column">
        <h3>Programs</h3>
        <div class="value-container">
            <p><strong>Central School:</strong> <?= $school['central_school'] ? 'Yes' : 'No' ?></p>
            <a href="edit.php?field=central_school&school_id=<?= $school['school_id'] ?>" class="edit-icon"><i class='bx bx-edit'></i></a>
        </div>
        <div class="value-container">
            <p><strong>SPED Center:</strong> <?= $school['sped_center'] ? 'Yes' : 'No' ?></p>
            <a href="edit.php?field=sped_center&school_id=<?= $school['school_id'] ?>" class="edit-icon"><i class='bx bx-edit'></i></a>
        </div>
        <div class="value-container">
            <p><strong>With SPED:</strong> <?= $school['with_sped'] ? 'Yes' : 'No' ?></p>
            <a href="edit.php?field=with_sped&school_id=<?= $school['school_id'] ?>" class="edit-icon"><i class='bx bx-edit'></i></a>
        </div>
        <div class="value-container">
            <p><strong>Annex:</strong> <?= $school['annex'] ? 'Yes' : 'No' ?></p>
            <a href="edit.php?field=annex&school_id=<?= $school['school_id'] ?>" class="edit-icon"><i class='bx bx-edit'></i></a>
        </div>
        <div class="value-container">
            <p><strong>Kindergarten:</strong> <?= $school['kindergarten'] ? 'Yes' : 'No' ?></p>
            <a href="edit.php?field=kindergarten&school_id=<?= $school['school_id'] ?>" class="edit-icon"><i class='bx bx-edit'></i></a>
        </div>
        <div class="value-container">
            <p><strong>Grades 1 - 6:</strong> <?= $school['grades'] ? 'Yes' : 'No' ?></p>
            <a href="edit.php?field=grades&school_id=<?= $school['school_id'] ?>" class="edit-icon"><i class='bx bx-edit'></i></a>
        </div>
    </div>
</div>
</div>


		</main>
	</section>
	<script src="../script.js"></script>
    <script>
        $(document).ready(function() {
            // Show save icon when editing
            $('.editable').on('focus', function() {
                $(this).siblings('.save-icon').addClass('active');
            });

            // Hide save icon when not editing
            $('.editable').on('blur', function() {
                $(this).siblings('.save-icon').removeClass('active');
            });

            // Handle save button click
            $('.save-icon').on('click', function(e) {
                e.preventDefault();

                var $this = $(this);
                var field = $this.data('field');
                var value = $this.siblings('.editable').text();
                var schoolId = '<?= $school['school_id'] ?>'; // Replace with actual school ID

                $.ajax({
                    url: 'save.php',
                    method: 'POST',
                    data: {
                        field: field,
                        value: value,
                        school_id: schoolId
                    },
                    success: function(response) {
                        // Optionally show a success message or handle response
                        $this.removeClass('active');
                    },
                    error: function() {
                        // Optionally show an error message
                    }
                });
            });
        });
    </script>
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
</body>
</html>