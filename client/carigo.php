<?php
	
	$id=$_POST['search'];
	
	$url = "http://localhost/REST/mahasiswaService/service/api.php/get".$_POST['kat']."/".$id;
	
	$xml = simplexml_load_file($url);
	if($_POST['kat']=='dosen')
	{
		$dosen = array();
		
		foreach($xml->dsn as $data)
		{
			$dosen[] = $data;
		}
		
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
				Kode Matakuliah
			</th>
		
		</tr>
		<?php
		foreach($dosen as $row)
		{
		?>
		<tr>	
			<td>
				<?php echo $row->kode_dosen; ?>
			</td>
			<td>
				<?php echo $row->nama; ?>
			</td>
			<td>
				<?php echo $row->kode_mtk; ?>
			</td>
			
		</tr>
		<?php
		}
	?>
		</table>
	<?php
	}
	else if($_POST['kat']=='mahasiswa')
	{
		$mahasiswa = array();
		
		foreach($xml->mhs as $data)
		{
			$mahasiswa[] = $data;
		}
		
		?>
		<table border=1>
		<tr>	
			<th>
				Nim
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
		foreach($mahasiswa as $row)
		{
		?>
		<tr>	
			<td>
				<?php echo $row->nim; ?>
			</td>
			<td>
				<?php echo $row->nama; ?>
			</td>
			<td>
				<?php echo $row->kelas; ?>
			</td>
			<td>
				<?php echo $row->prodi; ?>
			</td>
			
		</tr>
		<?php
		}
	?>
		</table>
	<?php
	}
	?>
	