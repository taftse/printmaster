<?php
$tpl->set('title', 'Printer models');
$tpl->place('header');

$menuitems[] = array('models.php?action=add', 'Add new printer model', 'add.png');
$tpl->set('menuitems', $menuitems);
?>

<div class="grid_12">

<?php $tpl->place('menu'); ?>
<br />

<table class="list">
	<tr class="heading">
		<th><?php echo fCRUD::printSortableColumn('models.colour', 'Colour') ?></th>
		<th><?php echo fCRUD::printSortableColumn('manufacturers.name', 'Manufacturer') ?></th>
		<th><?php echo fCRUD::printSortableColumn('models.name', 'Name') ?></th>
		<th>Operations</th>
	</tr>
	
	<?php
	foreach($models as $m){
		
		echo '<tr>';
		
		$img = ($m->colour == 1) ? 'colour.png' : 'mono.png';
		echo '<td style="width:48px;text-align:center;">';
		echo '<img src="web/img/' . $img . '" width="16" height="16" />';
		echo '</td>';
		
		echo '<td>' . $m->mfr_name . '</td>';
		echo '<td class="name">' . $m->name . '</td>';
		echo '<td>';
		unset($actions);
		$actions[] = array('models.php?action=edit&id=' . $m->id, 'Edit', 'edit.png');
		$actions[] = array('models.php?action=delete&id=' . $m->id, 'Delete', 'delete.png');
		$tpl->set('menuitems', $actions);
		$tpl->place('menu');
		echo '</td>';
		
		echo '</tr>';
	}
	?>
	
</table>

</div>

<?php
$tpl->place('footer')
?>