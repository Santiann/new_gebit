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

/* /var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/pages/pricing.htm */
class __TwigTemplate_b864bb6cee8dcb71faf88cc52f8672f4991015e4257978559188ea8cdff93cf0 extends \Twig\Template
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
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Preços transparentes"]);
        echo "</h2>
            <!-- <p>Border-less account pricing</p> -->
        </div>
    </div>
</div>
<!-- End Page Title Area -->

";
        // line 14
        $context['__cms_component_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->componentFunction("prices"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        // line 15
        echo "
";
        // line 16
        $context['__cms_component_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->componentFunction("dealix_faq_questions"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        // line 17
        echo "
";
        // line 19
        echo "
";
        // line 20
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("sections/free-trial-area"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
    }

    public function getTemplateName()
    {
        return "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/pages/pricing.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 20,  75 => 19,  72 => 17,  68 => 16,  65 => 15,  61 => 14,  51 => 7,  44 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/pages/pricing.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("partial" => 1, "component" => 14);
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
