<?php

require_once("yumlSyntax.php");

class syntax_plugin_yuml_classdiagram extends YumlSyntax {

    function connectTo($mode) {
        $this->Lexer->addSpecialPattern('<classdiagram>.*?</classdiagram>',$mode,'plugin_yuml_classdiagram');
    }

    function handle($match, $state, $pos, &$handler) {
   
        if ($state == DOKU_LEXER_SPECIAL) {
            $match = substr($match, 14, -15);
            return array($state, $match);
        }
        return array();

    }

    function render($mode, &$renderer, $data) {
        if ($mode == 'xhtml') {
            list($state, $match) = $data;
            if ($state == DOKU_LEXER_SPECIAL) {
				$renderer->doc .= $this->getYumlIMG("class", $match);
            }
            return true;
        }
        return false;
    }
}
?>