<?php

class AlxDevSettingsPlugin
{
    public $settings = []; // настраиваем снаружи

    public $menu_title = 'Дополнительные';
    public $menu_slug = 'evrfly-settings';
    public $menu_position = 1;

    public $page_title = 'Дополнительные настройки сайта';
    public $settings_page = 'evrfly-settings';
    public $settings_option_group = 'evrfly-settings';

    public $capability = 'manage_options';

    public function init()
    {
        add_action('admin_menu', [$this, 'registerMenu']);
        add_action('admin_init',  [$this, 'registerSettings']);
    }

    public function registerMenu()
    {
        add_options_page(
            $this->page_title,
            $this->menu_title,
            $this->capability,
            $this->menu_slug,
            [$this, 'renderSettingsPage'],
            $this->menu_position
        );
    }

    public function registerSettings()
    {
        foreach ($this->settings as $section_name => $section) {
            $section_code = sanitize_title($section_name);
            add_settings_section(
                id: $section_code,
                title: $section_name,
                callback: null,
                page: $this->settings_page,
                args: [] // TODO add registering sanitize callback here (see "wp settings api" docs)
            );

            foreach ($section as $code => $setting) {
                if (!is_array($setting)) {
                    $setting = ['display_name' => $setting];
                }
                register_setting(
                    option_name: $this->settings_option_group,
                    option_group: $code,
                    args: $setting['args'] ?? []
                );
                add_settings_field(
                    id: $code,
                    title: $setting['display_name'] ?? $code,
                    callback: [$this, 'renderInput'],
                    page: $this->settings_page,
                    section: $section_code,
                    args: [
                        'code' => $code,
                        'type' => ($setting['type'] ?? 'text')
                    ]
                );
            }
        }
    }

    public function renderSettingsPage()
    {
        if (empty($this->settings)) {
            echo 'Добавьте необходимые настройки в plugins/evrfly-setings/evrfly-settings.php';
            return;
        }

        include(dirname(__FILE__) . '/../template/settings-page.php');
    }

    public function renderInput($args)
    {
        $type = $code['type'] ?? 'text';
        
        $code = $args['code']; // для шаблона
        $value = get_option($code); // для шаблона
        
        include(dirname(__FILE__) . "/../template/input/{$type}.php");
    }
}
