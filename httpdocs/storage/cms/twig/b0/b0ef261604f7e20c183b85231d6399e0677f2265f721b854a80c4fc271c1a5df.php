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

/* C:\xampp\htdocs\httpdocs\themes\dealix-novo\partials\funcionalidades\item.htm */
class __TwigTemplate_855d4e36f03381db9adfb066aaae94b3e5c8ed39e77fefd63e5696abc3d7b149 extends \Twig\Template
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
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["funcionalidades"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["func"]) {
            // line 2
            echo "    <div class=\"col-12 col-md-3 pr-2 pr-md-5 mb-5\">
        <div class=\"f-item pr-2 pr-md-5 ";
            // line 3
            echo ((twig_get_attribute($this->env, $this->source, $context["func"], "novo", [], "any", false, false, true, 3)) ? ("") : ("pt-4"));
            echo "\">
            ";
            // line 4
            if (twig_get_attribute($this->env, $this->source, $context["func"], "novo", [], "any", false, false, true, 4)) {
                // line 5
                echo "                <div class=\"badge bg-extra3 text-uppercase mb-3 text-white\">";
                echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Novo"]);
                echo "</div></br>
            ";
            }
            // line 7
            echo "            <img class=\"";
            echo ((twig_get_attribute($this->env, $this->source, $context["func"], "novo", [], "any", false, false, true, 7)) ? ("") : ("pt-4"));
            echo "\" src=\"";
            echo $this->extensions['System\Twig\Extension']->mediaFilter($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["func"], "image", [], "any", false, false, true, 7), 7, $this->source));
            echo "\" alt=\"Dealix - Solicitações de Compras\">
            <h1 class=\"h24 fsemi-bold mt-4\">";
            // line 8
            echo $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["func"], "title", [], "any", false, false, true, 8), 8, $this->source);
            echo "</h1>
            <p class=\"h15 fmedium my-3\">";
            // line 9
            echo $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["func"], "description", [], "any", false, false, true, 9), 9, $this->source);
            echo "</p>
            <a href=\"#\" class=\"p-0 h13 fsemi-bold btn btn-link text-uppercase\">";
            // line 10
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Saiba Mais"]);
            echo "</a>
        </div>
    </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['func'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "C:\\xampp\\htdocs\\httpdocs\\themes\\dealix-novo\\partials\\funcionalidades\\item.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 10,  69 => 9,  65 => 8,  58 => 7,  52 => 5,  50 => 4,  46 => 3,  43 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% for func in funcionalidades %}
    <div class=\"col-12 col-md-3 pr-2 pr-md-5 mb-5\">
        <div class=\"f-item pr-2 pr-md-5 {{ func.novo ? '' : 'pt-4' }}\">
            {% if func.novo %}
                <div class=\"badge bg-extra3 text-uppercase mb-3 text-white\">{{ 'Novo' |_}}</div></br>
            {% endif %}
            <img class=\"{{ func.novo ? '' : 'pt-4' }}\" src=\"{{ func.image | media }}\" alt=\"Dealix - Solicitações de Compras\">
            <h1 class=\"h24 fsemi-bold mt-4\">{{ func.title | raw }}</h1>
            <p class=\"h15 fmedium my-3\">{{ func.description | raw }}</p>
            <a href=\"#\" class=\"p-0 h13 fsemi-bold btn btn-link text-uppercase\">{{ 'Saiba Mais' |_}}</a>
        </div>
    </div>
{% endfor %}", "C:\\xampp\\htdocs\\httpdocs\\themes\\dealix-novo\\partials\\funcionalidades\\item.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("for" => 1, "if" => 4);
        static $filters = array("_" => 5, "media" => 7, "raw" => 8);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['for', 'if'],
                ['_', 'media', 'raw'],
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
