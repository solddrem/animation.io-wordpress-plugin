(function() {
    tinymce.create('tinymce.plugins.animation', {
        init : function(ed, url) {
            ed.addButton('animation', {
                title : 'Add Animation.io',
                image : url+'/animation-icon.png',
                onclick : function() {
					ed.windowManager.open({
						file : url + '/animation-window.php',
						width : 680,
						height : 480,
						inline : 1
					});					 

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('animation', tinymce.plugins.animation);
})();