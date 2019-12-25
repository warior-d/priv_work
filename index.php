<html>
	<head>		
			<title>Мультивыбор</title>		
			<style>.do {background: #f0f0f0; border: 1px dashed #abab9a; font: 9pt Tahoma; color: #2c2c2c; width: 600px; cursor: pointer}</style>
			<style>.done {background: #babaad; border: 1px dashed #abab9a; font: 9pt Tahoma; color: #2c2c2c; width: 600px; cursor: pointer}</style>
			<style>.not_sel {background: #babaad; font: 9pt Tahoma; color: #2c2c2c; cursor: pointer}</style>
			<style>.selected {font: 9pt Tahoma; color: black; cursor: pointer; position: absolute}</style>
			<style>.beh {display: none;background: #eeeeee; position: absolute; border: 1px ridge #5a5753;}</style>
			<style>.listOfUsers {font: 9pt Tahoma; color: #0071d0; cursor: pointer}</style>
			<style>.listOfUsers_Bad {font: 9pt Tahoma; color: #ff335c; font-style: italic;}</style>
<script type="text/javascript" src="jquery_341.js"></script>
<script type="text/javascript" src="chosen.js"></script>
<script type="text/javascript" src="main.js"></script>
<script type="text/javascript" src="jquery-ui.js"></script>
	</head> 
	<body>
	<table border = '0 px'>
			<tr>
				<td width="50%">
					<p style="font-size: 15px; font: 12pt Tahoma; color: #0b4d4b; font-weight: 600">Выбор привилегий</p>
				</td>		
				<td width="50%" colspan="2">
				
				</td>

			</tr>
			<tr>
				<td width="50%" valign = "top">			
					<input maxlength="25" size="60" placeholder="Привилегия (минимум 3 символов)" id="sel_some">
					<input name="rdbtn" type="radio" id="mgts_spri" checked hidden><label for="mgts_spri" hidden>208</label>
					<input name="rdbtn" type="radio" id="uspd_main" hidden><label for="uspd_main" hidden>200</label>
				</td>
				<td width="10%">
					<input type="button" id="refresh" value="Обновить привилегии" hidden>
				</td>	
				<td width="40%">	
					<input id="userFIO" size="30" hidden>	
					<div id = "block" class = "beh"></div>  
					<!--<input size="30" type="text" id="userFIO" hidden>-->
				</td>
			</tr>
			<tr>
				<td width="50%" valign = "top">
					<div id="main" align='left'></div>
				</td>
				<td width="50%" valign = "top" colspan="2">
					<div id="grants" align='left'></div>
				</td>

			</tr>
	</table>
			
	
	</body> 
</html>