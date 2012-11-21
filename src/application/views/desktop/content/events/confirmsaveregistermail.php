<h2><?php echo $header; ?></h2>					
<table cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td width="75">Datum:</td>
		<td>
			<b>
				<?php 
					echo formatDateGerman($event->{DB_EVENT_STARTDATE}); 
					if (isset($event->{DB_EVENT_ENDDATE}))	{
						echo " - " . formatDateGerman($event->{DB_EVENT_ENDDATE}); 	
					}
					?>
			</b>
		</td>
	</tr>
	<tr>
		<td width="75">Plats:</td>			
		<td>
			<b><?php echo $event->{DB_EVENT_LOCATION}; ?></b>		
		</td>
	</tr>				
	<?php
		$totalSum = 0;
		if (isset($eventItems)) {		
			foreach($eventItems as $key => $eventItem) {								
				$totalSum += ($eventItem->{DB_EVENTITEM_AMOUNT} * $eventItem->{DB_TABLE_PERSONHASEVENTITEM . DB_PERSONHASEVENTITEM_AMOUNT});
			}
		}
		if (isset($avecEventItems)) {		
			foreach($avecEventItems as $key => $eventItem) {								
				$totalSum += ($eventItem->{DB_EVENTITEM_AMOUNT} * $eventItem->{DB_TABLE_PERSONHASEVENTITEM . DB_PERSONHASEVENTITEM_AMOUNT});
			}
		}				
	?>
	<tr>
		<td width="75">Totalt:</td>
		<td><b><?php echo formatCurrency($totalSum); ?></b></td>
	</tr>
</table>
<p>Betalning bör ske till Akademiska Sångföreningens konto FI97 4055 1810 0000 87 (BIC: HELSFIHH), ange som meddelande i betalningen "jubileum".</p>			
<p><a href="<?php echo site_url() . CONTROLLER_EVENTS_EDIT_REGISTER_DIRECTLY; ?>/<?php echo $eventId; ?>/<?php echo $personId; ?>/<?php echo $hash; ?>"><b>Klicka här</b></a> för att ändra din anmälan.</p>
<p><a href="<?php echo site_url() . CONTROLLER_EVENTS_CANCEL_REGISTER_DIRECTLY; ?>/<?php echo $eventId; ?>/<?php echo $personId; ?>/<?php echo $hash; ?>"><b>Klicka här</b></a> för att annulera din anmälan.</p>
<?php if (isset($event->{DB_EVENT_REGISTRATIONDUEDATE})) { ?>
	<p>Det är möjligt att ändra eller annulera anmälningen fram till den <b><?php echo formatDateGerman($event->{DB_EVENT_REGISTRATIONDUEDATE}); ?></b>.</p>
<?php } ?>
<hr/>
<p>
	<h3>Mina anmälningsuppgifter</h3>				
	<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td width="75">Namn:</td>
			<td><b><?php echo $person->{DB_PERSON_FIRSTNAME} . ' ' . $person->{DB_PERSON_LASTNAME}; ?></b></td>
		</tr>
		<tr>
			<td width="75">E-post:</td>
			<td><a href="mailto:<?php echo $person->{DB_PERSON_EMAIL}; ?>"><b><?php echo $person->{DB_PERSON_EMAIL}; ?></b></a></td>
		</tr>
		<tr>
			<td width="75">Telefon:</td>
			<td><b><?php echo $person->{DB_PERSON_PHONE}; ?></b></td>
		</tr>
		<?php if (isset($person->{DB_PERSON_ALLERGIES}) && $person->{DB_PERSON_ALLERGIES} != '') { ?>
		<tr>
			<td width="75">Allergier:</td>
			<td><b><?php echo $person->{DB_PERSON_ALLERGIES}; ?></b></td>
		</tr>
		<?php } ?>
	</table>
	<?php
		$previousCaption = "";
		if (isset($eventItems)) {		
			foreach($eventItems as $key => $eventItem) {					
				if ($eventItem->{DB_EVENTITEM_CAPTION} != $previousCaption) {
					echo "<br/>" . $eventItem->{DB_EVENTITEM_CAPTION} . ":";
					echo "<br/>";
				}
				if ($eventItem->{DB_EVENTITEM_MAXPCS} == 0) {
					echo "<b>";
					if ($eventItem->{DB_EVENTITEM_TYPE} == EVENT_TYPE_TEXTAREA) {
						echo $eventItem->{DB_TABLE_PERSONHASEVENTITEM . DB_PERSONHASEVENTITEM_DESCRIPTION};
					}								
					echo $eventItem->{DB_EVENTITEM_DESCRIPTION};
					if (!is_null($eventItem->{DB_EVENTITEM_AMOUNT})) {
						 echo " - pris: " . formatCurrency($eventItem->{DB_EVENTITEM_AMOUNT});
					}
					echo "</b>";
					echo "<br/>";
				} else {
					echo "<b>";
					echo $eventItem->{DB_TABLE_PERSONHASEVENTITEM . DB_PERSONHASEVENTITEM_AMOUNT} . " st. ";
					echo $eventItem->{DB_EVENTITEM_DESCRIPTION};
					if (!is_null($eventItem->{DB_EVENTITEM_AMOUNT})) {
						 echo " - pris: " . formatCurrency($eventItem->{DB_EVENTITEM_AMOUNT}) . " per styck";
					}
					echo "</b>";
					echo "<br/>";
				}
				$previousCaption = $eventItem->{DB_EVENTITEM_CAPTION};
			}
		}
	?>													
	<?php if ($personHasEvent->{DB_PERSONHASEVENT_AVECPERSONID} != NULL) { ?>
		<h3>Min avecs anmälningsuppgifter</h3>
		<table cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td width="75">Namn:</td>
				<td><b><?php echo $personAvec->{DB_PERSON_FIRSTNAME} . ' ' . $personAvec->{DB_PERSON_LASTNAME}; ?></b></td>
			</tr>
			<?php if (isset($personAvec->{DB_PERSON_ALLERGIES}) && $personAvec->{DB_PERSON_ALLERGIES} != '') { ?>
			<tr>
				<td width="75">Allergier:</td>
				<td><b><?php echo $personAvec->{DB_PERSON_ALLERGIES}; ?></b></td>
			</tr>
			<?php } ?>
		</table>								
		<?php
		$previousCaption = "";
		if (isset($avecEventItems)) {		
			foreach($avecEventItems as $key => $eventItem) {					
				if ($eventItem->{DB_EVENTITEM_CAPTION} != $previousCaption) {
					echo "<br/>" . $eventItem->{DB_EVENTITEM_CAPTION} . ":";
					echo "<br/>";
				}
				if ($eventItem->{DB_EVENTITEM_MAXPCS} == 0) {
					echo "<b>";
					if ($eventItem->{DB_EVENTITEM_TYPE} == EVENT_TYPE_TEXTAREA) {
						echo $eventItem->{DB_TABLE_PERSONHASEVENTITEM . DB_PERSONHASEVENTITEM_DESCRIPTION};
					}								
					echo $eventItem->{DB_EVENTITEM_DESCRIPTION};
					if (!is_null($eventItem->{DB_EVENTITEM_AMOUNT})) {
						 echo " - pris: " . formatCurrency($eventItem->{DB_EVENTITEM_AMOUNT});
					}
					echo "</b>";
					echo "<br/>";
				} else {
					echo "<b>";
					echo $eventItem->{DB_TABLE_PERSONHASEVENTITEM . DB_PERSONHASEVENTITEM_AMOUNT} . " st. ";
					echo $eventItem->{DB_EVENTITEM_DESCRIPTION};
					if (!is_null($eventItem->{DB_EVENTITEM_AMOUNT})) {
						 echo " - pris: " . formatCurrency($eventItem->{DB_EVENTITEM_AMOUNT}) . " per styck";
					}
					echo "</b>";
					echo "<br/>";
				}
				$previousCaption = $eventItem->{DB_EVENTITEM_CAPTION};
			}
		}				
	} 
?>
</p>