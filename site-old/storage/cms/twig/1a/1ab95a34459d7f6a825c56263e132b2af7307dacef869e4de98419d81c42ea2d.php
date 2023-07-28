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

/* /var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/resetPasswordForm/reset.htm */
class __TwigTemplate_c4ad425e9c476bf9284169c3a7d756727c5a354cad2072c536f475f8b6c734b2 extends \Twig\Template
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
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Defina uma senha para acessar o sistema"]);
        echo "
                </p>
                <form
                    data-request=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["__SELF__"] ?? null), 9, $this->source), "html", null, true);
        echo "::onResetPassword\"
                    data-request-update=\"'";
        // line 10
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["__SELF__"] ?? null), 10, $this->source), "html", null, true);
        echo "::complete': '#partialUserResetForm'\">
                    <input name=\"code\" type=\"hidden\" id=\"resetCode\" value=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "code", [], "any", false, false, true, 11), 11, $this->source), "html", null, true);
        echo "\">

                    <div class=\"form-group\">
                        <label for=\"resetPassword\">";
        // line 14
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Nova senha"]);
        echo "</label>
                        <input name=\"password\" type=\"password\" class=\"form-control\" id=\"resetPassword\" placeholder=\"";
        // line 15
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Insira uma nova senha"]);
        echo "\">
                        <br>
                        <p>
                            Sua nova senha deve ter:<br>
                            - Mais de 8 caracteres<br>
                            - Maiúsculas e minúsculas<br>
                            - Letras e números<br>
                            - Caracteres especiais, por exemplo: \$#!@<br>
                        </p>
                    </div>

                    <div class=\"row justify-content-center\">
                        <div class=\"col-lg-12 col-md-12 text-center\">
                            <button type=\"submit\" class=\"default-btn\"><i class='bx bxs-paper-plane'></i>";
        // line 28
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Alterar senha"]);
        echo "<span></span></button>
                            <div id=\"msgSubmit\" class=\"h3 text-center hidden\"></div>
                            <div class=\"clearfix\"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/resetPasswordForm/reset.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  86 => 28,  70 => 15,  66 => 14,  60 => 11,  56 => 10,  52 => 9,  46 => 6,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/resetPasswordForm/reset.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array("_" => 6, "escape" => 9);
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
