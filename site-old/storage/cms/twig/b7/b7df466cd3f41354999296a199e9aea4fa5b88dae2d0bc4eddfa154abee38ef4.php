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

/* /var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/newsletterForm/default.htm */
class __TwigTemplate_8540513d2c0dfc5a17dc9dbc32643e8b05c472712a8a69d48694bd70d3cd7b9e extends \Twig\Template
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
        $context["subscription"] = twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "subscription", [], "any", false, false, true, 1);
        // line 2
        echo "
";
        // line 3
        if ((null === ($context["subscription"] ?? null))) {
            // line 4
            echo "<!-- Start Subscribe Content -->
<div class=\"subscribe-content border-radius-0\" id=\"subscription-box\">
    <h2>";
            // line 6
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Assine e receba nossas novidades"]);
            echo "</h2>
    
    <form data-request=\"onSubscription\" class=\"newsletter-form\" data-request-success=\"alert('";
            // line 8
            echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["text_messages"] ?? null), 8, $this->source), "html", null, true);
            echo "');\$('#subscriptionForm').trigger('reset');\" id=\"subscriptionForm\">
        <div class=\"row align-items-center\">
            <div class=\"col-lg-8 col-md-8\">
                <input type=\"email\" class=\"input-newsletter\" placeholder=\"email@email.com\" name=\"email\" required=\"\" autocomplete=\"off\">
            </div>

            <div class=\"col-lg-4 col-md-4\">
                <button type=\"submit\" class=\"disabled\" style=\"pointer-events: all; cursor: pointer;\"><i class=\"bx bxs-hot\"></i> ";
            // line 15
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Assinar"]);
            echo "</button>
            </div>

            <div class=\"col-lg-12 col-md-12\">
                <div id=\"validator-newsletter\" class=\"form-result\"></div>
            </div>
        </div>

        ";
            // line 23
            if (($context["failureMessage"] ?? null)) {
                // line 24
                echo "        <div class=\"alert alert-danger alert-dismissible\" role=\"alert\">
            ";
                // line 25
                echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Ocorreu um erro ao assinar, tente novamente mais tarde."]);
                echo "
        </div>
        ";
            }
            // line 28
            echo "        
    ";
            // line 29
            echo call_user_func_array($this->env->getFunction('form_close')->getCallable(), ["close"]);
            echo "
    
    <div class=\"shape14\"><img src=\"";
            // line 31
            echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/shape/13.png");
            echo "\" alt=\"image\"></div>
    <div class=\"shape15\"><img src=\"";
            // line 32
            echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/shape/14.png");
            echo "\" alt=\"image\"></div>
    <div class=\"shape16\"><img src=\"";
            // line 33
            echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/shape/15.png");
            echo "\" alt=\"image\"></div>
    <div class=\"shape17\"><img src=\"";
            // line 34
            echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/shape/16.png");
            echo "\" alt=\"image\"></div>
    <div class=\"shape18\"><img src=\"";
            // line 35
            echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/shape/17.png");
            echo "\" alt=\"image\"></div>
</div>
";
        } else {
            // line 38
            echo "
<div class=\"subscribe-content success-message-white\">
    ";
            // line 40
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Obrigado por assinar! Em breve entraremos em contato com mais novidades!"]);
            echo "
</div>

";
        }
        // line 44
        echo "<!-- End Subscribe Content -->";
    }

    public function getTemplateName()
    {
        return "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/newsletterForm/default.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  128 => 44,  121 => 40,  117 => 38,  111 => 35,  107 => 34,  103 => 33,  99 => 32,  95 => 31,  90 => 29,  87 => 28,  81 => 25,  78 => 24,  76 => 23,  65 => 15,  55 => 8,  50 => 6,  46 => 4,  44 => 3,  41 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/newsletterForm/default.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 1, "if" => 3);
        static $filters = array("_" => 6, "escape" => 8, "theme" => 31);
        static $functions = array("form_close" => 29);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['_', 'escape', 'theme'],
                ['form_close']
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
