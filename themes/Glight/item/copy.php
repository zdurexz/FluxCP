<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2>คัดลอกไอเทม</h2>
<?php if ($item): ?>
<?php if (!empty($errorMessage)): ?>
<p class="red"><?php echo htmlspecialchars($errorMessage) ?></p>
<?php else: ?>
<p>คุณสามารถคัดลอกไอเทมไปยัง <em>item_db2</em> เป็นรหัสไอเทมใหม่</p>
<?php endif ?>
<form action="<?php echo $this->urlWithQs ?>" method="post" class="generic-form">
	<input type="hidden" name="copyitem" value="1" />
	<table class="generic-form-table">
		<tr>
			<th><label>ชื่อไอเทม (รหัสไอเทม)</label></th>
			<td>
				<p>
					<strong><?php echo htmlspecialchars($item->name_japanese) ?></strong>
					<?php if ($auth->actionAllowed('item', 'view')): ?>
						(<a href="<?php echo $this->url('item', 'view', array('id' => $itemID)) ?>"><?php echo htmlspecialchars($itemID) ?></a>)
					<?php else: ?>
						(<?php echo htmlspecialchars($itemID) ?>)
					<?php endif ?>
				</p>
				
			</td>
			<td></td>
		</tr>
		<tr>
			<th><label for="new_item_id">รหัสไอเทมใหม่</label></th>
			<td><input type="text" name="new_item_id" id="new_item_id" value="" /></td>
			<td><p>คุณจะได้รหัสไอเทมใหม่จากการคัดลอกไอเทม</p></td>
		</tr>
		<tr>
			<td colspan="2" align="right"><input type="submit" value="คัดลอกไอเทม" /></td>
			<td></td>
		</tr>
	</table>
</form>
<?php else: ?>
<p>ไม่พบข้อมูลไอเทม. <a href="javascript:history.go(-1)">ย้อนกลับ</a>.</p>
<?php endif ?>