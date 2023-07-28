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

/* /var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/common/footer.htm */
class __TwigTemplate_ebd12b67ae4bc0c708a3a7ad3699678e8a05ae1f2dee79c94b4a49e8e5c38e90 extends \Twig\Template
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
        $context['__placeholder_footer_default_contents'] = null;        echo $this->env->getExtension('Cms\Twig\Extension')->displayBlock('footer', $context['__placeholder_footer_default_contents']);
        unset($context['__placeholder_footer_default_contents']);        // line 2
        echo "
<!-- Start Footer Area -->
<footer class=\"footer-area\">
    <div class=\"divider\"></div>

    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-lg-4 col-md-6 col-sm-6\">
                <div class=\"single-footer-widget\">
                    <div class=\"logo\">
                        <a href=\"";
        // line 12
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("home");
        echo "\"><img src=\"";
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/logo-dealix-white.png");
        echo "\" alt=\"Dealix\"></a>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
            </div>

            <div class=\"col-lg-2 col-md-6 col-sm-6\">
                <div class=\"single-footer-widget\">
                    <h3>";
        // line 20
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Empresa"]);
        echo "</h3>

                    <ul class=\"services-list\">
                        <li><a href=\"";
        // line 23
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("about");
        echo "\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Sobre"]);
        echo "</a></li>
                        <li><a href=\"";
        // line 24
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("services");
        echo "\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Serviços"]);
        echo "</a></li>
                        <li><a href=\"";
        // line 25
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("features");
        echo "\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Características"]);
        echo "</a></li>
                        <li><a href=\"";
        // line 26
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("pricing");
        echo "\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Preços"]);
        echo "</a></li>
                    </ul>
                </div>
            </div>

            <div class=\"col-lg-2 col-md-6 col-sm-6\">
                <div class=\"single-footer-widget\">
                    <h3>";
        // line 33
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Suporte"]);
        echo "</h3>

                    <ul class=\"support-list\">
                        <li><a href=\"";
        // line 36
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("faq");
        echo "\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["FAQ's"]);
        echo "</a></li>
                        <li><a href=\"";
        // line 37
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("privacy-policy");
        echo "\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Política de Privacidade"]);
        echo "</a></li>
                        <li><a href=\"";
        // line 38
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("terms-of-use");
        echo "\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Termos de Uso"]);
        echo "</a></li>
                        <li><a href=\"";
        // line 39
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("contact");
        echo "\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Contato"]);
        echo "</a></li>
                    </ul>
                </div>
            </div>

            <div class=\"col-lg-4 col-md-6 col-sm-6\">
                <div class=\"single-footer-widget\">
                    <h3>";
        // line 46
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Contato"]);
        echo "</h3>

                    <ul class=\"footer-contact-info\">
                        <li>";
        // line 49
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Endereço"]);
        echo ": <a href=\"https://goo.gl/maps/8yJ91bagf9J8URX2A\" target=\"_blank\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Praça Zacarias, 58 cj.1202 - Curitiba, PR - 80020-080"]);
        echo "</a></li>
                        <li>";
        // line 50
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["E-mail"]);
        echo ": <a href=\"mailto:suporte@dealix.com.br\">suporte@dealix.com.br</a></li>
                        <li>";
        // line 51
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Telefone"]);
        echo ": (41) 98700-2332 | (41) 3014-6511</li>
                    </ul>
                    <ul class=\"social\">
                        <li><a href=\"#\" target=\"_blank\"><i class=\"bx bxl-facebook\"></i></a></li>
                        <li><a href=\"#\" target=\"_blank\"><i class=\"bx bxl-twitter\"></i></a></li>
                        <li><a href=\"#\" target=\"_blank\"><i class=\"bx bxl-linkedin\"></i></a></li>
                        <li><a href=\"#\" target=\"_blank\"><i class=\"bx bxl-instagram\"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class=\"copyright-area\">
            <p>Copyright @";
        // line 64
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y"), "html", null, true);
        echo " Dealix.</p>
        </div>
    </div>
</footer>
<!-- End Footer Area -->

<div class=\"go-top\"><i class='bx bx-chevron-up'></i></div>

<script src=\"";
        // line 72
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/js/jquery.min.js");
        echo "\"></script>
<script src=\"";
        // line 73
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/js/popper.min.js");
        echo "\"></script>
<script src=\"";
        // line 74
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/js/bootstrap.min.js");
        echo "\"></script>
<script src=\"";
        // line 75
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/js/odometer.min.js");
        echo "\"></script>

<script src=\"";
        // line 77
        echo $this->extensions['Cms\Twig\Extension']->themeFilter([0 => "assets/js/jquery.magnific-popup.min.js", 1 => "assets/js/jquery.appear.min.js", 2 => "assets/js/owl.carousel.min.js", 3 => "assets/js/jquery.meanmenu.js", 4 => "assets/js/wow.min.js", 5 => "assets/js/conversation.js", 6 => "assets/js/jquery.ajaxchimp.min.js", 7 => "assets/js/particles.min.js", 8 => "assets/js/coustom-particles.js", 9 => "assets/js/form-validator.min.js", 10 => "assets/js/jquery.mask.js", 11 => "assets/js/main.js"]);
        // line 90
        echo "\"></script>

<!-- JS Scripts -->
";
        // line 93
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
        // line 94
        echo "
";
        // line 95
        echo $this->env->getExtension('Cms\Twig\Extension')->assetsFunction('js');
        echo $this->env->getExtension('Cms\Twig\Extension')->displayBlock('scripts');
    }

    public function getTemplateName()
    {
        return "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/common/footer.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  219 => 95,  216 => 94,  205 => 93,  200 => 90,  198 => 77,  193 => 75,  189 => 74,  185 => 73,  181 => 72,  170 => 64,  154 => 51,  150 => 50,  144 => 49,  138 => 46,  126 => 39,  120 => 38,  114 => 37,  108 => 36,  102 => 33,  90 => 26,  84 => 25,  78 => 24,  72 => 23,  66 => 20,  53 => 12,  41 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/vhosts/dealix.com.br/httpdocs/themes/dealix/partials/common/footer.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("placeholder" => 1, "framework" => 93, "scripts" => 95);
        static $filters = array("page" => 12, "theme" => 12, "_" => 20, "escape" => 64, "date" => 64);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['placeholder', 'framework', 'scripts'],
                ['page', 'theme', '_', 'escape', 'date'],
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
