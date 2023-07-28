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

/* /var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/registerForm/fields/common.htm */
class __TwigTemplate_a29dd6f434a2f323fdc2d4d9f6a41de7329282b3f5f646d0946f1de15474555e extends \Twig\Template
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
    <div class=\"col-lg-6 col-md-6\">
        <div class=\"form-group\">
            <input type=\"text\" name=\"name\" id=\"name\" class=\"form-control\" data-minlength=\"3\" data-error=\"";
        // line 4
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Nome inválido"]);
        echo "\" required placeholder=\"";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Nome completo"]);
        echo "\">
            <div class=\"help-block with-errors\"></div>
        </div>
    </div>
    <div class=\"col-lg-6 col-md-6\">
        <div class=\"form-group\">
            <input type=\"text\" name=\"a001_cpf\" id=\"a001_cpf\" data-minlength=\"14\" data-maxlength=\"14\" data-mask=\"000.000.000-00\" data-mask-reverse=\"true\" required data-error=\"";
        // line 10
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["CPF inválido"]);
        echo "\" class=\"form-control\" placeholder=\"";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Seu CPF"]);
        echo "\">
            <div class=\"help-block with-errors\"></div>
        </div>
    </div>
</div>
<div class=\"row\">
    <div class=\"col-lg-6 col-md-6\">
        <div class=\"form-group\">
            <input type=\"email\" name=\"email\" id=\"email\" class=\"form-control\" required data-error=\"";
        // line 18
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["E-mail inválido"]);
        echo "\" placeholder=\"";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Seu e-mail"]);
        echo "\">
            <input hidden type=\"password\" name=\"password\" id=\"password\" class=\"form-control d-none\" value=\"xxxxxxxxx\">
            <div class=\"help-block with-errors\"></div>
        </div>
    </div>
    <div class=\"col-lg-6 col-md-6\">
        <div class=\"form-group\">
            <input readonly type=\"text\" name=\"a001_telefone\" id=\"a001_telefone\" class=\"form-control\" required placeholder=\"";
        // line 25
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Seu telefone"]);
        echo "\">
            <div class=\"help-block with-errors\"></div>
        </div>
    </div>
    <!-- Campo só para jurídica -->
    <div data-id-tab=\"company\" class=\"col-lg-6 col-md-6\" style=\"display: none;\">
        <div class=\"form-group\">
            <input type=\"text\" name=\"a001_cargo\" id=\"a001_cargo\" class=\"form-control\" placeholder=\"";
        // line 32
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Seu cargo"]);
        echo "\">
            <div class=\"help-block with-errors\"></div>
        </div>
    </div>
</div>

";
        // line 38
        $context['__cms_component_params'] = [];
        $context['__cms_component_params']['prefix'] = "a001"        ;
        echo $this->env->getExtension('Cms\Twig\Extension')->componentFunction("localization"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
    }

    public function getTemplateName()
    {
        return "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/registerForm/fields/common.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  99 => 38,  90 => 32,  80 => 25,  68 => 18,  55 => 10,  44 => 4,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/registerForm/fields/common.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("component" => 38);
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
