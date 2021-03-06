<?php
$tpl->set('title', 'Consumables');
$tpl->place('header');

$menuitems[] = array('consumables.php?action=add', 'Add new consumable', 'add.png');
#$menuitems[] = array('stock.php', 'New delivery', 'package_green.png');
$tpl->set('menuitems', $menuitems);

$colour = '<span style="color:#%s;">&bull;</span>';
?>

<div class="grid_12">

<?php $tpl->place('menu'); ?>
<br />

<table class="list">
	<tr class="heading">
		<th>Colour</th>
		<th><?php echo fCRUD::printSortableColumn('consumables.name', 'Name') ?></th>
		<th colspan="2"><?php echo fCRUD::printSortableColumn('consumables.qty', 'Quantity') ?></th>
		<th>Printer models</th>
		<th>Operations</th>
	</tr>
	
	<?php
	foreach($consumables as $c){
		
		echo '<tr>';
		
		echo '<td style="width:100px;text-align:left;" class="col">';
		if($c->col_c){ printf($colour, '0066B3'); }
		if($c->col_y){ printf($colour, 'FFCC00'); }
		if($c->col_m){ printf($colour, 'CC0099'); }
		if($c->col_k){ printf($colour, '000'); }
		echo '</td>';
		
		echo '<td class="name">' . $c->name . '</td>';
		$qtycol = Consumable::getQtyStatus($c->qty);
		$qtyinfo = '<span style="background:#%s;padding:3px 6px;-webkit-border-radius:4px;font-weight:bold;color:#000;">%d</span>';
#		echo '<td>' . sprintf($qtyinfo, $qtycol, $c->qty) . '</td>';

		echo '<td width="20">' . $c->qty . '</td>';
		
		$bar = '<td width="120"><div class="progress-container"><div style="width: %d%%; background: #%s;"></div></div></td>';
		printf($bar, $c->qty_percent, $qtycol);
		
		
		
		echo '<td>' . $c->model . '</td>';
		
		echo '<td>';
		unset($actions);
		$actions[] = array('consumables.php?action=edit&id=' . $c->id, 'Edit', 'edit.png');
		$actions[] = array('consumables.php?action=delete&id=' . $c->id, 'Delete', 'delete.png');
		// Only allow installation if there is stock
		if($c->qty > 0){
			#$actions[] = array('install.php?consumable_id=' . $c->id, 'Install to printer &rarr;', 'printer_add.png');
		}
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