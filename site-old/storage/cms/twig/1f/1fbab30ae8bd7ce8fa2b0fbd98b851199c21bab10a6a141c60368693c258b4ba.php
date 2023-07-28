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

/* /var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/resetPasswordForm/complete.htm */
class __TwigTemplate_f21774103a3c20f903ec71856bb2ea7ea8546b0c33a1ba72ce69c8b55762fa3d extends \Twig\Template
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
        echo "<div class=\"container pb-5\">
    <div class=\"contact-inner\">
        <div class=\"row justify-content-center\">
            <div class=\"col-lg-6 col-md-6\">
                <p class=\"lead\">
                    ";
        // line 6
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Senha alterada com sucesso, acesse o sistema utilizando-a."]);
        echo "
                </p>
            </div>
        </div>
        <div class=\"row justify-content-center mt-4\">
            <div class=\"col-md-12 col-12 text-center\">
                ";
        // line 12
        $context["api_token"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "session", [], "any", false, false, true, 12), "get", [0 => "api_token"], "method", false, false, true, 12);
        // line 13
        echo "                ";
        $context["email"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "session", [], "any", false, false, true, 13), "get", [0 => "user_email"], "method", false, false, true, 13);
        // line 14
        echo "                <a href=";
        echo twig_escape_filter($this->env, (call_user_func_array($this->env->getFunction('env')->getCallable(), ["URL_SISTEMA"]) . ((("/login/" . $this->sandbox->ensureToStringAllowed(($context["email"] ?? null), 14, $this->source)) . "/") . $this->sandbox->ensureToStringAllowed(($context["api_token"] ?? null), 14, $this->source))), "html", null, true);
        echo " target=\"_blank\" class=\"default-btn px-4\">
                    ";
        // line 15
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Clique aqui para acessar o sistema"]);
        echo "
                </a>
            </div>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/resetPasswordForm/complete.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  65 => 15,  60 => 14,  57 => 13,  55 => 12,  46 => 6,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/resetPasswordForm/complete.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 12);
        static $filters = array("_" => 6, "escape" => 14);
        static $functions = array("env" => 14);

        try {
            $this->sandbox->checkSecurity(
                ['set'],
                ['_', 'escape'],
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
