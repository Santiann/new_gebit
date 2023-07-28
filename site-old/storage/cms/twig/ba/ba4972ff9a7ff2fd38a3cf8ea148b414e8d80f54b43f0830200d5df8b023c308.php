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

/* /var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/pages/register.htm */
class __TwigTemplate_a62c2870c0c9ea35a24dd3fec8d76e16908ff714e15ef1208d9da6b40531a040 extends \Twig\Template
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
        $context['__cms_partial_params'] = [];
        $context['__cms_partial_params']['menuClass'] = "navbar-style-two"        ;
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("common/header"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 2
        echo "
<!-- Start Page Title Area -->
<div class=\"container page-title-area\">
    <div class=\"container\">
        <div class=\"page-title-content\">
            <h2>";
        // line 7
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Cadastro"]);
        echo "</h2>
            <!-- <p>The Strax Story</p> -->
        </div>
    </div>
</div>
<!-- End Page Title Area -->

<!-- Start Checkout Steps Area -->
<div class=\"checkout-steps-area\">
    <div class=\"container\">
        <div class=\"row justify-content-center text-center\">
            <div class=\"col-12 col-md-12\">
                <a href=\"";
        // line 19
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("login", ["plan_id" => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "param", [], "any", false, false, true, 19), "plan_id", [], "any", false, false, true, 19)]);
        echo "\">
                    <small>";
        // line 20
        echo "Já possui uma conta? Clique aqui para fazer login";
        echo "</small>
                </a>
            </div>
        </div>
        <div class=\"row justify-content-center mt-5\">
            <div class=\"col-6\">
                <div class=\"row justify-content-end step-one\">
                    <i class='bx bxs-right-arrow-circle'></i> ";
        // line 27
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Cadastro"]);
        echo "
                </div>
            </div>
            <div class=\"col-6 text-start\">
                <div class=\"row justify-content-start step-two\">
                    <i class='bx bx-loader-circle'></i> ";
        // line 32
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Checkout"]);
        echo "
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Checkout Steps Area -->


";
        // line 41
        $context['__cms_component_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->componentFunction("registerForm"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        // line 42
        echo "
";
        // line 43
        $context['__cms_component_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->componentFunction("newsletterForm"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        // line 44
        echo "
";
        // line 45
        echo $this->env->getExtension('Cms\Twig\Extension')->startBlock('scripts'        );
        // line 46
        echo "    <script>
        function copyCompanyData()
        {
            \$('#email').val( \$('#company_email').val() )
            \$('#a001_cep').val( \$('#a005_cep').val() )
            \$('#a001_endereco').val( \$('#a005_endereco').val() )
            \$('#a001_numero_end').val( \$('#a005_numero_end').val() )
            \$('#a001_bairro').val( \$('#a005_bairro').val() )
            \$('#a001_complemento_end').val( \$('#a005_complemento_end').val() )
        }
    </script>
";
        // line 45
        echo $this->env->getExtension('Cms\Twig\Extension')->endBlock(true        );
    }

    public function getTemplateName()
    {
        return "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/pages/register.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  129 => 45,  116 => 46,  114 => 45,  111 => 44,  107 => 43,  104 => 42,  100 => 41,  88 => 32,  80 => 27,  70 => 20,  66 => 19,  51 => 7,  44 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/pages/register.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("partial" => 1, "component" => 41, "put" => 45);
        static $filters = array("_" => 7, "page" => 19);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['partial', 'component', 'put'],
                ['_', 'page'],
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
