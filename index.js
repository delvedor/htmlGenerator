/*
 * Project: Html Generator
 * Author: delvedor
 * Site: http://projects.delved.org/htmlGenerator
 * GitHub: https://github.com/delvedor
 */

$(document).ready(function() {

    $('.listComponent').click(function() {
    	//alert($(this).attr('class'));
    	if ($(this).attr('class') !== 'listComponent disable-select selected') {
	    	$(this).addClass('selected');
			addEle(this,$(this).parents().eq(2).attr('id')); // Get the partent id element.
    	} else {
	    	$(this).removeClass('selected');
	    	removeEle(this,$(this).parents().eq(2).attr('id'));
    	}
    });
    
    $("#file-name").keyup(function(){
        setName($(this).val());
    });



});

function addEle(ele, id) {
	$("#"+id+"Component").append($(ele).text()+" "); // Write into the eleComponent list.
	$("input[name='"+id+"Input']").attr("value", $("input[name='"+id+"Input']").attr("value")+"#"+$(ele).attr('id'));
}

function removeEle(ele, id) {
	var idEle = "#"+$(ele).attr('id');
	var idComponentString = $("#"+id+"Component").text();
	var inputComponentString = $("input[name='"+id+"Input']").attr("value");
	idComponentString = idComponentString.replace($(idEle).text(), "");
	inputComponentString = inputComponentString.replace(idEle, "");
	
	$("#"+id+"Component").text(idComponentString);
	$("input[name='"+id+"Input']").attr("value", inputComponentString);
}

function setName(name) {
	$("input[name='filenameInput']").attr("value", name);
}