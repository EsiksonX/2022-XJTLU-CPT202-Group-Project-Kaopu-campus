//这三个全局变量记录用户筛选和排序方法，并通过AJAX传递给Store.php
let sort_type = "comprehensive";
let category_list = "";
let price_list = "";
//这是西交利物浦大学的经纬度
let longitude = 120.7355864;
let latitude = 31.2758371;

//获取当前地理位置经纬度
getposition();
function getposition() {        //获取位置信息
	if (navigator.geolocation) {
		//position_option配置navigator.geolocation.getCurrentPosition方法参数
		let position_option = {
			enableHighAccuracy: true,
			maximumAge: 30000,
			timeout: 5000
		};
		navigator.geolocation.getCurrentPosition(getPositionSuccess, getPositionError, position_option);
	} else {
		alert("Sorry, your device does not support geolocation")
	}
}

function getPositionSuccess(position){
	latitude = position.coords.latitude;
	longitude = position.coords.longitude;
}

function getPositionError(error){
	switch (error.code) {
		case error.TIMEOUT:
			alert("Connection timed out, please try again");
			break;
		case error.PERMISSION_DENIED:
			alert("You have declined the use of location sharing services");
			break;
		case error.POSITION_UNAVAILABLE:
			alert("Failed to get location information");
			break;
	}
}

function sorterClick(){
	let className = document.getElementById("sorter").className;
	if (className === "filter-nav") {
		document.getElementById("sorter").classList.add("open");
		document.getElementById("sortList").classList.add("open");
		document.getElementById("filter").classList.remove("open");
		document.getElementById("filterList").classList.remove("open");
	} else {
		document.getElementById("sorter").classList.remove("open");
		document.getElementById("sortList").classList.remove("open");
	}
}
		
function filterClick(){
	let className = document.getElementById("filter").className;
	if (className === "filter-nav-more") {
		document.getElementById("filter").classList.add("open");
		document.getElementById("filterList").classList.add("open");
		document.getElementById("sorter").classList.remove("open");
		document.getElementById("sortList").classList.remove("open");
	} else {
		document.getElementById("filter").classList.remove("open");
		document.getElementById("filterList").classList.remove("open");
	}
}
		
function sortclick() {
	if (document.getElementById("sort1").classList.contains("active")){
		document.getElementById("sort1").classList.remove("active");
	}
	if (document.getElementById("sort2").classList.contains("active")){
		document.getElementById("sort2").classList.remove("active");
	}
	if (document.getElementById("sort3").classList.contains("active")){
		document.getElementById("sort3").classList.remove("active");
	}
	if (document.getElementById("sort4").classList.contains("active")){
		document.getElementById("sort4").classList.remove("active");
	}
	if (document.getElementById("sort5").classList.contains("active")){
		document.getElementById("sort5").classList.remove("active");
	}
}

function categoryclick() {
	if (document.getElementById("fastfood").classList.contains("morefilter-block-selected")){
		document.getElementById("fastfood").classList.remove("morefilter-block-selected");
	}
	if (document.getElementById("drinks").classList.contains("morefilter-block-selected")){
		document.getElementById("drinks").classList.remove("morefilter-block-selected");
	}
	if (document.getElementById("noodles").classList.contains("morefilter-block-selected")){
		document.getElementById("noodles").classList.remove("morefilter-block-selected");
	}
	if (document.getElementById("rice").classList.contains("morefilter-block-selected")){
		document.getElementById("rice").classList.remove("morefilter-block-selected");
	}
	if (document.getElementById("cake").classList.contains("morefilter-block-selected")){
		document.getElementById("cake").classList.remove("morefilter-block-selected");
	}
	if (document.getElementById("barbeque").classList.contains("morefilter-block-selected")){
		document.getElementById("barbeque").classList.remove("morefilter-block-selected");
	}
	if (document.getElementById("hotpot").classList.contains("morefilter-block-selected")){
		document.getElementById("hotpot").classList.remove("morefilter-block-selected");
	}
	if (document.getElementById("spicyboiled").classList.contains("morefilter-block-selected")){
		document.getElementById("spicyboiled").classList.remove("morefilter-block-selected");
	}
	if (document.getElementById("westernfood").classList.contains("morefilter-block-selected")){
		document.getElementById("westernfood").classList.remove("morefilter-block-selected");
	}
	if (document.getElementById("italianfood").classList.contains("morefilter-block-selected")){
		document.getElementById("italianfood").classList.remove("morefilter-block-selected");
	}
	if (document.getElementById("japenesefood").classList.contains("morefilter-block-selected")){
		document.getElementById("japenesefood").classList.remove("morefilter-block-selected");
	}
	if (document.getElementById("cvs").classList.contains("morefilter-block-selected")){
		document.getElementById("cvs").classList.remove("morefilter-block-selected");
	}
	if (document.getElementById("fruit").classList.contains("morefilter-block-selected")){
		document.getElementById("fruit").classList.remove("morefilter-block-selected");
	}
	if (document.getElementById("dumplings").classList.contains("morefilter-block-selected")){
		document.getElementById("dumplings").classList.remove("morefilter-block-selected");
	}
	if (document.getElementById("baozi").classList.contains("morefilter-block-selected")){
		document.getElementById("baozi").classList.remove("morefilter-block-selected");
	}
	if (document.getElementById("breakfest").classList.contains("morefilter-block-selected")){
		document.getElementById("breakfest").classList.remove("morefilter-block-selected");
	}
	if (document.getElementById("stationery").classList.contains("morefilter-block-selected")){
		document.getElementById("stationery").classList.remove("morefilter-block-selected");
	}
}
		
function sort1(){
	sortclick();
	document.getElementById("sort1").classList.add("active");
	document.getElementById("sortName").innerHTML = "Comprehensive Sorting";
	document.getElementById("sorter").classList.remove("open");
	document.getElementById("sortList").classList.remove("open");
	sort_type = "comprehensive";
	getData();
}

function sort2(){
	sortclick();
	document.getElementById("sort2").classList.add("active");
	document.getElementById("sortName").innerHTML = "Closest";
	document.getElementById("sorter").classList.remove("open");
	document.getElementById("sortList").classList.remove("open");
	sort_type = "closest";
	getData();
}
		
function sort3(){
	sortclick();
	document.getElementById("sort3").classList.add("active");
	document.getElementById("sortName").innerHTML = "Higest Rated";
	document.getElementById("sorter").classList.remove("open");
	document.getElementById("sortList").classList.remove("open");
	sort_type = "highest-rated";
	getData();
}
		
function sort4(){
	sortclick();
	document.getElementById("sort4").classList.add("active");
	document.getElementById("sortName").innerHTML = "Lowest Price";
	document.getElementById("sorter").classList.remove("open");
	document.getElementById("sortList").classList.remove("open");
	sort_type = "lowest-price";
	getData();
}
		
function sort5(){
	sortclick();
	document.getElementById("sort5").classList.add("active");
	document.getElementById("sortName").innerHTML = "Highest Price";
	document.getElementById("sorter").classList.remove("open");
	document.getElementById("sortList").classList.remove("open");
	sort_type = "highest-price";
	getData();
}

function fastfood() {
	let id = "fastfood";

	if (document.getElementById(id).classList.contains("morefilter-block-selected")){
		categoryclick();
		category_list = "";
	} else {
		categoryclick();
		document.getElementById(id).classList.add("morefilter-block-selected");
		category_list = id;
	}
	getData();
}

function drinks() {
	let id = "drinks";
	if (document.getElementById(id).classList.contains("morefilter-block-selected")){
		categoryclick();
		category_list = "";
	} else {
		categoryclick();
		document.getElementById(id).classList.add("morefilter-block-selected");
		category_list = id;
	}
	getData();
}

function noodles() {
	let id = "noodles";
	if (document.getElementById(id).classList.contains("morefilter-block-selected")){
		categoryclick();
		category_list = "";
	} else {
		categoryclick();
		document.getElementById(id).classList.add("morefilter-block-selected");
		category_list = id;
	}
	getData();
}

function rice() {
	let id = "rice"
	if (document.getElementById(id).classList.contains("morefilter-block-selected")){
		categoryclick();
		category_list = "";
	} else {
		categoryclick();
		document.getElementById(id).classList.add("morefilter-block-selected");
		category_list = id;
	}
	getData();
}

function cake() {
	let id = "cake"
	if (document.getElementById(id).classList.contains("morefilter-block-selected")){
		categoryclick();
		category_list = "";
	} else {
		categoryclick();
		document.getElementById(id).classList.add("morefilter-block-selected");
		category_list = id;
	}
	getData();
}

function barbeque() {
	let id = "barbeque"
	if (document.getElementById(id).classList.contains("morefilter-block-selected")){
		categoryclick();
		category_list = "";
	} else {
		categoryclick();
		document.getElementById(id).classList.add("morefilter-block-selected");
		category_list = id;
	}
	getData();
}

function hotpot() {
	let id = "hotpot"
	if (document.getElementById(id).classList.contains("morefilter-block-selected")){
		categoryclick();
		category_list = "";
	} else {
		categoryclick();
		document.getElementById(id).classList.add("morefilter-block-selected");
		category_list = id;
	}
	getData();
}

function spicyboiled() {
	let id = "spicyboiled"
	if (document.getElementById(id).classList.contains("morefilter-block-selected")){
		categoryclick();
		category_list = "";
	} else {
		categoryclick();
		document.getElementById(id).classList.add("morefilter-block-selected");
		category_list = id;
	}
	getData();
}

function westernfood() {
	let id = "westernfood"
	if (document.getElementById(id).classList.contains("morefilter-block-selected")){
		categoryclick();
		category_list = "";
	} else {
		categoryclick();
		document.getElementById(id).classList.add("morefilter-block-selected");
		category_list = id;
	}
	getData();
}

function italianfood() {
	let id = "italianfood"
	if (document.getElementById(id).classList.contains("morefilter-block-selected")){
		categoryclick();
		category_list = "";
	} else {
		categoryclick();
		document.getElementById(id).classList.add("morefilter-block-selected");
		category_list = id;
	}
	getData();
}

function japenesefood() {
	let id = "japenesefood"
	if (document.getElementById(id).classList.contains("morefilter-block-selected")){
		categoryclick();
		category_list = "";
	} else {
		categoryclick();
		document.getElementById(id).classList.add("morefilter-block-selected");
		category_list = id;
	}
	getData();
}

function cvs() {
	let id = "cvs"
	if (document.getElementById(id).classList.contains("morefilter-block-selected")){
		categoryclick();
		category_list = "";
	} else {
		categoryclick();
		document.getElementById(id).classList.add("morefilter-block-selected");
		category_list = id;
	}
	getData();
}

function fruit() {
	let id = "fruit"
	if (document.getElementById(id).classList.contains("morefilter-block-selected")){
		categoryclick();
		category_list = "";
	} else {
		categoryclick();
		document.getElementById(id).classList.add("morefilter-block-selected");
		category_list = id;
	}
	getData();
}

function stationery() {
	let id = "stationery"
	if (document.getElementById(id).classList.contains("morefilter-block-selected")){
		categoryclick();
		category_list = "";
	} else {
		categoryclick();
		document.getElementById(id).classList.add("morefilter-block-selected");
		category_list = id;
	}
	getData();
}

function dumplings() {
	let id = "dumplings"
	if (document.getElementById(id).classList.contains("morefilter-block-selected")){
		categoryclick();
		category_list = "";
	} else {
		categoryclick();
		document.getElementById(id).classList.add("morefilter-block-selected");
		category_list = id;
	}
	getData();
}

function baozi() {
	let id = "baozi"
	if (document.getElementById(id).classList.contains("morefilter-block-selected")){
		categoryclick();
		category_list = "";
	} else {
		categoryclick();
		document.getElementById(id).classList.add("morefilter-block-selected");
		category_list = id;
	}
	getData();
}

function breakfest() {
	let id = "breakfest"
	if (document.getElementById(id).classList.contains("morefilter-block-selected")){
		categoryclick();
		category_list = "";
	} else {
		categoryclick();
		document.getElementById(id).classList.add("morefilter-block-selected");
		category_list = id;
	}
	getData();
}

function priceclick() {
	if (document.getElementById("under20").classList.contains("morefilter-block-selected")){
		document.getElementById("under20").classList.remove("morefilter-block-selected");
	}
	if (document.getElementById("20-50").classList.contains("morefilter-block-selected")){
		document.getElementById("20-50").classList.remove("morefilter-block-selected");
	}
	if (document.getElementById("50-70").classList.contains("morefilter-block-selected")){
		document.getElementById("50-70").classList.remove("morefilter-block-selected");
	}
	if (document.getElementById("70-100").classList.contains("morefilter-block-selected")){
		document.getElementById("70-100").classList.remove("morefilter-block-selected");
	}
	if (document.getElementById("100-150").classList.contains("morefilter-block-selected")){
		document.getElementById("100-150").classList.remove("morefilter-block-selected");
	}
	if (document.getElementById("over150").classList.contains("morefilter-block-selected")){
		document.getElementById("over150").classList.remove("morefilter-block-selected");
	}

}

function under20() {
	let id = "under20"
	if (document.getElementById(id).classList.contains("morefilter-block-selected")){
		priceclick();
		price_list = "";
	} else {
		priceclick();
		document.getElementById(id).classList.add("morefilter-block-selected");
		price_list = id;
	}
	getData();
}

function under50() {
	let id = "20-50"
	if (document.getElementById(id).classList.contains("morefilter-block-selected")){
		priceclick();
		price_list = "";
	} else {
		priceclick();
		document.getElementById(id).classList.add("morefilter-block-selected");
		price_list = id;
	}
	getData();
}

function under70() {
	let id = "50-70"
	if (document.getElementById(id).classList.contains("morefilter-block-selected")){
		priceclick();
		price_list = "";
	} else {
		priceclick();
		document.getElementById(id).classList.add("morefilter-block-selected");
		price_list = id;
	}
	getData();
}

function under100() {
	let id = "70-100"
	if (document.getElementById(id).classList.contains("morefilter-block-selected")){
		priceclick();
		price_list = "";
	} else {
		priceclick();
		document.getElementById(id).classList.add("morefilter-block-selected");
		price_list = id;
	}
	getData();
}

function under150() {
	let id = "100-150"
	if (document.getElementById(id).classList.contains("morefilter-block-selected")){
		priceclick();
		price_list = "";
	} else {
		priceclick();
		document.getElementById(id).classList.add("morefilter-block-selected");
		price_list = id;
	}
	getData();
}

function over150() {
	let id = "over150"
	if (document.getElementById(id).classList.contains("morefilter-block-selected")){
		priceclick();
		price_list = "";
	} else {
		priceclick();
		document.getElementById(id).classList.add("morefilter-block-selected");
		price_list = id;
	}
	getData();
}

/**
 * 将小数改为百分数
 * @param point 小数
 * @return {string} 百分数
 */
function toPercent(point){
	var str=Number(point*100).toFixed(1);
	str+="%";
	return str;
}

/* 加载店铺卡片内容
* @param Object store_info 后端传回的店铺信息
* @return string
* */
function StoreContainer(loop) {
	let content = '';
	for (var i = 0; i < loop; i++){
		let rate_percent, a, rate;
		if (store_info[i].rate != null) {
			a = parseFloat(store_info[i].rate);
			rate = parseFloat(store_info[i].rate).toFixed(1);
			rate_percent = toPercent(a/5);
		} else {
			rate_percent = "0%";
			rate = "no rating yet";
		}
		content += `
					<section class="index-container shop-1">
						<div onclick="window.open('http://kaopu-campus.online/KaopuUI/store_detail.html?store_id=${store_info[i].id}','_self')" class="index-shopInfo">
							<div class="logo-container">
								<div class="logo-main">
									<img alt="${store_info[i].name}" class="logo-logo" src="http://kaopu-campus.online/KaopuUI/image/store/${store_info[i].id}/logo.jpg">
								</div>
							</div>
							<div class="index-main">
								<section class="index-line">
									<h3 class="index-shopname">
									<span style="font-size: 15px">${store_info[i].name}</span>
									</h3>
								</section>
								<section class="index-line">
									<div class="index-rateWrap">
										<div class='rating-wrapper index-stars'>
											<div class="rating-gray">
												<img src="image/stars/gray.svg">
											</div>
											<div class="rating-actived" style="width: ${rate_percent}">
												<img src="image/stars/actived.svg">
											</div>
										</div>
										<span class="index-rate" style="font-size:14px">${rate}</span>
									</div>
								</section>
								<section class="index-line">
									<div class="index-moneylimit">
										<span style="font-size:12px;">¥${store_info[i].avg_price} per person</span>
									</div>
									<div class="index-distanceWrap">
										<span style="font-size:12px;">Distance: ${store_info[i].distance}</span>
									</div>
								</section>
							</div>
						</div>
						<div class="index-activityWrap">
							<section class="index-tagLine">
								<span class="mini-tag index-tag">
								"${store_info[i].category}"
									<span class="index-tagGhost mini-tag-ghost" style="color: rgb(102, 102, 102); border-color: rgb(221, 221, 221); font-size:10px;">${store_info[i].category}</span>
								</span>
							</section>
						</div>
					</section>`;
	}
	return content;
}