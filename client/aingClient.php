<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function()
	{
		$('#forming').submit(function()
		{
			$.ajax({
				url : 'carigo.php',
				type : 'POST',
				data : $(this).serialize(),
				success : function(data)
				{
					$('#data').html(data);
				}
			});
			return false;
		});
	});
</script>
<fieldset>
<legend>
Cari *GET*
</legend>
<form action="" method="post" id="forming">
	Ingin mencari apa <br>
	<select name="kat">
		<option value="mahasiswa">
			Mahasiswa
		</option>
		<option value="dosen">
			Dosen
		</option>
		
	</select>
	<br>
	Masukkan Id<br>	
	<input type="search" name="search" />
	<input type="submit" id="submit"/>
</form>
</fieldset>
<div id="data">

</div>
<hr>
<div id="datamahasiswa" style="float:left">
	<h2>
		Data Mahasiswa
	</h2>
	<?php
		$url = "http://localhost/rest/mahasiswaService/service/api.php/getAllMahasiswa";
		$data = simplexml_load_file($url);
	?>
	<table border=1>
		<tr>
			<th>
				NIM
			</th>
			<th>
				Nama
			</th>
			<th>
				Kelas
			</th>
			<th>
				Prodi
			</th>
			
		</tr>
		
		<?php
		foreach($data->mhs as $mahasiswa)
		{
		?>
		<tr>
			<td>
				<?php
					echo $mahasiswa->nim;
				?>
			</td>
			<td>
				<?php
					echo $mahasiswa->nama;
				?>
			</td>
			<td>
				<?php
					echo $mahasiswa->kelas;
				?>
			</td>
			<td>
				<?php
					echo $mahasiswa->prodi;
				?>
			</td>
		</tr>
		<?php
		}
		?>
	</table>
</div>
<div id="dataDosen" style="margin:25px;margin-left:350px;">
	<h2>
		Data Dosen
	</h2>
	<?php
		$url = "http://localhost/rest/mahasiswaService/service/api.php/getAllDosen";
		$data = simplexml_load_file($url);
	?>
	<table border=1>
		<tr>
			<th>
				Kode Dosen
			</th>
			<th>
				Nama
			</th>
			<th>
				Mata Kuliah
			</th>
		</tr>
		
		<?php
		foreach($data->dsn as $dosen)
		{
		?>
		<tr>
			<td>
				<?php
					echo $dosen->kode_dosen;
				?>
			</td>
			<td>
				<?php
					echo $dosen->nama;
				?>
			</td>
			<td>
				<?php
					echo $dosen->kode_mtk;
				?>
			</td>
		</tr>
		<?php
		}
		?>
	</table>
</div>
<hr>
<div style="clear:both"/>
<div id="insertMahasiswa">
<fieldset style="width:325px;float:left">
<legend>
	Insert Mahasiswa *POST*
</legend>
	<form action="" method="post">
		<label>
			Nim
		</label>
		
		<input type="hidden" name="method" value="post"/>
		<input type="text" placeholder="Nim" name="nim"/>
		<br>
		<label>
			Nama
		</label>
		<input type="text" placeholder="Nama" name="nama"/>
		<br>
		<label>
			Prodi
		</label>
		<select name="prodi">
			<option value="TK">Teknik Komputer</option>
			<option value="MI">Manajemen Informatika</option>
			<option value="KA">Komputerisasi Akutansi</option>
		</select>
		<br>
		<label>
			Kelas
		</label>
		<select name="kelas">
			<option value="pce1008">PCE-10-08</option>
			<option value="pce1009">PCE-10-09</option>
			<option value="pce1010">PCE-10-10</option>
		</select>
		<br>
		<input type="hidden" name="jenis" value="mahasiswa">
		<input type="submit" value="Insert">
	</form>
	
	</fieldset>
</div>

<div id="insertMahasiswa">
<fieldset style="width:325px;float:left">
<legend>
	Insert DOSEN *POST*
</legend>
	<form action="" method="post">
			<input type="hidden" name="method" value="post"/>

		<label>
			Kode Dosen
		</label>
		<input type="text" placeholder="Kode Dosen" name="kd_dsn"/>
		<br>
		<label>
			Nama
		</label>
		<input type="text" placeholder="Nama" name="nama"/>
		<br>
		<label>
			Kode Matakuliah
		</label>
		<select name="kd_mtk">
			<option value="web">Web</option>
			<option value="sisop">Sistem Operasi</option>
			<option value="jarkom">Jaringan Komputer</option>
		</select>
		<br>
		<input type="hidden" value="dosen" name="jenis">
		<input type="submit" value="Insert">
	</form>
	</fieldset>
</div>
<div style="clear:both"/>
<fieldset style="width:300px">
	<legend>
		Deleting
	</legend>
	
	<form method="post">
	Ingin Delete apa <br>
	<select name="kat">
		<option value="mahasiswa">
			Mahasiswa
		</option>
		<option value="dosen">
			Dosen
		</option>
		
	</select>
	<br>
	<input type="hidden" name="jenis" value="mahasiswa"/>
	<input type="hidden" name="method" value="delete"/>
		Masukkan Id : <input type="text" name="id"/>
		<br>
		<input type="submit" value="Delete">
	</form>
</fieldset>
<?php
	if($_POST['method']=="post")
	{
		if($_POST['jenis']=="mahasiswa")
		{
			$url = "http://localhost/rest/mahasiswaService/service/api.php/insertMahasiswa";
			$dataInsert = "<mahasiswa>
			<mhs>
				<nim>".$_POST['nim']."</nim>
				<nama>".$_POST['nama']."</nama>
				<prodi>".$_POST['prodi']."</prodi>
				<kelas>".$_POST['kelas']."</kelas>
			</mhs>
		</mahasiswa>";
		}
		else if($_POST['jenis']=="dosen")
		{
			$url = "http://localhost/rest/mahasiswaService/service/api.php/insertDosen";
			$dataInsert = "<dosen>
			<dsn>
				<kode_dosen>".$_POST['kd_dsn']."</kode_dosen>
				<nama>".$_POST['nama']."</nama>
				<kode_mtk>".$_POST['kd_mtk']."</kode_mtk>
			</dsn>
		</dosen>";
		}
			$c = curl_init();

			curl_setopt($c, CURLOPT_URL, $url);
			curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($c, CURLOPT_POST, true);
			curl_setopt($c, CURLOPT_POSTFIELDS, $dataInsert);
			$respon = curl_exec($c);
				echo $respon;
			curl_close($c);
			
		?>
		<meta http-equiv="refresh" content="0.01">
		<?php
	}
	else if($_POST['jenis']=="mahasiswa" && $_POST['method']=="delete")
	{
		$url = 'http://localhost/rest/mahasiswaService/service/api.php/delete'.$_POST['kat'].'/'.$_POST['id'];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		$respon=curl_exec($ch);
		curl_close($ch);
			?>
		<meta http-equiv="refresh" content="0.1">
		<?php
	}
	
?>
