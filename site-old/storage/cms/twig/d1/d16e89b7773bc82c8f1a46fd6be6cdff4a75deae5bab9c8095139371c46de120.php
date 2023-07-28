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

/* /var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/sections/free-trial-area.htm */
class __TwigTemplate_e8a1fd84c8504c628ef458b8784140cc6205eb15ea2778a8073d3679a11ba831 extends \Twig\Template
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
        echo "<!-- Start Free Trial Area -->
<section class=\"free-trial-area pb-100 bg-f4f5fe\">
    <div class=\"container\">
        <div class=\"free-trial-content\">
            <h3>";
        // line 5
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Estamos a sua disposição para darmos a melhor ajuda possível. "]);
        echo "</h3>
            <!-- <p>Qualify your leads & recognize the value of word your customer will love you</p> -->
            <a href=\"";
        // line 7
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("contact");
        echo "\" class=\"default-btn\"><i class=\"bx bxs-hot\"></i>";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Entre em contato"]);
        echo " <span></span></a>
        </div>
    </div>

    <div class=\"shape10\"><img src=\"";
        // line 11
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/shape/10.png");
        echo "\" alt=\"image\"></div>
    <div class=\"shape11\"><img src=\"";
        // line 12
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/shape/7.png");
        echo "\" alt=\"image\"></div>
    <div class=\"shape12\"><img src=\"";
        // line 13
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/shape/11.png");
        echo "\" alt=\"image\"></div>
    <div class=\"shape13\"><img src=\"";
        // line 14
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/shape/12.png");
        echo "\" alt=\"image\"></div>
</section>
<!-- End Free Trial Area -->";
    }

    public function getTemplateName()
    {
        return "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/sections/free-trial-area.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  71 => 14,  67 => 13,  63 => 12,  59 => 11,  50 => 7,  45 => 5,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/sections/free-trial-area.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array("_" => 5, "page" => 7, "theme" => 11);
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
