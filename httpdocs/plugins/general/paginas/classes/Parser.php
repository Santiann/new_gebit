<?php namespace General\Paginas\Classes;


class Parser extends \October\Rain\Parse\Syntax\Parser
{

    protected function processRepeatingTag($engine, $template, $field, $tagDetails)
    {
        $prefixField = $this->varPrefix.$field;
        $params = $this->fieldParser->getFieldParams($field);
        $innerFields = array_get($params, 'fields', []);
        $innerTags = $tagDetails['tags'];
        $innerTemplate = $tagDetails['template'];

        /*
         * Replace all the inner tags
         */
        foreach ($innerTags as $innerField => $tagString) {
            $innerParams = array_get($innerFields, $innerField, []);
            $tagReplacement = $this->{'eval'.$engine.'ViewField'}($innerField, $innerParams, 'fields');
            $innerTemplate = str_replace($tagString, $tagReplacement, $innerTemplate);
        }

        /*
         * Replace the opening tag
         */
        $openTag = array_get($tagDetails, 'open', '{repeater}');
        $openReplacement = $engine == 'Twig' ? '{% for index,fields in '.$prefixField.' %}' : '{'.$prefixField.'}';
        $openReplacement = $openReplacement . PHP_EOL;
        $innerTemplate = str_replace($openTag, $openReplacement, $innerTemplate);

        /*
         * Replace the closing tag
         */
        $closeTag = array_get($tagDetails, 'close', '{/repeater}');
        $closeReplacement = $engine == 'Twig' ? '{% endfor %}' : '{/'.$prefixField.'}';
        $closeReplacement = PHP_EOL . $closeReplacement;
        $innerTemplate = str_replace($closeTag, $closeReplacement, $innerTemplate);

        $templateString = $tagDetails['template'];
        $template = str_replace($templateString, $innerTemplate, $template);
        return $template;
    }

}
