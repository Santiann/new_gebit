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

/* C:\wamp64\www\httpdocs\themes\dealix-novo\partials\meta\styles.htm */
class __TwigTemplate_b5282fafee6a733b354eb5dde0b83f07c25b021f78f7b74cd485c529034853ba extends \Twig\Template
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
        echo "<!-- Styles -->
<link rel=\"stylesheet\" href=\"";
        // line 2
        echo $this->extensions['Cms\Twig\Extension']->themeFilter([0 => "assets/scss/main.scss", 1 => "assets/vendor/fontawesome-free/css/all.min.css", 2 => "assets/vendor/owl.carousel/assets/owl.carousel.min.css"]);
        // line 6
        echo "\"></link>

<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js\"></script>
";
        // line 9
        echo $this->env->getExtension('Cms\Twig\Extension')->assetsFunction('css');
        echo $this->env->getExtension('Cms\Twig\Extension')->displayBlock('styles');
        // line 10
        $context['__placeholder_head_default_contents'] = null;        echo $this->env->getExtension('Cms\Twig\Extension')->displayBlock('head', $context['__placeholder_head_default_contents']);
        unset($context['__placeholder_head_default_contents']);    }

    public function getTemplateName()
    {
        return "C:\\wamp64\\www\\httpdocs\\themes\\dealix-novo\\partials\\meta\\styles.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  52 => 10,  49 => 9,  44 => 6,  42 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!-- Styles -->
<link rel=\"stylesheet\" href=\"{{ [
    'assets/scss/main.scss',
    'assets/vendor/fontawesome-free/css/all.min.css',
    'assets/vendor/owl.carousel/assets/owl.carousel.min.css',
] | theme }}\"></link>

<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js\"></script>
{% styles %}
{% placeholder head %}", "C:\\wamp64\\www\\httpdocs\\themes\\dealix-novo\\partials\\meta\\styles.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("styles" => 9, "placeholder" => 10);
        static $filters = array("theme" => 6);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['styles', 'placeholder'],
                ['theme'],
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
