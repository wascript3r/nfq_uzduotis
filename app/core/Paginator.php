<?php
/**
 * Klasė, skirta darbui su puslapiais
 */
class Paginator {
	/**
	 * @var int $_perPage - kiek eilučių talpinti į vieną puslapį
	 * @var string $_instance - puslapis $_GET[$_instance]
	 * @var int $_page - dabartinis puslapis
	 * @var int $_page - visų puslapių kiekis
	 * @var int $_maxPages - maksimalus puslapių kiekis
	 * @var int $_total - visų eilučių kiekis
	 */
	private $_perPage;
	private $_instance;
	private $_page;
	private $_pages;
	private $_maxPages;
	private $_total;

	/**
	 * Konstruktorius
	 */
	public function __construct($perPage, $maxPages, $total, $instance = 'page') {
		$this->_perPage = $perPage;
		$this->_maxPages = $maxPages;
		$this->_total = $total;
		$this->_instance = $instance;
		$this->setPage();
	}

	/**
	 * Dabartinio puslapio radimas
	 */
	private function setPage() {
		$form = new Form();
		$page = $form->get($this->_instance);
		$this->_pages = ceil($this->_total / $this->_perPage);

		$this->_page = isset($page) ? (int) $page : 1;
		if ($this->_page <= 0 || $this->_page > $this->_pages) {
			$this->_page = 1;
		}
	}

	public function getPages() {
		return $this->_pages;
	}

	private function getOffset() {
		return ($this->_page * $this->_perPage) - $this->_perPage;
	}

	public function getLimit() {
		return 'LIMIT ' . $this->getOffset() . ', ' . $this->_perPage;
	}

	public function getLinks() {
		$pagination = '';
		$side = floor($this->_maxPages / 2);

		if ($this->_pages > 1) {
			$pagination .= '<div class="pagination">';
			
			if ($this->_page > $side + 1) {
				$pagination .= '<div class="pull-left" style="margin-right: 15px;"><a href="?' . $this->_instance . '=1" class="prevnext"><i class="fa fa-angle-double-left"></i></a></div>';
			}
			if ($this->_page > 1) {
				$pagination .= '<div class="pull-left"><a href="?' . $this->_instance . '=' . ($this->_page - 1) . '" class="prevnext"><i class="fa fa-angle-left"></i></a></div>';
			}

			for ($i = $this->_page - $side; $i <= $this->_page + $side; $i++) {
				if ($i > 0 && $i <= $this->_pages) {
					if ($i != $this->_page) {
						$pagination .= '<span class="hidden-xs"><a href="?' . $this->_instance . '=' . $i . '">' . $i . '</a></span>';
					} else {
						$pagination .= '<span class="hidden-xs darkgray"><span class="active">' . $i . '</span></span>';
					}
				}
			}

			if ($this->_page < $this->_pages) {
				$pagination .= '<div class="pull-left"><a href="?' . $this->_instance . '=' . ($this->_page + 1) . '" class="prevnext last"><i class="fa fa-angle-right"></i></a></div>';
			}
			if ($this->_page < $this->_pages - $side) {
				$pagination .= '<div class="pull-left" style="margin-left: 15px;"><a href="?' . $this->_instance . '=' . ($this->_pages) . '" class="prevnext"><i class="fa fa-angle-double-right"></i></a></div>';
			}

			$pagination .= '</div>';
		}
		return $pagination;
	}
}
?>