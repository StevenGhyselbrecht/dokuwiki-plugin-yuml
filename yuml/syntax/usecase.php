<?php

require_once('syntax.php');

class syntax_plugin_yuml_usecase extends syntax_plugin_yuml {

    function connectTo($mode) {
        $this->Lexer->addSpecialPattern('<usecase.*?>.*?</usecase>',$mode,'plugin_yuml_usecase');
    }

    function handle($match, $state, $pos, &$handler) {
   
        if ($state == DOKU_LEXER_SPECIAL) {
            // Look for style
			$result = array();
			preg_match('/<usecase(.*?)>(.*)<\/usecase>/is', $match, $result);
		
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
				$renderer->doc .= $this->getYumlIMG("usecase", $match, $style);
            }
            return true;
        }
        return false;

    }
}
?>
