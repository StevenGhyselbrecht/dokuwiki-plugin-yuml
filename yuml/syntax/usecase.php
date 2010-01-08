<?php

require_once('yumlSyntax.php');

class syntax_plugin_yuml_usecase extends YumlSyntax {

    function connectTo($mode) {
        $this->Lexer->addSpecialPattern('<usecase>.*?</usecase>',$mode,'plugin_yuml_usecase');
    }

    function handle($match, $state, $pos, &$handler) {
   
        if ($state == DOKU_LEXER_SPECIAL) {
            $match = substr($match, 9, -10);
            return array($state, $match);
        }
        return array();

    }

    function render($mode, &$renderer, $data) {
        if ($mode == 'xhtml') {
            list($state, $match) = $data;
            if ($state == DOKU_LEXER_SPECIAL) {
				$renderer->doc .= $this->getYumlIMG("usecase", $match);
            }
            return true;
        }
        return false;

    }
}
?>