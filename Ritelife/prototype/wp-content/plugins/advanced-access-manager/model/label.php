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

/**
 * Labels Model Class
 *
 * @package AAM
 * @subpackage Models
 * @author Vasyl Martyniuk <martyniuk.vasyl@gmail.com>
 * @copyright Copyright © 2011 Vasyl Martyniuk
 * @license GNU General Public License {@link http://www.gnu.org/licenses/}
 */
class mvb_Model_Label {

    /**
     * Labels container
     *
     * @var array
     * @access public
     */
    public static $labels = array();

    /**
     * Indicator that GUI Labels already been initialized
     *
     * @access protected
     * @var boolean
     */
    protected static $gui_flag = FALSE;

    /**
     * Indicator that Capability Lables already been initialized
     *
     * @access protected
     * @var boolean
     */
    protected static $cap_flag = FALSE;

    /**
     * Initialize ALL Labels with current system language
     *
     * @access public
     */
    public static function initAllLabels() {

        self::initGUILabels();
        self::initCapabilityLabels();
    }

    /**
     * Initialize labels related to Grafic Interface under
     * Access Manager page in backend
     *
     * @access public
     */
    public static function initGUILabels() {

        if (self::$gui_flag){ return FALSE;}

        self::$labels['LABEL_1'] = __('Advanced Access Manager', 'aam');
        self::$labels['LABEL_2'] = __('Basic version does not allow to setup more then %s restrictions. Please upgrade AAM. <a href="%s" target="_blank">More...</a>', 'aam');
        self::$labels['LABEL_3'] = __('Alert', 'aam');
        self::$labels['LABEL_6'] = __('Options updated successfully', 'aam');
        self::$labels['LABEL_7'] = __('Main Menu', 'aam');
        self::$labels['LABEL_8'] = __('Metaboxes & Widgets', 'aam');
        self::$labels['LABEL_9'] = __('Capabilities', 'aam');
        self::$labels['LABEL_10'] = __('Posts & Taxonomies', 'aam');
        self::$labels['LABEL_11'] = __('Drag and Drop Menu in the List and click <b>Save Order</b>', 'aam');
        self::$labels['LABEL_12'] = __('Reorganize', 'aam');
        self::$labels['LABEL_13'] = __('Whole Branch', 'aam');
        self::$labels['LABEL_14'] = __('To initialize list of metaboxes manually, copy and paste the URL to edit screen page (e.g. http://localhost/wp-admin/post.php?post=1&action=edit) into text field and click "Initiate URL". List of all new metaboxes will be added automatically.', 'aam');
        self::$labels['LABEL_15'] = __('Enter Correct URL', 'aam');
        self::$labels['LABEL_16'] = __('Initialize URL', 'aam');
        self::$labels['LABEL_17'] = __('Refresh List', 'aam');
        self::$labels['LABEL_18'] = __('ID', 'aam');
        self::$labels['LABEL_19'] = __('Priority', 'aam');
        self::$labels['LABEL_20'] = __('Position', 'aam');
        self::$labels['LABEL_21'] = __('Restrict', 'aam');
        self::$labels['LABEL_22'] = __('List of Metaboxes is empty or not initialized.', 'aam');
        self::$labels['LABEL_23'] = __('Initialize the List', 'aam');
        self::$labels['LABEL_24'] = __('Delete Capability', 'aam');
        self::$labels['LABEL_25'] = __('Error', 'aam');
        self::$labels['LABEL_26'] = __('Add New Capability', 'aam');
        self::$labels['LABEL_27'] = __('Add New', 'aam');
        self::$labels['LABEL_28'] = __('Give Administrator\'s List of Capabilities', 'aam');
        self::$labels['LABEL_29'] = __('Administrator', 'aam');
        self::$labels['LABEL_30'] = __('Give Editor\'s List of Capabilities', 'aam');
        self::$labels['LABEL_31'] = __('Editor', 'aam');
        self::$labels['LABEL_32'] = __('Give Author\'s List of Capabilities', 'aam');
        self::$labels['LABEL_33'] = __('Author', 'aam');
        self::$labels['LABEL_34'] = __('Give Contributor\'s List of Capabilities', 'aam');
        self::$labels['LABEL_35'] = __('Contributor', 'aam');
        self::$labels['LABEL_36'] = __('Give Subscriber\'s List of Capabilities', 'aam');
        self::$labels['LABEL_37'] = __('Subscriber', 'aam');
        self::$labels['LABEL_38'] = __('Clear all Capabilities', 'aam');
        self::$labels['LABEL_39'] = __('Clear All', 'aam');
        self::$labels['LABEL_40'] = __('Collapse All', 'aam');
        self::$labels['LABEL_41'] = __('Expand All', 'aam');
        self::$labels['LABEL_42'] = __('Error during saving', 'aam');
        self::$labels['LABEL_59'] = __('Apply Restrictions Only for Current Role/User', 'aam');
        self::$labels['LABEL_60'] = __('Apply', 'aam');
        self::$labels['LABEL_61'] = __('Apply Restrictions for All Roles', 'aam');
        self::$labels['LABEL_62'] = __('Apply for All', 'aam');
        self::$labels['LABEL_71'] = __('Select Post, Page or Taxonomy.', 'aam');
        self::$labels['LABEL_72'] = __('Click to toggle', 'aam');
        self::$labels['LABEL_73'] = __('General', 'aam');
        self::$labels['LABEL_74'] = __('Current Role', 'aam');
        self::$labels['LABEL_75'] = __('Change', 'aam');
        self::$labels['LABEL_76'] = __('OK', 'aam');
        self::$labels['LABEL_77'] = __('Cancel', 'aam');
        self::$labels['LABEL_78'] = __('Restore Default Setting', 'aam');
        self::$labels['LABEL_79'] = __('Frontend Widgets', 'aam');
        self::$labels['LABEL_81'] = __('Saving...', 'aam');
        self::$labels['LABEL_82'] = __('Save', 'aam');
        self::$labels['LABEL_83'] = __('Role Manager', 'aam');
        self::$labels['LABEL_84'] = __('Role List', 'aam');
        self::$labels['LABEL_85'] = __('Add New', 'aam');
        self::$labels['LABEL_86'] = __('Delete', 'aam');
        self::$labels['LABEL_87'] = __('Enter New Role', 'aam');
        self::$labels['LABEL_88'] = __('Add', 'aam');
        self::$labels['LABEL_89'] = __('New Role Created successfully', 'aam');
        self::$labels['LABEL_91'] = __('Role can not be created', 'aam');
        self::$labels['LABEL_97'] = __('Delete Role?', 'aam');
        self::$labels['LABEL_98'] = __('Please confirm deleting Role %s', 'aam');
        self::$labels['LABEL_99'] = __('Save Menu Order', 'aam');
        self::$labels['LABEL_100'] = __('Save Menu Order <b>ONLY</b> for Role %s?', 'aam');
        self::$labels['LABEL_101'] = __('Delete Capability?', 'aam');
        self::$labels['LABEL_102'] = __('Please confirm deleting Capability - <b>%s</b>', 'aam');
        self::$labels['LABEL_103'] = __('Restore Default Settings?', 'aam');
        self::$labels['LABEL_104'] = __('All current settings will be lost. Are you sure?', 'aam');
        self::$labels['LABEL_105'] = __('Apply Setting for ALL Roles?', 'aam');
        self::$labels['LABEL_106'] = __('Do you really want to apply these settings for <b>ALL</b> Roles?', 'aam');
        self::$labels['LABEL_107'] = __('Do not show me this message again.', 'aam');
        self::$labels['LABEL_112'] = __('Classname', 'aam');
        self::$labels['LABEL_113'] = __('Description', 'aam');
        self::$labels['LABEL_114'] = __('Upgrade functionality', 'aam');
        self::$labels['LABEL_115'] = __('Important Message', 'aam');
        self::$labels['LABEL_116'] = __('Dashboard Widgets', 'aam');
        self::$labels['LABEL_117'] = __('No Description found', 'aam');
        self::$labels['LABEL_118'] = __('WARNING', 'aam');
        self::$labels['LABEL_122'] = __('Advanced Access Manager requires WordPress 3.2 or newer. <a href="http://codex.wordpress.org/Upgrading_WordPress">Update now!</a>', 'aam');
        self::$labels['LABEL_123'] = __('Advanced Access Manager requires PHP 5.1.2 or newer', 'aam');
        self::$labels['LABEL_124'] = __('Empty Capability', 'aam');
        self::$labels['LABEL_125'] = __('Current Capability can not be deleted', 'aam');
        self::$labels['LABEL_126'] = __('Super Admin', 'aam');
        self::$labels['LABEL_127'] = __('Unauthorized Action', 'aam');
        self::$labels['LABEL_128'] = __('Options List', 'aam');
        self::$labels['LABEL_130'] = __('Yes', 'aam');
        self::$labels['LABEL_131'] = __('Apply for All', 'aam');
        self::$labels['LABEL_132'] = __('Add Capability', 'aam');
        self::$labels['LABEL_133'] = __('Error appeared during Metabox initialization!', 'aam');
        self::$labels['LABEL_134'] = __('Delete Role', 'aam');
        self::$labels['LABEL_135'] = __('Restore', 'aam');
        self::$labels['LABEL_136'] = __('Current Role can not be restored!', 'aam');
        self::$labels['LABEL_137'] = __('Apply All', 'aam');
        self::$labels['LABEL_138'] = __('Error during information grabbing!', 'aam');
        self::$labels['LABEL_140'] = __('Premium', 'aam');
        self::$labels['LABEL_141'] = __('Create', 'aam');
        self::$labels['LABEL_142'] = __('Do not Create', 'aam');
        self::$labels['LABEL_143'] = __('Change Role', 'aam');
        self::$labels['LABEL_144'] = __('Current Site', 'aam');
        self::$labels['LABEL_145'] = __('cURL library returned empty result. Contact your system administrator to fix this issue.', 'aam');
        self::$labels['LABEL_146'] = __('You are not an active user for current blog. Please click <a href="#" id="add-user-toblog">here</a> to add yourself to current blog as Administrator', 'aam');
        self::$labels['LABEL_147'] = __('<p><span style="color: #FF0000;">PLEASE READ THIS!</span> You entered <b>Advanced Access Manager</b> Option Page.</p>
        <p>This graphic interface allows you to control access to your WordPress Blog. <b>DO NOT</b> try to change settings if you are not sure what you are doing! If you have problems or questions, or just found something weird in a system\'s behavior, <b>PLEASE</b> take a look to <a href="http://wordpress.org/extend/plugins/advanced-access-manager/faq/" target="_blank">FAQ</a> section before asking for support.</p>
        <p>For your safety, after you press <b>OK</b> button, Super Admin Role will be created specifically for your user.</p>
        <p>Users with already defined Super Admin Role will be deprived of it and replaced with Administrator Role</p>
        <p>If you have Multi-Site Setup, you will see the same message again for each new Blog you entered or created.</p>', 'aam');
        self::$labels['LABEL_148'] = __('You have a basic version of AAM. Settings applied only for first ' . WPACCESS_APPLY_LIMIT . ' blogs. Please upgrade AAM by following the <a href="http://whimba.org/advanced-access-manager" target="_blank">link</a>', 'aam');
        self::$labels['LABEL_149'] = __('Basic', 'aam');
        self::$labels['LABEL_152'] = __('Visit whimba.org for more information', 'aam');
        self::$labels['LABEL_153'] = __('empty', 'aam');
        self::$labels['LABEL_154'] = __('Administrator added Successfully', 'aam');
        self::$labels['LABEL_155'] = __('Failed to add new Administrator', 'aam');
        self::$labels['LABEL_156'] = __('Click for more information', 'aam');
        self::$labels['LABEL_80'] = __('ConfigPress', 'aam');
        self::$labels['LABEL_119'] = __('Current User', 'aam');
        self::$labels['LABEL_120'] = __('All Users', 'aam');
        self::$labels['LABEL_121'] = __('Delete current capability', 'aam');
        self::$labels['LABEL_157'] = __('ConfigPress is a flexible way to configure your Access Manager. For more information please click on help button to see ConfigPress Reference Guide.', 'aam');
        self::$labels['LABEL_161'] = __('Click Here for The ConfigPress Reference Notes', 'aam');
        self::$labels['LABEL_162'] = __('Config File is not Writable.', 'aam');
        self::$labels['LABEL_164'] = __('Module Directory is not Writable.', 'aam');
        self::$labels['LABEL_166'] = __('JavaScript Error Appeared on Page. <a href="%s" target="_blank">Ream more...</a>', 'aam');
        self::$labels['LABEL_167'] = __('Only first 5 blog applied.', 'aam');
        self::$labels['LABEL_168'] = __('Read more...', 'aam');
        self::$labels['LABEL_169'] = __('For more information about Capabilities in WordPress, please read the topic <a href="http://codex.wordpress.org/Roles_and_Capabilities" target="_blank">Roles and Capabilities</a>.', 'aam');
        self::$labels['LABEL_170'] = __('Restore', 'aam');
        self::$labels['LABEL_171'] = __('Restore Default Settings', 'aam');
        self::$labels['LABEL_172'] = __('Check Menu or Submenu to restrict or <b>Whole Branch</b> to restrict whole menu.', 'aam');
        self::$labels['LABEL_173'] = __('Save Order', 'aam');
        self::$labels['LABEL_174'] = __('Only Latin letters, numbers and space are allowed. All other symbols will be filtered.<br/>New Capability will be added to Super Admin and Admin Roles automatically.', 'aam');
        self::$labels['LABEL_175'] = __('Enter New Capability', 'aam');
        self::$labels['LABEL_176'] = __('Would you like to restore default restrictions?', 'aam');
        self::$labels['LABEL_177'] = __('Restore Restrictions', 'aam');
        self::$labels['LABEL_178'] = __('Posts in %s', 'aam');
        self::$labels['LABEL_158'] = __('Information', 'aam');
        self::$labels['LABEL_159'] = __('Refresh', 'aam');
        self::$labels['LABEL_160'] = __('Frontend', 'aam');
        self::$labels['LABEL_150'] = __('Backend', 'aam');
        self::$labels['LABEL_151'] = __('List', 'aam');
        self::$labels['LABEL_129'] = __('Exclude', 'aam');
        self::$labels['LABEL_108'] = __('Read', 'aam');
        self::$labels['LABEL_109'] = __('Trash', 'aam');
        self::$labels['LABEL_110'] = __('Delete', 'aam');
        self::$labels['LABEL_111'] = __('Edit', 'aam');
        self::$labels['LABEL_92'] = __('Publish', 'aam');
        self::$labels['LABEL_93'] = __('Comment', 'aam');
        self::$labels['LABEL_94'] = __('Browse', 'aam');

        /*
         * These labels where deleted in previous release so you can use them
         * to define new labels

          self::$labels['LABEL_95'] = __('', 'aam');
          self::$labels['LABEL_96'] = __('', 'aam');
          self::$labels['LABEL_90'] = __('', 'aam');
          self::$labels['LABEL_63'] = __('', 'aam');
          self::$labels['LABEL_64'] = __('', 'aam');
          self::$labels['LABEL_65'] = __('', 'aam');
          self::$labels['LABEL_66'] = __('', 'aam');
          self::$labels['LABEL_67'] = __('', 'aam');
          self::$labels['LABEL_68'] = __('', 'aam');
          self::$labels['LABEL_69'] = __('', 'aam');
          self::$labels['LABEL_70'] = __('', 'aam');
          self::$labels['LABEL_43'] = __('', 'aam');
          self::$labels['LABEL_44'] = __('', 'aam');
          self::$labels['LABEL_45'] = __('', 'aam');
          self::$labels['LABEL_46'] = __('', 'aam');
          self::$labels['LABEL_47'] = __('', 'aam');
          self::$labels['LABEL_48'] = __('', 'aam');
          self::$labels['LABEL_49'] = __('', 'aam');
          self::$labels['LABEL_50'] = __('', 'aam');
          self::$labels['LABEL_51'] = __('', 'aam');
          self::$labels['LABEL_52'] = __('', 'aam');
          self::$labels['LABEL_53'] = __('', 'aam');
          self::$labels['LABEL_54'] = __('', 'aam');
          self::$labels['LABEL_55'] = __('', 'aam');
          self::$labels['LABEL_56'] = __('', 'aam');
          self::$labels['LABEL_57'] = __('', 'aam');
          self::$labels['LABEL_58'] = __('', 'aam');
          self::$labels['LABEL_4'] = __('', 'aam');
          self::$labels['LABEL_5'] = __('', 'aam');
          self::$labels['LABEL_139'] = __('', 'aam');
          self::$labels['LABEL_165'] = __('', 'aam');
          self::$labels['LABEL_163'] = __('', 'aam');
         */

        self::$gui_flag = TRUE;
    }

    /**
     * Initialize labels for Capabilities Tooltips for the Tab
     * Capabilities under Access Manager page in backend
     *
     * @access public
     */
    public static function initCapabilityLabels() {

        if (self::$cap_flag){ return FALSE;}

        self::$labels = array_merge(self::$labels, array(
            'switch_themes' => __('Since 2.0 - Allows access to Administration Panel options: Appearance // Appearance > Themes', 'aam'),
            'edit_themes' => __('Since 2.0 - Allows access to Appearance > Theme Editor to edit theme files.', 'aam'),
            'edit_theme_options' => __('Since 3.0 - Allows access to Administration Panel options:  Appearance > Background // Appearance > Header // Appearance > Menus // Appearance > Widgets // Also allows access to Theme Options pages if they are included in the Theme', 'aam'),
            'update_themes' => __('Since 2.0', 'aam'),
            'edit_published_posts' => __('Since 2.0 - User can edit their published posts (off by default). The core checks the capability edit_posts, but on demand this check is changed to edit_published_posts. If you do not want a user to be able edit his published posts, remove this capability.', 'aam'),
            'edit_others_posts' => __('Since 2.0 - Allows access to Administration Panel options:  Manage > Comments (Lets user delete and edit every comment, see edit_posts above) // User can edit other posts through function get_others_drafts()  // User can see other images in inline-uploading', 'aam'),
            'manage_options' => __('Since 2.0 - Allows access to Administration Panel options:  Settings > General // Settings > Writing // Settings > Writing // Settings > Reading // Settings > Discussion // Settings > Permalinks // Settings > Miscellaneous', 'aam'),
            'install_themes' => __('Since 2.0 - Allows access to Administration Panel option: Appearance > Add New Themes', 'aam'),
            'activate_plugins' => __('Since 2.0 - Allows access to Administration Panel option: Plugins', 'aam'),
            'edit_plugins' => __('Since 2.0 - Allows access to Administration Panel option:  Plugins > Plugin Editor', 'aam'),
            'install_plugins' => __('Since 2.0 - Allows access to Administration Panel option: Plugins > Add New', 'aam'),
            'edit_users' => __('Since 2.0 - Allows access to Administration Panel option:  Users', 'aam'),
            'edit_files' => __('Since 2.0 - Note: No longer used.', 'aam'),
            'moderate_comments' => __('Since 2.0 - Allows users to moderate comments from the Comments SubPanel (although a user needs the edit_posts Capability in order to access this)', 'aam'),
            'reply_comment' => __('Since 2.0', 'aam'),
            'quick_edit_comment' => __('Since 2.0', 'aam'),
            'unapprove_comment' => __('Since 2.0', 'aam'),
            'unspam_comment' => __('Since 2.0', 'aam'),
            'untrash_comment' => __('Since 2.0', 'aam'),
			'manage_categories' => __('Since 2.0 - Allows access to Administration Panel options: Posts > Categories // Links > Categories', 'aam'),
            'manage_links' => __('Since 2.0 - Allows access to Administration Panel options:  Links // Links > Add New', 'aam'),
            'upload_files' => __('Since 2.0 - Allows access to Administration Panel options: Media // Media > Add New', 'aam'),
            'import' => __('Since 2.0 - Allows access to Administration Panel options:  Tools > Import // Tools > Export', 'aam'),
            'unfiltered_html' => __('Since 2.0 - Allows user to post HTML markup or even JavaScript code in pages, posts, and comments. Note: Enabling this option for untrusted users may result in their posting malicious or poorly formatted code.', 'aam'),
            'edit_posts' => __('Since 2.0 - Allows access to Administration Panel options:  Posts - Posts > Add New // Comments // Comments > Awaiting Moderation', 'aam'),
            'publish_posts' => __('Since 2.0 - See and use the PUBLISH button when editing their post (otherwise they can only save drafts).  Can use XML-RPC to publish (otherwise they get a… Sorry, you can not post on this weblog or category.)', 'aam'),
            'publish_pages' => __('Since 2.1', 'aam'),
            'edit_pages' => __('Since 2.0 - Allows access to Administration Panel options: Pages - Pages > Add New', 'aam'),
            'edit_permalink' => __('Since 2.1', 'aam'),
            'read' => __('Since 2.0 - Allows access to Administration Panel options:  Dashboard - Users > Your Profile // Used only in menu.php', 'aam'),
            'edit_others_pages' => __('Since 2.1', 'aam'),
            'edit_published_pages' => __('Since 2.1', 'aam'),
            'edit_published_pages_2' => __('Since 2.1', 'aam'),
            'delete_pages' => __('Since 2.1', 'aam'),
            'delete_others_pages' => __('Since 2.1', 'aam'),
            'delete_published_pages' => __('Since 2.1', 'aam'),
            'delete_posts' => __('Since 2.1', 'aam'),
            'delete_others_posts' => __('Since 2.1', 'aam'),
            'delete_published_posts' => __('Since 2.1', 'aam'),
            'delete_private_posts' => __('Since 2.1', 'aam'),
            'edit_private_posts' => __('Since 2.1', 'aam'),
            'read_private_posts' => __('Since 2.1', 'aam'),
            'delete_private_pages' => __('Since 2.1', 'aam'),
            'edit_private_pages' => __('Since 2.1', 'aam'),
            'read_private_pages' => __('Since 2.1', 'aam'),
            'delete_users' => __('Since 2.1', 'aam'),
            'create_users' => __('Since 2.1', 'aam'),
            'unfiltered_upload' => __('Since 2.3', 'aam'),
            'edit_dashboard' => __('Since 2.5', 'aam'),
            'update_plugins' => __('Since 2.6', 'aam'),
            'delete_plugins' => __('Since 2.6', 'aam'),
            'update_core' => __('Since 3.0', 'aam'),
            'list_users' => __('Since 3.0', 'aam'),
            'remove_users' => __('Since 3.0', 'aam'),
            'add_users' => __('Since 3.0', 'aam'),
            'promote_users' => __('Since 3.0', 'aam'),
            'delete_themes' => __('Since 3.0', 'aam'),
            'export' => __('Since 3.0', 'aam'),
            'edit_comment' => __('Since 3.1', 'aam'),
            'manage_sites' => __('Since 3.0 - Multi-site only.  Allows access to Network Sites menu // Allows user to add, edit, delete, archive, unarchive, activate, deactivate, spam and unspam new site/blog in the network', 'aam'),
            'manage_network_users' => __('Since 3.0 - Multi-site only. Allows access to Network Users menu', 'aam'),
            'manage_network_themes' => __('Since 3.0 - Multi-site only. Allows access to Network Themes menu', 'aam'),
            'manage_network_options' => __('Since 3.0 - Multi-site only
				Allows access to Network Options menu', 'aam'),
            'level_0' => __('User Level 0 converts to Subscriber', 'aam'),
            'level_1' => __('User Level 1 converts to Contributor', 'aam'),
            'level_2' => __('User Level 2 converts to Author', 'aam'),
            'level_3' => __('User Level 3 converts to Author', 'aam'),
            'level_4' => __('User Level 4 converts to Author', 'aam'),
            'level_5' => __('User Level 5 converts to Editor', 'aam'),
            'level_6' => __('User Level 6 converts to Editor', 'aam'),
            'level_7' => __('User Level 7 converts to Editor', 'aam'),
            'level_8' => __('User Level 8 converts to Administrator', 'aam'),
            'level_9' => __('User Level 9 converts to Administrator', 'aam'),
            'level_10' => __('User Level 10 converts to Administrator', 'aam'),
            'publish_pages' => __('Description does not exist', 'aam'),
            'administrator' => __('Description does not exist', 'aam'),
            'update_themes' => __('Description does not exist', 'aam'),
            'trash_comment' => __('Allow trash comment. Is available only for Premium Version.', 'aam'),
            'approve_comment' => __('Allow approve comment. Is available only for Premium Version.', 'aam'),
            'delete_comment' => __('Allow delete comment. Is available only for Premium Version.', 'aam'),
            'spam_comment' => __('Allow mark comment as spam. Is available only for Premium Version.', 'aam'))
        );

        self::$cap_flag = TRUE;
    }

    /**
     * Initialize labels for ConfigPress Guide Reference
     * Overwrite all other labels in fact this is separate
     * screen
     *
     * @access public
     */
    public static function initConfigPressGuideLabels() {

        self::$labels['LABEL_1'] = __('Introduction', 'aam');
        self::$labels['LABEL_2'] = __('Basic Idea', 'aam');
        self::$labels['LABEL_3'] = __('Syntax', 'aam');
        self::$labels['LABEL_4'] = __('Reference', 'aam');
        self::$labels['LABEL_5'] = __('AAM Section', 'aam');
        self::$labels['LABEL_6'] = __('Backend Section', 'aam');
        self::$labels['LABEL_7'] = __('Frontend Section', 'aam');
        self::$labels['LABEL_8'] = __('[p]Select a topic from Guide Reference Tree.[/p]', 'aam');
        self::$labels['LABEL_9'] = __('[p]ConfigPress was designed for advanced WordPress Users or Developers. Mainly it is used to configure some very specific AAM features which go out of GUI (Graphic User Interface).[/p]', 'aam');
        self::$labels['LABEL_10'] = __('[p]There are three major configuration parts to deal with: comments, sections and parameters.[/p][p][b]Comments[/b]
        It is good practice to leave some comments about parameters and values you specified. That is why comments are very important part. Comment starts from semicolon [b];[/b] and ends in the end of line:
        [section][aam][/section]
            [comment];specify callback function to check if user has access to delete capabilities[/comment]
            delete_capabilities.userFunc = [value]"checkUser::hasDeleteCap"[/value][/p][p][b]Sections[/b]
        All ConfigPress parameters are grouped by section. Section starts from open [b][[/b] and ends by closing [b]][/b]
        [section][aam][/section]
        [section][backend][/section][/p][p][b]Parameters[/b]
        Each Parameter should belong to section and it allows to have only alphanumeric symbols, underscore or dash. Also all parameters follow the same logic. It means you can define userFunc for anyone.
        [section][aam][/section]
        error_reporting = [value]"true"[/value][/p]', 'aam');
        self::$labels['LABEL_11'] = __('[p]AAM is a section for internal plugin features.[/p]', 'aam');
        self::$labels['LABEL_12'] = __('[p]Advanced Access Manager has internal caching for User\'s and Role\'s configurations. By default caching is turned on.[/p]
        [section][aam][/section]
        caching = [value]"true"[/value]', 'aam');
        self::$labels['LABEL_13'] = __('[p]This is additional protection layout in fact capabilities are the most important part of access management in WordPress. By default it is false.[/p]
        [section][aam][/section]
        delete_capabilities = [value]"false"[/value]', 'aam');
        self::$labels['LABEL_14'] = __('[p]Deprecated and Removed in release 1.6.5.1 (Beta)[/p][p]Use Advanced Access Manager error reporting feature and log all errors, related to this plugin to internal error log. By default is true.[/p][section][aam][/section]
        error_reporting = [value]"true"[/value]', 'aam');
        self::$labels['LABEL_15'] = __('[p]Group of settings for multisite support.[/p]', 'aam');
        self::$labels['LABEL_16'] = __('[p]If there is a lot of sites on multisite setup, you have possibility to apply configurations to all sites. It may duplicate Admin Menu, Menu Order, Metaboxes and Widgets, Capabilities, User Roles and Restrictions. Please notice that this feature is limited for basic version of Advanced Access Manager. By default it is false.[/p][section][aam][/section]
        multisite.apply_all = [value]"false"[/value]', 'aam');
        self::$labels['LABEL_17'] = __('[p]Group Pages into Categories. It works the same way as Post Categories. This option is working ONLY for Premium version of Advanced Access Manager. Default value is false.[/p][section][aam][/section]
        page_category = [value]"false"[/value]', 'aam');
        self::$labels['LABEL_18'] = __('[p]If you have purchased premium version for Advanced Access Manager, you have to receive a license key.[/p][section][aam][/section]
        license_key = [value]"2337eb1b9e4c9e8a64ffddf5b5735f9a7c983a26"[/value]', 'aam');
        self::$labels['LABEL_19'] = __('[p]Section to specify Advanced Access Manager behavior in Backend.[/p]', 'aam');
        self::$labels['LABEL_20'] = __('[p]Group of settings for resource access.[/p]', 'aam');
        self::$labels['LABEL_21'] = __('[p]Group of settings for access denied behavior to resource.[/p]', 'aam');
        self::$labels['LABEL_22'] = __('[p]Specify redirect if access is denied for specific resource. This will enforce the redirect to specified URL or if it is userFunc it will execute this function.[/p][p]PLEASE NOTICE! Custom userFunc should die an application or redirect to some URL by sending header, otherwise the application will through the Exception "Unauthorized Action"
            If redirect is valid URL then it\'ll redirect to that URL
            If redirect is number, it\'ll try to redirect to page or post with that ID by using WordPress function get_permalink
            If redirect has property userFunc it\'ll execute the userFunc.[/p][section][backend][/section]
        access.deny.redirect = [value]"5"[/value]', 'aam');
        self::$labels['LABEL_23'] = __('[p]Specify the restriction message if access is denied.[/p][section][backend][/section]
        access.deny.message = [value]"You are not allowed to view this page"[/value]', 'aam');
        self::$labels['LABEL_24'] = __('[p]Section to specify Advanced Access Manager behavior for Frontend.[/p]', 'aam');
        self::$labels['LABEL_25'] = __('[p]Holder for default behavior.[/p]', 'aam');
        self::$labels['LABEL_26'] = __('[p]Holder for taxonomy configurations.[/p]', 'aam');
        self::$labels['LABEL_27'] = __('[p]Holder for post configurations.[/p]', 'aam');
        self::$labels['LABEL_28'] = __('[p]Specify default listing. It means allow or deny listing post or taxonomy.[/p][section][backend][/section]
        access.taxonomy.default.list = [value]"deny"[/value]', 'aam');
        self::$labels['LABEL_29'] = __('Not commented yet.', 'aam');
        self::$labels['LABEL_30'] = __('Not commented yet.', 'aam');
        self::$labels['LABEL_31'] = __('Not commented yet.', 'aam');
        self::$labels['LABEL_32'] = __('Not commented yet.', 'aam');
        self::$labels['LABEL_33'] = __('Not commented yet.', 'aam');
        self::$labels['LABEL_34'] = __('Not commented yet.', 'aam');
        self::$labels['LABEL_35'] = __('Not commented yet.', 'aam');
        self::$labels['LABEL_36'] = __('Collapse All', 'aam');
        self::$labels['LABEL_37'] = __('Expand All', 'aam');
        self::$labels['LABEL_38'] = __('[p]Define what information should be transfered to all sites. This is a possible set of parameters.[/p][section][aam][/section]
            multisite.apply[] = [value]"menu"[/value]
            multisite.apply[] = [value]"menu_order"[/value]
            multisite.apply[] = [value]"metaboxes"[/value]
            multisite.apply[] = [value]"capabilities"[/value]
            multisite.apply[] = [value]"current_role"[/value]
            multisite.apply[] = [value]"role_list"[/value][p]Default is menu, menu_order, metaboxes, capabilities, current_role.[/p]', 'aam');
        self::$labels['LABEL_39'] = __('[p]Define a site which will be used as default settings holder for newely created sites.[/p][section]aam[/section]
            multisite.default_site = [value]"1"[/value]', 'aam');
    }

    /**
     * Get list of labels for JavaScript
     *
     * @access public
     */
    public static function getJSLocalization() {

        self::initGUILabels();

        return array(
            'LABEL_11' => self::get('LABEL_11'),
            'LABEL_12' => self::get('LABEL_12'),
            'LABEL_24' => self::get('LABEL_24'),
            'LABEL_25' => self::get('LABEL_25'),
            'LABEL_76' => self::get('LABEL_76'),
            'LABEL_77' => self::get('LABEL_77'),
            'LABEL_91' => self::get('LABEL_91'),
            'LABEL_98' => self::get('LABEL_98'),
            'LABEL_97' => self::get('LABEL_97'),
            'LABEL_99' => self::get('LABEL_99'),
            'LABEL_100' => self::get('LABEL_100'),
            'LABEL_101' => self::get('LABEL_101'),
            'LABEL_102' => self::get('LABEL_102'),
            'LABEL_103' => self::get('LABEL_103'),
            'LABEL_104' => self::get('LABEL_104'),
            'LABEL_108' => self::get('LABEL_108'),
            'LABEL_109' => self::get('LABEL_109'),
            'LABEL_114' => self::get('LABEL_114'),
            'LABEL_130' => self::get('LABEL_130'),
            'LABEL_131' => self::get('LABEL_131'),
            'LABEL_132' => self::get('LABEL_132'),
            'LABEL_133' => self::get('LABEL_133'),
            'LABEL_134' => self::get('LABEL_134'),
            'LABEL_135' => self::get('LABEL_135'),
            'LABEL_136' => self::get('LABEL_136'),
            'LABEL_137' => self::get('LABEL_137'),
            'LABEL_138' => self::get('LABEL_138'),
            'LABEL_141' => self::get('LABEL_141'),
            'LABEL_142' => self::get('LABEL_142'),
            'LABEL_143' => self::get('LABEL_143'),
            'LABEL_166' => self::get('LABEL_166'),
            'LABEL_115' => self::get('LABEL_115'),
            'LABEL_147' => self::get('LABEL_147'),
            'LABEL_166' => sprintf(self::get('LABEL_166'), WPACCESS_ERROR166_URL),
            'LABEL_172' => self::get('LABEL_172'),
            'LABEL_173' => self::get('LABEL_173'),
            'LABEL_177' => self::get('LABEL_177'),
            'LABEL_176' => self::get('LABEL_176'),
        );
    }

    /**
     * Get label from store
     *
     * @param string $label
     * @return string|bool
     */
    public static function get($label) {

        return (isset(self::$labels[$label]) ? self::$labels[$label] : FALSE);
    }

    /**
     * Clear template from labels
     *
     * @param type $template
     * @return type
     */
    public static function clearLabels($template, $bbcode = NULL) {

        //try to replace all labels
        $l_list = array();
        $i = 1;
        for ($i = 1; $i <= 300; $i++) {
            if (($label = self::get('LABEL_' . $i)) !== FALSE) {
                $l_list['###LABEL_' . $i . '###'] = (is_null($bbcode) ? $label : $bbcode->render($label));
            }
        }

        return mvb_Model_Template::updateMarkers($l_list, $template);
    }

}

?>