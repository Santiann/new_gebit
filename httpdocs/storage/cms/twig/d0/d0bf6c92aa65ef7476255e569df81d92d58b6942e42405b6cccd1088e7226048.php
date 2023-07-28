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

/* C:\wamp64\www\httpdocs\themes\dealix-novo\partials\sections\featured-futuro.htm */
class __TwigTemplate_bbb069e8e0c336bea175deedab9afe77f95fd6928f32fcc1f34ae228fec5bcfd extends \Twig\Template
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
        echo "<div class=\"container futuro\">
    <div class=\"row\">
        <div class=\"col-12 col-md-6\">
            <div class=\"f-wraper destaque\">
                <span class=\"mb-2 text-uppercase h22\">";
        // line 5
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["span"] ?? null), 5, $this->source), "html", null, true);
        echo "</span>
                <h1 class=\"h61 fmedium\">";
        // line 6
        echo $this->sandbox->ensureToStringAllowed(($context["title"] ?? null), 6, $this->source);
        echo "</h1>
                <p class=\"h22\">";
        // line 7
        echo $this->sandbox->ensureToStringAllowed(($context["subtitle"] ?? null), 7, $this->source);
        echo "</p>

                <ul class=\"mt-5 mb-5 mb-md-0\">
                    ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["futuros"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["futuro"]) {
            // line 11
            echo "                        <li class=\"d-flex align-items-center mb-3 h17\">
                            <img class=\"mr-3\" src=\"";
            // line 12
            echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/f-checked.svg");
            echo "\" alt=\"";
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Dealix - Controle de Contratos"]);
            echo "\">
                            ";
            // line 13
            echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["futuro"], "text", [], "any", false, false, true, 13), 13, $this->source), "html", null, true);
            echo "
                        </li>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['futuro'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 16
        echo "                </ul>
            </div>
        </div>
        <div class=\"col-12 col-md-6\">
            <div class=\"slide-price\">
                ";
        // line 21
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_slice($this->env, twig_get_attribute($this->env, $this->source, ($context["prices"] ?? null), "plans", [], "any", false, false, true, 21), 0, 3));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["plano"]) {
            // line 22
            echo "                    <div class=\"slide-item i";
            echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, true, 22), 22, $this->source), "html", null, true);
            echo "\">
                        <h1 class=\"h42 fsemi-bold\">";
            // line 23
            echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["plano"], "nome", [], "any", false, false, true, 23), 23, $this->source), "html", null, true);
            echo "</h1>
                        <div class=\"price my-2\">
                            <span>";
            // line 25
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["R\$"]);
            echo "</span>
                            <h1>";
            // line 26
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["plano"], "valor", [], "any", false, false, true, 26), 26, $this->source), 2, ",", "."), "html", null, true);
            echo "
                                ";
            // line 27
            if ((twig_get_attribute($this->env, $this->source, $context["plano"], "valor", [], "any", false, false, true, 27) == 0)) {
                // line 28
                echo "                                <span></span>
                                ";
            }
            // line 30
            echo "                            </h1>
                            <span>";
            // line 31
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["mês"]);
            echo "</span>
                        </div>
                        <ul class=\"my-3 text-center\">
                            ";
            // line 34
            echo $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["plano"], "description", [], "any", false, false, true, 34), 34, $this->source);
            echo "

                            ";
            // line 36
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["plano"], "features", [], "any", false, false, true, 36));
            foreach ($context['_seq'] as $context["_key"] => $context["feature"]) {
                // line 37
                echo "                                <li class=\"my-2\">
                                    <i class=\"bx bxs-badge-check\"></i>
                                    ";
                // line 39
                echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["feature"], "description", [], "any", false, false, true, 39), 39, $this->source), "html", null, true);
                echo "
                                </li>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['feature'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 42
            echo "                        </ul>
                        ";
            // line 43
            $context["page_name"] = ((($context["user"] ?? null)) ? ("checkout") : ("user/register"));
            // line 44
            echo "                        <a class=\"btn-slide h15 fmedium mt-2\" href=\"";
            echo $this->extensions['Cms\Twig\Extension']->pageFilter($this->sandbox->ensureToStringAllowed(($context["page_name"] ?? null), 44, $this->source), ["plan_id" => twig_get_attribute($this->env, $this->source, $context["plano"], "pagarme_id", [], "any", false, false, true, 44)]);
            echo "\">
                            ";
            // line 45
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Começe já"]);
            echo "
                        </a>
                    </div>
                ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['plano'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 49
        echo "            </div>
            <a class=\"next\" id=\"next-price\">
                <img src=\"";
        // line 51
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/chevron-right.svg");
        echo "\" alt=\"Dealix - Próximo\">
            </a>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "C:\\wamp64\\www\\httpdocs\\themes\\dealix-novo\\partials\\sections\\featured-futuro.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  192 => 51,  188 => 49,  170 => 45,  165 => 44,  163 => 43,  160 => 42,  151 => 39,  147 => 37,  143 => 36,  138 => 34,  132 => 31,  129 => 30,  125 => 28,  123 => 27,  119 => 26,  115 => 25,  110 => 23,  105 => 22,  88 => 21,  81 => 16,  72 => 13,  66 => 12,  63 => 11,  59 => 10,  53 => 7,  49 => 6,  45 => 5,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<div class=\"container futuro\">
    <div class=\"row\">
        <div class=\"col-12 col-md-6\">
            <div class=\"f-wraper destaque\">
                <span class=\"mb-2 text-uppercase h22\">{{ span }}</span>
                <h1 class=\"h61 fmedium\">{{ title | raw }}</h1>
                <p class=\"h22\">{{ subtitle | raw }}</p>

                <ul class=\"mt-5 mb-5 mb-md-0\">
                    {% for futuro in futuros %}
                        <li class=\"d-flex align-items-center mb-3 h17\">
                            <img class=\"mr-3\" src=\"{{ 'assets/img/f-checked.svg'|theme }}\" alt=\"{{ 'Dealix - Controle de Contratos' | _ }}\">
                            {{ futuro.text }}
                        </li>
                    {% endfor %}
                </ul>
            </div>
        </div>
        <div class=\"col-12 col-md-6\">
            <div class=\"slide-price\">
                {% for plano in prices.plans|slice(0, 3) %}
                    <div class=\"slide-item i{{ loop.index }}\">
                        <h1 class=\"h42 fsemi-bold\">{{ plano.nome }}</h1>
                        <div class=\"price my-2\">
                            <span>{{ 'R\$' | _ }}</span>
                            <h1>{{  plano.valor | number_format(2, ',', '.') }}
                                {% if plano.valor == 0 %}
                                <span></span>
                                {% endif %}
                            </h1>
                            <span>{{ 'mês' | _ }}</span>
                        </div>
                        <ul class=\"my-3 text-center\">
                            {{ plano.description | raw }}

                            {% for feature in plano.features %}
                                <li class=\"my-2\">
                                    <i class=\"bx bxs-badge-check\"></i>
                                    {{ feature.description }}
                                </li>
                            {% endfor %}
                        </ul>
                        {% set page_name = user ? 'checkout' : 'user/register' %}
                        <a class=\"btn-slide h15 fmedium mt-2\" href=\"{{ page_name | page({'plan_id': plano.pagarme_id}) }}\">
                            {{ 'Começe já' | _ }}
                        </a>
                    </div>
                {% endfor %}
            </div>
            <a class=\"next\" id=\"next-price\">
                <img src=\"{{ 'assets/img/chevron-right.svg'|theme }}\" alt=\"Dealix - Próximo\">
            </a>
        </div>
    </div>
</div>", "C:\\wamp64\\www\\httpdocs\\themes\\dealix-novo\\partials\\sections\\featured-futuro.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("for" => 10, "if" => 27, "set" => 43);
        static $filters = array("escape" => 5, "raw" => 6, "theme" => 12, "_" => 12, "slice" => 21, "number_format" => 26, "page" => 44);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['for', 'if', 'set'],
                ['escape', 'raw', 'theme', '_', 'slice', 'number_format', 'page'],
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
