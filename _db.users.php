<?php
require_once('_db.php');

class AnnouncementsDB extends IWU_DB {
	public function __construct() {
		$this->dbn = 'Announcements';
		parent::__construct();
	}

	public function getCurrentItems() {
		$stmt = $this->dbh->prepare('SELECT ItemNo, ItemName, Location, Description, Date, Date_Reported, Email, ContactName, "lost" AS Type FROM TB_Lost_Items WHERE (TO_DAYS(CURDATE()) - TO_DAYS(Date_Reported)) <= 10 UNION SELECT ItemNo, ItemName, Location, Description, Date, Date_Reported, Email, ContactName, "found" AS Type FROM TB_Found_Items WHERE (TO_DAYS(CURDATE()) - TO_DAYS(Date_Reported)) <= 10 ORDER BY Date_Reported DESC');
		$stmt->execute();

		$result = array();

		while($row = $stmt->fetch()) {
			$result[] = new LostItem($row);
		}

		return $result;
	}
    
    function getCurrentAnnouncementsForUser($NetID) {
    return array();
    //    $data = mysql_query('SELECT * FROM Announcements WHERE `NetID`="'.mysql_real_escape_string($NetID).'"'); // TODO: and roles and dates match
    //    $result = array();

    //    while($row = mysql_fetch_assoc($data)) {
    //        $result[] = $row;
    //    }

    //    return $result;
    }
}

class AnnouncementItem extends IWU_DataRow {
	public function __toString() {
		$result = '<div class="post content_block '.$this->row['Type'].'"><h1>'.$this->row['ItemName'].'</h1><h2>'.$this->row['ContactName'].'<br /><a href="mailto:' . $this->row['Email'] . '">' . $this->row['Email'] . '</a></h2><h3><span class="type">'.$this->row['Type'].'</span> '.date('F j', strtotime($this->row['Date'])).'</h3><p class="description"><em>Description:</em> '.$this->row['Description'].'</p><p class="location"><em>Where was it?</em> '.$this->row['Location'].'</p></div>';
		return $result;
	}
}
?>