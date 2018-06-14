

<div class="row">
	<?php
		if(!isset($_GET["engelliler"])){
	?>
		<H1>Hiç bir engel bulunamadı.</H1>
	<?php
		}else{
	?>
	<table class="table">
		<thead>
			<tr>
				<td>Kim</td>
				<td>Engel Tipi</td>
				<td>Engel bitiş tarihi</td>
				<td>Engel başlama tarihi</td>
				<td>İşlemler</td>
			</tr>
		</thead>
		<tbody>
	<?php
		foreach ($_GET["engelliler"] as $value) {
	?>
			<tr>
				<td><?php echo $value["kullanici_adi"].' '.$value["kullanici_soyadi"]; ?></td>
				<td><?php echo $value["engel_tipi"]; ?></td>
				<td><?php echo $value["engelleme_tarihi"]; ?></td>
				<td><?php echo $value["engel_suresi"]; ?></td>
				<td>
					<a class="btn btn-danger" href="<?php echo Kok_Dizine_Yonlendir().$value['id'].'/engel-kaldir.html' ?>">Kaldır</a>
				</td>
			</tr>
	<?php							
		}

	?>
			

		</tbody>
	</table>
	<?php
	}
	?>
</div>