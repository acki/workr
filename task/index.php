<?php

	define('dire', '../');
	include(dire . '_env/exec.php');
	
	$tasks = array();
	$query = mysql_query('SELECT * FROM `task`') or sqlError(__FILE__,__LINE__,__FUNCTION__);
	while($fetch=mysql_fetch_array($query))
		array_push($tasks, $fetch);
		
	$tire = array();
	$query = mysql_query('SELECT * FROM `tire`') or sqlError(__FILE__,__LINE__,__FUNCTION__);
	while($fetch=mysql_fetch_array($query))
		$tire[$fetch[0]] = $fetch[1];
		
	write_header('Auftr&auml;ge');
	
	?>
	
		<table width="850" border="0" cellspacing="0" cellpadding="10" class="table_main">
		  <tbody><tr style="background-color:#d9d8d8; font-size:14px;">
			<td width="50"><strong>NR</strong></td>
			<td width="250"><strong>KUNDE</strong></td>
			<td width="150"><strong>TYP</strong></td>
			<td width="150"><strong>TERMIN</strong></td>
			<td width="200"><strong>AKTION</strong></td>
		  </tr>
		  
		  <?php 
		  
		  	for($i=0;$i<count($tasks);$i++) {
		  		$t = $tasks[$i];
		  		$class = '';
		  		if($i % 2 == 0)
		  			$class = 'gray';
		  			
		  		if(strlen($t['company'])>0)
		  			$t['company'] = $t['company'] . ' | ';
		  			
		  		print '
						<tr class="'.$class.'">
							<td><a href="'.dire.'task/detail/?id='.$t['id'].'">'.$t['id'].'</a></td>
							<td><a href="'.dire.'task/detail/?id='.$t['id'].'">'.$t['company'].' '.$t['name'].'</a></td>
							<td>'.$tire[$t['tire']].'</td>
							<td>'.date('d.m.Y H:i', $t['duetime']).'</td>
							<td><a href="#">BEARBEITEN </a>| <a href="#">ERLEDIGT </a></td>
						</tr>
		  		';
		  		
		  	}
		  
		  ?>

		</tbody></table>
		
	<?php
	
	write_footer();
	
?>