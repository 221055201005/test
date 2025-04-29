<?php 

public function transfer_file_to_new_server($date = "2020-04-01", $count = 1){
		error_reporting(E_ALL);
		$mydir = './upload/activity_revision';
		$myfiles = array_diff(scandir($mydir), array('.', '..'));
		$file_to_move = [];
		$total_file_size = 0;
		foreach ($myfiles as $key => $value) {
			$file_size = filesize($mydir . '/' . $value);
			$mtime = filemtime($mydir . '/' . $value);
			$file_time = date("Y-m-d H:i:s", $mtime);
			if($date == date("Y-m-01", strtotime($file_time))){
				$file_to_move[] = [
					"file_name" => $value, 
					"file_time" => $file_time,
					"file_size" => $file_size,
				];
				$total_file_size += $file_size;
			}
		}

		$total_file_size_round = $total_file_size;
		$unit = ['Byte','KiB','MiB','GiB','TiB','PiB','EiB','ZiB','YiB'];
    for($i = 0; $total_file_size_round >= 1024 && $i < count($unit)-1; $i++){
    	$total_file_size_round /= 1024;
    }
    $total_file_size_round = round($total_file_size_round, 2).' '.$unit[$i];

		echo "Transfering File Month ".$date." From 10.5.252.116 to 10.5.252.52";
		echo "<br>Total File : ".count($file_to_move);
		echo "<br>Total Size : ".$total_file_size_round." / ".number_format($total_file_size,2,",",".")." Bytes";
		if($count != 0){
			test_var($file_to_move);
		}

		include_once APPPATH.'third_party/Net/SFTP.php';
		$ftp = [
			"hostname" => '10.5.252.52',//Destination
			"username" => 'developer',//username
			"password" => 'Wahyu.pcms22',//password
		];
		$sftp = new Net_SFTP($ftp['hostname']);
		if (!$sftp->login($ftp['username'], $ftp['password'])) {
			test_var("CANNOT LOGIN SFTP");
		}
		foreach ($file_to_move as $key => $value) {
			$source = $mydir."/".$value['file_name'];
			$destination = $mydir."/".$value['file_name'];
			$destination  = '/PCMS/pcms_ori/'.$destination;
			if($sftp->file_exists($destination)){
        $filesize = $sftp->size($destination); //gets filesize
      }
			else{
        $filesize = "Not Exist";
      }
			if($filesize == "Not Exist" || $filesize != $value['file_size']){
				if(!$sftp->put($destination , $source, NET_SFTP_LOCAL_FILE)){
					test_var([
						"key" => $key,
						"file_name" => $value['file_name'],
						"status" => "ERROR",
						"error" => $sftp->getSFTPErrors(),
					], 1);
				}
				else{
					test_var([
						"key" => $key,
						"file_name" => $value['file_name'],
						"status" => "Success Upload",
					], 1);
				}
			}
			else{
				test_var([
					"key" => $key,
					"file_name" => $value['file_name'],
					"status" => "Skip already exist and same size",
				], 1);
			}
		}
		test_var("END");
	}

?>