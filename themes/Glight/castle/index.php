<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2>บ้านกิลด์</h2>
<p>โชว์ข้อมูลบ้านกิลด์และบ้านกิลด์ที่ถูกกิลด์ครอบครอง</p>
<?php if ($castles): ?>
<table class="vertical-table">
	<tr>
		<th>รหัสบ้านกิลด์</th>
		<th>ชื่อบ้านกิลด์</th>
		<th colspan="2">ชื่อกิลด์</th>
	</tr>
	<?php foreach ($castles as $castle): ?>
		<tr>
			<td align="right"><?php echo htmlspecialchars($castle->castle_id) ?></td>
			<td>
				<?php if (array_key_exists($castle->castle_id, $castleNames) && $castleNames[$castle->castle_id]): ?>
					<?php echo htmlspecialchars($castleNames[$castle->castle_id]) ?>
				<?php else: ?>
					<span class="not-applicable">ไม่รู้จัก<?php echo " (".$castle->castle_id.")" ?></span>
				<?php endif ?>
			</td>
			<?php if ($castle->guild_name): ?>
				<?php if ($castle->emblem_len): ?>
					<td width="24"><img src="<?php echo $this->emblem($castle->guild_id) ?>" /></td>
					<td>
						<?php if ($auth->actionAllowed('guild', 'view') && $auth->allowedToViewGuild): ?>
							<?php echo $this->linkToGuild($castle->guild_id, $castle->guild_name) ?>
						<?php else: ?>
							<?php echo htmlspecialchars($castle->guild_name) ?>
						<?php endif ?>
					</td>
				<?php else: ?>
					<td colspan="2"><?php echo htmlspecialchars($castle->guild_name) ?></td>
				<?php endif ?>
			<?php else: ?>
				<td colspan="2"><span class="not-applicable"><?php echo htmlspecialchars(Flux::message('NoneLabel')) ?></span></td>
			<?php endif ?>
		</tr>
	<?php endforeach ?>
</table>
<?php else: ?>
<p>ไม่พบข้อมูลบ้านกิลด์. <a href="javascript:history.go(-1)">ย้อนกลับ</a>.</p>
<?php endif ?>