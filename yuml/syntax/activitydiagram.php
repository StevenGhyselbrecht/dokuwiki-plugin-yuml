<?php

require_once("syntax.php");

class syntax_plugin_yuml_activitydiagram extends syntax_plugin_yuml {

    function connectTo($mode) {
        $this->Lexer->addSpecialPattern('<activitydiagram.*?>.*?</activitydiagram>',$mode,'plugin_yuml_activitydiagram');
		/*$this->Lexer->addEntryPattern('<activitydiagram.*?>(?=.*?</activitydiagram>)',$mode,'plugin_yuml_activitydiagram');*/
    }

    function handle($match, $state, $pos, &$handler) {
		
        if ($state == DOKU_LEXER_SPECIAL) {
			// Look for style
			$result = array();
			preg_match('/<activitydiagram(.*?)>(.*)<\/activitydiagram>/is', $match, $result);
		
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
				$renderer->doc .= $this->getYumlIMG("activity", $match, $style);
            }
            return true;
        }
        return false;
    }
}
?>
