<?php
     
    if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
    if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
    require_once(DOKU_PLUGIN.'syntax.php');
	require_once('yuml.php');
     
   
    class syntax_plugin_yuml extends DokuWiki_Syntax_Plugin {
     
        function getInfo(){
            return array(
                'author' => 'Steven Ghyselbrecht',
                'email'  => 'steven.ghyselbrecht@gmail.com',
                'date'   => '2010-01-08',
                'name'   => 'Yuml.me parser',
                'desc'   => 'Parses Yuml.me code and display\'s the image!',
                'url'    => 'http://www.dokuwiki.org/wiki:plugins',
            );
        }
     
       /**
        * Get the type of syntax this plugin defines.
        *
        * @param none
        * @return String <tt>'substition'</tt> (i.e. 'substitution').
        * @public
        * @static
        */
        function getType(){
            return 'substition';
        }
     
        /**
         * What kind of syntax do we allow (optional)
         */
    //    function getAllowedTypes() {
    //        return array();
    //    }
     
       /**
        * Define how this plugin is handled regarding paragraphs.
        *
        * <p>
        * This method is important for correct XHTML nesting. It returns
        * one of the following values:
        * </p>
        * <dl>
        * <dt>normal</dt><dd>The plugin can be used inside paragraphs.</dd>
        * <dt>block</dt><dd>Open paragraphs need to be closed before
        * plugin output.</dd>
        * <dt>stack</dt><dd>Special case: Plugin wraps other paragraphs.</dd>
        * </dl>
        * @param none
        * @return String <tt>'block'</tt>.
        * @public
        * @static
        */
        function getPType(){
            return 'normal';
        }
     
       /**
        * Where to sort in?
        *
        * @param none
        * @return Integer <tt>6</tt>.
        * @public
        * @static
        */
        function getSort(){
            return 999;
        }
     
     
       /**
        * Connect lookup pattern to lexer.
        *
        * @param $aMode String The desired rendermode.
        * @return none
        * @public
        * @see render()
        */
        function connectTo($mode) {
	        $this->Lexer->addSpecialPattern('<usecase>.*?</usecase>',$mode,'plugin_yuml');
        }
     
        //function postConnect() {
       
        //}
     
		 var $diagramType = "";
       
        function handle($match, $state, $pos, &$handler){
		
          if ($state == DOKU_LEXER_SPECIAL) {
			
			$match = substr($match, 9, -10);
			$this->diagramType = "usecase";
			return array($state, $match);
        }
        return array();

        }
     

        function render($mode, &$renderer, $data) {
			if ($mode == 'xhtml') {
				list($state, $match) = $data;
				if ($state == DOKU_LEXER_SPECIAL) {
					$renderer->doc .= Yuml::renderYuml($match, $this->diagramType);
				}
			return true;
        }
        return false;

        }
	
		
    }
 ?>