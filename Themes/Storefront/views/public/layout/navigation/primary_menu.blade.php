<nav class="navbar navbar-expand-sm">
    <ul class="navbar-nav mega-menu horizontal-megamenu" id="navbar-nav-mega-menu-horizontal-megamenu">
    </ul>
</nav>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>
    $.ajax({
        url     : "/storefront/menus",
        type    : "get",
        success : function (data) {
            let menustr = "";
            for (let i = 0; i < data.length; i++) {
                menustr += '<li class="nav-item fluid-menu">';
                menustr += '<a href="/categories/' + data[i].slug + '/products" class="nav-link menu-item" target="_blank" data-text="' + data[i].name + '">' + data[i].name;
                menustr += '<i class="las la-angle-right"></i>';
                menustr += '</a>';
                menustr += '<ul class="list-inline fluid-menu-wrap" style="overflow: scroll; height: 700px;"><li>';
                menustr += '<div class="fluid-menu-content">';
                    let items = data[i].items;
                    for (let j = 0; j < items.length; j++) {
                    menustr += '<div class="fluid-menu-list">';
                    menustr += '<h5 class="fluid-menu-title">';
                    menustr += '<a href="/categories/' + items[j].slug + '/products" target="_self">' + items[j].name + '</a>';
                    menustr += '</h5></div>';
                }
                menustr += '</div></li></ul></li>';
            }
            $("#navbar-nav-mega-menu-horizontal-megamenu").html(menustr);
        }
    });
</script>