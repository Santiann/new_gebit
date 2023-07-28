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

/* C:\wamp64\www\httpdocs\themes\dealix-novo\partials\site\header.htm */
class __TwigTemplate_a278aba4bc559947de6a2e776855d25e5c413dd57691a7d500f183b81fddf627 extends \Twig\Template
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
<html lang=\"en\">
    <head>
        <meta charset=\"UTF-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <title>";
        // line 7
        $context['__placeholder_page_title_default_contents'] = null;        ob_start();        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, true, 7), "title", [], "any", false, false, true, 7), 7, $this->source), "html", null, true);
        $context['__placeholder_page_title_default_contents'] = ob_get_clean();        echo $this->env->getExtension('Cms\Twig\Extension')->displayBlock('page_title', $context['__placeholder_page_title_default_contents']);
        unset($context['__placeholder_page_title_default_contents']);        echo " | Dealix</title>
        ";
        // line 8
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("meta/styles"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 9
        echo "        ";
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("meta/seo"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 10
        echo "        <link rel=\"shortcut icon\" href=\"";
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/favicon.ico");
        echo "\" type=\"image/x-icon' }}\" type=\"image/x-icon\">
        <link rel=\"icon\" href=\"";
        // line 11
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/favicon.ico");
        echo "\" type=\"image/x-icon' }}\">
        <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
        <link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>
        <link href=\"https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap\" rel=\"stylesheet\">
        <link rel=\"icon\" href=\"";
        // line 15
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/homes/favicon.svg");
        echo "\" sizes=\"24x24\" type=\"image/svg\">
    </head>
    ";
        // line 17
        $context["pageId"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, true, 17), "id", [], "any", false, false, true, 17);
        // line 18
        echo "    ";
        $context["pageTitle"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, true, 18), "title", [], "any", false, false, true, 18);
        // line 19
        echo "    ";
        if (twig_test_empty(($context["pageId"] ?? null))) {
            // line 20
            echo "        ";
            $context["pageId"] = twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "id", [], "any", false, false, true, 20);
            // line 21
            echo "    ";
        }
        // line 22
        echo "    ";
        if (twig_test_empty(($context["pageTitle"] ?? null))) {
            // line 23
            echo "        ";
            $context["pageTitle"] = twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "title", [], "any", false, false, true, 23);
            // line 24
            echo "    ";
        }
        // line 25
        echo "    ";
        if ((($context["noheader"] ?? null) == false)) {
            // line 26
            echo "        <body style=\"background-image: url(";
            echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/bg-svg.svg");
            echo ")\">
            ";
            // line 27
            $context['__cms_partial_params'] = [];
            echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("common/navbar"            , $context['__cms_partial_params']            , true            );
            unset($context['__cms_partial_params']);
            // line 28
            echo "    ";
        } else {
            // line 29
            echo "        <body>
    ";
        }
    }

    public function getTemplateName()
    {
        return "C:\\wamp64\\www\\httpdocs\\themes\\dealix-novo\\partials\\site\\header.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  116 => 29,  113 => 28,  109 => 27,  104 => 26,  101 => 25,  98 => 24,  95 => 23,  92 => 22,  89 => 21,  86 => 20,  83 => 19,  80 => 18,  78 => 17,  73 => 15,  66 => 11,  61 => 10,  56 => 9,  52 => 8,  47 => 7,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\">
    <head>
        <meta charset=\"UTF-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <title>{% placeholder page_title default %}{{ this.page.title }}{% endplaceholder %} | Dealix</title>
        {% partial \"meta/styles\" %}
        {% partial \"meta/seo\" %}
        <link rel=\"shortcut icon\" href=\"{{ 'assets/img/favicon.ico' | theme }}\" type=\"image/x-icon' }}\" type=\"image/x-icon\">
        <link rel=\"icon\" href=\"{{ 'assets/img/favicon.ico' | theme }}\" type=\"image/x-icon' }}\">
        <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
        <link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>
        <link href=\"https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap\" rel=\"stylesheet\">
        <link rel=\"icon\" href=\"{{ 'assets/img/homes/favicon.svg' | theme }}\" sizes=\"24x24\" type=\"image/svg\">
    </head>
    {% set pageId = this.page.id %}
    {% set pageTitle = this.page.title %}
    {% if pageId is empty %}
        {% set pageId = page.id %}
    {% endif %}
    {% if pageTitle is empty %}
        {% set pageTitle = page.title %}
    {% endif %}
    {% if noheader == false %}
        <body style=\"background-image: url({{ 'assets/img/bg-svg.svg'|theme }})\">
            {% partial 'common/navbar' %}
    {% else %}
        <body>
    {% endif %}", "C:\\wamp64\\www\\httpdocs\\themes\\dealix-novo\\partials\\site\\header.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("placeholder" => 7, "partial" => 8, "set" => 17, "if" => 19);
        static $filters = array("escape" => 7, "theme" => 10);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['placeholder', 'partial', 'set', 'if'],
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
