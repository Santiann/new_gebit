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

/* /var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/sections/features-area-2.htm */
class __TwigTemplate_0334a60da01402f5fd1f711fb40f076b51647a3cde3919f32897d788ba24d1c6 extends \Twig\Template
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
        echo "<!-- Start Features Area -->
<section class=\"features-area pt-100 pb-70 bg-f4f6fc\">
    <div class=\"container\">
        <div class=\"section-title\">
            <h2>";
        // line 5
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Características"]);
        echo "</h2>
        </div>
        <div class=\"row\">
            <div class=\"col-lg-4 col-md-6 col-sm-6\">
                <div class=\"single-features-box\">
                    <div class=\"icon\">
                        <i class='bx bx-conversation'></i>
                    </div>
                    <h3>";
        // line 13
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Simplificar Cadastros"]);
        echo "</h3>
                    <p>";
        // line 14
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["De maneira compartilhada a atualização dos contatos gerais como endereços, emails, celulares e tudo mais que for importante para comunicação entre cliente/fornecedor está sempre a mão de ambos os lados."]);
        echo "</p>
                </div>
            </div>

            <div class=\"col-lg-4 col-md-6 col-sm-6\">
                <div class=\"single-features-box\">
                    <div class=\"icon\">
                        <i class='bx bx-customize'></i>
                    </div>
                    <h3>";
        // line 23
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Informações na mão"]);
        echo "</h3>
                    <p>";
        // line 24
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Saiba de forma antecipada quando seus contratos vão expirar, quando precisam ser renovados, quando uma rescisão pode não ser um bom negócio. E muito mais."]);
        echo "</p>
                </div>
            </div>

            <div class=\"col-lg-4 col-md-6 col-sm-6\">
                <div class=\"single-features-box\">
                    <div class=\"icon\">
                        <i class='bx bx-slider-alt'></i>
                    </div>
                    <h3>";
        // line 33
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Quick Setup"]);
        echo "</h3>
                    <p>";
        // line 34
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Configuração inicial muito simples. Sem custos de implantação. Estrutura totalmente em nuvem."]);
        echo "</p>
                </div>
            </div>

            <div class=\"col-lg-4 col-md-6 col-sm-6\">
                <div class=\"single-features-box\">
                    <div class=\"icon\">
                        <i class='bx bx-reset'></i>
                    </div>
                    <h3>";
        // line 43
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Logs de ações"]);
        echo "</h3>
                    <p>";
        // line 44
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Registro de ações importantes executadas no sistema. Quem fez, o que fez e quando."]);
        echo "</p>
                </div>
            </div>

            <div class=\"col-lg-4 col-md-6 col-sm-6\">
                <div class=\"single-features-box\">
                    <div class=\"icon\">
                        <i class='bx bx-bell'></i>
                    </div>
                    <h3>";
        // line 53
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Notificações automáticas"]);
        echo "</h3>
                    <p>";
        // line 54
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Não perca mais seus prazos e evite desperdícios."]);
        echo "</p>
                </div>
            </div>

            <div class=\"col-lg-4 col-md-6 col-sm-6\">
                <div class=\"single-features-box\">
                    <div class=\"icon\">
                        <i class='bx bx-shape-circle'></i>
                    </div>
                    <h3>";
        // line 63
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Módulo auditor"]);
        echo "</h3>
                    <p>";
        // line 64
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Ative o modo auditor e tenha ainda mais controle sobre seu negócio."]);
        echo "</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Features Area -->";
    }

    public function getTemplateName()
    {
        return "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/sections/features-area-2.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  140 => 64,  136 => 63,  124 => 54,  120 => 53,  108 => 44,  104 => 43,  92 => 34,  88 => 33,  76 => 24,  72 => 23,  60 => 14,  56 => 13,  45 => 5,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/sections/features-area-2.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array("_" => 5);
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
