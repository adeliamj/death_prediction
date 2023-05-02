<?php
class database{
    var $host = "localhost";
    var $username = "root";
    var $password = "";
    var $database = "prediksi";
    var $koneksi;

    function __construct(){
		$this->koneksi = mysqli_connect($this->host, $this->username, $this->password,$this->database);
	}


	function register($nama,$username,$email,$password)
	{	
		$insert = mysqli_query($this->koneksi,"insert into dataregis values ('','$nama','$username','$email','$password')");
		return $insert;
	}

	function login($username,$password,$simpanpw)
	{
		$query = mysqli_query($this->koneksi,"select * from dataregis where username='$username'");
		$data= $query->fetch_array();
		if(password_verify($password,$data['password']))
		{
			
			if($simpanpw)
			{
				setcookie('username', $username, time() + (60 * 60 * 24 * 5), '/');
				setcookie('nama', $data['nama'], time() + (60 * 60 * 24 * 5), '/');
			}
			$_SESSION['username'] = $username;
			$_SESSION['nama'] = $data['nama'];
			$_SESSION['inilogin'] = TRUE;
			return TRUE;
		}
	}

	function relogin($username)
	{
		$query = mysqli_query($this->koneksi,"select * from dataregis where username='$username'");
		$data = $query->fetch_array();
		$_SESSION['username'] = $username;
		$_SESSION['nama'] = $data['nama'];
		$_SESSION['inilogin'] = TRUE;
	}
} 

$konektor= mysqli_connect("localhost", "root", "","prediksi");
if (mysqli_connect_errno()) {
    echo "Koneksi gagal";
}


?>