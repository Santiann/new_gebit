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

/* C:\xampp\htdocs\new_gebit\httpdocs\themes\dealix-novo\partials\sections\featured-colaborativa.htm */
class __TwigTemplate_d49731f7759e1a7fa0bf5ad1daeae8b1cec05b6df6bc52fb11cb421e3c0c5dd8 extends \Twig\Template
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
        echo "<div class=\"container top\">
    <div class=\"row\">
        <div class=\"col-12 col-md-5\">
            <div class=\"swap\">
                <h1 class=\"fmedium h61\">";
        // line 5
        echo $this->sandbox->ensureToStringAllowed(($context["dTitle"] ?? null), 5, $this->source);
        echo "</span></h1>
                <p class=\"h20\">";
        // line 6
        echo $this->sandbox->ensureToStringAllowed(($context["dSubTitle"] ?? null), 6, $this->source);
        echo "</p>
                <div class=\"dialog\">
                    <h3 class=\"h15 fsemi-bold\">";
        // line 8
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Simples, igual assistir um filme no streaming!"]);
        echo "</h3>
                </div>
                <div class=\"help d-flex align-items-center\">
                    <img src=\"";
        // line 11
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/help.svg");
        echo "\" alt=\"Podemos te Ajudar?\">
                    <a href=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["dLink"] ?? null), 12, $this->source), "html", null, true);
        echo "\" class=\"h16 fmedium text-extra ml-2\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Podemos te ajudar?"]);
        echo "</a>
                </div>
            </div>
            <div class=\"destaque\">
                <span class=\"h22 text-uppercase\">";
        // line 16
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["fSpan"] ?? null), 16, $this->source), "html", null, true);
        echo "</span>
                <h1 class=\"fmedium h61\">";
        // line 17
        echo $this->sandbox->ensureToStringAllowed(($context["fTitle"] ?? null), 17, $this->source);
        echo "</span></h1>
                <p class=\"h20\">";
        // line 18
        echo $this->sandbox->ensureToStringAllowed(($context["fSubTitle"] ?? null), 18, $this->source);
        echo "</p>
            </div>
        </div>
        <div class=\"col-12 col-md-7 pr-md-0\">
            <img class=\"top-image\" src=\"";
        // line 22
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/teste.png");
        echo "\" alt=\"Dealix\">
        </div>
    </div>
    <img class=\"after-top\" src=\"";
        // line 25
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/after_funcionalidades.svg");
        echo "\" alt=\"Dealix\">
</div>";
    }

    public function getTemplateName()
    {
        return "C:\\xampp\\htdocs\\new_gebit\\httpdocs\\themes\\dealix-novo\\partials\\sections\\featured-colaborativa.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  94 => 25,  88 => 22,  81 => 18,  77 => 17,  73 => 16,  64 => 12,  60 => 11,  54 => 8,  49 => 6,  45 => 5,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<div class=\"container top\">
    <div class=\"row\">
        <div class=\"col-12 col-md-5\">
            <div class=\"swap\">
                <h1 class=\"fmedium h61\">{{ dTitle | raw }}</span></h1>
                <p class=\"h20\">{{ dSubTitle | raw }}</p>
                <div class=\"dialog\">
                    <h3 class=\"h15 fsemi-bold\">{{ 'Simples, igual assistir um filme no streaming!' | _ }}</h3>
                </div>
                <div class=\"help d-flex align-items-center\">
                    <img src=\"{{ 'assets/img/help.svg'|theme }}\" alt=\"Podemos te Ajudar?\">
                    <a href=\"{{ dLink }}\" class=\"h16 fmedium text-extra ml-2\">{{ 'Podemos te ajudar?' | _ }}</a>
                </div>
            </div>
            <div class=\"destaque\">
                <span class=\"h22 text-uppercase\">{{ fSpan }}</span>
                <h1 class=\"fmedium h61\">{{ fTitle | raw }}</span></h1>
                <p class=\"h20\">{{ fSubTitle | raw }}</p>
            </div>
        </div>
        <div class=\"col-12 col-md-7 pr-md-0\">
            <img class=\"top-image\" src=\"{{ 'assets/img/teste.png'|theme }}\" alt=\"Dealix\">
        </div>
    </div>
    <img class=\"after-top\" src=\"{{ 'assets/img/after_funcionalidades.svg'|theme }}\" alt=\"Dealix\">
</div>", "C:\\xampp\\htdocs\\new_gebit\\httpdocs\\themes\\dealix-novo\\partials\\sections\\featured-colaborativa.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array("raw" => 5, "_" => 8, "theme" => 11, "escape" => 12);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                [],
                ['raw', '_', 'theme', 'escape'],
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
