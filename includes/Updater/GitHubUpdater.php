<?php

namespace BuilderWidgets\Updater;

class GitHubUpdater
{
    private $file;
    private $plugin;
    private $basename;
    private $active;
    private $username;
    private $repository;

    public function __construct($file, $username, $repository)
    {
        $this->file = $file;
        $this->plugin = plugin_basename($file);
        $this->basename = plugin_basename($file);
        $this->active = is_plugin_active($this->basename);
        $this->username = $username;
        $this->repository = $repository;

        add_filter('pre_set_site_transient_update_plugins', [$this, 'check_for_updates']);
        add_filter('plugins_api', [$this, 'plugins_api'], 10, 3);
    }

    public function check_for_updates($transient)
    {
        if (empty($transient->checked)) {
            return $transient;
        }

        // Get the current version of the plugin
        $repo_info = $this->get_repo_info();

        if ($repo_info && version_compare($repo_info->tag_name, $transient->checked[$this->plugin], '>')) {
            $transient->response[$this->plugin] = (object) [
                'slug' => $this->basename,
                'plugin' => $this->plugin,
                'new_version' => $repo_info->tag_name,
                'url' => $repo_info->html_url,
                'package' => $repo_info->zipball_url,
            ];
        }

        return $transient;
    }

    public function plugins_api($false, $action, $response)
    {
        if (empty($response->slug) || $response->slug !== $this->basename) {
            return $false;
        }

        $repo_info = $this->get_repo_info();
        $response->last_updated = $repo_info->published_at;
        $response->slug = $this->basename;
        $response->plugin_name = $repo_info->name;
        $response->version = $repo_info->tag_name;
        $response->author = '<a href="https://github.com/' . esc_html($this->username) . '">' . esc_html($this->username) . '</a>';
        $response->homepage = $repo_info->html_url;
        $response->download_link = $repo_info->zipball_url;

        return $response;
    }

    private function get_repo_info()
    {
        $request = wp_remote_get("https://api.github.com/repos/{$this->username}/{$this->repository}/releases/latest");

        if (is_wp_error($request)) {
            return false;
        }

        return json_decode(wp_remote_retrieve_body($request));
    }
}
?>
