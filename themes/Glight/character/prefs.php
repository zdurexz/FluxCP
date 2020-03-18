<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2>ตั้งค่า</h2>
<?php if ($char): ?>
<?php if (!empty($errorMessage)): ?>
<p class="red"><?php echo htmlspecialchars($errorMessage) ?></p>
<?php endif ?>
<h3>ตั้งค่าการมองเห็นบัญชี “<?php echo ($charName=htmlspecialchars($char->name))  ?>” ในเซิร์ฟเวอร์ <?php echo htmlspecialchars($server->serverName) ?></h3>
<form action="<?php echo $this->urlWithQs ?>" method="post" class="generic-form">
	<input type="hidden" name="charprefs" value="1" />
	<table class="generic-form-table">
		<tr>
			<th><label for="hide_from_whos_online">ซ่อนตัวละครจาก "ตัวละครออนไลน์"</label></th>
			<td><input type="checkbox" name="hide_from_whos_online" id="hide_from_whos_online"<?php if ($hideFromWhosOnline) echo ' checked="checked"' ?> /></td>
			<td><p>ติ๊กเพื่อซ่อน <?php echo $charName ?> จากหน้า "ตัวละครออนไลน์" </p></td>
		</tr>
		<tr>
			<th><label for="hide_map_from_whos_online">ซ่อนแมพที่อยู่จาก "ตัวละครออนไลน์"</label></th>
			<td><input type="checkbox" name="hide_map_from_whos_online" id="hide_map_from_whos_online"<?php if ($hideMapFromWhosOnline) echo ' checked="checked"' ?> /></td>
			<td><p>ติ๊กเพื่อซ่อน <?php echo $charName ?>จากหน้า "ตัวละครออนไลน์" </p></td>
		</tr>
		<?php if ($auth->allowedToHideFromZenyRank): ?>
		<tr>
			<th><label for="hide_from_zeny_ranking">ซ่อนตัวละครจาก "อันดับเงินในเซิร์ฟเวอร์"</label></th>
			<td><input type="checkbox" name="hide_from_zeny_ranking" id="hide_from_zeny_ranking"<?php if ($hideFromZenyRanking) echo ' checked="checked"' ?> /></td>
			<td><p>ติ๊กเพื่อซ่อน <?php echo $charName ?> จากหน้า "อันดับเงินในเซิร์ฟเวอร์" </p></td>
		</tr>
		<?php endif ?>
		<tr>
			<td align="right"><p><input type="submit" value="บันทึกการตั้งค่า" /></p></td>
			<td colspan="2"></td>
		</tr>
	</table>
</form>
<?php else: ?>
<p>ไม่พบข้อมูลตัวละคร. <a href="javascript:history.go(-1)">ย้อนกลับ</a>.</p>
<?php endif ?>