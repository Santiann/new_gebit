<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* /var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/common/header.htm */
class __TwigTemplate_623fbeff49343dce88f22d60c7719ea7c43bd598b57904670d9412465ff1d9a9 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!-- Header -->
";
        $_type = isset($context["type"]) ? $context["type"] : null;        $_message = isset($context["message"]) ? $context["message"] : null;        // line 2
        foreach (Flash::getMessages() as $type => $messages) {
            foreach ($messages as $message) {
                $context["type"] = $type;                $context["message"] = $message;                // line 3
                echo "    <p
        data-control=\"flash-message\"
        class=\"flash-message fade ";
                // line 5
                echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["type"] ?? null), 5, $this->source), "html", null, true);
                echo "\"
        data-interval=\"5\">
        ";
                // line 7
                echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["message"] ?? null), 7, $this->source), "html", null, true);
                echo "
    </p>
";
            }
        }
        $context["type"] = $_type;        $context["message"] = $_message;        // line 10
        echo "
";
        // line 11
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("common/navbar"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
    }

    public function getTemplateName()
    {
        return "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/common/header.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  64 => 11,  61 => 10,  54 => 7,  49 => 5,  45 => 3,  42 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/common/header.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("flash" => 2, "partial" => 11);
        static $filters = array("escape" => 5);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['flash', 'partial'],
                ['escape'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
