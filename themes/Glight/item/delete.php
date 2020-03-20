<h2>Delete Item</h2>
<form action="<?php echo $this->urlWithQs ?>" method="post" class="generic-form">
<input type="hidden" name="deleteitem" value="1" />
<p>Are you sure you want to delete 
<strong><?php echo htmlspecialchars($item->name_japanese) ?></strong>
<?php if ($auth->actionAllowed('item', 'view')): ?>
	(<a href="<?php echo $this->url('item', 'view', array('id' => $itemID)) ?>"><?php echo htmlspecialchars($itemID) ?></a>)
<?php else: ?>
	(<?php echo htmlspecialchars($itemID) ?>)
<?php endif ?>
?</p>
<input type="submit" value="Yes">
<a href="<?php echo $this->url('item', 'view', array('id' => $itemID)); ?>">No</a>
</form>