$(document).ready(function() {
	KHAYR_MAIN_COMMENT_ShowMessage();
	$("#KHAYR_MAIN_COMMENT_container").on("click", ".nav a", function() {
		BX.showWait();
		$.post($(this).attr("href"), {"ACTION": "nav", "clear_cache": "Y"}, function(result) {
			$("#KHAYR_MAIN_COMMENT_container").html(result);
			BX.closeWait();
		});
		return false;
	});
});

/*
в дальнейшем применим это...
console.log(window.location);
var link = document.createElement('a');
link.href = '//ya.ru/?q=1';
console.log(link.search);
var query = {};
'?sd=fdg&fd=&&sd=8'.substring(1).split('&').forEach(function(value) {
    value = value.split('=');

    if (value[0] in query) {
        if (!(query[value[0]] instanceof Array))
            query[value[0]] = [query[value[0]]];

        query[value[0]].push(value[1]);
    } else
        query[value[0]] = value[1];
});
query;
*/
function KHAYR_MAIN_COMMENT_validate(_this, pagen)
{
	if (!pagen)
		pagen = '';
	else
		pagen = '&PAGEN_'+pagen;
    console.log(_this);
	BX.showWait();
	$.ajax({
        url: $(_this).attr("action") + "?clear_cache=Y" + pagen,
        type: 'POST',
		data: new FormData(_this),
		processData: false,
		contentType: false,
        success: function(result) {
			$("#KHAYR_MAIN_COMMENT_container").html(result);
			BX.closeWait();
			KHAYR_MAIN_COMMENT_ShowMessage();
		},
        error: function() {}
    });
	return false;
}

function KHAYR_MAIN_COMMENT_delete(_this, id, message, pagen)
{
	if (!pagen)
		pagen = '';
	else
		pagen = '&PAGEN_'+pagen;
	if (!message)
		var message = "DELETE?";
	if (confirm(message))
	{
		BX.showWait();
		$(_this).parents(".stock:first").hide("slow");
		$.post(location.pathname + "?clear_cache=Y" + pagen, {"ACTION": "delete", "COM_ID": id, "clear_cache": "Y"}, function(data) {
			$("#KHAYR_MAIN_COMMENT_container").html(data);
			BX.closeWait();
			KHAYR_MAIN_COMMENT_ShowMessage();
		});
	}
	return false;
}
function KHAYR_MAIN_COMMENT_edit(_this, id)
{
	$(".main_form").hide();
	$(".form_for").hide();
	$("#edit_form_"+id).show();
}
function KHAYR_MAIN_COMMENT_add(_this, id)
{
	$(".main_form").hide();
	$(".form_for").hide();
	$("#add_form_"+id).show();
}
function KHAYR_MAIN_COMMENT_back()
{
	$(".main_form").show();
	$(".form_for").hide();
}

var KHAYR_MAIN_COMMENT_action = false;
function KHAYR_MAIN_COMMENT_ShowMessage()
{
	$(".khayr_main_comment_suc_exp, .khayr_main_comment_err_exp").remove();
	var err = $(".err").text();
	var suc = $(".suc").text();
	clearTimeout(KHAYR_MAIN_COMMENT_action);
    
    KHAYR_MAIN_COMMENT_back();
	/*if (err.length > 0)
	{
		var exp = "<div onclick='KHAYR_MAIN_COMMENT_exp_close()' class='khayr_main_comment_err_exp'>"+err+"</div>";
		$("body").prepend(exp);
		$(".khayr_main_comment_err_exp").fadeIn(500);
	}
	else if (suc.length > 0)
	{
		var exp = "<div onclick='KHAYR_MAIN_COMMENT_exp_close()' class='khayr_main_comment_suc_exp'>"+suc+"</div>";
		$("body").prepend(exp);
		$(".khayr_main_comment_suc_exp").fadeIn(500);
	}*/
	
	KHAYR_MAIN_COMMENT_action = setTimeout(function() {
		KHAYR_MAIN_COMMENT_exp_close();
	}, 5000);
}
function KHAYR_MAIN_COMMENT_exp_close()
{
	$(".khayr_main_comment_suc_exp, .khayr_main_comment_err_exp").fadeOut(1000);
	setTimeout(function() {
		$(".khayr_main_comment_suc_exp, .khayr_main_comment_err_exp").remove();
	}, 1000);
}