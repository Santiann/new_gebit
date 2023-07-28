<?php namespace General\Painel {

    use System\Classes\PluginBase;

    class Plugin extends PluginBase
    {
        public function pluginDetails()
        {
            return [
                'name'        => 'Painel Customizado',
                'description' => 'Painel customizado e melhorado para administração de conteúdo',
                'author'      => 'Orbital',
                'icon'        => 'icon-files-o'
            ];
        }
    }
}
