<?php
	class Chart{
		private $array;
		private $options;
		/**
		 * Class Constructor
		 */
		public function __construct()
		{
			$this->array = array();
			$this->options = array();
		}
	    public function addArray($arr){
	    	if (is_array($arr)) {
	    		array_push($this->array, $arr);
	    	}
	    }
	    /**
	     * @return mixed
	     */
	    public function getArray()
	    {
	        return $this->array;
	    }

	    /**
	     * @param mixed $array
	     *
	     * @return self
	     */
	    public function setArray($array)
	    {
	        $this->array = $array;

	        return $this;
	    }
	    public function addOptions($opt){
	    	if (is_array($opt)) {
	    		array_push($this->options, $opt);
	    	}
	    }
	    /**
	     * @return mixed
	     */
	    public function getOptions()
	    {
	        return $this->options;
	    }

	    /**
	     * @param mixed $options
	     *
	     * @return self
	     */
	    public function setOptions($options)
	    {
	        $this->options = $options;

	        return $this;
	    }
	    public function arrayToJs(){
	    	$txt="[";
	    	$flag=True;
	    	foreach ($this->array as $value) {
	    		$flag2=True;
	    		if ($flag) {
	    			$flag=False;
	    		}else{
	    			$txt.=",";
	    		}
	    		$txt.="[";
	    		foreach ($value as $value2) {
	    			if ($flag2) {
		    			$flag2=False;
		    		}else{
		    			$txt.=",";
		    		}
		    		if ((is_string($value2))&&(!preg_match("/{/", $value2))&&(!is_numeric($value2))) {
		    			$txt.="\"".$value2."\"";	
		    		}else{
		    			$txt.=$value2;	
		    		}
	    		}
	    		$txt.="]";
	    	}
	    	$txt.="]";
	    	return $txt;
	    }
	    public function optionsToJs(){
	    	$txt="{";
	    	foreach ($this->options as $key => $value) {
	    		$txt.=$key.": ";
	    		if ((is_string($value))&&(!preg_match("/{/", $value))) {
	    			$txt.="\"".$value."\",";
	    		}else{
	    			$txt.=$value.",";
	    		}
	    	}
	    	$txt.="}";
	    	return $txt;
	    }
	}
?>