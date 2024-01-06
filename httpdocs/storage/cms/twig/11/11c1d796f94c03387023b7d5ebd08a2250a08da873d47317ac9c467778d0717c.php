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

/* C:\xampp\htdocs\new_gebit\httpdocs\themes\dealix-novo\partials\common\footer.htm */
class __TwigTemplate_faf7841d89581904a6a786bc578e5384c1a5a355a39bac79367a124e767c1bb5 extends \Twig\Template
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
        echo "<div class=\"container footer mb-3 mt-5 pt-3 pb-1\">
    <div class=\"d-flex align-items-center justify-content-between flex-column flex-md-row w-100\">
        <div class=\"d-flex align-items-center justify-content-between\">
            <img class=\"footer-logo\" src=\"";
        // line 4
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/logo.svg");
        echo "\" alt=\"Dealix\">
            <h4 class=\"h13 f-semi-bold pl-3 mb-0\" style=\"line-height: 13px;\">";
        // line 5
        echo "Gestão ágil e colaborativa";
        echo "</br>";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["de negociações."]);
        echo "</h4>
        </div>
        <ul class=\"d-flex align-items-center justify-content-between my-5 my-md-0 text-uppercase w-100\" style=\"max-width: 422px;\" href=\"#\">
            <li><a class=\"h15 fsemi-bold text-uppercase\" href=\"";
        // line 8
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("funcionalidades");
        echo "\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Funcionalidades"]);
        echo "</a></li>
            <li><a class=\"h15 fsemi-bold text-uppercase\" href=\"";
        // line 9
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("comeceja");
        echo "\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Recursos"]);
        echo "</a></li>
            <li><a class=\"h15 fsemi-bold text-uppercase\" href=\"";
        // line 10
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("sobre");
        echo "\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Sobre nós"]);
        echo "</a></li>
            <li><a class=\"h15 fsemi-bold text-uppercase\" href=\"";
        // line 11
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("blog/list");
        echo "\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Blog"]);
        echo "</a></li>
            <li><a class=\"h15 fsemi-bold text-uppercase\" href=\"";
        // line 12
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("comeceja");
        echo "\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Preços"]);
        echo "</a></li>
        </ul>
        <div>
            <a class=\"btn btn-primary text-uppercase\" href=\"";
        // line 15
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("comeceja");
        echo "\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Começar Grátis"]);
        echo "</a>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "C:\\xampp\\htdocs\\new_gebit\\httpdocs\\themes\\dealix-novo\\partials\\common\\footer.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  88 => 15,  80 => 12,  74 => 11,  68 => 10,  62 => 9,  56 => 8,  48 => 5,  44 => 4,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<div class=\"container footer mb-3 mt-5 pt-3 pb-1\">
    <div class=\"d-flex align-items-center justify-content-between flex-column flex-md-row w-100\">
        <div class=\"d-flex align-items-center justify-content-between\">
            <img class=\"footer-logo\" src=\"{{ 'assets/img/logo.svg'|theme }}\" alt=\"Dealix\">
            <h4 class=\"h13 f-semi-bold pl-3 mb-0\" style=\"line-height: 13px;\">{{ 'Gestão ágil e colaborativa' }}</br>{{ 'de negociações.' | _ }}</h4>
        </div>
        <ul class=\"d-flex align-items-center justify-content-between my-5 my-md-0 text-uppercase w-100\" style=\"max-width: 422px;\" href=\"#\">
            <li><a class=\"h15 fsemi-bold text-uppercase\" href=\"{{ 'funcionalidades'| page }}\">{{ 'Funcionalidades' | _ }}</a></li>
            <li><a class=\"h15 fsemi-bold text-uppercase\" href=\"{{ 'comeceja'| page }}\">{{ 'Recursos' | _ }}</a></li>
            <li><a class=\"h15 fsemi-bold text-uppercase\" href=\"{{ 'sobre'| page }}\">{{ 'Sobre nós' | _ }}</a></li>
            <li><a class=\"h15 fsemi-bold text-uppercase\" href=\"{{ 'blog/list'| page }}\">{{ 'Blog' | _ }}</a></li>
            <li><a class=\"h15 fsemi-bold text-uppercase\" href=\"{{ 'comeceja'| page }}\">{{ 'Preços' | _ }}</a></li>
        </ul>
        <div>
            <a class=\"btn btn-primary text-uppercase\" href=\"{{ 'comeceja'| page }}\">{{ 'Começar Grátis' | _ }}</a>
        </div>
    </div>
</div>", "C:\\xampp\\htdocs\\new_gebit\\httpdocs\\themes\\dealix-novo\\partials\\common\\footer.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array("theme" => 4, "_" => 5, "page" => 8);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                [],
                ['theme', '_', 'page'],
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
