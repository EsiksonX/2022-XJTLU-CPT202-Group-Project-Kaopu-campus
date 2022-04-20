
/**
 * Get it all from the back end guide
 */
function getData(){
    $.ajax({
        type: "GET",
        url: "http://kaopu-campus.online/kaopuUI/php/Guide.php",
        success: function (data){
            try {
                let post_data = jQuery.parseJSON(data);
                let size = post_data.length;
                $("#tutorial").html(StoreContainer(post_data, size));
            } catch (err) {
                alert("no data");
            }

        },
        async: false
    });
}

/**
 * Add data to HTML
 * @return string return html
 * @param object ajax returned object
 * @param length The length of the array of objects returned
 */
function StoreContainer(object, length){
    let content = '';
    for (var i = 0; i < length; i++){
        content += `
            <li class="mui-table-view-cell mui-media">
                <a href="http://kaopu-campus.online/kaopuUI/Guide_detail.html?guide_id=${object[i].id}">
                <img class="mui-media-object mui-pull-left" src="${object[i].image}">
                    <div class="mui-media-body">
                        <div class="mui-media-body">${object[i].title}</div>
                        <p class="mui-ellipsis">${object[i].article.substring(0, 100)}</p>
                    </div>
                </a>
            </li>`;
    }
    return content;
}
