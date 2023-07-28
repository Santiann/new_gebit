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

/* /var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/pages/contact.htm */
class __TwigTemplate_b8b4fbbf8ce6f221495edcce62bce40030a0d5b6e9833c53af4898293025bfb4 extends \Twig\Template
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
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Contato"]);
        echo "</h2>
            <!-- <p>The Strax Story</p> -->
        </div>
    </div>
</div>
<!-- End Page Title Area -->

 <!-- Start Contact Area -->
 <section class=\"contact-area ptb-100\">
    <div class=\"container\">
        <div class=\"contact-inner\">
            <div class=\"row\">
                <div class=\"col-lg-6 col-md-12\">
                    <div class=\"contact-features-list\">
                        <h3>";
        // line 21
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Algumas outras ótimas razões para nos escolher"]);
        echo "</h3>
                        <p>";
        // line 22
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Somos altamente dedicados e profissionais. Te ajudaremos a ganhar tempo e maior controle nos detalhes de seu negócio."]);
        echo "</p>

                        <ul>
                            <li><i class='bx bx-badge-check'></i> ";
        // line 25
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Suporte totalmente nacional"]);
        echo "</li>
                            <li><i class='bx bx-badge-check'></i> ";
        // line 26
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Possibilidade de Customizações"]);
        echo "</li>
                            <li><i class='bx bx-badge-check'></i> ";
        // line 27
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Redução de custos com operações de conformidade e auditorias"]);
        echo "</li>
                        </ul>
                    </div>
                </div>

                <div class=\"col-lg-6 col-md-12\">
                    <div class=\"contact-form\">
                        <h3>";
        // line 34
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Entre em contato conosco"]);
        echo "</h3>

                        ";
        // line 36
        $context['__cms_component_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->componentFunction("contactForm"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        // line 37
        echo "                    </div>
                </div>
            </div>

            <div class=\"contact-info\">
                <div class=\"contact-info-content\">
                    <h3>";
        // line 43
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Contate-nos pelo WhatsApp ou e-mail"]);
        echo "</h3>
                    <h2>
                        <a href=\"https://wa.me/5541987002332\">(41) 98700-2332</a>
                        <span>";
        // line 46
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["OU"]);
        echo "</span>
                        <a href=\"mailto:suporte@dealix.com.br\">suporte@dealix.com.br</a>
                    </h2>

                    <ul class=\"social\">
                        <li><a href=\"#\" target=\"_blank\"><i class=\"bx bxl-twitter\"></i></a></li>
                        <li><a href=\"#\" target=\"_blank\"><i class=\"bx bxl-youtube\"></i></a></li>
                        <li><a href=\"#\" target=\"_blank\"><i class='bx bxl-facebook'></i></a></li>
                        <li><a href=\"#\" target=\"_blank\"><i class=\"bx bxl-linkedin\"></i></a></li>
                        <li><a href=\"#\" target=\"_blank\"><i class=\"bx bxl-instagram\"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Contact Area -->

";
    }

    public function getTemplateName()
    {
        return "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/pages/contact.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  119 => 46,  113 => 43,  105 => 37,  101 => 36,  96 => 34,  86 => 27,  82 => 26,  78 => 25,  72 => 22,  68 => 21,  51 => 7,  44 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/pages/contact.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("partial" => 1, "component" => 36);
        static $filters = array("_" => 7);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['partial', 'component'],
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
