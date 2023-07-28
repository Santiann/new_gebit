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

/* /var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/sections/main-banner-area.htm */
class __TwigTemplate_8619f803cf16e4a2942ea18f32346654db41afc511134f5144afe24460e69406 extends \Twig\Template
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
        echo "<!-- Start Main Banner Area -->
<div class=\"main-banner main-banner-one\">
    <div class=\"container-fluid\">
        <div class=\"row\">
            <div class=\"col-lg-7 col-md-12\">
                <div class=\"main-banner-content\">
                    <div class=\"d-table\">
                        <div class=\"d-table-cell\">
                            <div class=\"content\">
                                <h2>";
        // line 10
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Soluções simples e diretas, em modo colaborativo, para otimizar a redução de custos de quem compra e aumentar a receita de quem vende"]);
        echo "</h2>
                                <p>";
        // line 11
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["O melhor “sistema ágil” para gestão de custos, receitas e auditoria. Para quem busca praticidade e resultados, 
                                    trabalhando em parceria com seus clientes e fornecedores. Reduza desperdícios, faça mais... com muito menos."]);
        // line 12
        echo "</p>
                                <a href=\"";
        // line 13
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("pricing");
        echo "\" class=\"default-btn\">
                                    <i class=\"bx bxs-hot\"></i>";
        // line 14
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Adquira já"]);
        echo "<span></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class=\"col-lg-5 col-md-12\">
                <div class=\"banner-image mbanner-bg-one\">
                    <div class=\"d-table\">
                        <div class=\"d-table-cell\">
                            <div class=\"animate-banner-image\">
                                <img src=\"";
        // line 27
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/animate-banner-img1.jpg");
        echo "\" alt=\"image\">
                            </div>
                        </div>
                    </div>

                    <img src=\"";
        // line 32
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/banner-slider/banner-img1.jpg");
        echo "\" class=\"mbanner-img\" alt=\"image\">
                </div>
            </div>
        </div>
    </div>

    <div class=\"shape20\"><img src=\"";
        // line 38
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/shape/19.png");
        echo "\" alt=\"image\"></div>
    <div class=\"shape21\"><img src=\"";
        // line 39
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/shape/20.png");
        echo "\" alt=\"image\"></div>
    <div class=\"shape19\"><img src=\"";
        // line 40
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/shape/18.png");
        echo "\" alt=\"image\"></div>
    <div class=\"shape22\"><img src=\"";
        // line 41
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/shape/21.png");
        echo "\" alt=\"image\"></div>
    <div class=\"shape23\"><img src=\"";
        // line 42
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/shape/22.svg");
        echo "\" alt=\"image\"></div>
    <div class=\"shape24\"><img src=\"";
        // line 43
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/shape/23.png");
        echo "\" alt=\"image\"></div>
    <div class=\"shape26\"><img src=\"";
        // line 44
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/shape/25.png");
        echo "\" alt=\"image\"></div>
</div>
<!-- End Main Banner Area -->";
    }

    public function getTemplateName()
    {
        return "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/sections/main-banner-area.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  121 => 44,  117 => 43,  113 => 42,  109 => 41,  105 => 40,  101 => 39,  97 => 38,  88 => 32,  80 => 27,  64 => 14,  60 => 13,  57 => 12,  54 => 11,  50 => 10,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/sections/main-banner-area.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array("_" => 10, "page" => 13, "theme" => 27);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                [],
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
