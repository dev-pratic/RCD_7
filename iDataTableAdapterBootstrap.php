<?php
if(isset($data['table']['width'])){
	$width = 'width:'.$data['table']['width'].'px;';
}else{
	$width = '';
}

$first = true;
echo '<table class="table table-striped" style="'.$width.'"><thead><tr>';
while($row = $sel->read()){
	if($first===true){
		$first = false;
		foreach ($row as $key => $value){
			if(isset($data[$key]['label'])){
				if(isset($data[$key]['align'])){
					$align = $data[$key]['align'];
				}else{
					$align = "center";
				}
				echo '<th scope="col"><div align="'.$align.'">'.$data[$key]['label'].'</div></th>';
			}
		}
		echo '</tr></thead><tbody>';
	}
	echo '<tr>';
	$firstB = true;
	foreach ($row as $key => $value){
		if(isset($data[$key]['label'])){
			# ALINHAMENTO
			if(isset($data[$key]['align'])){
				$align = $data[$key]['align'];
			}else{
				$align = "center";
			}
			# MASCARA
			$background = false;
			$color = false;
			if(isset($data[$key]['mask']['background'])){
				$background = 'background-color:'.$data[$key]['mask']['background'][$value].';';
			}
			if(isset($data[$key]['mask']['color'])){
				$color = 'color:'.$data[$key]['mask']['color'][$value].';';
			}
			if(isset($data[$key]['mask']['label'])){
				$value = $data[$key]['mask']['label'][$value];
			}
			# FORMATE DATA
			if(isset($data[$key]['formatData'])){
				$value = $idsa->formatDate($value,"timestamp",$data[$key]['formatData']);
			}
			if($firstB===true){
				$firstB = false;
				echo '<th scope="row" align="'.$align.'">'.$value.'</th>';
			}else{
				echo '<td align="'.$align.'" style="'.$background.$color.'">'.$value.'</td>';
			}
		}
	}
	echo '</tr>';
}
echo '</tbody></table>';