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

/* /var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/loginForm/default.htm */
class __TwigTemplate_3521ac4b56b428a97f41366800dee5d18f488850694818ccf535a1fadfd56a04 extends \Twig\Template
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
        if (( !($context["user"] ?? null) &&  !get("reset"))) {
            // line 2
            echo "
<!-- Start Login Area -->
<section class=\"login-area\">
    <div class=\"row m-0\">
        <div class=\"col-lg-6 col-md-12 p-0\">
            <div class=\"login-image\">
                <img src=\"";
            // line 8
            echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/login-bg.jpg");
            echo "\" alt=\"image\">
            </div>
        </div>

        <div class=\"col-lg-6 col-md-12 p-0\">
            <div class=\"login-content\">
                <div class=\"d-table\">
                    <div class=\"d-table-cell\">
                        <div class=\"login-form\">
                            <div class=\"logo\">
                                <a href=\"";
            // line 18
            echo $this->extensions['Cms\Twig\Extension']->pageFilter("home");
            echo "\"><img src=\"";
            echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/logo-dealix-vertical.png");
            echo "\" alt=\"Dealix\"></a>
                            </div>

                            ";
            // line 21
            $context["plan_id"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "param", [], "any", false, false, true, 21), "plan_id", [], "any", false, false, true, 21);
            // line 22
            echo "                            <p>";
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Novo na Dealix?"]);
            echo " 
                                ";
            // line 23
            if (($context["plan_id"] ?? null)) {
                // line 24
                echo "                                    <a href=\"";
                echo $this->extensions['Cms\Twig\Extension']->pageFilter("register", ["plan_id" => ($context["plan_id"] ?? null)]);
                echo "\">
                                ";
            } else {
                // line 26
                echo "                                    <a href=\"";
                echo $this->extensions['Cms\Twig\Extension']->pageFilter("register");
                echo "\">
                                ";
            }
            // line 28
            echo "                                        ";
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Assine"]);
            echo "
                                    </a></p>

                            ";
            // line 31
            echo call_user_func_array($this->env->getFunction('form_ajax')->getCallable(), ["ajax", "onSignin"]);
            echo "

                                <div class=\"form-group\">
                                    <input id=\"userSigninLogin\" type=\"email\" name=\"login\" placeholder=\"Your email address\" class=\"form-control\">
                                </div>

                                <div class=\"form-group\">
                                    <input name=\"password\" type=\"password\" placeholder=\"Your password\" class=\"form-control\">
                                </div>

                                <button type=\"submit\" class=\"default-btn\"><i class=\"bx bxs-hot\"></i>Login<span></span></button>

                                ";
            // line 43
            if ((($context["rememberLoginMode"] ?? null) == "ask")) {
                // line 44
                echo "                                <div class=\"form-group\">
                                    <div class=\"checkbox\">
                                    <label><input name=\"remember\" type=\"checkbox\" value=\"0\">Stay logged in</label>
                                    </div>
                                </div>
                                ";
            }
            // line 50
            echo "
                                <div class=\"forgot-password\">
                                    <a href=\"";
            // line 52
            echo $this->extensions['Cms\Twig\Extension']->pageFilter("restore_password");
            echo "\">";
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Esqueceu sua senha?"]);
            echo "</a>
                                </div>

";
            // line 59
            echo "                            ";
            echo call_user_func_array($this->env->getFunction('form_close')->getCallable(), ["close"]);
            echo "
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Login Area -->
";
        } elseif (get("reset")) {
            // line 69
            echo "
    ";
            // line 70
            $context['__cms_component_params'] = [];
            echo $this->env->getExtension('Cms\Twig\Extension')->componentFunction("resetPasswordForm"            , $context['__cms_component_params']            );
            unset($context['__cms_component_params']);
            // line 71
            echo "
";
        }
    }

    public function getTemplateName()
    {
        return "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/loginForm/default.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  156 => 71,  152 => 70,  149 => 69,  135 => 59,  127 => 52,  123 => 50,  115 => 44,  113 => 43,  98 => 31,  91 => 28,  85 => 26,  79 => 24,  77 => 23,  72 => 22,  70 => 21,  62 => 18,  49 => 8,  41 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/loginForm/default.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 1, "set" => 21, "component" => 70);
        static $filters = array("theme" => 8, "page" => 18, "_" => 22);
        static $functions = array("get" => 1, "form_ajax" => 31, "form_close" => 59);

        try {
            $this->sandbox->checkSecurity(
                ['if', 'set', 'component'],
                ['theme', 'page', '_'],
                ['get', 'form_ajax', 'form_close']
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
