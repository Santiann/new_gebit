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

/* /var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/contactForm/default.htm */
class __TwigTemplate_a4b706310c34252dc38ff7235284ca0341245ede050dca057c5aa5cbc7471eaa extends \Twig\Template
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
        echo "<form id=\"contactForm\" data-request=\"";
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["__SELF__"] ?? null), 1, $this->source), "html", null, true);
        echo "::onFormSubmit\">
    ";
        // line 2
        echo call_user_func_array($this->env->getFunction('form_token')->getCallable(), ["token"]);
        echo "
    <div id=\"";
        // line 3
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["__SELF__"] ?? null), 3, $this->source), "html", null, true);
        echo "_forms_flash\"></div>
    <div class=\"row\">
        <div class=\"col-lg-6 col-md-6\">
            <div class=\"form-group\">
                <input type=\"text\" name=\"name\" id=\"name\" class=\"form-control\" required data-error=\"";
        // line 7
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Insira seu nome"]);
        echo "\" placeholder=\"";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Seu nome"]);
        echo "\">
                <div class=\"help-block with-errors\"></div>
            </div>
        </div>

        <div class=\"col-lg-6 col-md-6\">
            <div class=\"form-group\">
                <input type=\"email\" name=\"email\" id=\"email\" class=\"form-control\" required data-error=\"";
        // line 14
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Insira seu e-mail"]);
        echo "\" placeholder=\"";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Seu e-mail"]);
        echo "\">
                <div class=\"help-block with-errors\"></div>
            </div>
        </div>

        <div class=\"col-lg-6 col-md-6\">
            <div class=\"form-group\">
                <input type=\"text\" name=\"phone_number\" id=\"phone_number\" required data-error=\"";
        // line 21
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Insira o telefone"]);
        echo "\" class=\"form-control\" placeholder=\"";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Seu telefone"]);
        echo "\">
                <div class=\"help-block with-errors\"></div>
            </div>
        </div>

        <div class=\"col-lg-6 col-md-6\">
            <div class=\"form-group\">
                <input type=\"text\" name=\"msg_subject\" id=\"msg_subject\" class=\"form-control\" required data-error=\"";
        // line 28
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Insira o assunto"]);
        echo "\" placeholder=\"";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Seu assunto"]);
        echo "\">
                <div class=\"help-block with-errors\"></div>
            </div>
        </div>

        <div class=\"col-lg-12 col-md-12\">
            <div class=\"form-group\">
                <textarea name=\"message\" class=\"form-control\" id=\"message\" cols=\"30\" rows=\"6\" required data-error=\"";
        // line 35
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Escreva sua mensagem"]);
        echo "\" placeholder=\"";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Sua mensagem"]);
        echo "\"></textarea>
                <div class=\"help-block with-errors\"></div>
            </div>
        </div>

        <div class=\"form-group\">
            ";
        // line 41
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("@recaptcha"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 42
        echo "        </div>

        <div class=\"col-lg-12 col-md-12\">
            <button type=\"submit\" class=\"default-btn\"><i class='bx bxs-paper-plane'></i>";
        // line 45
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Enviar"]);
        echo "<span></span></button>
            <div id=\"msgSubmit\" class=\"h3 text-center hidden\"></div>
            <div class=\"clearfix\"></div>
        </div>
    </div>
</form>";
    }

    public function getTemplateName()
    {
        return "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/contactForm/default.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  123 => 45,  118 => 42,  114 => 41,  103 => 35,  91 => 28,  79 => 21,  67 => 14,  55 => 7,  48 => 3,  44 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/contactForm/default.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("partial" => 41);
        static $filters = array("escape" => 1, "_" => 7);
        static $functions = array("form_token" => 2);

        try {
            $this->sandbox->checkSecurity(
                ['partial'],
                ['escape', '_'],
                ['form_token']
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
