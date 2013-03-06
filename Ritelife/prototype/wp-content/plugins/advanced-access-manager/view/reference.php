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

require_once('../../../../wp-admin/admin.php');
require_once('Zend/Markup.php');
require_once('bbcodes.php');

wp_enqueue_style('aam-treeview', WPACCESS_CSS_URL . 'treeview/jquery.treeview.css');
wp_enqueue_style('aam-reference', WPACCESS_CSS_URL . 'reference.css');
wp_enqueue_script('jquery-treeview', WPACCESS_JS_URL . 'treeview/jquery.treeview.js', array('jquery'));
wp_enqueue_script('jquery-treeedit', WPACCESS_JS_URL . 'treeview/jquery.treeview.edit.js');
wp_enqueue_script('admin-reference', WPACCESS_JS_URL . 'admin-reference.js');

iframe_header('ConfigPress Reference');

$template = mvb_Model_Template::readTemplate(WPACCESS_TEMPLATE_DIR . 'reference.html');
mvb_Model_Label::initConfigPressGuideLabels();

$bbcode = Zend_Markup::factory('Bbcode');

foreach ($bbcode_list as $code => $config) {
    $bbcode->addMarkup(
            $code, Zend_Markup_Renderer_RendererAbstract::TYPE_REPLACE, $config
    );
}

$template = mvb_Model_Label::clearLabels($template, $bbcode);

echo mvb_Model_Template::clearTemplate($template);

iframe_footer();
?>