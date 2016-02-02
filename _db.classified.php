<?php
require_once('_db.php');

class ClassifiedDB extends IWU_DB {
	public function __construct() {
		$this->dbn = 'ClassifiedAds';
		parent::__construct();
	}

	public function getCurrentAds() {
		$stmt = $this->dbh->prepare('SELECT * FROM ClassifiedAds WHERE (To_Days(CURDATE()) - To_Days(Date_Posted)) <= 10 ORDER BY ItemNo DESC');
		$stmt->execute();

		$result = array();

		while($row = $stmt->fetch()) {
			$result[] = new ClassifiedAd($row);
		}

		return $result;
	}
}

class ClassifiedAd extends IWU_DataRow {
	public function __toString() {
		$result = '<div class="ad content_block"><h1>'.$this->row['Headline'].'</h1><h2>'.$this->row['Name'].'<br /><a href="mailto:'.$this->row['Email'].'">'.$this->row['Email'].'</a></h2><p>'.$this->row['Description'].'</p></div>';
		return $result;
	}
}
?>