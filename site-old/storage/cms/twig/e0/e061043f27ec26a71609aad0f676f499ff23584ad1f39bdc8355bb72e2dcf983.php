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

/* /var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/registerForm/default.htm */
class __TwigTemplate_7019827e378aa441d3c0fef7a854b5839457499fdd3d60ddc393a66aad74857b extends \Twig\Template
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
        echo "<!-- Start Login Area -->
<section class=\"register-area\">
<div class=\"container\">
    <div class=\"contact-inner\">
        <div class=\"row justify-content-center\">
            <div class=\"logo\">
                <a href=\"";
        // line 7
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("home");
        echo "\"><img src=\"";
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/logo-dealix-vertical.png");
        echo "\" alt=\"Dealix\"></a>
            </div>
        </div>
        <div id=\"verify_phone_number\">
            <div class=\"row justify-content-center pt-100\">
                <h6><span class=\"mr-3\">";
        // line 12
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Antes de prosseguirmos com o cadastro, precisamos verificar seu número. Vamos enviar um código para você."]);
        echo "</span></h6>
            </div>
            <div class=\"row justify-content-center\">
                <div class=\"col-md-5 col-sm-12\">
                    <label></label>
                    <input type=\"text\" name=\"phone_number\" id=\"phone_number\" class=\"form-control\" data-minlength=\"13\" data-error=\"";
        // line 17
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Número inválido"]);
        echo "\" data-mask=\"(00) 000000000\" required placeholder=\"";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Seu número de celular"]);
        echo "\">
                </div>
                <div class=\"col-md-2 mt-4 col-sm-12\">
                    <button type=\"button\" onclick=\"verifyPhone()\" class=\"btn btn-primary btn-sm\"><i class='bx bx-mail-send'></i> ";
        // line 20
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Enviar"]);
        echo "</button>
                </div>
                <div class=\"help-block with-errors\"></div>
            </div>
        </div>
        <div id=\"form_fields\" hidden>
            <div class=\"row justify-content-center ptb-100\">
                <div class=\"tab pricing-list-tab\">
                    <ul class=\"tabs\">
                        <li data-id-tab=\"person\" class=\"current\">
                            <a href=\"#\">
                                <i class=\"bx bx-group\"></i> ";
        // line 31
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Pessoa física"]);
        echo "
                            </a>
                        </li>
                        <li data-id-tab=\"company\">
                            <a href=\"#\">
                                <i class=\"bx bx-building \"></i>";
        // line 36
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Pessoa jurídica"]);
        echo "
                            </a>
                        </li>
                    </ul>
                    <div class=\"tab_content\">
                        <div class=\"row justify-content-center\">
                            <div class=\"col-10\">
                                ";
        // line 43
        if (($context["canRegister"] ?? null)) {
            // line 44
            echo "                                ";
            echo call_user_func_array($this->env->getFunction('form_ajax')->getCallable(), ["ajax", ($this->sandbox->ensureToStringAllowed(($context["__SELF__"] ?? null), 44, $this->source) . "::onRegister"), ["id" => "registerForm", "data-toggle" => "validator", "role" => "form"]]);
            echo "
                                    ";
            // line 45
            echo call_user_func_array($this->env->getFunction('form_token')->getCallable(), ["token"]);
            echo "
                                    <!-- Início conteúdo só para pessoa física -->
                                    <div class=\"tabs_item\" style=\"display: block;\">
                                    </div>
                                    <!-- Fim conteúdo só para pessoa física -->

                                    <!-- Início conteúdo só para pessoa jurídica -->
                                    <div class=\"tabs_item\">
                                        <h5>";
            // line 53
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Dados da empresa"]);
            echo "</h5>
                                        <hr>
                                        ";
            // line 55
            $context['__cms_partial_params'] = [];
            echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("@fields/company"            , $context['__cms_partial_params']            , true            );
            unset($context['__cms_partial_params']);
            // line 56
            echo "                                    </div>
                                    <!-- Fim conteúdo só para pessoa jurídica -->
                                        
                                    <!-- Início conteúdo para ambos -->
                                    <div class=\"pt-3\">
                                        <h5><span class=\"mr-3\">";
            // line 61
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Dados do usuário"]);
            echo "</span>
                                        <button onclick=\"copyCompanyData()\" type=\"button\" style=\"display: none;\" class=\"btn btn-primary btn-sm\" data-id-tab=\"company\"><i class=\"bx bx-building \"></i> ";
            // line 62
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Repetir dados da empresa"]);
            echo "</button>
                                        </h5>
                                        <hr>
                                    </div>
                                    ";
            // line 66
            $context['__cms_partial_params'] = [];
            echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("@fields/common"            , $context['__cms_partial_params']            , true            );
            unset($context['__cms_partial_params']);
            // line 67
            echo "                                    <!-- Fim conteúdo para ambos -->
                                    
                                    <div class=\"row pt-3\">
                                        <div class=\"col-lg-12 col-md-12 text-center\">
                                            <div class=\"form-group\">
                                                <button type=\"submit\" class=\"btn btn-primary default-btn\"><i class='bx bxs-paper-plane'></i>";
            // line 72
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Enviar"]);
            echo "<span></span></button>
                                                <div id=\"msgSubmit\" class=\"h3 text-center hidden\"></div>
                                            </div>
                                            <div class=\"clearfix\"></div>
                                        </div>
                                    </div>

                                    <div id=\"";
            // line 79
            echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["__SELF__"] ?? null), 79, $this->source), "html", null, true);
            echo "_forms_flash\"></div>
                                ";
            // line 80
            echo call_user_func_array($this->env->getFunction('form_close')->getCallable(), ["close"]);
            echo "
                                ";
        }
        // line 82
        echo "                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        
    </div>
</div>
</section>

";
        // line 94
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("registerForm/validate-phone"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 95
        echo "
";
        // line 96
        echo $this->env->getExtension('Cms\Twig\Extension')->startBlock('scripts'        );
        // line 97
        echo "<script type=\"text/javascript\">
    function verifyPhone () {
        let number = \$('#phone_number').cleanVal()

        if (number.length < 10) {
            alert('O número não é válido')
        }
        else {
            \$.ajax({
                method: \"POST\",
                url: \"/verifyPhone\",
                data: { phone_number: number }
            })
            .done(function(response){
                \$('#validatePhone').modal('toggle')
            })
            .fail(function(response){
                alert('Ocorreu um erro, confira o console ou contate o administrador')
                console.log(response)
            })
        }
    }

    function verifyCodePhone ()
    {
        let number = \$('#phone_number').cleanVal()
        let code = \$('#phone_code').val()

        \$.ajax({
            method: \"POST\",
            url: \"/verifyCodePhone\",
            data: { phone_number: number, token: code}
        })
        .done(function(response){
            \$('#verify_phone_number').hide()
            \$('#form_fields').show()

            \$('#a001_telefone').val(number)

            \$('#validatePhone').modal('toggle')
        })
        .fail(function(response){
            alert('Código inválido')
            console.log(response)
        })
    }
</script>
";
        // line 96
        echo $this->env->getExtension('Cms\Twig\Extension')->endBlock(true        );
        // line 145
        echo "
<!-- End Login Area -->";
    }

    public function getTemplateName()
    {
        return "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/registerForm/default.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  254 => 145,  252 => 96,  203 => 97,  201 => 96,  198 => 95,  194 => 94,  180 => 82,  175 => 80,  171 => 79,  161 => 72,  154 => 67,  150 => 66,  143 => 62,  139 => 61,  132 => 56,  128 => 55,  123 => 53,  112 => 45,  107 => 44,  105 => 43,  95 => 36,  87 => 31,  73 => 20,  65 => 17,  57 => 12,  47 => 7,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/registerForm/default.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 43, "partial" => 55, "put" => 96);
        static $filters = array("page" => 7, "theme" => 7, "_" => 12, "escape" => 79);
        static $functions = array("form_ajax" => 44, "form_token" => 45, "form_close" => 80);

        try {
            $this->sandbox->checkSecurity(
                ['if', 'partial', 'put'],
                ['page', 'theme', '_', 'escape'],
                ['form_ajax', 'form_token', 'form_close']
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
