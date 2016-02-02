<?php
$DEV = strpos($_SERVER['REQUEST_URI'], '~') != 0;
set_include_path(get_include_path() . PATH_SEPARATOR . ($DEV ? '/home/mgorman/public_html/_resources/php' : '/var/www/php.iwu.edu/htdocs/_resources/php'));
require_once('_class.IWU_DB.php');
require_once('_class.IWU_DataRow.php');
require_once('_class.IWU_Auth.php');
require_once('_class.IWU_Template.php');
require_once('_class.IWU_Paginate.php');
require_once('_db.php');

	IWU_Auth::forceAuthentication();

	if(userHasRole(IWU_Auth::getUser(), 'admin') && isset($_GET['impersonate'])) {
		$user = $_GET['impersonate'];
	}
	else {
		$user = IWU_Auth::getUser();
	}

	$roles = getRoles($user);

	class Channel {
		protected $slug = '';
		protected $heading = '';
		protected $styles = array();
		protected $classes = array('highlight');
		protected $context = '';
		protected $contexts = array();
		protected $contentHTML = '';

		public function __construct($slug, $heading, $content = '', $max_height = NULL) {
			$this->slug = $slug;
			$this->heading = $heading;
			$this->contentHTML = $content;
			if($max_height !== NULL) {
				$this->styles['max-height'] = $max_height;
			}
		}

		public function __destruct() {

		}

		public function __toString() {
			$classes = $this->classes;
			$classes[] = $this->slug;

			$result = '<section class="';
			$result.= implode(' ', $classes);
			$result.= '"';

			foreach($this->contexts as $slug => $url) {
				$result.= ' data-url-'.$slug.'="'.$url.'"';
			}
            
            $result.= ' data-channel-name="'.$this->slug.'"';

			if(count($this->styles) > 0) {
				$result.= ' style="';
				foreach($this->styles as $key => $value) {
					$result.= $key.': '.$value.';';
				}
				$result.= '"';
			}

			$result.= '>';
			$result.= '<h1 class="channelname" onclick="toggleChannel($(this).closest(\'section\'));">'.$this->heading.'</h1>';
			$result.= '<div class="content">';
			if($this->contentHTML != '') {
				$result.= $this->contentHTML;
			}
			else {
				if($this->context != '' && isset($this->contexts[$this->context])) {
					$result.= get_include_contents($this->contexts[$this->context]);
				}
				elseif(isset($this->contexts['default'])) {
					$result.= get_include_contents($this->contexts['default']);
				}
				elseif(count($this->contexts) > 0) {
					$context_keys = array_keys($this->contexts);
					$result.= get_include_contents($this->contexts[$context_keys[0]]);
				}
			}
			$result.= '</div>';
			$result.= '</section>';
			return $result;
		}

		public function addStyle($key, $value) {
			$this->styles[$key] = $value;
		}

		public function removeStyle($key) {
			unset($this->styles[$key]);
		}

		public function addContext($slug, $url) {
			$this->contexts[$slug] = $url;
		}

		public function removeContext($slug) {
			unset($this->contexts[$slug]);
		}

		public function addClass($class) {
			$this->classes[] = $class;
		}

		public function removeClass($class) {
			$key = array_search($class, $this->classes);

			if($key) {
				unset($this->classes[$key]);
			}
		}

		public function setContent($content) {
			$this->contentHTML = $content;
		}

		public function getContent() {
			return $this->contentHTML;
		}

		public function addContent($content) {
			$this->contentHTML.= $content;
		}
	}

	function get_include_contents($filename) {
		if(is_file($filename)) {
			ob_start();
			include $filename;
			return ob_get_clean();
		}
		return false;
	}

	function get_name_from_netid($NetID) {
		$ldapconn = ldap_connect('ldaps://ldap.iwu.edu/');
		ldap_bind($ldapconn);

		$sr = ldap_search($ldapconn, 'ou=People,dc=iwu,dc=edu', 'uid='.$NetID, array('cn'));
		$info = ldap_get_entries($ldapconn, $sr);

		$result = $info[0]['cn'][0];

		if($result === NULL)
			$result = $NetID;

		echo $result;
	}
?>