var purchase = {
    win_height: $(window).height(),
    section: null,
    panel: null,
    shade: null,
    input: null,
    action: 'up',
    maxNum: 0,
    num: 1,
    goods_id: 0,
    close: function(){
        this.shade.removeClass('fade_toggle');
        this.panel.removeClass('active');
        var section = this.section;
        setTimeout(function(){
            section.remove();
        },300);
    },
    show: function(){
        var me = this;
        setTimeout(function(){
            me.shade.addClass('fade_toggle');
            me.panel.addClass('active');
        },10);
    },
    getNum: function(){
       return parseInt(this.input.val());
    },
    setNum: function(num){
        this.num = num;
        this.input.val(this.num);
        return this;
    },
    updateCart: function(){
        if(this.action == 'down' && this.num > 1){
            this.setNum(this.num - 1);
        }else if(this.action == 'up' && this.num < this.maxNum){
            this.setNum(this.num + 1);
        }
    },
    add: function(){
        this.close();
        var data = {};
        data.goods_id = this.goods_id;
        data.num = this.num;
        loading.show('正在加入购物车...');
        $.post('/cart/add',data,function(){
            loading.hide();
        });
        return this;
    },
    setAction: function(action){
        this.action = action;
        return this;
    },
    setPanelHeight: function(height){
        this.panel.css('height',height);
    }
}

$(function(){
    $(window).resize(function(e){
        var cur_win_height = $(this).height();
        if(purchase && purchase.panel.length >= 1 && purchase.win_height > cur_win_height){
            purchase.setPanelHeight('100%');
        }else{
            purchase.setPanelHeight('80%');
        }
    });
    $('.cart_add').live('click',function(){

        var li = $(this).closest('li');
        var image_src = li.find('.product-img img').attr('src');
        var name = li.find('.product_name').text();
        var sku = purchase.maxNum = $(this).data('sku');
        var unit = $(this).data('unit');
        var rule = JSON.parse($(this).data('rule'));
        purchase.goods_id = $(this).data('id');

        var section = purchase.section = $('<section class="product-purchasing"></section>');
        section.append('<div class="all-shade"></div>')
                    .append('<div class="product-panel"></div>');
        purchase.shade = section.find('.all-shade');
        var panel = purchase.panel = section.find('.product-panel');

        //view
        var view = panel.append('<div class="product-view"></div>').find('.product-view');
        view.append('<div class="product-img"></img>');
        view.find('.product-img').append('<img src="' + image_src + '">');
        view.append('<div class="product-info"></div>');
        var view_info = view.find('.product-info');
        view_info.append('<h3 class="product_name">' + name + '</h3>');
        view_info.append('<div class="flex widthScale00 rule"></div>');

        for(var i in rule){
            var price = rule[i].price.split('.');

            var numLabel = '≥' + rule[i].num;
            /*var j = parseInt(i) + 1;
            if(j < rule.length){
                var numLabel =  rule[i].num + '-' + rule[j].num;
            }else{
                var numLabel = '≥' + rule[i].num;
            }*/
            view_info.find('.rule')
                        .append('<div class="flex-1">' +
                                    '<p class="product_price"><sup>￥</sup><em>' + price[0] + '.</em><i>' + price[1] + '</i></p>' +
                                    '<p class="product-purchase_num">' + numLabel + '<unit>' + unit + '</unit></p>' +
                                '</div>');
        }


        //order
        var order = panel.append('<div class="product-order"></div>').find('.product-order');
        order.append('<div class="order-header">' +
                        '<span class="order-title">购买数量：</span>' +
                        '<span class="order-stock">库存<span class="value">' + sku + '</span><span class="unit">' + unit + '</span></span>' +
                    '</div>');
        order.append('<div class="order-action"><div class="amount-control"></div></div>');
        order.find('.amount-control').append('<a class="amount-down pull-left" href="javascript:;"><i class="icon icon-jianhao"></i></a>')
                                            .append('<input class="amount-input pull-left" type="number" pattern="\d*" maxlength="8" value="1"/>')
                                                .append('<a class="amount-up pull-left" href="javascript:;"><i class="icon icon-jiahao"></i></a>');

        purchase.input = order.find('.amount-input');
        var amount_down = order.find('.amount-down');
        var amount_up = order.find('.amount-up');
        amount_down.click(function(){
            purchase.setAction('down').updateCart();
        });
        amount_up.click(function(){
            purchase.setAction('up').updateCart();
        });
        purchase.input.on({
            blur: function(){
                purchase.setAction('input').updateCart();
                purchase.setPanelHeight('80%');
            },
            focus: function(){
                purchase.setPanelHeight('100%');
            }
        });
        purchase.input.blur(function(){
            purchase.setAction('input').updateCart();
        });

        //action
        var action = panel.append('<div class="product-action"></div>').find('.product-action');
        action.append('<div class="flex">' +
                            '<div class="flex-1">' +
                                '<a class="btn btn-primary no-radius btn-block product-ok">确定</a>' +
                            '</div>' +
                    '</div>');
        action.find('.product-ok').click(function(){
            purchase.add();
        });


        //close
        var close = panel.append('<div class="panel-close"><i class="icon icon-cha action-close"></i></div>');

        close.find('.action-close').click(function(){
            purchase.close();
        });

        $('body').append(section);

        purchase.show();
    });

});
