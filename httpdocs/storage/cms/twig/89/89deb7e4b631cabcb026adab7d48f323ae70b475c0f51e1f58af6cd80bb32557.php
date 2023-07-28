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

/* C:\xampp\htdocs\httpdocs\themes\dealix-novo\partials\site\footer.htm */
class __TwigTemplate_273c05443765c2702dd135717c88ffd82b6442f502b11bd022b0e32a1f95107e extends \Twig\Template
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
        if ((($context["nofooter"] ?? null) == false)) {
            // line 2
            echo "        <footer>
            ";
            // line 3
            $context['__cms_partial_params'] = [];
            echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("common/pre-footer"            , $context['__cms_partial_params']            , true            );
            unset($context['__cms_partial_params']);
            // line 4
            echo "            ";
            $context['__cms_partial_params'] = [];
            echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("common/footer"            , $context['__cms_partial_params']            , true            );
            unset($context['__cms_partial_params']);
            // line 5
            echo "            ";
            $context['__cms_partial_params'] = [];
            echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("common/copy"            , $context['__cms_partial_params']            , true            );
            unset($context['__cms_partial_params']);
            // line 6
            echo "        </footer>
       ";
        }
        // line 8
        echo "
        ";
        // line 9
        $_minify = System\Classes\CombineAssets::instance()->useMinify;
        if ($_minify) {
            echo '<script src="' . Request::getBasePath() . '/modules/system/assets/js/framework.combined-min.js"></script>'.PHP_EOL;
        }
        else {
            echo '<script src="' . Request::getBasePath() . '/modules/system/assets/js/framework.js"></script>'.PHP_EOL;
            echo '<script src="' . Request::getBasePath() . '/modules/system/assets/js/framework.extras.js"></script>'.PHP_EOL;
        }
        echo '<link rel="stylesheet" property="stylesheet" href="' . Request::getBasePath() .'/modules/system/assets/css/framework.extras'.($_minify ? '-min' : '').'.css">'.PHP_EOL;
        unset($_minify);
        // line 10
        echo "
        <script>
            document.getElementById(\"toggle-password\").addEventListener(\"click\", function () {
                    \$(this).toggleClass(\"fa-eye fa-eye-slash\");
                    var input = \$(\$(this).attr(\"toggle\"));
                    if (input.attr(\"type\") == \"password\") {
                        input.attr(\"type\", \"text\");
                    } else {
                        input.attr(\"type\", \"password\");
                    }
                });
            document.getElementById(\"toggle-password1\").addEventListener(\"click\", function () {
                \$(this).toggleClass(\"fa-eye fa-eye-slash\");
                var input = \$(\$(this).attr(\"toggle\"));
                if (input.attr(\"type\") == \"password\") {
                    input.attr(\"type\", \"text\");
                } else {
                    input.attr(\"type\", \"password\");
                }
            });
        </script>

        <!-- Scripts -->
        <script src=\"";
        // line 33
        echo $this->extensions['Cms\Twig\Extension']->themeFilter([0 => "assets/vendor/jquery/jquery.min.js", 1 => "assets/vendor/bootstrap/js/bootstrap.bundle.min.js", 2 => "assets/vendor/light-switch-bootstrap/js/switch.js", 3 => "assets/js/custom.min.js"]);
        // line 38
        echo "\"></script>
        <script src=\"";
        // line 39
        echo $this->extensions['Cms\Twig\Extension']->themeFilter([0 => "assets/js/form-validator.min.js", 1 => "assets/js/jquery.mask.js"]);
        // line 42
        echo "\"></script>
        ";
        // line 43
        echo $this->env->getExtension('Cms\Twig\Extension')->assetsFunction('js');
        echo $this->env->getExtension('Cms\Twig\Extension')->displayBlock('scripts');
        // line 44
        echo "
        <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js\" integrity=\"sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM\" crossorigin=\"anonymous\"></script>

        ";
        $_type = isset($context["type"]) ? $context["type"] : null;        $_message = isset($context["message"]) ? $context["message"] : null;        // line 47
        foreach (Flash::getMessages() as $type => $messages) {
            foreach ($messages as $message) {
                $context["type"] = $type;                $context["message"] = $message;                // line 48
                echo "            <p
                    data-control=\"flash-message\"
                    class=\"flash-message fade ";
                // line 50
                echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["type"] ?? null), 50, $this->source), "html", null, true);
                echo "\"
                    data-interval=\"5\">
                ";
                // line 52
                echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["message"] ?? null), 52, $this->source), "html", null, true);
                echo "
            </p>
        ";
            }
        }
        $context["type"] = $_type;        $context["message"] = $_message;        // line 55
        echo "    </body>
</html>";
    }

    public function getTemplateName()
    {
        return "C:\\xampp\\htdocs\\httpdocs\\themes\\dealix-novo\\partials\\site\\footer.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  138 => 55,  131 => 52,  126 => 50,  122 => 48,  119 => 47,  114 => 44,  111 => 43,  108 => 42,  106 => 39,  103 => 38,  101 => 33,  76 => 10,  65 => 9,  62 => 8,  58 => 6,  53 => 5,  48 => 4,  44 => 3,  41 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% if nofooter == false %}
        <footer>
            {% partial 'common/pre-footer' %}
            {% partial 'common/footer' %}
            {% partial 'common/copy' %}
        </footer>
       {% endif %}

        {% framework extras %}

        <script>
            document.getElementById(\"toggle-password\").addEventListener(\"click\", function () {
                    \$(this).toggleClass(\"fa-eye fa-eye-slash\");
                    var input = \$(\$(this).attr(\"toggle\"));
                    if (input.attr(\"type\") == \"password\") {
                        input.attr(\"type\", \"text\");
                    } else {
                        input.attr(\"type\", \"password\");
                    }
                });
            document.getElementById(\"toggle-password1\").addEventListener(\"click\", function () {
                \$(this).toggleClass(\"fa-eye fa-eye-slash\");
                var input = \$(\$(this).attr(\"toggle\"));
                if (input.attr(\"type\") == \"password\") {
                    input.attr(\"type\", \"text\");
                } else {
                    input.attr(\"type\", \"password\");
                }
            });
        </script>

        <!-- Scripts -->
        <script src=\"{{ [
            'assets/vendor/jquery/jquery.min.js',
            'assets/vendor/bootstrap/js/bootstrap.bundle.min.js',
            'assets/vendor/light-switch-bootstrap/js/switch.js',
            'assets/js/custom.min.js',
        ] | theme }}\"></script>
        <script src=\"{{ [
            'assets/js/form-validator.min.js',
            'assets/js/jquery.mask.js',
        ] | theme }}\"></script>
        {% scripts %}

        <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js\" integrity=\"sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM\" crossorigin=\"anonymous\"></script>

        {% flash %}
            <p
                    data-control=\"flash-message\"
                    class=\"flash-message fade {{ type }}\"
                    data-interval=\"5\">
                {{ message }}
            </p>
        {% endflash %}
    </body>
</html>", "C:\\xampp\\htdocs\\httpdocs\\themes\\dealix-novo\\partials\\site\\footer.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 1, "partial" => 3, "framework" => 9, "scripts" => 43, "flash" => 47);
        static $filters = array("theme" => 38, "escape" => 50);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if', 'partial', 'framework', 'scripts', 'flash'],
                ['theme', 'escape'],
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
