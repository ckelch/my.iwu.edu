<?php

require_once('_functions.php');

class PortalDB extends IWU_DB {
	public function __construct() {
		$this->dbn = 'Portal';
		parent::__construct();
	}
    
    public function getChannelStatus($Channel, $NetID) {
        $stmt = $this->dbh->prepare('SELECT * FROM ChannelStatus WHERE Channel=:Channel AND NetID=:NetID ORDER BY Timestamp DESC LIMIT 1');
		$stmt->execute(array(':Channel' => $Channel, ':NetID' => $NetID));

		while($row = $stmt->fetch()) {
			return $row['Status'];
		}

		return null;
    }

	public function updateChannelStatus($data) {
        return parent::insertRow('ChannelStatus', $data);
	}
}

function getRoles($NetID) {
return array();
	$data = mysql_query('SELECT * FROM Roles WHERE `NetID`="'.mysql_real_escape_string($NetID).'"');
	$result = array();

	while($row = mysql_fetch_assoc($data)) {
		$result[] = $row;
	}

	return $result;
}

function getCurrentAnnouncementsForUser($NetID) {
return array();
	$data = mysql_query('SELECT * FROM Announcements WHERE `NetID`="'.mysql_real_escape_string($NetID).'"'); // TODO: and roles and dates match
	$result = array();

	while($row = mysql_fetch_assoc($data)) {
		$result[] = $row;
	}

	return $result;
}

function userHasRole($user) {
    return true;
}



?>