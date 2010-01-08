<?php

if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'syntax.php');
require_once("yumlSyntax.php");


class YumlSyntax extends DokuWiki_Syntax_Plugin {

    function getInfo() {
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
    function getType() {
        return 'substition';
    }

    /**
     * What kind of syntax do we allow (optional)
     */
    //    function getAllowedTypes() {
    //        return array();
    //    }

    function getPType() {
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
    function getSort() {
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
      // Not implemented
    }

    //function postConnect() {

    //}

    function handle($match, $state, $pos, &$handler) {
		// Not implemented
    }


    function render($mode, &$renderer, $data) {
		// Not implemented
    }
	
	function getYumlIMG($type, $uml_code){
		$uml_code = preg_replace(array("/\n/", "/,,/"), array(", ",   ","   ),	trim($uml_code));
		$output = "<img src=\"http://yUML.me/diagram/scruffy/" . $type . "/";
		return $output . htmlspecialchars($uml_code)."\"/>";
	}
}
?>