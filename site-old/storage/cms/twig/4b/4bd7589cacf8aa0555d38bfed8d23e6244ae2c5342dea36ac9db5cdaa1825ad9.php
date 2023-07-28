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

/* /var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/registerForm/validate-phone.htm */
class __TwigTemplate_3c53441619288bc6dd809c879097efca38fafa6872e33c80123a96837d8f9b43 extends \Twig\Template
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
        echo "<!-- Modal -->
<div class=\"modal fade\" id=\"validatePhone\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"validatePhoneLabel\" data-backdrop=\"static\" aria-hidden=\"true\">
    <div class=\"modal-dialog\" role=\"document\">
        <div class=\"modal-content\">
        <div class=\"modal-header\">
            <h5 class=\"modal-title\" id=\"validatePhoneLabel\">";
        // line 6
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Insira o código enviado para o número"]);
        echo "</h5>
        </div>
        <div class=\"modal-body\">
            <div class=\"row justify-content-center\">
                <div class=\"col-md-12\">
                    <label></label>
                    <input type=\"number\" name=\"phone_code\" id=\"phone_code\" class=\"form-control\" placeholder=\"";
        // line 12
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Insira o código"]);
        echo "\">
                </div>
                <div class=\"col-md-12 text-center mt-4\">
                    <button type=\"button\" onclick=\"verifyCodePhone()\" class=\"btn btn-primary btn-sm\"><i class='bx bx-phone'></i> ";
        // line 15
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Verificar"]);
        echo "</button>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/registerForm/validate-phone.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  61 => 15,  55 => 12,  46 => 6,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/registerForm/validate-phone.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array("_" => 6);
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
