<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2>อันดับกิลด์</h2>
<h3>
	<?php echo number_format($limit=(int)Flux::config('GuildRankingLimit')) ?> อันดับกิลด์
	ในเซิร์ฟเวอร์ <?php echo htmlspecialchars($server->serverName) ?>
</h3>
<?php if ($guilds): ?>
	<table class="horizontal-table table table-striped">
		<tr>
			<th>ลำดับ</th>
			<th colspan="2">ชื่อกิลด์</th>
			<th>เลเวลกิลด์</th>
			<th>หัวหน้ากิลด์</th>
			<th>สมาชิก</th>
			<th>เลเวลเฉลี่ย</th>
			<th>ค่าประสบการณ์กิลด์</th>
		</tr>
		<?php for ($i = 0; $i < $limit; ++$i): ?>
		<tr<?php if (!isset($guilds[$i])) echo ' class="empty-row"'; if ($i === 0) echo ' class="top-ranked info" title="<strong>'.htmlspecialchars($guilds[$i]->name).'</strong> is the top ranked guild!"' ?>>
			<td align="right"><?php echo number_format($i + 1) ?></td>
			<?php if (isset($guilds[$i])): ?>
			<?php if ($guilds[$i]->emblem_len): ?>
			<td width="24"><img src="<?php echo $this->emblem($guilds[$i]->guild_id) ?>" /></td>
			<?php endif ?>
			<td<?php if (!$guilds[$i]->emblem_len) echo ' colspan="2"' ?>><strong>
				<?php if ($auth->actionAllowed('guild', 'view') && $auth->allowedToViewGuild): ?>
					<?php echo $this->linkToGuild($guilds[$i]->guild_id, $guilds[$i]->name) ?>
				<?php else: ?>
					<?php echo htmlspecialchars($guilds[$i]->name) ?>
				<?php endif ?>
			</strong></td>
			<td><?php echo number_format($guilds[$i]->guild_lv) ?></td>
			<td><?php echo number_format($guilds[$i]->castles) ?></td>
			<td><?php echo number_format($guilds[$i]->members) ?></td>
			<td><?php echo number_format($guilds[$i]->average_lv) ?></td>
			<td><?php echo number_format($guilds[$i]->exp) ?></td>
			<?php else: ?>
			<td colspan="8"></td>
			<?php endif ?>
		</tr>
		<?php endfor ?>
	</table>
<?php else: ?>
<p>ไม่พบข้อมูลกิลด์. <a href="javascript:history.go(-1)">ย้อนกลับ</a>.</p>
<?php endif ?>