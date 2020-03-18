<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2>เพิ่มไอเทม</h2>
<p>ช่องที่จำเป็นต้องกรอก<em>รหัสไอเทม</em>, <em>ชื่อไอเทม(ยังไม่ส่อง)</em>, <em>ชื่อไอเทม</em> และ <em>ประเภท</em></p>
<p><strong>โปรดระวัง:</strong><em>ราคาขาย</em> จะเหลือเพียงครึ่งเดียวของราคาซื้อภายในเกม</p>
<?php if (!empty($errorMessage)): ?>
<p class="red"><?php echo htmlspecialchars($errorMessage) ?></p>
<?php endif ?>
<form action="<?php echo $this->urlWithQs ?>" method="post">
	<input type="hidden" name="additem" value="1" />
	<table class="vertical-table">
		<tr>
			<th><label for="item_id">รหัสไอเทม</label></th>
			<td><input type="text" name="item_id" id="item_id" value="<?php echo htmlspecialchars($itemID) ?>" /></td>
			<th><label for="view">ค่าวิว</label></th>
			<td><input type="text" name="view" id="view" value="<?php echo htmlspecialchars($viewID) ?>" /></td>
		</tr>
		<tr>
			<th><label for="name_english">ชื่อไอเทม(ยังไม่ส่อง)</label></th>
			<td><input type="text" name="name_english" id="name_english" value="<?php echo htmlspecialchars($identifier) ?>" /></td>
			<th><label for="type">ประเภท</label></th>
			<td>
				<select name="type" id="type">
				<?php foreach (Flux::config('ItemTypes')->toArray() as $nameid => $typeName): ?>
					<option value="<?php echo htmlspecialchars($nameid) ?>"<?php if ($nameid == $type) echo ' selected="selected"' ?>>
						<?php echo htmlspecialchars($typeName) ?>
					</option>
				<?php endforeach ?>
				</select>
			</td>
		</tr>
		<tr>
			<th><label for="name_japanese">ชื่อไอเทม</label></th>
			<td><input type="text" name="name_japanese" id="name_japanese" value="<?php echo htmlspecialchars($itemName) ?>" /></td>
			<th><label for="slots">ช่องการ์ด</label></th>
			<td><input type="text" name="slots" id="slots" value="<?php echo htmlspecialchars($slots) ?>" /></td>
		</tr>
		<tr>
			<th><label for="npc_buy">ราคาซื้อ</label></th>
			<td><input type="text" name="npc_buy" id="npc_buy" value="<?php echo htmlspecialchars($npcBuy) ?>" /></td>
			<th><label for="weight">น้ำหนัก</label></th>
			<td><input type="text" name="weight" id="weight" value="<?php echo htmlspecialchars(round($weight, 1)) ?>" /></td>
		</tr>
		<tr>
			<th><label for="npc_sell">ราคาขาย</label></th>
			<td><input type="text" name="npc_sell" id="npc_sell" value="<?php echo htmlspecialchars($npcSell) ?>" /></td>
			<th><label for="attack">พลังโจมตี</label></th>
			<td><input type="text" name="attack" id="attack" value="<?php echo htmlspecialchars($attack) ?>" /></td>
		</tr>
		<tr>
			<th><label for="weapon_level">เลเวลอาวุธ</label></th>
			<td><input type="text" name="weapon_level" id="weapon_level" value="<?php echo htmlspecialchars($weaponLevel) ?>" /></td>
			<th><label for="defense">พลังป้องกัน</label></th>
			<td><input type="text" name="defense" id="defense" value="<?php echo htmlspecialchars($defense) ?>" /></td>

		</tr>
		<tr>
			<th><label for="equip_level">เลเวลสวมใส่</label></th>
			<td><input type="text" name="equip_level" id="equip_level" value="<?php echo htmlspecialchars($equipLevel) ?>" /></td>

			<th><label for="range">ระยะโจมตี</label></th>
			<td><input type="text" name="range" id="range" value="<?php echo htmlspecialchars($range) ?>" /></td>
		</tr>
		<tr>
			<th><label>การตีบวก</label></th>
			<td colspan="3">
				<label style="display: inline"><input type="radio" name="refineable" value="1"<?php if ($refineable) echo ' checked="checked"' ?>/>ได้</label>
				<label style="display: inline"><input type="radio" name="refineable" value="0"<?php if (!$refineable) echo ' checked="checked"' ?> />ไม่ได้</label>
			</td>
		</tr>
		<tr>
			<th><label for="equip_locations">ตำแหน่งสวมใส่</label></th>
			<td colspan="3">
				<select class="multi-select" name="equip_locations[]" id="equip_locations" size="5" multiple="multiple">
				<?php foreach (Flux::getEquipLocationList() as $bit => $location): ?>
					<option value="<?php echo htmlspecialchars($bit) ?>"<?php if ($equipLocs && in_array($bit, $equipLocs)) echo ' selected="selected"' ?>>
						<?php echo htmlspecialchars($location) ?>
					</option>
				<?php endforeach ?>
				</select>
				<p class="action">
					<span class="anchor" onclick="$('#equip_locations option').attr('selected','selected')">เลือกทั้งหมด</span> |
					<span class="anchor" onclick="$('#equip_locations option').attr('selected', false)">ไม่เลือก</span>
				</p>
			</td>
		</tr>
		<tr>
			<th><label for="equip_upper">สำหรับคลาส</label></th>
			<td colspan="3">
				<select class="multi-select" name="equip_upper[]" id="equip_upper" size="5" multiple="multiple">
				<?php foreach (Flux::getEquipUpperList() as $bit => $upper): ?>
					<option value="<?php echo htmlspecialchars($bit) ?>"<?php if ($equipUpper && in_array($bit, $equipUpper)) echo ' selected="selected"' ?>>
						<?php echo htmlspecialchars($upper) ?>
					</option>
				<?php endforeach ?>
				</select>
				<p class="action">
					<span class="anchor" onclick="$('#equip_upper option').attr('selected', 'selected')">เลือกทั้งหมด</span> |
					<span class="anchor" onclick="$('#equip_upper option').attr('selected', false)">ไม่เลือก</span>
				</p>
			</td>
		</tr>
		<tr>
			<th><label for="equip_jobs">สำหรับอาชีพ</label></th>
			<td colspan="3">
				<select class="multi-select" name="equip_jobs[]" id="equip_jobs" size="10" multiple="multiple">
				<?php foreach (Flux::getEquipJobsList() as $bit => $className): ?>
					<option value="<?php echo htmlspecialchars($bit) ?>"<?php if ($equipJobs && in_array($bit, $equipJobs)) echo ' selected="selected"' ?>>
						<?php echo htmlspecialchars($className) ?>
					</option>
				<?php endforeach ?>
				</select>
				<p class="action">
					<span class="anchor" onclick="$('#equip_jobs option').attr('selected', 'selected')">เลือกทั้งหมด</span> |
					<span class="anchor" onclick="$('#equip_jobs option').attr('selected', false)">ไม่เลือก</span>
				</p>
			</td>
		</tr>
		<tr>
			<th><label>เพศ</label></th>
			<td colspan="3">
				<label style="display: inline"><input type="checkbox" name="equip_male" value="1"<?php if ($equipMale) echo ' checked="checked"' ?> />ชาย</label>
				<label style="display: inline"><input type="checkbox" name="equip_female" value="1"<?php if ($equipFemale) echo ' checked="checked"' ?> />หญิง</label>
			</td>
		</tr>
		<tr>
			<th><label for="script">คำสั่งไอเทม</label></th>
			<td colspan="3"><textarea class="script" name="script" id="script"><?php echo htmlspecialchars($script) ?></textarea></td>
		</tr>
		<tr>
			<th><label for="equip_script">คำสั่งเมื่อสวมใส่</label></th>
			<td colspan="3"><textarea class="script" name="equip_script" id="equip_script"><?php echo htmlspecialchars($equipScript) ?></textarea></td>
		</tr>
		<tr>
			<th><label for="unequip_script">คำสั่งเมื่อถอด</label></th>
			<td colspan="3"><textarea class="script" name="unequip_script" id="unequip_script"><?php echo htmlspecialchars($unequipScript) ?></textarea></td>
		</tr>
		<tr>
			<td colspan="4" align="right"><input type="submit" value="เพิ่มไอเทม" /></td>
		</tr>
	</table>
</form>