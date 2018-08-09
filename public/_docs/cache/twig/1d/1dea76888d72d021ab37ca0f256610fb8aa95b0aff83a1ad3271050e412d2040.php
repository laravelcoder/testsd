<?php

/* opensearch.twig */
class __TwigTemplate_d829ac402d7b1efa922d8340c406b6ec774cd23c7b57f813af98bfe1badb8e34 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        if (twig_get_attribute($this->env, $this->source, (isset($context['project']) || array_key_exists('project', $context) ? $context['project'] : (function () {
            throw new Twig_Error_Runtime('Variable "project" does not exist.', 1, $this->source);
        })()), 'config', [0 => 'base_url'], 'method')) {
            // line 2
            echo '<?xml version="1.0" encoding="UTF-8"?>
    <OpenSearchDescription xmlns="http://a9.com/-/spec/opensearch/1.1/" xmlns:referrer="http://a9.com/-/opensearch/extensions/referrer/">
        <ShortName>';
            // line 4
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context['project']) || array_key_exists('project', $context) ? $context['project'] : (function () {
                throw new Twig_Error_Runtime('Variable "project" does not exist.', 4, $this->source);
            })()), 'config', [0 => 'title'], 'method'), 'html', null, true);
            echo ' (';
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context['project']) || array_key_exists('project', $context) ? $context['project'] : (function () {
                throw new Twig_Error_Runtime('Variable "project" does not exist.', 4, $this->source);
            })()), 'version', []), 'html', null, true);
            echo ')</ShortName>
        <Description>Searches ';
            // line 5
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context['project']) || array_key_exists('project', $context) ? $context['project'] : (function () {
                throw new Twig_Error_Runtime('Variable "project" does not exist.', 5, $this->source);
            })()), 'config', [0 => 'title'], 'method'), 'html', null, true);
            echo ' (';
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context['project']) || array_key_exists('project', $context) ? $context['project'] : (function () {
                throw new Twig_Error_Runtime('Variable "project" does not exist.', 5, $this->source);
            })()), 'version', []), 'html', null, true);
            echo ')</Description>
        <Tags>';
            // line 6
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context['project']) || array_key_exists('project', $context) ? $context['project'] : (function () {
                throw new Twig_Error_Runtime('Variable "project" does not exist.', 6, $this->source);
            })()), 'config', [0 => 'title'], 'method'), 'html', null, true);
            echo '</Tags>
        ';
            // line 7
            if (twig_get_attribute($this->env, $this->source, (isset($context['project']) || array_key_exists('project', $context) ? $context['project'] : (function () {
                throw new Twig_Error_Runtime('Variable "project" does not exist.', 7, $this->source);
            })()), 'config', [0 => 'favicon'], 'method')) {
                // line 8
                echo '<Image height="16" width="16" type="image/x-icon">';
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context['project']) || array_key_exists('project', $context) ? $context['project'] : (function () {
                    throw new Twig_Error_Runtime('Variable "project" does not exist.', 8, $this->source);
                })()), 'config', [0 => 'favicon'], 'method'), 'html', null, true);
                echo '</Image>
        ';
            }
            // line 10
            echo '        <Url type="text/html" method="GET" template="';
            echo twig_escape_filter($this->env, (twig_replace_filter(twig_get_attribute($this->env, $this->source, (isset($context['project']) || array_key_exists('project', $context) ? $context['project'] : (function () {
                throw new Twig_Error_Runtime('Variable "project" does not exist.', 10, $this->source);
            })()), 'config', [0 => 'base_url'], 'method'), ['%version%' => twig_get_attribute($this->env, $this->source, (isset($context['project']) || array_key_exists('project', $context) ? $context['project'] : (function () {
                throw new Twig_Error_Runtime('Variable "project" does not exist.', 10, $this->source);
            })()), 'version', [])]).'/index.html?q={searchTerms}&src={referrer:source?}'), 'html', null, true);
            echo '"/>
        <InputEncoding>UTF-8</InputEncoding>
        <AdultContent>false</AdultContent>
    </OpenSearchDescription>
';
        }
    }

    public function getTemplateName()
    {
        return 'opensearch.twig';
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return [53 => 10,  47 => 8,  45 => 7,  41 => 6,  35 => 5,  29 => 4,  25 => 2,  23 => 1];
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% if project.config('base_url') -%}
    <?xml version=\"1.0\" encoding=\"UTF-8\"?>
    <OpenSearchDescription xmlns=\"http://a9.com/-/spec/opensearch/1.1/\" xmlns:referrer=\"http://a9.com/-/opensearch/extensions/referrer/\">
        <ShortName>{{ project.config('title') }} ({{ project.version }})</ShortName>
        <Description>Searches {{ project.config('title') }} ({{ project.version }})</Description>
        <Tags>{{ project.config('title') }}</Tags>
        {% if project.config('favicon') -%}
            <Image height=\"16\" width=\"16\" type=\"image/x-icon\">{{ project.config('favicon') }}</Image>
        {% endif %}
        <Url type=\"text/html\" method=\"GET\" template=\"{{ project.config('base_url')|replace({'%version%': project.version}) ~ '/index.html?q={searchTerms}&src={referrer:source?}' }}\"/>
        <InputEncoding>UTF-8</InputEncoding>
        <AdultContent>false</AdultContent>
    </OpenSearchDescription>
{% endif %}
", 'opensearch.twig', 'phar://C:/Users/phillip.madsen/sami.phar/Sami/Resources/themes\\default/opensearch.twig');
    }
}
