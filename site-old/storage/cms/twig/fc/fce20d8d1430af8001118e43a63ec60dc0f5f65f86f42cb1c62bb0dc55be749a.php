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

/* /var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/pages/about.htm */
class __TwigTemplate_bd7e8cefd9679b2309ae1b8ff0198335d6eeb16a689c401640a6251aadb66d27 extends \Twig\Template
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
<!-- Start Page Title Area -->
<div class=\"page-title-area\">
    <div class=\"container\">
        <div class=\"page-title-content\">
            <h2>";
        // line 7
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Sobre"]);
        echo "</h2>
            <!-- <p>The Strax Story</p> -->
        </div>
    </div>
</div>
<!-- End Page Title Area -->

<!-- Start About Area -->
<section class=\"about-area ptb-100\">
    <div class=\"container\">
        <div class=\"row align-items-center\">
            <div class=\"col-lg-6 col-md-12\">
                <div class=\"about-content\">
                    <!-- <span class=\"sub-title\">How we are Founded</span> -->
                    <h2>";
        // line 21
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Leve seu negócio para o próximo nível"]);
        echo "</h2>
                    <p>
                        ";
        // line 23
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Nossa solução surgiu de uma grande necessidade de redução de custos, no período da recessão de 2016-2017.
                        Daquele momento em diante, iniciamos um processo de enxugar todos os desperdícios na empresa, através de controles simples e eficientes.
                        Então percebemos que através da colaboração e troca de informações entre clientes e fornecedores, os processos de cadastramento, troca de documentos, controle de pagamentos, cotações e auditorias se tornam muito mais ágeis."]);
        // line 25
        echo "
                    </p>
                </div>
            </div>

            <div class=\"col-lg-6 col-md-12\">
                <div class=\"about-image\">
                    <img src=\"";
        // line 32
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/about-img.jpg");
        echo "\" alt=\"image\">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End About Area -->

";
        // line 41
        echo "
";
        // line 43
        echo "
";
        // line 45
        echo "
";
        // line 47
        echo "
";
        // line 49
        echo "
";
        // line 50
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("sections/free-trial-area"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
    }

    public function getTemplateName()
    {
        return "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/pages/about.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  112 => 50,  109 => 49,  106 => 47,  103 => 45,  100 => 43,  97 => 41,  86 => 32,  77 => 25,  73 => 23,  68 => 21,  51 => 7,  44 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/pages/about.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("partial" => 1);
        static $filters = array("_" => 7, "theme" => 32);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['partial'],
                ['_', 'theme'],
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
