<?php

/*
  Copyright (C) <2011>  Vasyl Martyniuk <martyniuk.vasyl@gmail.com>

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program.  If not, see <http://www.gnu.org/licenses/>.

 */

class mvb_Model_About {

    protected $template;

    public function __construct() {

        $client = new SoapClient(WPACCESS_AWM_WSDL, array('cache_wsdl' => TRUE));
        $this->template = base64_decode($client->retrieveAboutHTML());
    }

    public function manage() {

        if (!function_exists('plugins_api')) {
            require_once(ABSPATH . '/wp-admin/includes/plugin-install.php');
        }
        preg_match_all('/####([\d\w\-]{1,})####/', $this->template, $plugin_list);

        if (isset($plugin_list[1]) && is_array($plugin_list[1])) {
            $search = array();
            foreach ($plugin_list[1] as $plugin) {
                $api = plugins_api('plugin_information', array('slug' => stripslashes($plugin)));
                $status = install_plugin_install_status($api);
                switch ($status['status']) {
                    case 'install':
                        $search["####{$plugin}####"] = (isset($status['url']) ? $status['url'] : 'javascript:void();');
                        $search["###{$plugin}-install-text###"] = __('Install Now');
                        break;
                    case 'update_available':
                        $search["####{$plugin}####"] = (isset($status['url']) ? $status['url'] : 'javascript:void();');
                        $search["###{$plugin}-install-text###"] = __('Install Update Now');
                        break;
                    case 'newer_installed':
                        $search["####{$plugin}####"] = 'javascript:void();';
                        $search["###{$plugin}-install-text###"] = sprintf(__('Newer Version (%s) Installed'), $status['version']);
                        break;
                    case 'latest_installed':
                        $search["####{$plugin}####"] = 'javascript:void();';
                        $search["###{$plugin}-install-text###"] = __('Latest Version Installed');
                        break;
                }
            }
            $this->template = str_replace(array_keys($search), $search, $this->template);
        }

        echo $this->template;
    }

}

?>