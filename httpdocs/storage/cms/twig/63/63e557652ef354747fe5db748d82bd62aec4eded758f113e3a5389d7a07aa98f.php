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

/* C:\xampp\htdocs\httpdocs\themes\dealix-novo\partials\register\fields.htm */
class __TwigTemplate_d85d254ba75063d3528b924c2f2b9f7961f314e2051d9debe559a3e35d47cadc extends \Twig\Template
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
        echo "<div id=\"form_fields\">
    <ul class=\"nav nav-tabs\" id=\"myTab\" role=\"tablist\">
        <li class=\"nav-item w-50 text-center\">
        <a class=\"nav-link active\" id=\"home-pf\" data-toggle=\"tab\" href=\"#pf\" role=\"tab\" aria-controls=\"pf\" aria-selected=\"true\">";
        // line 4
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Pessoa Física"]);
        echo "</a>
        </li>
        <li class=\"nav-item w-50 text-center\">
        <a class=\"nav-link\" id=\"profile-pj\" data-toggle=\"tab\" href=\"#pj\" role=\"tab\" aria-controls=\"pf\" aria-selected=\"false\">";
        // line 7
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Pessoa Jurídica"]);
        echo "</a>
        </li>
    </ul>
    <div class=\"tab-content mt-3\" id=\"myTabContent\">
        <div class=\"tab-pane fade show active\" id=\"pf\" role=\"tabpanel\" aria-labelledby=\"home-pf\">
            ";
        // line 12
        if (($context["canRegister"] ?? null)) {
            // line 13
            echo "            ";
            echo call_user_func_array($this->env->getFunction('form_ajax')->getCallable(), ["ajax", "onRegister", ["id" => "registerForm", "data-toggle" => "validator", "role" => "form"]]);
            echo "
                ";
            // line 14
            echo call_user_func_array($this->env->getFunction('form_token')->getCallable(), ["token"]);
            echo "
                <div class=\"form-group mt-3\">
                    <input type=\"text\" class=\"form-control\" name=\"name\" required=\"\">
                    <label class=\"form-control-placeholder\" for=\"nome\">";
            // line 17
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Nome"]);
            echo "</label>
                </div>
                <div class=\"form-group mt-3 bg-cinza2 rounded d-flex align-items-center justify-content-between p-3 px-4\">
                    <h4 class=\"h15 mb-0 ml-2\">";
            // line 20
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Não sou brasileiro"]);
            echo "</h4>
                    <div class=\"form-check form-switch\">
                        <input class=\"form-check-input\" type=\"checkbox\" id=\"flexSwitchCheckChecked\" checked>
                        <label class=\"form-check-label\" for=\"flexSwitchCheckChecked\"></label>
                    </div>
                </div>
                <div class=\"form-group mt-3\">
                    <input type=\"text\" class=\"form-control\" name=\"a001_cpf\" data-minlength=\"14\" data-maxlength=\"14\" data-mask=\"000.000.000-00\" data-mask-reverse=\"true\" required=\"\">
                    <label class=\"form-control-placeholder\" for=\"cpf\">";
            // line 28
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["CPF"]);
            echo "</label>
                </div>
                <div class=\"form-group mt-3\">
                    <input type=\"text\" class=\"form-control\" data-minlength=\"13\" data-mask=\"(00) 000000000\" required=\"\">
                    <label class=\"form-control-placeholder\" for=\"telefone\">";
            // line 32
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Telefone de contato"]);
            echo "</label>
                </div>
                <div class=\"form-group mt-3\">
                    <input type=\"text\" name=\"email\" class=\"form-control\" required=\"\">
                    <label class=\"form-control-placeholder\" for=\"email\">";
            // line 36
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["E-mail"]);
            echo "</label>
                </div>
                <div class=\"form-group\">
                    <input id=\"password-field\" name=\"password\" type=\"password\" class=\"form-control\" required=\"\">
                    <label class=\"form-control-placeholder\" for=\"password\">";
            // line 40
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Senha"]);
            echo "</label>
                    <span toggle=\"#password-field\" id=\"toggle-password\" class=\"fa fa-fw field-icon toggle-password fa-eye\"></span>
                </div>
                <div class=\"form-group\">
                    <button type=\"submit\" class=\"btn-cinza form-control btn btn-primary rounded submit px-3\">";
            // line 44
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Continuar"]);
            echo "</button>
                </div>
                <div class=\"form-group text-center\">
                    <div class=\"w-100 text-left d-none\">
                        <label class=\"checkbox-wrap checkbox-primary mb-0\">";
            // line 48
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Remember Me"]);
            echo "
                            <input type=\"checkbox\" checked=\"\">
                            <span class=\"checkmark\"></span>
                        </label>
                    </div>
                    <div class=\"w-100 text-center\">
                        <p class=\"h14\">";
            // line 54
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Ao clicar em me cadastrar eu aceito os "]);
            echo "<a href=\"#\" class=\"text-black\">";
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["termos de serviço"]);
            echo "</a> e a <a href=\"#\" class=\"text-black\">política de privacidade.</a></p>
                    </div>
                </div>
            ";
            // line 57
            echo call_user_func_array($this->env->getFunction('form_close')->getCallable(), ["close"]);
            echo "
            ";
        }
        // line 59
        echo "        </div>
        <div class=\"tab-pane fade\" id=\"pj\" role=\"tabpanel\" aria-labelledby=\"profile-pj\">
            ";
        // line 61
        if (($context["canRegister"] ?? null)) {
            // line 62
            echo "            ";
            echo call_user_func_array($this->env->getFunction('form_ajax')->getCallable(), ["ajax", "onRegister", ["id" => "registerForm", "data-toggle" => "validator", "role" => "form"]]);
            echo "
                ";
            // line 63
            echo call_user_func_array($this->env->getFunction('form_token')->getCallable(), ["token"]);
            echo "
                <div class=\"form-group mt-3\">
                    <input type=\"text\" class=\"form-control\" name=\"name\" required=\"\">
                    <label class=\"form-control-placeholder\" for=\"nome_empresa\">";
            // line 66
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Nome da Empresa"]);
            echo "</label>
                </div>
                <div class=\"form-group mt-3 bg-cinza2 rounded d-flex align-items-center justify-content-between p-3 px-4\">
                    <h4 class=\"h15 mb-0 ml-2\">";
            // line 69
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Registrado fora do Brasil"]);
            echo "</h4>
                    <div class=\"form-check form-switch\">
                        <input class=\"form-check-input\" type=\"checkbox\" id=\"flexSwitchCheckChecked\" checked>
                        <label class=\"form-check-label\" for=\"flexSwitchCheckChecked\"></label>
                    </div>
                </div>
                <div class=\"form-group mt-3\">
                    <input type=\"text\" class=\"form-control\" id=\"a005_cnpj\" name=\"a005_cnpj\" required=\"\">
                    <label class=\"form-control-placeholder\" for=\"a005_cnpj\">";
            // line 77
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["CNPJ"]);
            echo "</label>
                </div>
                <div class=\"form-group mt-3\">
                    <input type=\"text\" class=\"form-control\" name=\"a005_fone\" required=\"\">
                    <label class=\"form-control-placeholder\" for=\"telefone\">";
            // line 81
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Telefone de contato"]);
            echo "</label>
                </div>
                <div class=\"form-group mt-3\">
                    <input type=\"text\" class=\"form-control\" name=\"email\" required=\"\">
                    <label class=\"form-control-placeholder\" for=\"email\">";
            // line 85
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["E-mail"]);
            echo "</label>
                </div>
                <div class=\"form-group\">
                    <input id=\"password-field1\" type=\"password\" name=\"password\" class=\"form-control\" required=\"\">
                    <label class=\"form-control-placeholder\" for=\"password\">";
            // line 89
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Senha"]);
            echo "</label>
                    <span toggle=\"#password-field1\" id=\"toggle-password1\" class=\"fa fa-fw field-icon toggle-password fa-eye\"></span>
                </div>
                <div class=\"form-group\">
                    <button type=\"submit\" class=\"btn-cinza form-control btn btn-primary rounded submit px-3\">";
            // line 93
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Continuar"]);
            echo "</button>
                </div>
                <div class=\"form-group text-center\">
                    <div class=\"w-100 text-left d-none\">
                        <label class=\"checkbox-wrap checkbox-primary mb-0\">";
            // line 97
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Remember Me"]);
            echo "
                            <input type=\"checkbox\" checked=\"\">
                            <span class=\"checkmark\"></span>
                        </label>
                    </div>
                    <div class=\"w-100 text-center\">
                        <p class=\"h14\">";
            // line 103
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Ao clicar em me cadastrar eu aceito os"]);
            echo " <a href=\"#\" class=\"text-black\">";
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["termos de serviço"]);
            echo "</a> e a <a href=\"#\" class=\"text-black\">";
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["política de privacidade."]);
            echo "</a></p>
                    </div>
                </div>
            ";
            // line 106
            echo call_user_func_array($this->env->getFunction('form_close')->getCallable(), ["close"]);
            echo "
            ";
        }
        // line 108
        echo "        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "C:\\xampp\\htdocs\\httpdocs\\themes\\dealix-novo\\partials\\register\\fields.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  238 => 108,  233 => 106,  223 => 103,  214 => 97,  207 => 93,  200 => 89,  193 => 85,  186 => 81,  179 => 77,  168 => 69,  162 => 66,  156 => 63,  151 => 62,  149 => 61,  145 => 59,  140 => 57,  132 => 54,  123 => 48,  116 => 44,  109 => 40,  102 => 36,  95 => 32,  88 => 28,  77 => 20,  71 => 17,  65 => 14,  60 => 13,  58 => 12,  50 => 7,  44 => 4,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<div id=\"form_fields\">
    <ul class=\"nav nav-tabs\" id=\"myTab\" role=\"tablist\">
        <li class=\"nav-item w-50 text-center\">
        <a class=\"nav-link active\" id=\"home-pf\" data-toggle=\"tab\" href=\"#pf\" role=\"tab\" aria-controls=\"pf\" aria-selected=\"true\">{{ 'Pessoa Física' | _ }}</a>
        </li>
        <li class=\"nav-item w-50 text-center\">
        <a class=\"nav-link\" id=\"profile-pj\" data-toggle=\"tab\" href=\"#pj\" role=\"tab\" aria-controls=\"pf\" aria-selected=\"false\">{{ 'Pessoa Jurídica' | _ }}</a>
        </li>
    </ul>
    <div class=\"tab-content mt-3\" id=\"myTabContent\">
        <div class=\"tab-pane fade show active\" id=\"pf\" role=\"tabpanel\" aria-labelledby=\"home-pf\">
            {% if canRegister %}
            {{ form_ajax('onRegister', {id: 'registerForm', 'data-toggle': 'validator', 'role': 'form'}) }}
                {{ form_token() }}
                <div class=\"form-group mt-3\">
                    <input type=\"text\" class=\"form-control\" name=\"name\" required=\"\">
                    <label class=\"form-control-placeholder\" for=\"nome\">{{ 'Nome' | _ }}</label>
                </div>
                <div class=\"form-group mt-3 bg-cinza2 rounded d-flex align-items-center justify-content-between p-3 px-4\">
                    <h4 class=\"h15 mb-0 ml-2\">{{ 'Não sou brasileiro' | _ }}</h4>
                    <div class=\"form-check form-switch\">
                        <input class=\"form-check-input\" type=\"checkbox\" id=\"flexSwitchCheckChecked\" checked>
                        <label class=\"form-check-label\" for=\"flexSwitchCheckChecked\"></label>
                    </div>
                </div>
                <div class=\"form-group mt-3\">
                    <input type=\"text\" class=\"form-control\" name=\"a001_cpf\" data-minlength=\"14\" data-maxlength=\"14\" data-mask=\"000.000.000-00\" data-mask-reverse=\"true\" required=\"\">
                    <label class=\"form-control-placeholder\" for=\"cpf\">{{ 'CPF' | _ }}</label>
                </div>
                <div class=\"form-group mt-3\">
                    <input type=\"text\" class=\"form-control\" data-minlength=\"13\" data-mask=\"(00) 000000000\" required=\"\">
                    <label class=\"form-control-placeholder\" for=\"telefone\">{{ 'Telefone de contato' | _ }}</label>
                </div>
                <div class=\"form-group mt-3\">
                    <input type=\"text\" name=\"email\" class=\"form-control\" required=\"\">
                    <label class=\"form-control-placeholder\" for=\"email\">{{ 'E-mail' | _ }}</label>
                </div>
                <div class=\"form-group\">
                    <input id=\"password-field\" name=\"password\" type=\"password\" class=\"form-control\" required=\"\">
                    <label class=\"form-control-placeholder\" for=\"password\">{{ 'Senha' | _ }}</label>
                    <span toggle=\"#password-field\" id=\"toggle-password\" class=\"fa fa-fw field-icon toggle-password fa-eye\"></span>
                </div>
                <div class=\"form-group\">
                    <button type=\"submit\" class=\"btn-cinza form-control btn btn-primary rounded submit px-3\">{{ 'Continuar' | _ }}</button>
                </div>
                <div class=\"form-group text-center\">
                    <div class=\"w-100 text-left d-none\">
                        <label class=\"checkbox-wrap checkbox-primary mb-0\">{{ 'Remember Me' | _ }}
                            <input type=\"checkbox\" checked=\"\">
                            <span class=\"checkmark\"></span>
                        </label>
                    </div>
                    <div class=\"w-100 text-center\">
                        <p class=\"h14\">{{ 'Ao clicar em me cadastrar eu aceito os ' | _ }}<a href=\"#\" class=\"text-black\">{{ 'termos de serviço' | _ }}</a> e a <a href=\"#\" class=\"text-black\">política de privacidade.</a></p>
                    </div>
                </div>
            {{ form_close() }}
            {% endif %}
        </div>
        <div class=\"tab-pane fade\" id=\"pj\" role=\"tabpanel\" aria-labelledby=\"profile-pj\">
            {% if canRegister %}
            {{ form_ajax('onRegister', {id: 'registerForm', 'data-toggle': 'validator', 'role': 'form'}) }}
                {{ form_token() }}
                <div class=\"form-group mt-3\">
                    <input type=\"text\" class=\"form-control\" name=\"name\" required=\"\">
                    <label class=\"form-control-placeholder\" for=\"nome_empresa\">{{ 'Nome da Empresa' | _ }}</label>
                </div>
                <div class=\"form-group mt-3 bg-cinza2 rounded d-flex align-items-center justify-content-between p-3 px-4\">
                    <h4 class=\"h15 mb-0 ml-2\">{{ 'Registrado fora do Brasil' | _ }}</h4>
                    <div class=\"form-check form-switch\">
                        <input class=\"form-check-input\" type=\"checkbox\" id=\"flexSwitchCheckChecked\" checked>
                        <label class=\"form-check-label\" for=\"flexSwitchCheckChecked\"></label>
                    </div>
                </div>
                <div class=\"form-group mt-3\">
                    <input type=\"text\" class=\"form-control\" id=\"a005_cnpj\" name=\"a005_cnpj\" required=\"\">
                    <label class=\"form-control-placeholder\" for=\"a005_cnpj\">{{ 'CNPJ' | _ }}</label>
                </div>
                <div class=\"form-group mt-3\">
                    <input type=\"text\" class=\"form-control\" name=\"a005_fone\" required=\"\">
                    <label class=\"form-control-placeholder\" for=\"telefone\">{{ 'Telefone de contato' | _ }}</label>
                </div>
                <div class=\"form-group mt-3\">
                    <input type=\"text\" class=\"form-control\" name=\"email\" required=\"\">
                    <label class=\"form-control-placeholder\" for=\"email\">{{ 'E-mail' | _ }}</label>
                </div>
                <div class=\"form-group\">
                    <input id=\"password-field1\" type=\"password\" name=\"password\" class=\"form-control\" required=\"\">
                    <label class=\"form-control-placeholder\" for=\"password\">{{ 'Senha' | _ }}</label>
                    <span toggle=\"#password-field1\" id=\"toggle-password1\" class=\"fa fa-fw field-icon toggle-password fa-eye\"></span>
                </div>
                <div class=\"form-group\">
                    <button type=\"submit\" class=\"btn-cinza form-control btn btn-primary rounded submit px-3\">{{ 'Continuar' | _ }}</button>
                </div>
                <div class=\"form-group text-center\">
                    <div class=\"w-100 text-left d-none\">
                        <label class=\"checkbox-wrap checkbox-primary mb-0\">{{ 'Remember Me' | _ }}
                            <input type=\"checkbox\" checked=\"\">
                            <span class=\"checkmark\"></span>
                        </label>
                    </div>
                    <div class=\"w-100 text-center\">
                        <p class=\"h14\">{{ 'Ao clicar em me cadastrar eu aceito os' | _ }} <a href=\"#\" class=\"text-black\">{{ 'termos de serviço' | _ }}</a> e a <a href=\"#\" class=\"text-black\">{{ 'política de privacidade.' | _ }}</a></p>
                    </div>
                </div>
            {{ form_close() }}
            {% endif %}
        </div>
    </div>
</div>", "C:\\xampp\\htdocs\\httpdocs\\themes\\dealix-novo\\partials\\register\\fields.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 12);
        static $filters = array("_" => 4);
        static $functions = array("form_ajax" => 13, "form_token" => 14, "form_close" => 57);

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['_'],
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
