/*
  Copyright (C) <2011>  Vasyl Martyniuk  <whimba@gmail.com>

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
function aamms_multisite_support_object(){}aamms_multisite_support_object.prototype.prepareURL=function(){var a=jQuery.url();a.sparam("site",jQuery("#site").val());return a.compileURL()};aamms_multisite_support_object.prototype.redirect=function(){window.location=this.prepareURL()}; jQuery(document).ready(function(){aamms_multisite_supportObj=new aamms_multisite_support_object;jQuery(".change-site").bind("click",function(a){a.preventDefault();jQuery("div #site-select").show();jQuery(this).hide()});jQuery("#site-ok").bind("click",function(a){a.preventDefault();0<mObj.formChanged?jQuery("#leave-confirm").dialog({resizable:!1,height:180,modal:!0,buttons:{"Change Site":function(){jQuery(this).dialog("close");aamms_multisite_supportObj.redirect()},Cancel:function(){jQuery(this).dialog("close")}}}): aamms_multisite_supportObj.redirect()});jQuery("#site-cancel").bind("click",function(a){a.preventDefault();jQuery("div #site-select").hide();jQuery(".change-site").show()});jQuery("#site").bind("change",function(){mObj.formChanged--});jQuery("#add-user-toblog").bind("click",function(a){a.preventDefault();jQuery.post(wpaccessLocal.ajaxurl,{action:"mvbam",sub_action:"add_blog_admin",_ajax_nonce:wpaccessLocal.nonce},function(a){"success"==a.status?(window.location.reload(!0),mObj.success_message(a.message)): mObj.failed_message(a.message)}," json")})});