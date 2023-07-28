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

/* /var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/common/head.htm */
class __TwigTemplate_caf5f10f7fd3a1b7ed124bcf703544ba150492208d9780847374457566bfbde0 extends \Twig\Template
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
        echo "<head>
    <title>Dealix - ";
        // line 2
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, true, 2), "title", [], "any", false, false, true, 2), 2, $this->source), "html", null, true);
        echo "</title>

    <!-- Required meta tags always come first -->
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <meta http-equiv=\"x-ua-compatible\" content=\"ie=edge\">
    <meta name=\"description\" content=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, true, 8), "meta_description", [], "any", false, false, true, 8), 8, $this->source), "html", null, true);
        echo "\">
    <meta name=\"title\" content=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, true, 9), "meta_title", [], "any", false, false, true, 9), 9, $this->source), "html", null, true);
        echo "\">
    <link rel=\"apple-touch-icon\" sizes=\"57x57\" href=\"";
        // line 10
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/favicon/apple-icon-57x57.png");
        echo "\">
    <link rel=\"apple-touch-icon\" sizes=\"60x60\" href=\"";
        // line 11
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/favicon/apple-icon-60x60.png");
        echo "\">
    <link rel=\"apple-touch-icon\" sizes=\"72x72\" href=\"";
        // line 12
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/favicon/apple-icon-72x72.png");
        echo "\">
    <link rel=\"apple-touch-icon\" sizes=\"76x76\" href=\"";
        // line 13
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/favicon/apple-icon-76x76.png");
        echo "\">
    <link rel=\"apple-touch-icon\" sizes=\"114x114\" href=\"";
        // line 14
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/favicon/apple-icon-114x114.png");
        echo "\">
    <link rel=\"apple-touch-icon\" sizes=\"120x120\" href=\"";
        // line 15
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/favicon/apple-icon-120x120.png");
        echo "\">
    <link rel=\"apple-touch-icon\" sizes=\"144x144\" href=\"";
        // line 16
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/favicon/apple-icon-144x144.png");
        echo "\">
    <link rel=\"apple-touch-icon\" sizes=\"152x152\" href=\"";
        // line 17
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/favicon/apple-icon-152x152.png");
        echo "\">
    <link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"";
        // line 18
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/favicon/apple-icon-180x180.png");
        echo "\">
    <link rel=\"icon\" type=\"image/png\" sizes=\"192x192\"  href=\"";
        // line 19
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/favicon/android-icon-192x192.png");
        echo "\">
    <link rel=\"icon\" type=\"image/png\" sizes=\"32x32\" href=\"";
        // line 20
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/favicon/favicon-32x32.png");
        echo "\">
    <link rel=\"icon\" type=\"image/png\" sizes=\"96x96\" href=\"";
        // line 21
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/favicon/favicon-96x96.png");
        echo "\">
    <link rel=\"icon\" type=\"image/png\" sizes=\"16x16\" href=\"";
        // line 22
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/favicon/favicon-16x16.png");
        echo "\">
    <link rel=\"manifest\" href=\"";
        // line 23
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/favicon/manifest.json");
        echo "\">
    <meta name=\"msapplication-TileColor\" content=\"#ffffff\">
    <meta name=\"msapplication-TileImage\" content=\"";
        // line 25
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/favicon/ms-icon-144x144.png");
        echo "\">
    <meta name=\"theme-color\" content=\"#ffffff\">

    <!-- Bootstrap Min CSS -->
    <link rel=\"stylesheet\" href=\"";
        // line 29
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/css/bootstrap.min.css");
        echo "\">
    <!-- Animate Min CSS -->
    <link rel=\"stylesheet\" href=\"";
        // line 31
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/css/animate.min.css");
        echo "\">
    <!-- BoxIcons Min CSS -->
    <link rel=\"stylesheet\" href=\"";
        // line 33
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/css/boxicons.min.css");
        echo "\">
    <!-- Owl Carousel Min CSS -->
    <link rel=\"stylesheet\" href=\"";
        // line 35
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/css/owl.carousel.min.css");
        echo "\">
    <!-- Odometer Min CSS -->
    <link rel=\"stylesheet\" href=\"";
        // line 37
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/css/odometer.min.css");
        echo "\">
    <!-- MeanMenu CSS -->
    <link rel=\"stylesheet\" href=\"";
        // line 39
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/css/meanmenu.css");
        echo "\">
    <!-- Magnific Popup Min CSS -->
    <link rel=\"stylesheet\" href=\"";
        // line 41
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/css/magnific-popup.min.css");
        echo "\">
    <!-- Select2 -->
    <link href=\"https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css\" rel=\"stylesheet\" />

    <!-- Style CSS -->
    <link rel=\"stylesheet\" href=\"";
        // line 46
        echo $this->extensions['Cms\Twig\Extension']->themeFilter([0 => "assets/css/responsive.scss", 1 => "assets/css/style.scss"]);
        // line 49
        echo "\">

    ";
        // line 51
        echo $this->env->getExtension('Cms\Twig\Extension')->assetsFunction('css');
        echo $this->env->getExtension('Cms\Twig\Extension')->displayBlock('styles');
        // line 52
        echo "</head>";
    }

    public function getTemplateName()
    {
        return "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/common/head.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  170 => 52,  167 => 51,  163 => 49,  161 => 46,  153 => 41,  148 => 39,  143 => 37,  138 => 35,  133 => 33,  128 => 31,  123 => 29,  116 => 25,  111 => 23,  107 => 22,  103 => 21,  99 => 20,  95 => 19,  91 => 18,  87 => 17,  83 => 16,  79 => 15,  75 => 14,  71 => 13,  67 => 12,  63 => 11,  59 => 10,  55 => 9,  51 => 8,  42 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/common/head.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("styles" => 51);
        static $filters = array("escape" => 2, "theme" => 10);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['styles'],
                ['escape', 'theme'],
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
