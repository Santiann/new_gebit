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

/* C:\wamp64\www\httpdocs\themes\dealix-novo\partials\common\pre-footer.htm */
class __TwigTemplate_a3915d1204e69364c7f040cb9007e4885fb8fc001303baaf79ca3d17ad7a8570 extends \Twig\Template
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
        echo "<div class=\"container px-md-0 pre-footer\">
    <img class=\"img-fluid\" src=\"";
        // line 2
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/pre-footer.svg");
        echo "\" alt=\"Dealix\">
</div>";
    }

    public function getTemplateName()
    {
        return "C:\\wamp64\\www\\httpdocs\\themes\\dealix-novo\\partials\\common\\pre-footer.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  42 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<div class=\"container px-md-0 pre-footer\">
    <img class=\"img-fluid\" src=\"{{ 'assets/img/pre-footer.svg'|theme }}\" alt=\"Dealix\">
</div>", "C:\\wamp64\\www\\httpdocs\\themes\\dealix-novo\\partials\\common\\pre-footer.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array("theme" => 2);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                [],
                ['theme'],
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