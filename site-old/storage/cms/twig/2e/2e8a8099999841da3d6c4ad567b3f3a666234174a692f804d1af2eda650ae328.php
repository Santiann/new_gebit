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

/* /var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/common/navbar.htm */
class __TwigTemplate_4cacfcd85c6322e1bfc0a85aa8b7fd21c248c0be701aaf825c8f273579275506 extends \Twig\Template
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
        echo "<!-- Start Navbar Area -->
<div class=\"navbar-area ";
        // line 2
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["menuClass"] ?? null), 2, $this->source), "html", null, true);
        echo "\">
    <div class=\"spacle-responsive-nav\">
        <div class=\"container\">
            <div class=\"spacle-responsive-menu\">
                <div class=\"logo\">
                    <a href=\"";
        // line 7
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("home");
        echo "\">
                        <img src=\"";
        // line 8
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/logo-dealix-horizontal.png");
        echo "\" alt=\"Dealix\" style=\"width: 150px;\">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class=\"spacle-nav\">
        <div class=\"container\">
            <nav class=\"navbar navbar-expand-md navbar-light\">
                <a class=\"navbar-brand\" href=\"";
        // line 18
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("home");
        echo "\">
                    <img src=\"";
        // line 19
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/logo-dealix-horizontal.png");
        echo "\" alt=\"Dealix\" style=\"width: 150px;\">
                </a>

                <div class=\"collapse navbar-collapse mean-menu\" id=\"navbarSupportedContent\">
                    <ul class=\"navbar-nav\">
                        <li class=\"nav-item\">
                            <a href=\"";
        // line 25
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("home");
        echo "\" class=\"nav-link ";
        echo (((twig_get_attribute($this->env, $this->source, ($context["viewBag"] ?? null), "activeMenu", [], "any", false, false, true, 25) == "home")) ? ("active") : (""));
        echo "\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Home"]);
        echo "</a>
                        </li>

                        <li class=\"nav-item\">
                            <a href=\"";
        // line 29
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("about");
        echo "\" class=\"nav-link ";
        echo (((twig_get_attribute($this->env, $this->source, ($context["viewBag"] ?? null), "activeMenu", [], "any", false, false, true, 29) == "about")) ? ("active") : (""));
        echo "\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Sobre"]);
        echo "</a>
                        </li>

                        <li class=\"nav-item\">
                            <a href=\"";
        // line 33
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("pricing");
        echo "\" class=\"nav-link ";
        echo (((twig_get_attribute($this->env, $this->source, ($context["viewBag"] ?? null), "activeMenu", [], "any", false, false, true, 33) == "pricing")) ? ("active") : (""));
        echo "\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Preços"]);
        echo "</a>
                        </li>

                        <li class=\"nav-item\">
                            <a href=\"";
        // line 37
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("services");
        echo "\" class=\"nav-link ";
        echo (((twig_get_attribute($this->env, $this->source, ($context["viewBag"] ?? null), "activeMenu", [], "any", false, false, true, 37) == "services")) ? ("active") : (""));
        echo "\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Serviços"]);
        echo "</a>
                        </li>

                        <li class=\"nav-item\">
                            <a href=\"";
        // line 41
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("features");
        echo "\" class=\"nav-link ";
        echo (((twig_get_attribute($this->env, $this->source, ($context["viewBag"] ?? null), "activeMenu", [], "any", false, false, true, 41) == "features")) ? ("active") : (""));
        echo "\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Características"]);
        echo "</a>
                        </li>

                        <li class=\"nav-item\">
                            <a href=\"";
        // line 45
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("contact");
        echo "\" class=\"nav-link ";
        echo (((twig_get_attribute($this->env, $this->source, ($context["viewBag"] ?? null), "activeMenu", [], "any", false, false, true, 45) == "contact")) ? ("active") : (""));
        echo "\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Contato"]);
        echo "</a>
                        </li>
                    </ul>

                    ";
        // line 49
        if (($context["user"] ?? null)) {
            // line 50
            echo "                        <div class=\"others-options\">
                            ";
            // line 51
            $context["api_token"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "session", [], "any", false, false, true, 51), "get", [0 => "api_token"], "method", false, false, true, 51);
            // line 52
            echo "                            <a href=";
            echo twig_escape_filter($this->env, (call_user_func_array($this->env->getFunction('env')->getCallable(), ["URL_SISTEMA"]) . ((("/login/" . $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "email", [], "any", false, false, true, 52), 52, $this->source)) . "/") . $this->sandbox->ensureToStringAllowed(($context["api_token"] ?? null), 52, $this->source))), "html", null, true);
            echo " target=\"_blank\" class=\"default-btn\">
                                <i class=\"bx bx-laptop\"></i>";
            // line 53
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Acessar sistema"]);
            echo "<span></span>
                            </a>
                            ";
            // line 55
            $context['__cms_component_params'] = [];
            echo $this->env->getExtension('Cms\Twig\Extension')->componentFunction("loginButton"            , $context['__cms_component_params']            );
            unset($context['__cms_component_params']);
            // line 56
            echo "                        </div>
                        <div class=\"others-options\">
                    ";
        } else {
            // line 59
            echo "                        <div class=\"others-options\">
                            ";
            // line 60
            $context['__cms_component_params'] = [];
            echo $this->env->getExtension('Cms\Twig\Extension')->componentFunction("loginButton"            , $context['__cms_component_params']            );
            unset($context['__cms_component_params']);
            // line 61
            echo "                        </div>
                        <div class=\"others-options ml-3\">
                    ";
        }
        // line 64
        echo "                        ";
        $context['__cms_component_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->componentFunction("localePicker"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        // line 65
        echo "                    </div>

                </div>
            </nav>
        </div>
    </div>
</div>
<!-- End Navbar Area -->";
    }

    public function getTemplateName()
    {
        return "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/common/navbar.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  189 => 65,  184 => 64,  179 => 61,  175 => 60,  172 => 59,  167 => 56,  163 => 55,  158 => 53,  153 => 52,  151 => 51,  148 => 50,  146 => 49,  135 => 45,  124 => 41,  113 => 37,  102 => 33,  91 => 29,  80 => 25,  71 => 19,  67 => 18,  54 => 8,  50 => 7,  42 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/common/navbar.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 49, "set" => 51, "component" => 55);
        static $filters = array("escape" => 2, "page" => 7, "theme" => 8, "_" => 25);
        static $functions = array("env" => 52);

        try {
            $this->sandbox->checkSecurity(
                ['if', 'set', 'component'],
                ['escape', 'page', 'theme', '_'],
                ['env']
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
