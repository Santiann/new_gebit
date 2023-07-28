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

/* /var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/resetPasswordForm/restore.htm */
class __TwigTemplate_6ee5986a825398ea38f0da33ce2770387ee3b339b4bb9c1800a4b04c637775d5 extends \Twig\Template
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
        echo "<p class=\"lead\">
    <strong>";
        // line 2
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Esqueceu sua senha?"]);
        echo "</strong> ";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Entre com seu e-mail para verificarmos sua conta."]);
        echo "
</p>

<form
    data-request=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["__SELF__"] ?? null), 6, $this->source), "html", null, true);
        echo "::onRestorePassword\">
    <div class=\"form-group\">
        <label for=\"userRestoreEmail\">E-mail</label>
        <input name=\"email\" type=\"email\" class=\"form-control\" id=\"userRestoreEmail\" placeholder=\"";
        // line 9
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Insira seu e-mail"]);
        echo "\">
    </div>

    <button type=\"submit\" class=\"btn btn-success\">";
        // line 12
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Restaurar senha"]);
        echo "</button>
</form>";
    }

    public function getTemplateName()
    {
        return "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/resetPasswordForm/restore.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  63 => 12,  57 => 9,  51 => 6,  42 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/resetPasswordForm/restore.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array("_" => 2, "escape" => 6);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                [],
                ['_', 'escape'],
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
