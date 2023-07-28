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

/* /var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/prices/default.htm */
class __TwigTemplate_e27755c392e4647e86d4075fe37c2bb88f2a06de53af1f3ed06a603cf954eeb3 extends \Twig\Template
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
        echo "<!-- Start Pricing Area -->
<section class=\"pricing-area pt-100 pb-70 bg-f4f5fe\">
    <div class=\"container\">
        <div class=\"section-title\">
            <h2>";
        // line 5
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Escolha o plano mais adequado"]);
        echo "</h2>
        </div>

        <div class=\"tab pricing-list-tab\">
            <ul class=\"tabs\">
                <li class=\"current\">
                    <a href=\"#\">
                        <i class=\"bx bxs-calendar-check\"></i> ";
        // line 12
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Mensal"]);
        echo "
                    </a>
                </li>
                <li>
                    <a href=\"#\">
                        <i class=\"bx bxs-calendar-check\"></i>";
        // line 17
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Anual"]);
        echo "
                    </a>
                </li>
            </ul>

            ";
        // line 22
        $context["plans"] = twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "plans", [], "any", false, false, true, 22);
        // line 23
        echo "
            <div class=\"tab_content\">
                <div class=\"tabs_item\">
                    <div class=\"row\">
                        ";
        // line 27
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["plans"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["plan"]) {
            // line 28
            echo "                            ";
            if (twig_get_attribute($this->env, $this->source, $context["plan"], "is_monthly", [], "any", false, false, true, 28)) {
                // line 29
                echo "                                ";
                $context['__cms_partial_params'] = [];
                $context['__cms_partial_params']['plan'] = $context["plan"]                ;
                $context['__cms_partial_params']['type'] = "Mês"                ;
                echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("prices/plan-card"                , $context['__cms_partial_params']                , true                );
                unset($context['__cms_partial_params']);
                // line 30
                echo "                            ";
            }
            // line 31
            echo "                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['plan'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 32
        echo "                    </div>
                </div>

                <div class=\"tabs_item\">
                    <div class=\"row\">
                        ";
        // line 37
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["plans"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["plan"]) {
            // line 38
            echo "                            ";
            if ( !twig_get_attribute($this->env, $this->source, $context["plan"], "is_monthly", [], "any", false, false, true, 38)) {
                // line 39
                echo "                                ";
                $context['__cms_partial_params'] = [];
                $context['__cms_partial_params']['plan'] = $context["plan"]                ;
                $context['__cms_partial_params']['type'] = "Ano"                ;
                echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("prices/plan-card"                , $context['__cms_partial_params']                , true                );
                unset($context['__cms_partial_params']);
                // line 40
                echo "                            ";
            }
            // line 41
            echo "                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['plan'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 42
        echo "                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Pricing Area -->";
    }

    public function getTemplateName()
    {
        return "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/prices/default.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  132 => 42,  126 => 41,  123 => 40,  116 => 39,  113 => 38,  109 => 37,  102 => 32,  96 => 31,  93 => 30,  86 => 29,  83 => 28,  79 => 27,  73 => 23,  71 => 22,  63 => 17,  55 => 12,  45 => 5,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/prices/default.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 22, "for" => 27, "if" => 28, "partial" => 29);
        static $filters = array("_" => 5);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['set', 'for', 'if', 'partial'],
                ['_'],
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
