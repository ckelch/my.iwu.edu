<?php
require_once('_db.php');

class JobsDB extends IWU_DB {
	public function __construct() {
		$this->dbn = 'mydb';
		parent::__construct();
	}

	public function getCurrentJobs() {
		$stmt = $this->dbh->prepare('SELECT * FROM StudentJobPostings WHERE UPPER(status) = "OPEN" ORDER BY postingdate DESC');
		$stmt->execute();

		$result = array();

		while($row = $stmt->fetch()) {
			$result[] = new JobsAd($row);
		}

		return $result;
	}

	public function getSingleJob($ID) {
		$stmt = $this->dbh->prepare('SELECT * FROM StudentJobPostings WHERE `id`= :id');
		$stmt->execute(array(':id' => $ID));

		$result = array();

		while($row = $stmt->fetch()) {
			$result[] = new JobsAd($row);
		}

		return $result;
	}
}

class JobsAd extends IWU_DataRow {
	public function __toString() {
		$result = '<a class="job content_block" onclick="changeChannelWithParameters($(this).closest(\'section\'), \'single\', {id: \''.$this->row['id'].'\'}); return false;" href="">';
		$result.= '<h1>'.$this->row['title'].'</h1>';
		$result.= '<h2>'.$this->row['department'].'</h2>';
		$result.= '<ul class="specs">';
		$result.= '<li class="type">';
		switch(strtoupper($this->row['Type'])) {
			case 'FWS':
				$result.= 'Work Study only; no exceptions';
				break;
			case 'NFWS':
				$result.= 'Non Federal Work Study';
				break;
			case 'FWS/EXCP':
				$result.= 'Work Study; exceptions possible';
				break;
			default:
				$result.= $this->row['Type'];
		}
		$result.= '</li>';

		if($row['postingdate'] != '2009-08-24 00:00:00') {
			$result.= '<li class="date">posted '.date('M j, Y', strtotime($this->row['postingdate'])).'</li>';
		}
		$result.= '</ul>';
		$result.= '</a>';
		return $result;
	}

	public function displaySingle() {
		$result = '<h1>'.$this->row['title'].'</h1>';
		$result.= '<h2>'.$this->row['department'].'</h2>';
		$result.= '<p class="description">'.$this->row['description'].'</p>';
		$result.= '<p class="skills">'.$this->row['skills'].'</p>';
		$result.= '<dl class="specs">';
		$result.= '<dt>Pay Rate</dt>';
		$result.= '<dd>'.$this->row['hiringrate'].'</dd>';
		$result.= '<dt>Employment Type</dt>';
		$result.= '<dd>';
		switch($this->row['Type']) {
			case 'FWS':
				$result.= '<strong>Federal Work Study</strong>. This position is only open to those IWU students who demonstrate financial need.';
				break;
			case 'NFWS':
				$result.= '<strong>Non Federal Work Study</strong>. This position is open to all students regardless of financial need.';
				break;
			case 'FWS/EXCP':
				$result.= '<strong>Federal Work Study, with exceptions</strong>. This position is primarily for those IWU students who demonstrate financial need, but exceptions can be made for students with special skills or experience.';
		}
		$result.= '</dd>';
		$result.= '<dt>Start</dt>';
		$result.= '<dd>'.date('M j, Y', strtotime($this->row['startdate'])).'</dd>';
		$result.= '<dt>End</dt>';
		$result.= '<dd>'.date('M j, Y', strtotime($this->row['enddate'])).'</dd>';
		$result.= '<dt>Contact</dt>';
		$result.= '<dd>'.$this->row['contact'];
			if($this->row['Address']) {
				$result.= ', '.$this->row['Address'];
			}

			if($this->row['email'] && $this->row['phone']) {
				$result.= '<br />(<a href="mailto:'.$this->row['email'].'">'.$this->row['email'].'</a> | '.$this->row['phone'].')';
			}
			elseif($this->row['email']) {
				$result.= '<br />(<a href="mailto:'.$this->row['email'].'">'.$this->row['email'].'</a>)';
			}
			elseif($this->row['phone']) {
				$result.= '<br />('.$this->row['phone'].')';
			}
		$result.= '</dd>';
		$result.= '</dl>';
		return $result;
	}
}
?>