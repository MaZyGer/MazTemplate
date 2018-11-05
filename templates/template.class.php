<?php
    
    class Template {

        public static $templateInstance = null;
        
        private $assignedFiles = array();
        private $assignedVars = array();
        private $assignedPageVars = array();
        private $templateBase;
        
        private $languageVar = array();
        private $languageReplacedment = array();
        private $lang;
        
        // will set the base templatepath
        function __construct($pathToBase = '', $language = "en") 
        
        {
            $this::$templateInstance = $this;
            if(!empty($pathToBase))
            {
                if(file_exists($pathToBase))
                {
                    $this->templateBase = $pathToBase; 
                }
                else 
                {
                    echo "<b>Template Error:</b> File inclusion error.";     
                }
            }
            
            $this->lang = strtoupper($language);
            //echo $this->tpl;
        }
        
        static function instance() {
            return Template::$templateInstance;
        }
        
        //Assign a file
        function assignPage($key, $file) {
            if(!empty($key) && !empty($file))
            {
                $this->assignedFiles[strtoupper($key)] = $file;
            }
        }
        
        function setPageVar($key, $file) {
            if(!empty($key) && !empty($file))
            {
                $this->assignedPageVars[strtoupper($key)] = file_get_contents($this->templateBase . '/' . $file);
            }
        }
        
        function writeVar($var, $replace) {
            if(!empty($var) && !empty($replace))
            {
                $this->assignedVars[strtoupper($var)] = $replace;
            }
        }
        
        function writeLocalizationVar($var, $lang, $replace) {
            if(!empty($var) && !empty($lang) && !empty($replace))
            {
                // little hacky. We save the lang behind the var and we will cut it out later
                //$this->languageVar[strtoupper($var . '_' . $lang)] = $replace;
                $upperLang = strtoupper($lang);
                $upperVar = strtoupper($var);
                
                if(empty($this->languageVar[$upperVar])) {
                    $this->languageVar[$upperVar] = array();
                }
                
                $this->languageVar[$upperVar][strtoupper($upperLang)] = $replace;
            }    
            
            
        }
        
        // data is = array('DE' => "bla")
        function writeMultipleLocalizationVar($var, $data) {
            if(!empty($var) && !empty($data))
            {
                // little hacky. We save the lang behind the var and we will cut it out later
                //$this->languageVar[strtoupper($var . '_' . $lang)] = $replace;
                $upperVar = strtoupper($var);
                
                if(empty($this->languageVar[$upperVar])) {
                    $this->languageVar[$upperVar] = $data;
                } else {
                    $this->languageVar[$upperVar] = array_merge($this->languageVar[$upperVar], $data);
                }
                
            }    
        }
        
        function showPage($key) {
            if(!empty($key) and count($this->assignedFiles) > 0)
            {
                $fileName = $this->assignedFiles[strtoupper($key)];
                if(!empty($fileName)) {
                    
                    $page = file_get_contents($this->templateBase . '/' . $fileName);
                    
                    // replace page variables
                    foreach($this->assignedPageVars as $search => $replace) {
                       $page = str_replace('{'.$search.'}', $replace, $page);
                    }
                    
                    //replace general variables
                    foreach($this->assignedVars as $search => $replace) {
                       $page = str_replace('{'.$search.'}', $replace, $page);
                    }
                    
                    //replace variables with secific language
                    foreach($this->languageVar as $search => $languages) {
                       if(!empty($languages[strtoupper($this->lang)])) {
                        $replace = $languages[strtoupper($this->lang)];
                        $page = str_replace('{'.$search.'}', $replace, $page);
                       }
                    }
                    
                    echo $page;
                }
            }
        }
        
        function includeContent() {
            include_once($this->templateBase . '/index.php'); 
        }
    }   