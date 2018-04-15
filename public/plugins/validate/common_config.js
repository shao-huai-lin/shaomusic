    $.validator.setDefaults({
    	highlight : function(a) {
    		$(a).closest(".form-group").removeClass("has-success").addClass(
    				"has-error")
    	},
    	success : function(a) {
    		a.closest(".form-group").removeClass("has-error").addClass(
    				"has-success")
    	},
    	errorElement : "span",
    	errorPlacement : function(a, b) {
    		if (b.is(":radio") || b.is(":checkbox")) {
    			a.appendTo(b.parent().parent().parent())
    		} else {
    			a.appendTo(b.parent())
    		}
    	},
    	errorClass : "help-block m-b-none",
    	validClass : "help-block m-b-none"
    });