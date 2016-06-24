<?php
include "init.php";

$aId = (isset($_REQUEST['aId']) ? $_REQUEST['aId'] : 0);
?><html>

<body>
<?php
	$api->setPath('swim/list/team?team='.TEAM.'&active='.ACTIVE);
	$data = $api->getData();
		//echo "<pre>";
		//print_r($data);
		//echo "</pre>";



	foreach ($data as $row => $swimmer) :

		try {
			?><h1>Persoonlijke records van <?php echo $swimmer->aFirstName; ?> <?php echo $swimmer->aLastName; ?></h1>
			<table width='100%'>
			<tr><td><strong>Slag</strong></td><td><strong>Baan</strong></td><td><strong>Tijd</strong></td><td><strong>Datum</strong></td><td><strong>Wedstrijdnaam</strong></td><td><strong>Plaats (Land)</strong></td></tr>
			<?php
			$api->setPath('swim/list/records?id='.$swimmer->aId);
			$data = $api->getData();
			foreach ($data as $row => $d) {
				echo "<tr>";
				echo "<td>".calcStyle($d->swimid)."</td>";
				echo "<td>".($d->mCourse == 1 ? '50m' : '25m')."</td>";
				echo "<td>".calcTime($d->resulttime/1000)."</td>";
				echo "<td>".calcDate($d->date)."</td>";
				echo "<td>".$d->mName."</td>";
				echo "<td>".$d->mCity." (".$d->mNation.")</td>";
				echo "</tr>";
			}
			?></table><?php
		} catch (Exception $e) {
			echo 'Error: ',  $e->getMessage(), "\n";
		}

		?>

<?php  endforeach; ?>
</body>

</html>