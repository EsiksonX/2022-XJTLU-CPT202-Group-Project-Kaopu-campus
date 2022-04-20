/**
 * 向后端发送查看的类型并返回后端传回数据
 * @param type recommend或follow
 */
function getData(type){
    $.ajax({
        type: "POST",
        url: "http://kaopu-campus.online/kaopuUI/php/Discover.php",
        data: `type=${type}`,
        success: function (data){
            if (data === "notlogin") {
                alert("You are not logged in, please log in first");
                window.open("http://kaopu-campus.online/kaopuUI/login.php");
            } else {
                try {
                    let post_data = jQuery.parseJSON(data);
                    let size = post_data.length;
                    $("#home").html(StoreContainer(post_data, size));
					getLiks();
                } catch (err) {
                    alert("no data");
                }
            }
        },
        async: false
    });
}

/**
 * 将数据添加到html中
 * @return string 返回的html
 * @param object ajax传回的对象
 * @param length 传回的对象数组的长度
 */
function StoreContainer(object, length){
    let content = '';
    for (var i = 0; i < length; i++){
        let a
        if (object[i].likes == null) a = 0;
        else a = parseInt(object[i].likes);
        content += `
            <div class="item" _tid=${object[i].PostID}>
                <div class="item-top">
                    <img src="${object[i].image1}" alt="" onclick="window.open('http://kaopu-campus.online/kaopuUI/dongtai_detail.html?pid=${object[i].PostID}','_self')">
                </div>
                <div class="item-cc">
                    <div class="title">${object[i].title}</div>
                    <div class="info">
                        <div class="avatar">
                            <img src="${object[i].head}" alt="">
                        </div>
                        <div class="name">${object[i].owner}</div>
                        <div class="love">
                            <img src="http://kaopu-campus.online/kaopuUI/image/svg/like.svg" alt="" onclick="dianzan(${object[i].PostID})">
                        </div>
                        <div class="count">0</div>
                    </div>
                </div>
            </div>`;
    }
    return content;
}

function dianzan(PostID){
	mui.init();
	mui.ajax('http://kaopu-campus.online/kaopuUI/think/public/Likes',{
		data:{
			'comment':PostID,
			'user':'',
		},
		type: 'post',
		dataType: "json",
		timeout: 10000,
		headers: {'Content-Type': 'application/json'},
		success: function (data) {
			alert('Thumb up success');
			getLiks();
		},
		error: function (xhr, type, errorThrown) {
			console.log(type);
		}
	});
}

function getLiks(){
	mui.init();
	let obj = {};
	mui.ajax('http://kaopu-campus.online/kaopuUI/think/public/Likes',{
		type: 'get',
		dataType: "json",
		timeout: 10000,
		headers: {'Content-Type': 'application/json'},
		success: function (data) {
			for(let i=0;i<data.length;i++){
				const da = data[i];
				const comment = da['comment'];
				if(typeof obj[comment] == 'undefined'){
					obj[comment] = 1;
				}else{
					obj[comment] = obj[comment] + 1;
				}
			}
			$('#home .item').each(function(){
				const tid = $(this).attr('_tid');
				const count = obj[tid];
				$(this).find('.count').text(count);
			});
		},
		error: function (xhr, type, errorThrown) {
			console.log(type);
		}
	});
}

function clean_open(){
    if (document.getElementById("Recommend").classList.contains("open")){
        document.getElementById("Recommend").classList.remove("open");
    }
    if (document.getElementById("Follow").classList.contains("open")){
        document.getElementById("Follow").classList.remove("open");
    }
}

function Recommend(){
    clean_open();
    document.getElementById("Recommend").classList.add("open");
    getData("recommend");
}

function Follow(){
    clean_open();
    document.getElementById("Follow").classList.add("open");
    try {
        getData("follow");
    } catch (SyntaxError){
        alert("You are not logged in, please log in first");
        window.open("http://kaopu-campus.online/kaopuUI/login.html");
    }
}