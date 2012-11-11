<?php
	include 'connect.php';
	
	function insertMahasiswa()
	{	
		$input = file_get_contents("php://input");
		//file_put_contents("php://output", $input);
		
		$data = simplexml_load_string($input);
		
		foreach($data->mhs as $dataMhs)
		{
			$nim = $dataMhs->nim;
			$nama = $dataMhs->nama;
			$prodi = $dataMhs->prodi;
			$kelas = $dataMhs->kelas;
			$insert=mysql_query("insert into mahasiswa (nim,nama,prodi,kelas) values ('$nim','$nama','$prodi','$kelas')");
		}
		if($insert)
		{
			echo "Mahasiswa Dengan Nim ".$nim." Berhasil Di Insert";
		}
	}
	function insertDosen()
	{	
		$input = file_get_contents("php://input");
		//file_put_contents("php://output", $input);
		
		$data = simplexml_load_string($input);
		
		foreach($data->dsn as $dataDsn)
		{
			$kode_dosen = $dataDsn->kode_dosen;
			$nama = $dataDsn->nama;
			$kode_mtk = $dataDsn->kode_mtk;
			$insert=mysql_query("insert into dosen (kode_dosen,nama,kode_mtk) values ('$kode_dosen','$nama','$kode_mtk'	)");
		}
		if($insert)
		{
			echo "Dosen ".$kode_dosen." Berhasil Di Insert";
		}
	}
	function getAllMahasiswa()
	{
		$query = "select * from mahasiswa";
		$roottag = "mahasiswa";
		$datatag = "mhs";
		xmlResult($query,$roottag,$datatag);
	}
	
	function getAllDosen()
	{
		$query = "select * from dosen";
		$roottag = "dosen";
		$datatag = "dsn";
		xmlResult($query,$roottag,$datatag);
	}
	
	function getDosen($kode_dosen)
	{
		$query = "select * from dosen where kode_dosen='$kode_dosen'";
		$roottag = "dosen";
		$datatag = "dsn";
		xmlResult($query,$roottag,$datatag);
	}
	
	function getMahasiswa($nim)
	{
		$query = "select * from mahasiswa where nim='$nim'";
		$roottag = "mahasiswa";
		$datatag = "mhs";
		xmlResult($query,$roottag,$datatag);
		
	}
	
	function deleteMahasiswa($nim)
	{
		$query = "delete from mahasiswa where nim='$nim'";
		mysql_query($query);
		echo "Nim ".$nim." Berhasil Dihapus";
	}
	
	function deleteDosen($kd_dsn)
	{
		$query = "delete from dosen where kode_dosen='$kd_dsn'";
		mysql_query($query);
		echo "Kode Dosen ".$kd_dsn." Berhasil Dihapus";
	}
	
	function xmlResult($query,$roottag,$datatag)
	{
		$result = mysql_query($query);
		if(mysql_num_rows($result) > 0)
		{		
			echo "<$roottag>";
			while($row=mysql_fetch_assoc($result))
			{
				echo "<$datatag>";
				foreach($row as $mhs => $val)
				{
					echo "<$mhs>$val</$mhs>";
				}
				echo "</$datatag>";
			}
			echo "</$roottag>";
		}
		else
		{
			echo $errorid = <<<XML
			<$roottag>
				<error>Data Not Found</error>
			</$roottag>
XML;
		}
	}
	
	 $errormethod = <<<XML
			<kampus>
				<error>Invalid Method</error>
			</kampus>
XML;
	
	
	header("Content-Type: text/xml");


	$param = $_SERVER['PATH_INFO'];
	if($param != null)
	{
		$param = spliti("/",$param);
	}
	
	if($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		if($param[1] != null)
		{	
			if($param[2] != null)
			{
				$param[1]($param[2]);
			}
			else
			{
				$param[1](null);
			}
		}
		else
		{
			echo $errormethod;
		}
	}
	else if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if($param[1] != null)
		{	
			if($param[2] != null)
			{
				$param[1]($param[2]);
			}
			else
			{
				$param[1](null);
			}
		}
		else
		{
			echo $errormethod;
		}
	}
	else if($_SERVER['REQUEST_METHOD'] == 'DELETE')
	{
		if($param[1] != null)
		{	
			if($param[2] != null)
			{
				$param[1]($param[2]);
			}
			else
			{
				echo $errormethod;
			}

		}
		else
		{
			echo $errormethod;
		}
	}

?>