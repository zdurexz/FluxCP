<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2>ข้อมูลมอนเตอร์</h2>
<p class="toggler"><a href="javascript:toggleSearchForm()">ค้นหามอนเตอร์...</a></p>
<form class="search-form" method="get">
	<?php echo $this->moduleActionFormInputs($params->get('module')) ?>
	<p>
		<label for="monster_id">รหัสมอนเตอร์:</label>
		<input type="text" name="monster_id" id="monster_id" value="<?php echo htmlspecialchars($params->get('monster_id')) ?>" />
		...
		<label for="name">ชื่อมอนเตอร์:</label>
		<input type="text" name="name" id="name" value="<?php echo htmlspecialchars($params->get('name')) ?>" />
		...
		<label for="card_id">รหัสการ์ด:</label>
		<input type="text" name="card_id" id="card_id" value="<?php echo htmlspecialchars($params->get('card_id')) ?>" />
		...
		<label for="mvp">MVP:</label>
		<select name="mvp" id="mvp">
			<option value="all"<?php if (!($mvpParam=strtolower($params->get('mvp'))) || $mvpParam == 'all') echo ' selected="selected"' ?>>ทั้งหมด</option>
			<option value="yes"<?php if ($mvpParam == 'yes') echo ' selected="selected"' ?>>ใช่</option>
			<option value="no"<?php if ($mvpParam == 'no') echo ' selected="selected"' ?>>ไม่ใช่</option>
		</select>
		...
		<label for="custom">เพิ่มเติม:</label>
		<select name="custom" id="custom">
			<option value=""<?php if (!($custom=$params->get('custom'))) echo ' selected="selected"' ?>>ทั้งหมด</option>
			<option value="yes"<?php if ($custom == 'yes') echo ' selected="selected"' ?>>ใช่</option>
			<option value="no"<?php if ($custom == 'no') echo ' selected="selected"' ?>>ไม่</option>
		</select>
		
		<input type="submit" value="ค้นหา" class="btn"/>
		<input type="button" value="รีเซ็ต" onclick="reload()" class="btn"/>
	</p>
</form>
<?php if ($monsters): ?>
<?php echo $paginator->infoText() ?>
<table class="horizontal-table">
	<tr>
		<th><?php echo $paginator->sortableColumn('monster_id', 'รหัสมอนเตอร์') ?></th>
		<th><?php echo $paginator->sortableColumn('kro_name', 'ชื่อมอนเตอร์') ?></th>
		<th><?php echo $paginator->sortableColumn('iro_name', 'ชื่อมอนเตอร์') ?></th>
		<th><?php echo $paginator->sortableColumn('level', 'เลเวล') ?></th>
		<th><?php echo $paginator->sortableColumn('hp', 'เลือด') ?></th>
		<th><?php echo $paginator->sortableColumn('exp', 'ประสบการณ์ Base') ?></th>
		<th><?php echo $paginator->sortableColumn('jexp', 'ประสบการณ์ Job') ?></th>
		<th><?php echo $paginator->sortableColumn('dropcard_id', 'รหัสการ์ด') ?></th>
		<th><?php echo $paginator->sortableColumn('origin_table', 'เพิ่มเติม') ?></th>
	</tr>
	<?php foreach ($monsters as $monster): ?>
	<tr>
		<td align="right">
			<?php if ($auth->actionAllowed('monster', 'view')): ?>
				<?php echo $this->linkToMonster($monster->monster_id, $monster->monster_id) ?>
			<?php else: ?>
				<?php echo htmlspecialchars($monster->monster_id) ?>
			<?php endif ?>
		</td>
		<td>
			<?php if ($monster->mvp_exp): ?>
			<span class="mvp">MVP!</span>
			<?php endif ?>
			<?php echo htmlspecialchars($monster->kro_name) ?>
		</td>
		<td><?php echo htmlspecialchars($monster->iro_name) ?></td>
		<td><?php echo number_format($monster->level) ?></td>
		<td><?php echo number_format($monster->hp) ?></td>
		<td><?php echo number_format($monster->exp * $server->baseExpRates) ?></td>
		<td><?php echo number_format($monster->jexp * $server->jobExpRates) ?></td>
		<?php if ($monster->dropcard_id): ?>
			<td>
				<?php if ($auth->actionAllowed('item', 'view')): ?>
					<?php echo $this->linkToItem($monster->dropcard_id, $monster->dropcard_id) ?>
				<?php else: ?>
					<?php echo htmlspecialchars($monster->dropcard_id) ?>
				<?php endif ?>
			</td>
		<?php else: ?>
			<td><span class="not-applicable">ไม่มี</span></td>
		<?php endif ?>
		<td>
			<?php if (preg_match('/mob_db2$/', $monster->origin_table)): ?>
				ใช่
			<?php else: ?>
				ไม่ใช่
			<?php endif ?>
		</td>
	</tr>
	<?php endforeach ?>
</table>
<?php echo $paginator->getHTML() ?>
<?php else: ?>
<p>ไม่พบมอนเตอร์ดังกล่าว <a href="javascript:history.go(-1)">ย้อนกลับ</a>.</p>
<?php endif ?>