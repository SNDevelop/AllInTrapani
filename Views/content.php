<?php
class Content
{	
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
    
    function History()
    {
        $this->_title = "Storia";
        $this->_content = "
            Questa è la pagina di Storia <a href=\"UsersLogic/Activation/jotaro.76%40hotmail.it/8p53byq0itupufy\">link</a>
            <a href=\"UsersLogic/Activation/8p53byq0itupufy/jotaro.76%40hotmail.it\">link2</a>
        ";
        
    }	
}
?>