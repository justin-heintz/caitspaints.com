( function( $ ) { $(document).on( 'ready post-load', function(){$('#header .page-list a').animate({'opacity':.6});$('#header .page-list a').hover(function(){$(this).stop().animate({'opacity':1})},function(){$(this).stop().animate({'opacity':.6})});$('input[type="text"], textarea').focus(function(){$(this).addClass('fieldFocus')});$('input[type="text"], textarea').blur(function(){$(this).removeClass('fieldFocus')});$('#searchBox button, #commentForm button').hover(function(){$(this).addClass('hoverBtn')},function(){$(this).removeClass('hoverBtn')});$('div.pingback').find('.replyLink').remove();var leftfold='<div class="left-fold"></div>';var rightfold='<div class="right-fold"></div>';var edge='<div class="edge"></div>';var pointer='<div class="pointer"></div>';$('#content .main-title, #content .sub-title, #reply-title, #respond .sub-title-border, #tag-cloud .sub-title').each(function(){$(this).append(leftfold)});$('#content .main-title, #sidebar .sidebar-title').each(function(){$(this).append(edge)});$('#tag-cloud .sub-title, #sidebar .sidebar-title').each(function(){$(this).append(rightfold)});$('#commentList div.comment').each(function(){$(this).append(pointer)});$('#reply-title').wrap('<div class="sub-title-border"></div>');$('#tag-cloud li:last').each(function(){$(this).addClass('last')});$('#sidebar .sidebar-box').each(function(){$(this).find('li:last').addClass('last')});$('#widgetList .sidebar-box').each(function(){$(this).find('li:first').addClass('first')});$.each($('#tag-cloud ul li'),function(e){if(e>-1&e<=7){$(this).addClass('tag-size-1')}
if(e>7&e<=16){$(this).addClass('tag-size-2')}
if(e>16&e<=26){$(this).addClass('tag-size-3')}
if(e>26&e<=35){$(this).addClass('tag-size-4')}
if(e>35&e<=47){$(this).addClass('tag-size-5')}});var divider='<li class="divider"></li>';$('#tag-cloud .tag-size-2:first, #tag-cloud .tag-size-3:first, #tag-cloud .tag-size-4:first, #tag-cloud .tag-size-5:first').before(divider);$('#tag-cloud .tag-size-5:last').after(divider);});
} ) (jQuery)