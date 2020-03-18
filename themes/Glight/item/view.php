<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2>ข้อมูลไอเทม</h2>
<?php if ($item): ?>
<?php $icon = $this->iconImage($item->item_id); ?>
<h3>
	<?php if ($icon): ?><img src="<?php echo $icon ?>" /><?php endif ?>
	#<?php echo htmlspecialchars($item->item_id) ?>: <?php echo htmlspecialchars($item->name) ?>
</h3>
<table class="vertical-table">
	<tr>
		<th>รหัสไอเทม</th>
		<td><?php echo htmlspecialchars($item->item_id) ?></td>
		<?php if ($image=$this->itemImage($item->item_id)): ?>
		<td rowspan="8"
			style="width: 150px; text-align: center; vertical-alignment: middle">
			<img src="<?php echo $image ?>" />
		</td>
		<?php endif ?>
		<th>ร้านแคช</th>
		<td>
			<?php if ($item->cost): ?>
				<span class="for-sale yes">
					มี
				</span>
			<?php else: ?>
				<span class="for-sale no">
					ไม่มี
				</span>
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th>ชื่อไอเทม</th>
		<td><?php echo htmlspecialchars($item->identifier) ?></td>
		<th>ราคาแคช</th>
		<td>
			<?php if ($item->cost): ?>
				<?php echo number_format((int)$item->cost) ?>
			<?php else: ?>
				<span class="not-applicable">ไม่มีขาย</span>
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th>ชื่อไอเทม</th>
		<td><?php echo htmlspecialchars($item->name) ?></td>
		<th>ประเภท</th>
		<td><?php echo $this->itemTypeText($item->type, $item->view) ?></td>
	</tr>
	<tr>
		<th>ราคาซื้อ</th>
		<td><?php echo number_format((int)$item->price_buy) ?></td>
		<th>น้ำหนัก</th>
		<td><?php echo round($item->weight, 1) ?></td>
	</tr>
	<tr>
		<th>ราคาขาย</th>
		<td>
			<?php if (is_null($item->price_sell) && $item->price_buy): ?>
				<?php echo number_format(floor($item->price_buy / 2)) ?>
			<?php else: ?>
				<?php echo number_format((int)$item->price_sell) ?>
			<?php endif ?>
		</td>
		<th>พลังโจมตี</th>
		<td><?php echo number_format((int)$item->attack) ?></td>
	</tr>
	<tr>
		<th>ระยะโจมตี</th>
		<td><?php echo number_format((int)$item->range) ?></td>
		<th>ป้องกัน</th>
		<td><?php echo number_format((int)$item->defence) ?></td>
	</tr>
	<tr>
		<th>ช่องการ์ด</th>
		<td><?php echo number_format((int)$item->slots) ?></td>
		<th>การตีบวก</th>
		<td>
			<?php if ($item->refineable): ?>
				ได้
			<?php else: ?>
				ไม่ได้
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th>เลเวลสวมใส่</th>
		<td><?php echo number_format((int)$item->equip_level) ?></td>
		<th>เลเวลอาวุธ</th>
		<td><?php echo number_format((int)$item->weapon_level) ?></td>
	</tr>
	<tr>
		<th>ตำแหน่งสวมใส่</th>
		<td colspan="<?php echo $image ? 4 : 3 ?>">
			<?php if ($locs=$this->equipLocations($item->equip_locations)): ?>
				<?php echo htmlspecialchars(implode(' + ', $locs)) ?>
			<?php else: ?>
				<span class="not-applicable">ไม่มี</span>
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th>สำหรับคลาส</th>
		<td colspan="<?php echo $image ? 4 : 3 ?>">
			<?php if ($upper=$this->equipUpper($item->equip_upper)): ?>
				<?php echo htmlspecialchars(implode(' / ', $upper)) ?>
			<?php else: ?>
				<span class="not-applicable">ไม่มี</span>
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th>สำหรับอาชีพ</th>
		<td colspan="<?php echo $image ? 4 : 3 ?>">
			<?php if ($jobs=$this->equippableJobs($item->equip_jobs)): ?>
				<?php echo htmlspecialchars(implode(' / ', $jobs)) ?>
			<?php else: ?>
				<span class="not-applicable">ไม่มี</span>
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th>เพศ</th>
		<td colspan="<?php echo $image ? 4 : 3 ?>">
			<?php if ($item->equip_genders === '0'): ?>
				หญิง
			<?php elseif ($item->equip_genders === '1'): ?>
				ชาย
			<?php elseif ($item->equip_genders === '2'): ?>
				ทั้งหมด (ชาย และ หญิง)
			<?php else: ?>
				<span class="not-applicable">ไม่รู้จัก</span>
			<?php endif ?>
		</td>
	</tr>
	<?php if (($isCustom && $auth->allowedToSeeItemDb2Scripts) || (!$isCustom && $auth->allowedToSeeItemDbScripts)): ?>
	<tr>
		<th>คำสั่งไอเทม</th>
		<td colspan="<?php echo $image ? 4 : 3 ?>">
			<?php if ($script=$this->displayScript($item->script)): ?>
				<?php #echo $script ?>
			<?php else: ?>
				<span class="not-applicable">ไม่มี</span>
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th>คำสั่งเมื่อสวมใส่</th>
		<td colspan="<?php echo $image ? 4 : 3 ?>">
			<?php if ($script=$this->displayScript($item->equip_script)): ?>
				<?php echo $script ?>
			<?php else: ?>
				<span class="not-applicable">ไม่มี</span>
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th>คำสั่งเมื่อถอด</th>
		<td colspan="<?php echo $image ? 4 : 3 ?>">
			<?php if ($script=$this->displayScript($item->unequip_script)): ?>
				<?php echo $script ?>
			<?php else: ?>
				<span class="not-applicable">ไม่มี</span>
			<?php endif ?>
		</td>
	</tr>
	<?php endif ?>
</table>
<?php if ($itemDrops): ?>
<h3><?php echo htmlspecialchars($item->name) ?> ดรอปจาก</h3>
<table class="vertical-table">
	<tr>
		<th>รหัสมอนเตอร์</th>
		<th>ชื่อมอนเตอร์</th>
		<th><?php echo htmlspecialchars($item->name) ?> โอกาสตก</th>
		<th>เลเวลมอนเตอร์</th>
		<th>ประเภท</th>
		<th>ธาตุมอนเตอร์</th>
	</tr>
	<?php foreach ($itemDrops as $itemDrop): ?>
	<tr class="item-drop-<?php echo $itemDrop['type'] ?>">
		<td align="right">
			<?php if ($auth->actionAllowed('monster', 'view')): ?>
				<?php echo $this->linkToMonster($itemDrop['monster_id'], $itemDrop['monster_id']) ?>
			<?php else: ?>
				<?php echo $itemDrop['monster_id'] ?>
			<?php endif ?>
		</td>
		<td>
			<?php if ($itemDrop['type'] == 'mvp'): ?>
				<span class="mvp">MVP!</span>
			<?php endif ?>
			<?php echo htmlspecialchars($itemDrop['monster_name']) ?>
		</td>
		<td><strong><?php echo $itemDrop['drop_chance'] ?>%</strong></td>
		<td><?php echo number_format($itemDrop['monster_level']) ?></td>
		<td><?php echo Flux::monsterRaceName($itemDrop['monster_race']) ?></td>
		<td>
			Level <?php echo floor($itemDrop['monster_ele_lv']) ?>
			<em><?php echo Flux::elementName($itemDrop['monster_element']) ?></em>
		</td>
	</tr>
	<?php endforeach ?>
</table>
<?php endif ?>
<?php else: ?>
<p>No such item was found. <a href="javascript:history.go(-1)">Go back</a>.</p>
<?php endif ?>