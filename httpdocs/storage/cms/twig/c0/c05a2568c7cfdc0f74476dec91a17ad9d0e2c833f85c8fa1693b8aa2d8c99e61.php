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

/* C:\xampp\htdocs\httpdocs\themes\dealix-novo\partials\sections\featured-possibilidades.htm */
class __TwigTemplate_4d9d0224278e09d940ab5dfdb47e87bb106a1bc9d9f5a37477b1c28afb6a9111 extends \Twig\Template
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
        echo "<div class=\"possibilidades position-relative mt-5 mt-md-0\">
    <div class=\"container\">
        <div class=\"row align-items-center\">
            <div class=\"col-12 col-md-6\">
                <div class=\"p-wraper\">
                    <h1 class=\"h61 fmedium\">";
        // line 6
        echo $this->sandbox->ensureToStringAllowed(($context["title"] ?? null), 6, $this->source);
        echo "</h1>
                    <p class=\"my-3 h24\">";
        // line 7
        echo $this->sandbox->ensureToStringAllowed(($context["subtitle"] ?? null), 7, $this->source);
        echo "</p>
                    <a href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["link"] ?? null), 8, $this->source), "html", null, true);
        echo "\" class=\"btn btn-primary bg-extra2\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Veja as Possibilidades"]);
        echo "</a>
                </div>
            </div>
            <div class=\"col-12 col-md-6\">
                <img class=\"p-image\" src=\"";
        // line 12
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/possibilidades.png");
        echo "\" alt=\"Dealix - ";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Flexível como sua empresa, social como você"]);
        echo "\">
            </div>
        </div>
    </div>
    <img class=\"p-afterimage\" src=\"";
        // line 16
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/after-posibilidade.svg");
        echo "\" alt=\"Dealix - ";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Flexível como sua empresa, social como você"]);
        echo "\">
</div>";
    }

    public function getTemplateName()
    {
        return "C:\\xampp\\htdocs\\httpdocs\\themes\\dealix-novo\\partials\\sections\\featured-possibilidades.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  72 => 16,  63 => 12,  54 => 8,  50 => 7,  46 => 6,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<div class=\"possibilidades position-relative mt-5 mt-md-0\">
    <div class=\"container\">
        <div class=\"row align-items-center\">
            <div class=\"col-12 col-md-6\">
                <div class=\"p-wraper\">
                    <h1 class=\"h61 fmedium\">{{ title | raw }}</h1>
                    <p class=\"my-3 h24\">{{ subtitle | raw }}</p>
                    <a href=\"{{ link }}\" class=\"btn btn-primary bg-extra2\">{{ 'Veja as Possibilidades' | _ }}</a>
                </div>
            </div>
            <div class=\"col-12 col-md-6\">
                <img class=\"p-image\" src=\"{{ 'assets/img/possibilidades.png'|theme }}\" alt=\"Dealix - {{ 'Flexível como sua empresa, social como você' | _ }}\">
            </div>
        </div>
    </div>
    <img class=\"p-afterimage\" src=\"{{ 'assets/img/after-posibilidade.svg'|theme }}\" alt=\"Dealix - {{ 'Flexível como sua empresa, social como você' | _ }}\">
</div>", "C:\\xampp\\htdocs\\httpdocs\\themes\\dealix-novo\\partials\\sections\\featured-possibilidades.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array("raw" => 6, "escape" => 8, "_" => 8, "theme" => 12);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                [],
                ['raw', 'escape', '_', 'theme'],
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
