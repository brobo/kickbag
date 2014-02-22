var KB_ENTER = 13;

$(function() {
	$('#student_table').dataTable( {
      "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 1 ] }
       ],
       "iDisplayLength": 5
	});
	
	$('#scan_space').on('paste', function() {setTimeout(onFinishedTyping, 1);});
	$('#scan_space').on('keypress', function(e) {setTimeout(function() {
		if (e.which == KB_ENTER) onFinishedTyping();
		else $('#BarcodeCode').val($('#scan_space').val());
	});})
})

function onFinishedTyping() {
	var input = $('#scan_space');
	$.post("barcodes/search", {search: input.val()}, function(data) {
		result = $.parseJSON(data);
		if (!$.isEmptyObject(result) && data != '"nope"') {
			$('#student_info').html('<h3>That barcode belongs to <a href="' + result['url'] + '">' + result['name'] + '</a></h3>');
			$('#student_select').hide();
			$('#student_info').show();
		} else {
			$('#student_info').hide();
			$('#student_select').show();
		}
	});
}

