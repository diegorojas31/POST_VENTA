/*Invoice Init*/
"use strict"; 
$(function() {
	/*DataTable Init*/
	if ($("#datable_1").length > 0) {
		/*Checkbox Add*/
		var tdCnt=0;
		$('table tr').each(function(){
			$('<span class="form-check mb-0"><input type="checkbox" class="form-check-input check-select" id="chk_sel_'+tdCnt+'"><label class="form-check-label" for="chk_sel_'+tdCnt+'"></label></span>').appendTo($(this).find("td:first-child"));
			tdCnt++;
		});
		$("div.invoice-toolbar-left").html('<div class="d-xxl-flex d-none align-items-center"> <select class="form-select form-select-sm w-120p"><option selected>Bulk actions</option><option value="1">Edit</option><option value="2">Move to trash</option></select> <button class="btn btn-sm btn-light ms-2">Apply</button></div><div class="d-xxl-flex d-none align-items-center form-group mb-0"> <label class="flex-shrink-0 mb-0 me-2">Sort by:</label> <select class="form-select form-select-sm w-130p"><option selected>Date Created</option><option value="1">Date Edited</option><option value="2">Frequent Contacts</option><option value="3">Recently Added</option> </select></div> <select class="d-flex align-items-center w-130p form-select form-select-sm"><option selected>Export to CSV</option><option value="2">Export to PDF</option><option value="3">Send Message</option><option value="4">Delegate Access</option> </select>');
		$("#datable_1").parent().addClass('table-responsive');
		/*Select all using checkbox*/
		var  DT1 = $('#datable_1').DataTable();
		$(".check-select-all").on( "click", function(e) {
			$('.check-select').attr('checked', true);
			if ($(this).is( ":checked" )) {
				DT1.rows().select();    
				$('.check-select').prop('checked', true);			
			} else {
				DT1.rows().deselect(); 
				$('.check-select').prop('checked', false);
			}
		});
		$(".check-select").on( "click", function(e) {
			if ($(this).is( ":checked" )) {
				$(this).closest('tr').addClass('selected');        
			} else {
				$(this).closest('tr').removeClass('selected');
				$('.check-select-all').prop('checked', false);
			}
		});
	}
});