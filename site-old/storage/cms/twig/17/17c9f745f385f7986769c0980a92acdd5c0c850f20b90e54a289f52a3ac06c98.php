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

/* /var/www/vhosts/dealix.com.br/httpdocs/plugins/dealix/register/components/localization/default.htm */
class __TwigTemplate_b178ce654d26c8a35fce36410ff4492fe6c7cd41a4a259320343e62bdaf48c0a extends \Twig\Template
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
        echo "<div class=\"row\">
    <div class=\"col-md-3 col-12\">
        <div class=\"form-group\">
            <input onfocusout=\"findAddressByCep_";
        // line 4
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["prefix"] ?? null), 4, $this->source), "html", null, true);
        echo "(this)\" type=\"text\" name=\"";
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["prefix"] ?? null), 4, $this->source), "html", null, true);
        echo "_cep\" data-mask=\"00000-000\" id=\"";
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["prefix"] ?? null), 4, $this->source), "html", null, true);
        echo "_cep\" pattern=\"\\d{5}-?\\d{3}\" class=\"form-control\" required data-error=\"";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["CEP inválido"]);
        echo "\" placeholder=\"";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["CEP"]);
        echo "\">
            <div class=\"help-block with-errors\"></div>
        </div>
    </div>
    <div class=\"col-md-6 col-12\">
        <div class=\"form-group\">
            <input type=\"text\" name=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["prefix"] ?? null), 10, $this->source), "html", null, true);
        echo "_endereco\" id=\"";
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["prefix"] ?? null), 10, $this->source), "html", null, true);
        echo "_endereco\" class=\"form-control\" required placeholder=\"";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Endereço"]);
        echo "\">
            <div class=\"help-block with-errors\"></div>
        </div>
    </div>
    <div class=\"col-md-3 col-12\">
        <div class=\"form-group\">
            <input type=\"text\" name=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["prefix"] ?? null), 16, $this->source), "html", null, true);
        echo "_numero_end\" id=\"";
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["prefix"] ?? null), 16, $this->source), "html", null, true);
        echo "_numero_end\" class=\"form-control\" required placeholder=\"";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Número"]);
        echo "\">
            <div class=\"help-block with-errors\"></div>
        </div>
    </div>
</div>
<div class=\"row\">
    <div class=\"col-md-4 col-12\">
        <div class=\"form-group\">
            <input type=\"text\" name=\"";
        // line 24
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["prefix"] ?? null), 24, $this->source), "html", null, true);
        echo "_complemento_end\" id=\"";
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["prefix"] ?? null), 24, $this->source), "html", null, true);
        echo "_complemento_end\" class=\"form-control\" placeholder=\"";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Complemento"]);
        echo "\">
            <div class=\"help-block with-errors\"></div>
        </div>
    </div>
    <div class=\"col-md-8 col-12\">
        <div class=\"form-group\">
            <input type=\"text\" name=\"";
        // line 30
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["prefix"] ?? null), 30, $this->source), "html", null, true);
        echo "_bairro\" id=\"";
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["prefix"] ?? null), 30, $this->source), "html", null, true);
        echo "_bairro\" class=\"form-control\" required placeholder=\"";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Bairro"]);
        echo "\">
            <div class=\"help-block with-errors\"></div>
        </div>
    </div>
</div>
<div class=\"row\">
    <div class=\"col-md-4 col-12\">
        <div class=\"form-group\">
            <select name=\"";
        // line 38
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["prefix"] ?? null), 38, $this->source), "html", null, true);
        echo "_pais\" id=\"";
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["prefix"] ?? null), 38, $this->source), "html", null, true);
        echo "_pais\" required class=\"custom-select form-control\">
                ";
        // line 39
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["countries"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["country"]) {
            // line 40
            echo "                <option val=\"";
            echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["country"], "a049_id_pais", [], "any", false, false, true, 40), 40, $this->source), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["country"], "a049_nome_pais", [], "any", false, false, true, 40), 40, $this->source), "html", null, true);
            echo "</option>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['country'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 42
        echo "            </select>
            <div class=\"help-block with-errors\"></div>
        </div>
    </div>
    <div class=\"col-md-4 col-12\">
        <div class=\"form-group\">
            <select name=\"";
        // line 48
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["prefix"] ?? null), 48, $this->source), "html", null, true);
        echo "_id_estado\"
                data-request=\"onSelectState\"
                data-request-data=\"prefix: '";
        // line 50
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["prefix"] ?? null), 50, $this->source), "html", null, true);
        echo "' \"
                data-request-update=\"registerForm/fields/cities : '#";
        // line 51
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["prefix"] ?? null), 51, $this->source), "html", null, true);
        echo "_city' \"
                required class=\"custom-select form-control\"
            >
                ";
        // line 54
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["states"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["state"]) {
            // line 55
            echo "                <option value=\"";
            echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["state"], "a048_id_estado", [], "any", false, false, true, 55), 55, $this->source), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["state"], "a048_uf", [], "any", false, false, true, 55), 55, $this->source), "html", null, true);
            echo "</option>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['state'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 57
        echo "            </select>
            <div class=\"help-block with-errors\"></div>
        </div>
    </div>
    <div class=\"col-md-4 col-12\">
        <div class=\"form-group\">
            ";
        // line 63
        $context['__cms_partial_params'] = [];
        $context['__cms_partial_params']['prefix'] = ($context["prefix"] ?? null)        ;
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("registerForm/fields/cities"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 64
        echo "            <div class=\"help-block with-errors\"></div>
        </div>
    </div>
</div>

";
        // line 69
        echo $this->env->getExtension('Cms\Twig\Extension')->startBlock('scripts'        );
        // line 70
        echo "<script>
    function findAddressByCep_";
        // line 71
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["prefix"] ?? null), 71, $this->source), "html", null, true);
        echo "(input)
    {
        let cep = \$(input).val()
        let prefix = \"";
        // line 74
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["prefix"] ?? null), 74, $this->source), "html", null, true);
        echo "\"

        \$.ajax({
            type: \"POST\",
            url: \"/findAddressByCep\",
            data: {'cep': cep},
            success : function(result){
                let data = JSON.parse(result)

                \$(`#\${prefix}_endereco`).val( data.street )
                \$(`#\${prefix}_bairro`).val( data.neighborhood )
                \$(`#\${prefix}_id_estado`).val( data.state )
            }
        });
    }
</script>
";
        // line 69
        echo $this->env->getExtension('Cms\Twig\Extension')->endBlock(true        );
    }

    public function getTemplateName()
    {
        return "/var/www/vhosts/dealix.com.br/httpdocs/plugins/dealix/register/components/localization/default.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  226 => 69,  207 => 74,  201 => 71,  198 => 70,  196 => 69,  189 => 64,  184 => 63,  176 => 57,  165 => 55,  161 => 54,  155 => 51,  151 => 50,  146 => 48,  138 => 42,  127 => 40,  123 => 39,  117 => 38,  102 => 30,  89 => 24,  74 => 16,  61 => 10,  44 => 4,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/vhosts/dealix.com.br/httpdocs/plugins/dealix/register/components/localization/default.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("for" => 39, "partial" => 63, "put" => 69);
        static $filters = array("escape" => 4, "_" => 4);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['for', 'partial', 'put'],
                ['escape', '_'],
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
