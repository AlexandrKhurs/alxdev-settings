<style>
    .evrfly-settings table tr th, 
    .evrfly-settings table tr td {
        padding: 5px 0px 5px 20px;
        white-space: nowrap;
    }
</style>
<div class="wrap evrfly-settings">
    <h1><?php echo get_admin_page_title() ?></h1>
    <form method="post" action="options.php">
        <?php
        settings_fields($this->settings_option_group); // settings built-in hidden fields
        do_settings_sections($this->settings_page); // render all sections and fields
        submit_button(); // adds built-in submit buttin
        ?>
    </form>
</div>