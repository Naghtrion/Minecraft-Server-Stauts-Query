<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Status Server</title>
</head>
<body>
<?php
	$ip = "mc.meuserver.com"; //ip do seu servidor
	$port = "25565";  //query_port do seu servidor
	$max = "100"; //quantos players devem aparecer? Use "-1" para mostrar todos
	$query = json_decode(file_get_contents('http://api.minetools.eu/query/'.$ip.'/'.$port.''), true);  //ira pegar os dados do seu servidor
	if(empty($query['error'])) {
		$playerlist = $query['Playerlist'];  //Adiciona os dados em variaveis
		$online = $query['Players'];  //Adiciona os dados em variaveis
		if ($online > 0) {
			$shown = "0";
			foreach ($playerlist as $player) { //loop para exibir os players
				if ($shown < $max + 1 || $max == "-1") {
					echo '<img src="https://cravatar.eu/helmavatar/'.$player.'/40" alt="'.$player.'" title="'.$player.'" style="padding-left: 3px; padding-right: 3px">'; //Exibe a cabeça dos players on
				}
				$shown++;
			}
			if ($shown > $max && $max != "-1") {
				echo '<p>e mais ' . (count($playerlist) - $max) . ' players...</p>';
			}
		} else {
			echo "<p>Não há players online no momento!</p>";  //Mensagem quando não tiver players online
		}
	} else {
		echo "<p>Servidor Offline</p>";  //mensagem quando o server estiver off-line
	}
?>
</body>
</html>
<!--   Por Naghtrion  -->