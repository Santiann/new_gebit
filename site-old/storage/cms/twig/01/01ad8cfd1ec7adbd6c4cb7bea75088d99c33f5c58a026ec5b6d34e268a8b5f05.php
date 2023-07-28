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

/* /var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/registerForm/fields/company.htm */
class __TwigTemplate_64ce4ccbf785ac66b227e5f555de21b7f183b425dcf34308980ec7039faed206 extends \Twig\Template
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
        echo "<div class=\"row\">
    <div class=\"col-lg-4 col-12\">
        <div class=\"form-group\">
            <input type=\"text\" data-mask=\"00.000.000/0000-00\" pattern=\"[0-9]{2}\\.[0-9]{3}\\.[0-9]{3}\\/[0-9]{4}-[0-9]{2}\" name=\"a005_cnpj\" id=\"a005_cnpj\" class=\"form-control\" data-error=\"";
        // line 4
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["CNPJ inválido"]);
        echo "\" placeholder=\"";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["CNPJ"]);
        echo "\">
            <div class=\"help-block with-errors\"></div>
        </div>
    </div>
    <div class=\"col-lg-4 col-12\">
        <div class=\"form-group\">
            <input type=\"text\" name=\"a005_razao_social\" id=\"a005_razao_social\" class=\"form-control\" placeholder=\"";
        // line 10
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Razão Social"]);
        echo "\">
            <div class=\"help-block with-errors\"></div>
        </div>
    </div>
    <div class=\"col-lg-4 col-12\">
        <div class=\"form-group\">
            <input type=\"text\" name=\"a005_nome_fantasia\" id=\"a005_nome_fantasia\" class=\"form-control\" placeholder=\"";
        // line 16
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Nome Fantasia"]);
        echo "\">
            <div class=\"help-block with-errors\"></div>
        </div>
    </div>
</div>
<div class=\"row\">
    <div class=\"col-lg-6 col-12\">
        <div class=\"form-group\">
            <input type=\"email\" name=\"company_email\" id=\"company_email\" class=\"form-control\" placeholder=\"";
        // line 24
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["E-mail"]);
        echo "\">
            <div class=\"help-block with-errors\"></div>
        </div>
    </div>
    <div class=\"col-lg-6 col-12\">
        <div class=\"form-group\">
            <input type=\"text\" name=\"company_phone\" id=\"company_phone\" class=\"form-control\" data-minlength=\"13\" data-error=\"";
        // line 30
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Número inválido"]);
        echo "\" data-mask=\"(00) 000000000\" placeholder=\"";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Telefone"]);
        echo "\">
            <div class=\"help-block with-errors\"></div>
        </div>
    </div>
    ";
        // line 41
        echo "</div>

";
        // line 43
        $context['__cms_component_params'] = [];
        $context['__cms_component_params']['prefix'] = "a005"        ;
        echo $this->env->getExtension('Cms\Twig\Extension')->componentFunction("localization"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
    }

    public function getTemplateName()
    {
        return "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/registerForm/fields/company.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  97 => 43,  93 => 41,  84 => 30,  75 => 24,  64 => 16,  55 => 10,  44 => 4,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/registerForm/fields/company.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("component" => 43);
        static $filters = array("_" => 4);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['component'],
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
