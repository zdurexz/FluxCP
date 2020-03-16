<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2>ข้อมูลมอนเตอร์</h2>
<?php if ($monster): ?>
<h3>
	#<?php echo $monster->monster_id ?>: <?php echo htmlspecialchars($monster->iro_name) ?>
	<?php if ($monster->mvp_exp): ?>
		<span class="mvp">(MVP)</span>
	<?php endif ?>
</h3>
<table class="vertical-table">
	<tr>
		<th>รหัสมอนเตอร์</th>
		<td><?php echo $monster->monster_id ?></td>
		<th>ชื่อมอนเตอร์</th>
		<td><?php echo htmlspecialchars($monster->sprite) ?></td>
		<?php if ($itemDrops): ?>
		<td rowspan="13" style="vertical-align: top">
			<h3><?php echo htmlspecialchars($monster->iro_name) ?> ไอเทมดรอป</h3>
			<table class="vertical-table">
				<tr>
					<th>รหัสไอเทม</th>
					<th colspan="2">ชื่อไอเทม</th>
					<th>โอกาสตก</th>
				</tr>
				<?php $mvpDrops = 0; ?>
				<?php foreach ($itemDrops as $itemDrop): ?>
				<tr class="item-drop-<?php echo $itemDrop['type'] ?>"
					title="<strong><?php echo htmlspecialchars($itemDrop['name']) ?></strong> (<?php echo (float)$itemDrop['chance'] ?>%)">
					<td align="right">
						<?php if ($auth->actionAllowed('item', 'view')): ?>
							<?php echo $this->linkToItem($itemDrop['id'], $itemDrop['id']) ?>
						<?php else: ?>
							<?php echo htmlspecialchars($itemDrop['id']) ?>
						<?php endif ?>
					</td>
					<?php if ($image=$this->iconImage($itemDrop['id'])): ?>
						<td><img src="<?php echo $image ?>" /></td>
						<td>
							<?php if ($itemDrop['type'] == 'mvp'): ?>
							<?php ++$mvpDrops; ?>
								<span class="mvp">MVP!</span>
							<?php endif ?>
							<?php echo htmlspecialchars($itemDrop['name']) ?>
						</td>
					<?php else: ?>
						<td colspan="2">
							<?php if ($itemDrop['type'] == 'mvp'): ?>
							<?php ++$mvpDrops; ?>
								<span class="mvp">MVP!</span>
							<?php endif ?>
							<?php echo htmlspecialchars($itemDrop['name']) ?>
						</td>
					<?php endif ?>
					<td><?php echo (float)$itemDrop['chance'] ?>%</td>
				</tr>
				<?php endforeach ?>
				<?php if ($mvpDrops > 1): ?>
				<tr>
					<td colspan="4" align="center">
						<p><em>Note: Only <strong>one</strong> MVP drop will be rewarded.</em></p>
					</td>
				</tr>
				<?php endif ?>
			</table>
		</td>
		<?php endif ?>
	</tr>
	<tr>
		<th>ชื่อมอนเตอร์</th>
		<td><?php echo htmlspecialchars($monster->kro_name) ?></td>
		<th>เลือด</th>
		<td><?php echo number_format($monster->hp) ?></td>
	</tr>
	<tr>
		<th>ชื่อมอนเตอร์</th>
		<td><?php echo htmlspecialchars($monster->iro_name) ?></td>
		<th>มานา</th>
		<td><?php echo number_format($monster->sp) ?></td>
	</tr>
	<tr>
		<th>ประเภท</th>
		<td>
			<?php if ($race=Flux::monsterRaceName($monster->race)): ?>
				<?php echo htmlspecialchars($race) ?>
			<?php else: ?>
				<span class="not-applicable">Unknown</span>
			<?php endif ?>	
		</td>
		<th>เลเวล</th>
		<td><?php echo number_format($monster->level) ?></td>
	</tr>
	<tr>
		<th>ธาตุ</th>
		<td><?php echo Flux::elementName($monster->element_type) ?> (Level <?php echo floor($monster->element_level) ?>)</td>
		<th>ความเร็ว</th>
		<td><?php echo number_format($monster->speed) ?></td>
	</tr>
	<tr>
		<th>ค่าประสบการณ์ Base</th>
		<td><?php echo number_format($monster->base_exp*$server->baseExpRates) ?></td>
		<th>พลังโจมตี</th>
		<td><?php echo number_format($monster->attack1) ?>~<?php echo number_format($monster->attack2) ?></td>
	</tr>
	<tr>
		<th>ค่าประสบการณ์ Job</th>
		<td><?php echo number_format($monster->job_exp*$server->jobExpRates) ?></td>
		<th>พลังป้องกัน</th>
		<td><?php echo number_format($monster->defense) ?></td>
	</tr>
	<tr>
		<th>ค่าประสบการณ์ MVP</th>
		<td><?php echo number_format($monster->mvp_exp*$server->mvpExpRates) ?></td>
		<th>พลังป้องกันเวทย์</th>
		<td><?php echo number_format($monster->magic_defense) ?></td>
	</tr>
	<tr>
		<th>อัตตราการโจมตี</th>
		<td><?php echo number_format($monster->attack_delay) ?> ms</td>
		<th>ระยะโจมตี</th>
		<td><?php echo number_format($monster->range1) ?></td>
	</tr>
	<tr>
		<th>ระยะเวลาท่าทางโจมตี</th>
		<td><?php echo number_format($monster->attack_motion) ?> ms</td>
		<th>ระยะห่างร่ายเวทย์</th>
		<td><?php echo number_format($monster->range2) ?></td>
	</tr>
	<tr>
		<th>ระยะเวลาท่าทาง</th>
		<td><?php echo number_format($monster->defense_motion) ?> ms</td>
		<th>ระยะมองเห็น</th>
		<td><?php echo number_format($monster->range3) ?></td>
	</tr>
	<tr>
		<th>การทำงานของมอนสเตอร์</th>
		<td colspan="3">
			<ul class="monster-mode">
			<?php foreach ($this->monsterMode($monster->mode) as $mode): ?>
				<li><?php echo htmlspecialchars($mode) ?></li>
			<?php endforeach ?>
			</ul>
		</td>
	</tr>
	<tr>
		<th>สเตตัสมอนสเตอร์</th>
		<td colspan="3">
			<table class="character-stats">
				<tr>
					<td><span class="stat-name">STR</span></td>
					<td><span class="stat-value"><?php echo number_format((int)$monster->strength) ?></span></td>
					<td><span class="stat-name">AGI</span></td>
					<td><span class="stat-value"><?php echo number_format((int)$monster->agility) ?></span></td>
					<td><span class="stat-name">VIT</span></td>
					<td><span class="stat-value"><?php echo number_format((int)$monster->vitality) ?></span></td>
				</tr>
				<tr>
					<td><span class="stat-name">INT</span></td>
					<td><span class="stat-value"><?php echo number_format((int)$monster->intelligence) ?></span></td>
					<td><span class="stat-name">DEX</span></td>
					<td><span class="stat-value"><?php echo number_format((int)$monster->dexterity) ?></span></td>
					<td><span class="stat-name">LUK</span></td>
					<td><span class="stat-value"><?php echo number_format((int)$monster->luck) ?></span></td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<h3>สกิลที่ “<?php echo htmlspecialchars($monster->iro_name) ?>” ใช้งาน</h3>
<?php if (!file_exists($skillDB) || !filesize($skillDB)): ?>
<p><strong>Mob skill database needs to be reloaded!</strong></p>
<?php elseif (empty($mobSkills)): ?>
<p>ไม่พบสกิลของ <?php echo htmlspecialchars($monster->iro_name) ?>.</p>
<?php else: ?>
<table class="vertical-table">
	<tr>
		<th>ชื่อสกิล</th>
		<th>เลเวลสกิล</th>
		<th>ใช้เมื่อ</th>
		<th>โอนกาสใช้</th>
		<th>ระยะเวลาร่าย</th>
		<th>ดีเลย์</th>
		<th>การถูกขัดขวาง</th>
		<th>เป้าหมาย</th>
		<th>เงื่อนไข</th>
		<th>ค่า</th>
	</tr>	
	<?php foreach ($mobSkills as $skill): ?>
	<tr>
		<td><?php echo htmlspecialchars($skill['name']) ?></td>
		<td><?php echo htmlspecialchars($skill['level']) ?></td>
		<td><?php echo htmlspecialchars(ucfirst($skill['state'])) ?></td>
		<td><?php echo $skill['rate'] ?>%</td>
		<td><?php echo $skill['cast_time'] ?>s</td>
		<td><?php echo $skill['delay'] ?>s</td>
		<td><?php echo htmlspecialchars(ucfirst($skill['cancelable'])) ?></td>
		<td><?php echo htmlspecialchars(ucfirst($skill['target'])) ?></td>
		<td><em><?php echo htmlspecialchars($skill['condition']) ?></em></td>
		<td>
			<?php if (!is_null($skill['value']) && trim($skill['value']) !== ''): ?>
				<?php echo htmlspecialchars($skill['value']) ?>
			<?php else: ?>
				<span class="not-applicable">ไม่มี</span>
			<?php endif ?>
		</td>
	</tr>
	<?php endforeach ?>
</table>
<?php endif ?>
<?php else: ?>
<p>ไม่พบสกิลมอนเตอร์. <a href="javascript:history.go(-1)">ย้อนกลับ</a>.</p>
<?php endif ?>