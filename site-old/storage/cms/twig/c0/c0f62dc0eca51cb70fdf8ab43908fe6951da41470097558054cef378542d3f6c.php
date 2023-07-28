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

/* /var/www/vhosts/dealix.com.br/httpdocs/plugins/dealix/faq/components/questions/default.htm */
class __TwigTemplate_c062895bd9fc3de54f17af0a44eb3bac89ec89c3a39d494f3e4718806165d271 extends \Twig\Template
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
        $context["questions"] = twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "itens", [], "any", false, false, true, 1);
        // line 2
        echo "
<!-- Start FAQ Area -->
<section class=\"faq-area ptb-100\">
    <div class=\"container-fluid\">
        <div class=\"row align-items-center\">
            <div class=\"col-lg-7 col-md-12\">
                <div class=\"faq-accordion\">
                    <h2>";
        // line 9
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Perguntas Frequentes"]);
        echo " <span>(";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["FAQ's"]);
        echo ")</span></h2>

                    <ul class=\"accordion\">
                        ";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["questions"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["question"]) {
            // line 13
            echo "                            <li class=\"accordion-item\">
                                <a class=\"accordion-title\" href=\"javascript:void(0)\">
                                    <i class=\"bx bx-plus\"></i>
                                    ";
            // line 16
            echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["question"], "title", [], "any", false, false, true, 16), 16, $this->source), "html", null, true);
            echo "
                                </a>
                                <div class=\"accordion-content\">
                                    ";
            // line 19
            echo $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["question"], "body", [], "any", false, false, true, 19), 19, $this->source);
            echo "
                                </div>
                            </li>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['question'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 23
        echo "                    </ul>
                </div>
            </div>

            <div class=\"col-lg-5 col-md-12\">
                <div class=\"faq-image\">
                    <img src=\"";
        // line 29
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/faq-img1.png");
        echo "\" alt=\"image\">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End FAQ Area -->";
    }

    public function getTemplateName()
    {
        return "/var/www/vhosts/dealix.com.br/httpdocs/plugins/dealix/faq/components/questions/default.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  91 => 29,  83 => 23,  73 => 19,  67 => 16,  62 => 13,  58 => 12,  50 => 9,  41 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/vhosts/dealix.com.br/httpdocs/plugins/dealix/faq/components/questions/default.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 1, "for" => 12);
        static $filters = array("_" => 9, "escape" => 16, "raw" => 19, "theme" => 29);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['set', 'for'],
                ['_', 'escape', 'raw', 'theme'],
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
