<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body>
	<?php
		//It creates a socket connection and send and recieve data.
		$str='www.google.com';
		$service_port = getservbyname('www', 'tcp');
		$address = gethostbyname($str);
		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		$result = socket_connect($socket, $address, $service_port);
		$in = "HEAD / HTTP/1.1\r\nHost: " . $str . "\r\nConnection: Close\r\n\r\n";
		$out = '';socket_write($socket, $in, strlen($in));
		$bytes = socket_recv($socket, $buf, 12000, MSG_WAITALL);
		socket_close($socket);
		for($i=0;$i<strlen($buf);$i++)
		{	
			if($buf[$i]=="\r"&&$buf[($i++)+1]=="\n")
				echo '<br />';
			else
				echo $buf[$i];
			if($buf[$i]=="\r"&&$buf[$i+1]=="\n"&&$buf[$i+2]=="\r"&&$buf[$i+3]=="\n")
				break;
		}
	?>
	</body>
</html>
