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

/* /var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/prices/plan-card.htm */
class __TwigTemplate_757ab210a899902a4f95bad16cbe890a9998122fca2a953d62b93cdd4d30b7f1 extends \Twig\Template
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
        echo "<div class=\"col-lg-4 col-sm-6\">
    <div class=\"single-pricing-table left-align\">
        <div class=\"pricing-header\">
            <h3>";
        // line 4
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["plan"] ?? null), "nome", [], "any", false, false, true, 4), 4, $this->source), "html", null, true);
        echo "</h3>
        </div>

        <div class=\"price\">
            <sup>";
        // line 8
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["R\$"]);
        echo "</sup> ";
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["plan"] ?? null), "valor", [], "any", false, false, true, 8), 8, $this->source), 2, ",", "."), "html", null, true);
        echo " <sub>/ ";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), [$this->sandbox->ensureToStringAllowed(($context["type"] ?? null), 8, $this->source)]);
        echo "</sub>
        </div>

        <ul class=\"pricing-features\">
            ";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["plan"] ?? null), "features", [], "any", false, false, true, 12));
        foreach ($context['_seq'] as $context["_key"] => $context["feature"]) {
            // line 13
            echo "                <li>
                    <i class=\"bx bxs-badge-check\"></i>
                    ";
            // line 15
            echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["feature"], "description", [], "any", false, false, true, 15), 15, $this->source), "html", null, true);
            echo "
                </li>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['feature'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 18
        echo "        </ul>

        <div class=\"btn-box\">
            ";
        // line 21
        if (($context["user"] ?? null)) {
            // line 22
            echo "            <a href=\"";
            echo $this->extensions['Cms\Twig\Extension']->pageFilter("checkout", ["plan_id" => twig_get_attribute($this->env, $this->source, ($context["plan"] ?? null), "pagarme_id", [], "any", false, false, true, 22)]);
            echo "\" class=\"default-btn\">
            ";
        } else {
            // line 24
            echo "            <a href=\"";
            echo $this->extensions['Cms\Twig\Extension']->pageFilter("register", ["plan_id" => twig_get_attribute($this->env, $this->source, ($context["plan"] ?? null), "pagarme_id", [], "any", false, false, true, 24)]);
            echo "\" class=\"default-btn\">
            ";
        }
        // line 26
        echo "                <i class=\"bx bxs-hot\"></i>
                ";
        // line 27
        if (twig_get_attribute($this->env, $this->source, ($context["plan"] ?? null), "free_trial_days", [], "any", false, false, true, 27)) {
            // line 28
            echo "                    ";
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Experimente por :days dias", ["days" => twig_get_attribute($this->env, $this->source, ($context["plan"] ?? null), "free_trial_days", [], "any", false, false, true, 28)]]);
            echo "
                ";
        } else {
            // line 30
            echo "                    ";
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Contratar"]);
            echo "
                ";
        }
        // line 32
        echo "
                <span></span>
            </a>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/prices/plan-card.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  115 => 32,  109 => 30,  103 => 28,  101 => 27,  98 => 26,  92 => 24,  86 => 22,  84 => 21,  79 => 18,  70 => 15,  66 => 13,  62 => 12,  51 => 8,  44 => 4,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/prices/plan-card.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("for" => 12, "if" => 21);
        static $filters = array("escape" => 4, "_" => 8, "number_format" => 8, "page" => 22);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['for', 'if'],
                ['escape', '_', 'number_format', 'page'],
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
