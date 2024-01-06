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

/* C:\xampp\htdocs\new_gebit\httpdocs\themes\dealix-novo\partials\common\navbar.htm */
class __TwigTemplate_9284a2f39e9301fb90c5333b300b49ead68862cb271a104e1940f491864662d4 extends \Twig\Template
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
        echo "<nav class=\"navbar navbar-expand-md navbar-light\">
    <div class=\"container px-md-0\">
      <a class=\"navbar-brand\" href=\"";
        // line 3
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("home");
        echo "\">
        <img class=\"img-fluid\" src=\"";
        // line 4
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/logo.svg");
        echo "\" alt=\"Dealix\">
      </a>
      <button class=\"navbar-toggler d-lg-none\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#collapsibleNavId\" aria-controls=\"collapsibleNavId\"
          aria-expanded=\"false\" aria-label=\"Toggle navigation\">
          <span class=\"navbar-toggler-icon\"></span>
      </button>
      <div class=\"collapse navbar-collapse justify-content-end\" id=\"collapsibleNavId\">
          <ul class=\"navbar-nav ml-auto mt-2 mt-lg-0 align-items-center\">
              <li class=\"nav-item active\">
                  <a class=\"nav-link text-uppercase\" href=\"";
        // line 13
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("home");
        echo "\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Ínicio"]);
        echo "</a>
              </li>
              <li class=\"nav-item\">
                  <a class=\"nav-link text-uppercase\" href=\"";
        // line 16
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("comeceja");
        echo "\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Como Funciona"]);
        echo "</a>
              </li>
              <li class=\"nav-item\">
                  <a class=\"nav-link text-uppercase\" href=\"";
        // line 19
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("funcionalidades");
        echo "\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Planos"]);
        echo "</a>
              </li>
              <li class=\"nav-item\">
                <a class=\"nav-link text-uppercase\" href=\"";
        // line 22
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("about");
        echo "\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Sobre"]);
        echo "</a>
              </li>
              <li class=\"nav-item\">
                  <a class=\"nav-link text-uppercase\" href=\"";
        // line 25
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("blog/list");
        echo "\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Blog"]);
        echo "</a>
              </li>
              <li class=\"nav-item\">
                ";
        // line 28
        $context['__cms_component_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->componentFunction("loginButton"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        // line 29
        echo "              </li>
              <li class=\"nav-item\">
                  ";
        // line 31
        if (($context["user"] ?? null)) {
            // line 32
            echo "                    ";
            $context["api_token"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "session", [], "any", false, false, true, 32), "get", [0 => "api_token"], "method", false, false, true, 32);
            // line 33
            echo "                    <a class=\"btn btn-primary text-uppercase\" href=";
            echo twig_escape_filter($this->env, (call_user_func_array($this->env->getFunction('env')->getCallable(), ["URL_SISTEMA"]) . ((("/login/" . $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "email", [], "any", false, false, true, 33), 33, $this->source)) . "/") . $this->sandbox->ensureToStringAllowed(($context["api_token"] ?? null), 33, $this->source))), "html", null, true);
            echo ">";
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Acessar sistema"]);
            echo "</a>
                  ";
        } else {
            // line 35
            echo "                      <a class=\"btn btn-primary text-uppercase\" href=\"";
            echo $this->extensions['Cms\Twig\Extension']->pageFilter("comeceja");
            echo "\">";
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Começar Grátis"]);
            echo "</a>
                  ";
        }
        // line 37
        echo "              </li>
              <li class=\"nav-item\">
                ";
        // line 39
        echo call_user_func_array($this->env->getFunction('form_open')->getCallable(), ["open"]);
        echo "
                  <select class=\"form-control pr-3 text-uppercase\" style=\"border: 0;\" name=\"locale\" data-request=\"onSwitchLocale\" id=\"language-menu\">
                    ";
        // line 41
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["locales"] ?? null));
        foreach ($context['_seq'] as $context["code"] => $context["name"]) {
            // line 42
            echo "                        <option value=\"";
            echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed($context["code"], 42, $this->source), "html", null, true);
            echo "\" ";
            echo ((($context["code"] == ($context["activeLocale"] ?? null))) ? ("selected") : (""));
            echo ">";
            echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed($context["name"], 42, $this->source), "html", null, true);
            echo "</option>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['code'], $context['name'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 44
        echo "                  </select>
                  ";
        // line 45
        echo call_user_func_array($this->env->getFunction('form_close')->getCallable(), ["close"]);
        echo "
              </li>
          </ul>
      </div>
    </div>
</nav>";
    }

    public function getTemplateName()
    {
        return "C:\\xampp\\htdocs\\new_gebit\\httpdocs\\themes\\dealix-novo\\partials\\common\\navbar.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  157 => 45,  154 => 44,  141 => 42,  137 => 41,  132 => 39,  128 => 37,  120 => 35,  112 => 33,  109 => 32,  107 => 31,  103 => 29,  99 => 28,  91 => 25,  83 => 22,  75 => 19,  67 => 16,  59 => 13,  47 => 4,  43 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<nav class=\"navbar navbar-expand-md navbar-light\">
    <div class=\"container px-md-0\">
      <a class=\"navbar-brand\" href=\"{{ 'home'| page }}\">
        <img class=\"img-fluid\" src=\"{{ 'assets/img/logo.svg'|theme }}\" alt=\"Dealix\">
      </a>
      <button class=\"navbar-toggler d-lg-none\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#collapsibleNavId\" aria-controls=\"collapsibleNavId\"
          aria-expanded=\"false\" aria-label=\"Toggle navigation\">
          <span class=\"navbar-toggler-icon\"></span>
      </button>
      <div class=\"collapse navbar-collapse justify-content-end\" id=\"collapsibleNavId\">
          <ul class=\"navbar-nav ml-auto mt-2 mt-lg-0 align-items-center\">
              <li class=\"nav-item active\">
                  <a class=\"nav-link text-uppercase\" href=\"{{ 'home'| page }}\">{{ 'Ínicio' | _ }}</a>
              </li>
              <li class=\"nav-item\">
                  <a class=\"nav-link text-uppercase\" href=\"{{ 'comeceja'| page }}\">{{ 'Como Funciona' | _ }}</a>
              </li>
              <li class=\"nav-item\">
                  <a class=\"nav-link text-uppercase\" href=\"{{ 'funcionalidades'| page }}\">{{ 'Planos' | _ }}</a>
              </li>
              <li class=\"nav-item\">
                <a class=\"nav-link text-uppercase\" href=\"{{ 'about'| page }}\">{{ 'Sobre' | _ }}</a>
              </li>
              <li class=\"nav-item\">
                  <a class=\"nav-link text-uppercase\" href=\"{{ 'blog/list'| page }}\">{{ 'Blog' | _ }}</a>
              </li>
              <li class=\"nav-item\">
                {% component 'loginButton' %}
              </li>
              <li class=\"nav-item\">
                  {% if user %}
                    {% set api_token = this.session.get('api_token') %}
                    <a class=\"btn btn-primary text-uppercase\" href={{ env('URL_SISTEMA') ~ \"/login/#{user.email}/#{api_token}\" }}>{{ 'Acessar sistema' | _ }}</a>
                  {% else %}
                      <a class=\"btn btn-primary text-uppercase\" href=\"{{ 'comeceja'| page }}\">{{ 'Começar Grátis' | _ }}</a>
                  {% endif %}
              </li>
              <li class=\"nav-item\">
                {{ form_open() }}
                  <select class=\"form-control pr-3 text-uppercase\" style=\"border: 0;\" name=\"locale\" data-request=\"onSwitchLocale\" id=\"language-menu\">
                    {% for code, name in locales %}
                        <option value=\"{{ code }}\" {{ code == activeLocale ? 'selected' }}>{{ name }}</option>
                    {% endfor %}
                  </select>
                  {{ form_close() }}
              </li>
          </ul>
      </div>
    </div>
</nav>", "C:\\xampp\\htdocs\\new_gebit\\httpdocs\\themes\\dealix-novo\\partials\\common\\navbar.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("component" => 28, "if" => 31, "set" => 32, "for" => 41);
        static $filters = array("page" => 3, "theme" => 4, "_" => 13, "escape" => 33);
        static $functions = array("env" => 33, "form_open" => 39, "form_close" => 45);

        try {
            $this->sandbox->checkSecurity(
                ['component', 'if', 'set', 'for'],
                ['page', 'theme', '_', 'escape'],
                ['env', 'form_open', 'form_close']
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
