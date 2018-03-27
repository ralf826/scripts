<meta http-equiv="refresh" content="15">
<?
echo getJSON();

function getJSON()
{
	$dataFull = file_get_contents("http://phisix-api3.appspot.com/stocks.json");
	$dataArr = json_decode($dataFull,true);

	$html = "<table border='1' cellspacing='0' cellpadding='3' style='float:left;margin-right:20px'>
				<tr style='font-weight:bold'><td>Название валюты</td><td>Цена</td><td>Количество</td></tr>";

	foreach($dataArr as $key => $val)
	{
		if($key == 'as_of') continue;
		foreach($val as $v)
		{
			$html .= "<tr>
						<td height='50'>".$v['name']."</td>
						<td>".sprintf('%d', $v['volume'])."</td>
						<td>".sprintf('%.2f', $v['price']['amount'])."</td>
					  </tr>";
		}
	}
	$html .= "</table>
			  <form method='post' action='".$_SERVER['SCRIPT_NAME']."'>
				<input type='submit' value='Обновить'>
			  </form>";
			  
	return $html;
}
?>