"use strict";
function Group_Manager(){
    var self= this;
    this.init= function(){
 		self.option();
    };

    this.option = function(){
        Layout.nicescroll();

    	$(".draggable-left, .draggable-right").sortable({
            connectWith: ".connected-sortable",
            stack: ".connected-sortable ul"
        }).disableSelection();

        var he = $('.group-manager-content').height();
        $(".group-manager-box").height(he - 61);

        $(window).resize(function(){
            var _he = $('.group-manager-content').height();
            $(".group-manager-box").height(_he - 61);
        });

        $(".group-name").keyup(function(){
            $("input[name='name']").val($(this).val());
        });

        $(document).on("click", ".saveGroups", function(){
            $(".saveFormGroups").submit();
        });


        $(document).on("click", ".action-groups", function(){
            var _that = $(this);
            var _items = _that.data("item");
            $(".widget .widget-list .widget-item").each(function(){
                var _item = $(this).attr("data-pid");
                if(_item != undefined && _item != ""){
                    var _item_array = _item.split("-");
                    if(_item_array.length > 0){
                        if(_item_array.length == 1){
                            var _item =_item_array[0];
                        }else{
                            var _item =_item_array[1];
                        }

                        $(this).removeClass("active");
                        $(this).find("input").prop('checked', false);

                        if(_items.indexOf(_item) != -1){
                            $(this).addClass("active");
                            $(this).find("input").prop('checked', true);
                        }
                    }
                }
            });
            $('.check-all').prop('checked', false);
        });
    };
}

var Group_Manager = new Group_Manager();
$(function(){
    Group_Manager.init();
});