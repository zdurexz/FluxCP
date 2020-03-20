<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2><?php echo htmlspecialchars(Flux::message('WoeHeading')) ?></h2>
<?php if ($woeTimes): ?>
<p><?php echo htmlspecialchars(sprintf(Flux::message('WoeInfo'), $session->loginAthenaGroup->serverName)) ?></p>
<p><?php echo htmlspecialchars(Flux::message('WoeServerTimeInfo')) ?> <strong class="important"><?php echo $server->getServerTime('Y-m-d H:i:s (l)') ?></strong>.<br>
Time left: <strong class="important"><span id="countdown" style="display:inline;"></span>
</strong></p>
<table class="woe-table">
	<tr>
		<th><?php echo htmlspecialchars(Flux::message('WoeServerLabel')) ?></th>
		<th colspan="3"><?php echo htmlspecialchars(Flux::message('WoeTimesLabel')) ?></th>
	</tr>
	<?php foreach ($woeTimes as $serverName => $times): ?>
	<tr>
		<td class="server" rowspan="<?php echo count($times) ?>">
			<?php echo htmlspecialchars($serverName)  ?>
		</td>
		<?php $n = 1;
	foreach ($times as $time):
	$addStyle = '';
	$sTim = $server->getServerTime('H:i');
	if ($n==1) 
	{
						if (date('N', strtotime($time['startingDay'])) - date('N') == 0) 
						{
						$curDay = date('l'); 
							if ($sTim < $time['startingHour']) 
							{
								$startTime = $time['startingHour'];
								$mesWOE = "WoE has started.";
								$n++;
							}
							elseif (($sTim < $time['endingHour'])) {
								$startTime = $time['endingHour'];
								$mesWOE = "WoE has ended.";
								$n++;
							}
						}
						else 
						{
						$curDay = "next ".$time['startingDay'];
						$startTime = $time['startingHour'];
						$mesWOE = "WoE has started.";
						$n++;
						}
						
	}
	?>
		<td class="time">
			<?php echo htmlspecialchars($time['startingDay']) ?>
			@ <?php echo htmlspecialchars($time['startingHour']) ?>
		</td>
		<td>~</td>
		<td class="time">
			<?php echo htmlspecialchars($time['endingDay']) ?>
			@ <?php echo htmlspecialchars($time['endingHour']) ?>
		</td>
	</tr>
	<tr>
		<?php endforeach ?>
	</tr>
	<?php endforeach;
	$woeDate = date('m/d/Y '.$startTime, strtotime("$curDay"));
	?>
</table>

<script language="JavaScript">
TargetDate = "<?php echo $woeDate; ?>";
CountActive = true;
CountStepper = -1;
LeadingZero = true;
DisplayFormat = "%%D%% Days, %%H%% Hours, %%M%% Minutes, %%S%% Seconds.";
FinishMessage = "<?php echo $mesWOE ?>";
</script>
<script language="JavaScript" src="<?php echo $this->themePath('woe/countdown.js') ?>"></script>
<?php else: ?>
<p><?php echo htmlspecialchars(Flux::message('WoeNotScheduledInfo')) ?></p>
<?php endif ?>