   mui.init();
   mui.plusReady(function(){
    var pages = ["Guide.html","Store.html","fadongtai.html","index.html","Me.html"];
    var ws = plus.webview.currentWebview();
    var pageStyle = {
     top:"0px",
     bottom:"50px"
    };
    for(var i = 0;i<pages.length;i++){
     var item = plus.webview.create(pages[i],pages[i],pageStyle);
     ws.append(item);
    }
    plus.webview.show(pages[0]);
    mui(".mui-bar-tab").on("tap"."a",function(){
     var href = this.getAttribute("href");
     plus.webview.show(herf);
    });
    });