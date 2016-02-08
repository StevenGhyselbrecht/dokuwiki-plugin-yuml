<?php

require_once("syntax.php");

class syntax_plugin_yuml_classdiagram extends syntax_plugin_yuml {

    function connectTo($mode) {
        $this->Lexer->addSpecialPattern('<classdiagram.*?>.*?</classdiagram>',$mode,'plugin_yuml_classdiagram');
		/*$this->Lexer->addEntryPattern('<classdiagram.*?>(?=.*?</classdiagram>)',$mode,'plugin_yuml_classdiagram');*/
    }

    function handle($match, $state, $pos, &$handler) {
		
        if ($state == DOKU_LEXER_SPECIAL) {
			// Look for style
			$result = array();
			preg_match('/<classdiagram(.*?)>(.*)<\/classdiagram>/is', $match, $result);
		
			$style = $result[1];
			$match = $result[2];
			
			return array($state, $match, $style);
        }
        return array();

    }

    function render($mode, &$renderer, $data) {
        if ($mode == 'xhtml') {
            list($state, $match, $style) = $data;
            if ($state == DOKU_LEXER_SPECIAL) {
				$renderer->doc .= $this->getYumlIMG("class", $match, $style);
            }
            return true;
        }
        return false;
    }
}
?>
