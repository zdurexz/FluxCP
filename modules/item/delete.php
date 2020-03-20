<?php

$itemID = $params->get('id');
if (!$itemID) {
	$this->deny();
}

require_once 'Flux/TemporaryTable.php';

$tableName  = "{$server->charMapDatabase}.items";
$fromTables = array("{$server->charMapDatabase}.item_db", "{$server->charMapDatabase}.item_db2", "{$server->charMapDatabase}.item_db_re");
$tempTable  = new Flux_TemporaryTable($server->connection, $tableName, $fromTables);

$sql = "SELECT * FROM $tableName WHERE id = ? LIMIT 1";
$sth = $server->connection->getStatement($sql);
$sth->execute(array($itemID));

$item = $sth->fetch();

if ($auth->actionAllowed('item', 'delete')) {
if ($item && count($_POST) && $params->get('deleteitem')) {

	$itemdbs = Flux::config('ItemDatabases');

	if ($itemdbs instanceOf Flux_Config) {
		$itemdbs = $itemdbs->toArray();
	}
	else $itemdbs = array();
	
	foreach( $itemdbs as $tables )
	{
		$sql = "DELETE FROM {$server->charMapDatabase}.$tables WHERE id = ? LIMIT 1";
		$sth = $server->connection->getStatement($sql);
		$sth->execute(array($itemID));
	}
	
	$session->setMessageData("Item has been deleted from your database");
	
	if ($auth->actionAllowed('item', 'index')) {
		$this->redirect($this->url('item', 'index'));
	}
	else {
		$this->redirect();
	}
}
}

?>