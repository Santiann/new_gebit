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

/* /var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/sections/features-area.htm */
class __TwigTemplate_6bb7cc2db473389ee5cc01f3d848f17c6a05812ba2bac42636eaa17c7e300b07 extends \Twig\Template
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
        echo "<!-- Start Features Area -->
<section class=\"features-area pt-100 pb-70 bg-f4f6fc\">
    <div class=\"container\">
        <div class=\"section-title\">
            <h2>";
        // line 5
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Serviços"]);
        echo "</h2>
        </div>

        <div class=\"row\">
            <div class=\"col-lg-4 col-md-6\">
                <div class=\"features-box-one wow fadeInLeft\" data-wow-delay=\".1s\">
                    <i class='bx bx-conversation bg-13c4a1'></i>
                    <h3>";
        // line 12
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Gerenciamento de Contrato"]);
        echo "</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor dolore magna.</p>
                </div>
            </div>

            <div class=\"col-lg-4 col-md-6\">
                <div class=\"features-box-one wow fadeInLeft\" data-wow-delay=\".2s\">
                    <i class='bx bxs-badge-check bg-6610f2'></i>
                    <h3>";
        // line 20
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Compras"]);
        echo "</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor dolore magna.</p>
                </div>
            </div>

            <div class=\"col-lg-4 col-md-6\">
                <div class=\"features-box-one wow fadeInLeft\" data-wow-delay=\".3s\">
                    <i class='bx bxs-dashboard bg-ffb700'></i>
                    <h3>";
        // line 28
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Vendas"]);
        echo "</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor dolore magna.</p>
                </div>
            </div>

            <div class=\"col-lg-4 col-md-6\">
                <div class=\"features-box-one wow fadeInLeft\" data-wow-delay=\".4s\">
                    <i class='bx bxs-bell-ring bg-fc3549'></i>
                    <h3>";
        // line 36
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Compromissos"]);
        echo "</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor dolore magna.</p>
                </div>
            </div>

            <div class=\"col-lg-4 col-md-6\">
                <div class=\"features-box-one wow fadeInLeft\" data-wow-delay=\".5s\">
                    <i class='bx bxs-info-circle bg-00d280'></i>
                    <h3>";
        // line 44
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Auditorias"]);
        echo "</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor dolore magna.</p>
                </div>
            </div>
            <!-- <div class=\"col-lg-4 col-md-6\">
                <div class=\"features-box-one wow fadeInLeft\" data-wow-delay=\".6s\">
                    <i class='bx bx-cog bg-ff612f'></i>
                    <h3>Flexible Functionality</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor dolore magna.</p>
                </div>
            </div> -->
        </div>
    </div>
</section>
<!-- End Features Area -->";
    }

    public function getTemplateName()
    {
        return "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/sections/features-area.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  99 => 44,  88 => 36,  77 => 28,  66 => 20,  55 => 12,  45 => 5,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/sections/features-area.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array("_" => 5);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                [],
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
