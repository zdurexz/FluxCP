<?php
$pageMenu = array();
if ($auth->actionAllowed('item', 'edit')) {
	$pageMenu['ปรับแต่งไอเทม'] = $this->url('item', 'edit', array('id' => $item->item_id));
}
if ($auth->actionAllowed('item', 'copy')) {
	$pageMenu['คัดลอกไอเทม'] = $this->url('item', 'copy', array('id' => $item->item_id));
}
if ($auth->actionAllowed('itemshop', 'add') && $auth->allowedToAddShopItem) {
	if ($item->cost) {
		$pageMenu['Add to Item Shop (Again)'] = $this->url('itemshop', 'add', array('id' => $item->item_id));
	}
	else {
		$pageMenu['เพิ่มไอเทมในร้านค้า'] = $this->url('itemshop', 'add', array('id' => $item->item_id));
	}
}
if ($auth->actionAllowed('cashshop', 'add') && $auth->allowedToManageCashShop) {
	$pageMenu['เพิ่มในร้านแคช'] = $this->url('cashshop', 'add', array('id' => $item->item_id));
}
if ($auth->actionAllowed('item', 'delete')) {
	$pageMenu['ลบไอเทม'] = $this->url('item', 'delete', array('id' => $item->item_id));
}
return $pageMenu;
?>