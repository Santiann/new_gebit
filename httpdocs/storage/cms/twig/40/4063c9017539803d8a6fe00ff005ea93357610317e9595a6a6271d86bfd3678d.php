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

/* C:\xampp\htdocs\httpdocs\themes\dealix-novo\partials\sections\featured-plataforma.htm */
class __TwigTemplate_123c78a099c7028d866c8bce9491646901b65b7a7977f76a05a57ebc0c250cec extends \Twig\Template
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
        echo "<div class=\"container-fluid plataforma\">
    <img class=\"after-plataforma\" src=\"";
        // line 2
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/after_plataforma.svg");
        echo "\" alt=\"Dealix\">
    <div class=\"row\">
        <div class=\"col-12 col-md-7\">
            <img class=\"img-p\" src=\"";
        // line 5
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/plataforma.png");
        echo "\" alt=\"Dealix - Muito mais que uma plataforma\">
        </div>
        <div class=\"col-12 col-md-5\">
            <h1 class=\"h47 fmedium\">";
        // line 8
        echo $this->sandbox->ensureToStringAllowed(($context["pTitle"] ?? null), 8, $this->source);
        echo "</span></h1>
            <div class=\"p-item d-flex align-items-start\">
                <div class=\"message\">
                    <img src=\"";
        // line 11
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/p-1.png");
        echo "\" alt=\"\">
                    <span></span>
                </div>
                <div class=\"ml-3 pt-2\">
                    <h3 class=\"h22 fsemi-bold\">";
        // line 15
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Rafael Santos"]);
        echo "</h3>
                    <p class=\"h18\">";
        // line 16
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Adicionou um contrato em colaboracão com você."]);
        echo "</p>
                </div>
            </div>
            <div class=\"p-item d-flex align-items-start\">
                <div class=\"message\">
                    <img src=\"";
        // line 21
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/p-2.png");
        echo "\" alt=\"\">
                    <span></span>
                </div>
                <div class=\"ml-3 pt-2\">
                    <h3 class=\"h22 fsemi-bold\">";
        // line 25
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Camila Lima"]);
        echo "</h3>
                    <p class=\"h18\">";
        // line 26
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Aceitou o contrato e adicionou uma notificacao."]);
        echo "</p>
                </div>
            </div>
            <div class=\"p-item d-flex align-items-start\">
                <div class=\"message\">
                    <div class=\"sucess bg-extra3\">
                        <img src=\"";
        // line 32
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/check.svg");
        echo "\" alt=\"";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Tudo certo!"]);
        echo "\">
                    </div>
                </div>
                <div class=\"ml-3 pt-2\">
                    <h3 class=\"h22 fsemi-bold\">";
        // line 36
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Tudo certo!"]);
        echo "</h3>
                    <p class=\"h18\">";
        // line 37
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Agora e so acompanhar pela plataforma."]);
        echo "</p>
                </div>
            </div>
            <img class=\"img-fluid mt-5\" src=\"";
        // line 40
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/repet.svg");
        echo "\" alt=\"Dealix -";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), [" Muito mais que uma plataforma"]);
        echo "\">
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "C:\\xampp\\htdocs\\httpdocs\\themes\\dealix-novo\\partials\\sections\\featured-plataforma.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  118 => 40,  112 => 37,  108 => 36,  99 => 32,  90 => 26,  86 => 25,  79 => 21,  71 => 16,  67 => 15,  60 => 11,  54 => 8,  48 => 5,  42 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<div class=\"container-fluid plataforma\">
    <img class=\"after-plataforma\" src=\"{{ 'assets/img/after_plataforma.svg'|theme }}\" alt=\"Dealix\">
    <div class=\"row\">
        <div class=\"col-12 col-md-7\">
            <img class=\"img-p\" src=\"{{ 'assets/img/plataforma.png'|theme }}\" alt=\"Dealix - Muito mais que uma plataforma\">
        </div>
        <div class=\"col-12 col-md-5\">
            <h1 class=\"h47 fmedium\">{{ pTitle | raw }}</span></h1>
            <div class=\"p-item d-flex align-items-start\">
                <div class=\"message\">
                    <img src=\"{{ 'assets/img/p-1.png'|theme }}\" alt=\"\">
                    <span></span>
                </div>
                <div class=\"ml-3 pt-2\">
                    <h3 class=\"h22 fsemi-bold\">{{ 'Rafael Santos' | _ }}</h3>
                    <p class=\"h18\">{{ 'Adicionou um contrato em colaboracão com você.' | _ }}</p>
                </div>
            </div>
            <div class=\"p-item d-flex align-items-start\">
                <div class=\"message\">
                    <img src=\"{{ 'assets/img/p-2.png'|theme }}\" alt=\"\">
                    <span></span>
                </div>
                <div class=\"ml-3 pt-2\">
                    <h3 class=\"h22 fsemi-bold\">{{ 'Camila Lima' | _ }}</h3>
                    <p class=\"h18\">{{ 'Aceitou o contrato e adicionou uma notificacao.' | _ }}</p>
                </div>
            </div>
            <div class=\"p-item d-flex align-items-start\">
                <div class=\"message\">
                    <div class=\"sucess bg-extra3\">
                        <img src=\"{{ 'assets/img/check.svg'|theme }}\" alt=\"{{ 'Tudo certo!' | _ }}\">
                    </div>
                </div>
                <div class=\"ml-3 pt-2\">
                    <h3 class=\"h22 fsemi-bold\">{{ 'Tudo certo!' | _ }}</h3>
                    <p class=\"h18\">{{ 'Agora e so acompanhar pela plataforma.' | _ }}</p>
                </div>
            </div>
            <img class=\"img-fluid mt-5\" src=\"{{ 'assets/img/repet.svg'|theme }}\" alt=\"Dealix -{{ ' Muito mais que uma plataforma' | _ }}\">
        </div>
    </div>
</div>", "C:\\xampp\\htdocs\\httpdocs\\themes\\dealix-novo\\partials\\sections\\featured-plataforma.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array("theme" => 2, "raw" => 8, "_" => 15);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                [],
                ['theme', 'raw', '_'],
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
