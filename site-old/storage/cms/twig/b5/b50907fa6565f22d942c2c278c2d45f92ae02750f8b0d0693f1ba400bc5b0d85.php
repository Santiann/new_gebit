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

/* /var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/layouts/default.htm */
class __TwigTemplate_ca35d08412d810cbafa0ace5d63a5b43c53d7d8d94ef9cbfc79a03e5e5d6ed55 extends \Twig\Template
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
        echo "<!DOCTYPE html>

";
        // line 3
        $context['__placeholder_head_default_contents'] = null;        ob_start();        // line 4
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("common/head"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        $context['__placeholder_head_default_contents'] = ob_get_clean();        // line 3
        echo $this->env->getExtension('Cms\Twig\Extension')->displayBlock('head', $context['__placeholder_head_default_contents']);
        unset($context['__placeholder_head_default_contents']);        // line 6
        echo "
<body>

    <!-- Start Preloader Area -->
    <div class=\"preloader-area\">
        <div class=\"spinner\">
            <div class=\"inner\">
                <div class=\"disc\"></div>
                <div class=\"disc\"></div>
                <div class=\"disc\"></div>
            </div>
        </div>
    </div>
    <!-- End Preloader Area -->

    <!-- Content -->
    ";
        // line 22
        echo $this->env->getExtension('Cms\Twig\Extension')->pageFunction();
        // line 23
        echo "
    <!-- Footer -->
    ";
        // line 25
        $context['__placeholder_footer_default_contents'] = null;        ob_start();        // line 26
        echo "    ";
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("common/footer"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 27
        echo "    ";
        $context['__placeholder_footer_default_contents'] = ob_get_clean();        // line 25
        echo $this->env->getExtension('Cms\Twig\Extension')->displayBlock('footer', $context['__placeholder_footer_default_contents']);
        unset($context['__placeholder_footer_default_contents']);        // line 28
        echo "
    ";
        // line 29
        echo $this->env->getExtension('Cms\Twig\Extension')->assetsFunction('js');
        echo $this->env->getExtension('Cms\Twig\Extension')->displayBlock('scripts');
        // line 30
        echo "
</body>

</html>";
    }

    public function getTemplateName()
    {
        return "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/layouts/default.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  90 => 30,  87 => 29,  84 => 28,  82 => 25,  80 => 27,  75 => 26,  74 => 25,  70 => 23,  68 => 22,  50 => 6,  48 => 3,  44 => 4,  43 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/layouts/default.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("placeholder" => 3, "partial" => 4, "page" => 22, "scripts" => 29);
        static $filters = array();
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['placeholder', 'partial', 'page', 'scripts'],
                [],
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
