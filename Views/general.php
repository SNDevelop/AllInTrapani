<?php
class General
{	
	private $_selectedSection;
	public $_title;
	public $_content;
			
	public function __construct($selectedSection)
	{		
		$this->_selectedSection = $selectedSection;				
	}
	
	function SelectContent()
	{
		$method=$this->_selectedSection;
		$this->$method();
	}
	
	function Home()
	{
		$this->_title = 'Home';
				
		$this->_content = '
			<div class="centralColumn">
				Ricette Tipiche
			</div>
			<div class="centralColumn">
				Storia
			</div>
			<div class="centralColumn">
				Le ricette di Mael
			</div>
		';
	}
	
	function About()
	{
		$this->_title = 'Chi siamo';
				
		$this->_content = '
			Pagina chi siamo
		';				
	}
	
	function Contacts()
	{
		$this->_title = 'Contatti';
				
		$this->_content = '
			Pagina Contatti
		';				
	}		
}
?>