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

/* /var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/pages/checkout.htm */
class __TwigTemplate_72d982d0cb548463e586ab276d703176df0ee4df069f8ac84576269d854cfdd5 extends \Twig\Template
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
        $context['__cms_partial_params'] = [];
        $context['__cms_partial_params']['menuClass'] = "navbar-style-two"        ;
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("common/header"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 2
        echo "
";
        // line 3
        if (($context["user"] ?? null)) {
            // line 4
            echo "
<!-- Start Page Title Area -->
<div class=\"page-title-area\">
    <div class=\"container\">
        <div class=\"page-title-content\">
            <h2>";
            // line 9
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Checkout"]);
            echo "</h2>
            <!-- <p>The Strax Story</p> -->
        </div>
    </div>
</div>
<!-- End Page Title Area -->

<!-- Start Checkout Steps Area -->
<div class=\"checkout-steps-area\">
    <div class=\"container\">
        <div class=\"row justify-content-center\">
            <div class=\"col-6\">
                <div class=\"row justify-content-end step-one\">
                    <i class='bx bxs-check-square'></i> ";
            // line 22
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Cadastro"]);
            echo "
                </div>
            </div>
            <div class=\"col-6 text-start\">
                <div class=\"row justify-content-start step-two\">
                    <i class='bx bxs-right-arrow-circle'></i> ";
            // line 27
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Checkout"]);
            echo "
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Checkout Steps Area -->

<!-- Start Checkout Area -->
<section class=\"checkout-area\">
    <div class=\"container\">

        <div class=\"contact-inner\">
            <div class=\"row\">
                <div class=\"col-lg-6 col-md-12 d-flex justify-content-center align-items-center contact-features-list\">
                    <div class=\"logo\">
                        <a href=\"";
            // line 43
            echo $this->extensions['Cms\Twig\Extension']->pageFilter("home");
            echo "\"><img src=\"";
            echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/logo-dealix-vertical.png");
            echo "\" alt=\"Dealix\"></a>
                    </div>
                </div>
                <div class=\"col-lg-6 col-md-12 pt-sm-100\">
                    <div class=\"checkout-form\">
                        ";
            // line 49
            echo "                        ";
            $context['__cms_component_params'] = [];
            echo $this->env->getExtension('Cms\Twig\Extension')->componentFunction("checkout"            , $context['__cms_component_params']            );
            unset($context['__cms_component_params']);
            // line 50
            echo "                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- End Checkout Area -->

";
        } else {
            // line 60
            echo "
<div class=\"checkout-steps-area mt-5 mb-5\">
    <div class=\"container mb-5\">
        <div class=\"contact-inner\" >
            <div class=\"row justify-content-center text-center\">
                <div class=\"col-12 col-md-12\">
                    <small>";
            // line 66
            echo "Verifique seu e-mail e ative sua conta para prosseguir.";
            echo "</small>
                    <br>
                    <br>
                    <a href=\"javascript:location.reload()\" class=\"btn btn-success btn-sm\">";
            // line 69
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Já ativei a minha conta"]);
            echo "</a>
                </div>
            </div>
        </div>
    </div>
</div>

";
        }
    }

    public function getTemplateName()
    {
        return "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/pages/checkout.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  140 => 69,  134 => 66,  126 => 60,  114 => 50,  109 => 49,  99 => 43,  80 => 27,  72 => 22,  56 => 9,  49 => 4,  47 => 3,  44 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/pages/checkout.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("partial" => 1, "if" => 3, "component" => 49);
        static $filters = array("_" => 9, "page" => 43, "theme" => 43);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['partial', 'if', 'component'],
                ['_', 'page', 'theme'],
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
