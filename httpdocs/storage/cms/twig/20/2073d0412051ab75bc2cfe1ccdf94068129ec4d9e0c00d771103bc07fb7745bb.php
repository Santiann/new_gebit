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

/* C:\xampp\htdocs\new_gebit\httpdocs\themes\dealix-novo\partials\common\copy.htm */
class __TwigTemplate_4014b61543e072bc5ae5016d3deb526cd09442dc9ad9f05232b6d921ad3ad81d extends \Twig\Template
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
        echo "<div class=\"container px-0\">
    <hr class=\"mb-0\">
</div>

<div class=\"container\">
    <div class=\"copy d-flex align-items-center justify-content-between pb-5 pt-1\">
        <h4 class=\"text-uppercase text-center mt-4 mt-md-0 text-md-left h13 fmedium\"><span class=\"text-extra\">DEALIX</span> - ";
        // line 7
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["GESTÃO INTELIGENTE © 2021 - TODOS OS DIREITOS RESERVADOS | CPNJ 36.569.594/0001-01"]);
        echo "</h4>
        <div class=\"social d-flex align-items-center\">
            <a href=\"#\"><i class=\"fab fa-linkedin-in mr-3\"></i></a>
            <a href=\"#\"><i class=\"fab fa-facebook-f mr-3\"></i></a>
            <a href=\"#\"><i class=\"fab fa-instagram\"></i></a>
            <div class=\"ml-3\">
                ";
        // line 13
        echo call_user_func_array($this->env->getFunction('form_open')->getCallable(), ["open"]);
        echo "
                  <select class=\"form-control pr-3 text-uppercase\" style=\"border: 0;\" name=\"locale\" data-request=\"onSwitchLocale\" id=\"language-menu\">
                    ";
        // line 15
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["locales"] ?? null));
        foreach ($context['_seq'] as $context["code"] => $context["name"]) {
            // line 16
            echo "                        <option value=\"";
            echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed($context["code"], 16, $this->source), "html", null, true);
            echo "\" ";
            echo ((($context["code"] == ($context["activeLocale"] ?? null))) ? ("selected") : (""));
            echo ">";
            echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed($context["name"], 16, $this->source), "html", null, true);
            echo "</option>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['code'], $context['name'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 18
        echo "                  </select>
                ";
        // line 19
        echo call_user_func_array($this->env->getFunction('form_close')->getCallable(), ["close"]);
        echo "
            </div>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "C:\\xampp\\htdocs\\new_gebit\\httpdocs\\themes\\dealix-novo\\partials\\common\\copy.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  81 => 19,  78 => 18,  65 => 16,  61 => 15,  56 => 13,  47 => 7,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<div class=\"container px-0\">
    <hr class=\"mb-0\">
</div>

<div class=\"container\">
    <div class=\"copy d-flex align-items-center justify-content-between pb-5 pt-1\">
        <h4 class=\"text-uppercase text-center mt-4 mt-md-0 text-md-left h13 fmedium\"><span class=\"text-extra\">DEALIX</span> - {{ 'GESTÃO INTELIGENTE © 2021 - TODOS OS DIREITOS RESERVADOS | CPNJ 36.569.594/0001-01' | _ }}</h4>
        <div class=\"social d-flex align-items-center\">
            <a href=\"#\"><i class=\"fab fa-linkedin-in mr-3\"></i></a>
            <a href=\"#\"><i class=\"fab fa-facebook-f mr-3\"></i></a>
            <a href=\"#\"><i class=\"fab fa-instagram\"></i></a>
            <div class=\"ml-3\">
                {{ form_open() }}
                  <select class=\"form-control pr-3 text-uppercase\" style=\"border: 0;\" name=\"locale\" data-request=\"onSwitchLocale\" id=\"language-menu\">
                    {% for code, name in locales %}
                        <option value=\"{{ code }}\" {{ code == activeLocale ? 'selected' }}>{{ name }}</option>
                    {% endfor %}
                  </select>
                {{ form_close() }}
            </div>
        </div>
    </div>
</div>", "C:\\xampp\\htdocs\\new_gebit\\httpdocs\\themes\\dealix-novo\\partials\\common\\copy.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("for" => 15);
        static $filters = array("_" => 7, "escape" => 16);
        static $functions = array("form_open" => 13, "form_close" => 19);

        try {
            $this->sandbox->checkSecurity(
                ['for'],
                ['_', 'escape'],
                ['form_open', 'form_close']
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
