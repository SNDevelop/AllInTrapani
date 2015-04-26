<?php
class Content
{
	public function __construct($selectedSection)
	{		
		$this->_selectedSection = $selectedSection;				
	}
	
	function SelectContent()
	{
		$method = $this->_selectedSection;
		$this->$method();
	}				
}	
?>