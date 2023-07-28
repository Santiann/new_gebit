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

/* C:\xampp\htdocs\httpdocs\themes\dealix-novo\partials\loginbutton\default.htm */
class __TwigTemplate_c2333a926588aba7735cad9182f5ea98668b01ddaaca719dd6e2875371c01291 extends \Twig\Template
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
        if (($context["user"] ?? null)) {
            // line 2
            echo "<a href=\"#\" data-request=\"";
            echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["__SELF__"] ?? null), 2, $this->source), "html", null, true);
            echo "::onLogout\" class=\"nav-link text-uppercase\">
    ";
            // line 3
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Sair"]);
            echo "
</a>
";
        } else {
            // line 6
            echo "<a class=\"nav-link text-uppercase\" href=\"";
            echo $this->extensions['Cms\Twig\Extension']->pageFilter("user/login");
            echo "\">";
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Entrar"]);
            echo "</a>
";
        }
    }

    public function getTemplateName()
    {
        return "C:\\xampp\\htdocs\\httpdocs\\themes\\dealix-novo\\partials\\loginbutton\\default.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  52 => 6,  46 => 3,  41 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% if user %}
<a href=\"#\" data-request=\"{{ __SELF__ }}::onLogout\" class=\"nav-link text-uppercase\">
    {{ 'Sair' |_ }}
</a>
{% else %}
<a class=\"nav-link text-uppercase\" href=\"{{ 'user/login'| page }}\">{{ 'Entrar' | _ }}</a>
{% endif %}", "C:\\xampp\\htdocs\\httpdocs\\themes\\dealix-novo\\partials\\loginbutton\\default.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 1);
        static $filters = array("escape" => 2, "_" => 3, "page" => 6);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape', '_', 'page'],
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
