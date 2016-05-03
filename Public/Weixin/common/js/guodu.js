var loading = {
    show: function(msg){
        $.loading = $('<section class="loading"></section>');
        $.loading.append('<div class="shade"></div>');
        var area = $.loading.append('<div class="loading-area"></div>').find('.loading-area');
        area.append('<img class="loading-img" src="http://m.jiawo.com/resouce/joyviomall/four/images/gungun.gif">');
        if(msg) area.append('<p>' + msg + '</p>');
        $('body').append($.loading);
    },
    hide: function(){
        if($.loading) $.loading.remove();
    }
}