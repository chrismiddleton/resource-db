<?php

require_once __DIR__ . "/../webapp/Page.php";

class HomePage extends Page {

	public function __construct($config) {
		parent::__construct($config);
		$this->rows = array();
	}
	
	public function getTitle() {
		return "Home";
	}

	public function init() {
		parent::init();
		$dbh = $this->getDbh();
		foreach ($dbh->query("SELECT * FROM resources") as $row) {
			$this->rows[] = $row;
		}
	}
	
	public function renderBody() {
		$html = "<h2>Resources</h2>
		<table>
			<thead>
				<tr>
					<th>Title</th>
					<th>Author</th>
				</tr>
			</thead>
			<tbody>";
		foreach ($this->rows as $row) {
			$html .= "<tr>
				<td>" . htmlspecialchars($row["title"]) . "</td>
				<td>" . htmlspecialchars($row["author"]) . "</td>
			</tr>";
		}
		$html .= "</tbody></table>";
		return $html;
	}

}